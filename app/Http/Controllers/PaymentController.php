<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OrderDish;
use App\Models\PaymentTransaction;
use App\Models\PendingTransaction;
use App\Notifications\Order;
use App\Utils\Utils;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    public function responsePayment(){
        $httpClient =new Client();
        $response = $httpClient->get('https://secure.epayco.co/validation/v1/reference/'.request('ref_payco'));
        $data = json_decode($response->getBody()->getContents())->data;//Transforma a array porque en el response tambien se usa array y ambos usan el mismo método de procesar el pago
        if(!$this->alreadyProcessed($data)){//si no ha sido procesado el pago
            $this->processPayment($data);
        }

        switch ($data->x_cod_response){
            case 1://Acepted transaction
                return  redirect('successfulPurchase');
            case 2://Rejected
                return redirect('rejectedPurchase');
            case 3://Pending
                return redirect('pendingPurchase');
        }

    }

    private function alreadyProcessed($data){
        $transaccion = PaymentTransaction::where('ref_payco',$data->x_ref_payco) ;
        return $transaccion->exists();
    }

    //ADD DESCRIPTION FROM DATA. data.description
    private function processPayment($data){
        $p_cust_id_cliente = env('EPAYCO_P_CUST_ID_CLIENTE');
        $p_key = env('EPAYCO_P_KEY');
        $x_ref_payco = $data->x_ref_payco;
        $x_transaction_id = $data->x_transaction_id;
        $x_amount = $data->x_amount;
        $x_currency_code = $data->x_currency_code;
        $x_signature = $data->x_signature;
        $signature = hash('sha256', $p_cust_id_cliente . '^' . $p_key . '^' . $x_ref_payco . '^' . $x_transaction_id . '^' . $x_amount . '^' . $x_currency_code);
        $x_response = $data->x_response;
        $x_response_reason_text = $data->x_response_reason_text;
        $x_id_invoice = $data->x_id_invoice;
        $x_autorizacion = $data->x_approval_code;

        //Validamos la firma
        if ($x_signature != $signature) {
            die("Firma no valida");
        }

        $this->saveTransaction($data);
        NotificationController::notify('delivery', $data->x_extra3, $x_amount,$data->x_extra5,"0");

        return response()->json([
            'success' => true,
            'message' => 'transacción procesada'
        ],200);

    }

    private function saveTransaction($data){
        $id = PaymentTransaction::create([
            'ref_payco' => $data->x_ref_payco,
            'response_code' => $data->x_cod_response,
            'response_reason' => $data->x_response_reason_text,
            'data' => json_encode($data),
            'cart' => $data->x_extra1,
            'delivery_name' => $data->x_extra4,
            'status' => $data->x_cod_response == 1 ? 1 : null,//if 1 accepted transaction
        ])->id;
        // Cuando esta pendiente
        if ($data->x_cod_response == 3){
            PendingTransaction::create([
                'transaction_id' => $id,
            ]);
        }
    }
}

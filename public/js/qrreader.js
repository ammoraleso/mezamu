let continueScanning = true;
async function onScanSuccess(qrMessage) {
    if(continueScanning) {
        continueScanning = false;
        try {
            await $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: checkOutUrl,
                data: {
                    token: qrMessage,
                    total: document.getElementById('totalPrice').value,
                    options: document.getElementById('options').value
                },
                type: "post"
            });
        } catch (error) {
            console.log("Error goCheckout put headers" + error);
            continueScanning = true;
            return
        }
        window.location.replace("successfulPurchase");
    }
}

function onScanFailure(error) {
    // handle scan failure, usually better to ignore and keep scanning
}

let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 2, qrbox: 250 }, /* verbose= */ true);//2 fps to avoid multiple call onScanSuccess
html5QrcodeScanner.render(onScanSuccess, onScanFailure);

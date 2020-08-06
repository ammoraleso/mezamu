<?php


namespace App\Utils;


use App\Models\Restaurant;
use App\Models\Branch;
use App\Models\Token;

class Utils
{
    static function verifyBranch(Restaurant $restaurant, $branchName){
        $branch = $restaurant->branches()->where('location',$branchName)->first();
        if(is_null($branch)){
            abort(404);
        }
        return $branch;
    }

    static function getSchedule(Branch $branch, $dayName){
        $schedule = $branch->ScheduleBranch()->where('day',$dayName)->first();
        if(is_null($schedule)){
            abort(404);
        }
        return $schedule;
    }

    static function validateSchedule($branch)
    {
        $schedule = Utils::getSchedule($branch, date("l"));
        date_default_timezone_set('America/Bogota');
        $currentTime = date('H:i:s');
        if ($currentTime >= $schedule->open && $currentTime <= $schedule->close) {
            return true;
        }
        return false;
    }


    static function isTokenValid($token){
        return !is_null(Token::where('token',$token)->first());
        //TODO check date for due tokens
        //TODO GUARDAR EL TOKEN EN LA SESION
    }

    static public function generateUrl()
    {
        $server_name = $_SERVER['SERVER_NAME'];

        if (!in_array($_SERVER['SERVER_PORT'], [80, 443])) {
            $port = ":$_SERVER[SERVER_PORT]";
        } else {
            $port = '';
        }

        if (!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1')) {
            $scheme = 'https';
        } else {
            $scheme = 'http';
        }
        return $scheme.'://'.$server_name.$port;
    }

}

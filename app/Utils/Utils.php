<?php


namespace App\Utils;


use App\Models\Restaurant;
use App\Models\Branch;
use App\Models\Token;
use \Datetime;

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
        date_default_timezone_set('America/Bogota');
        date("l", strtotime('yesterday'));
        
        $schedule = Utils::getSchedule($branch, date("l"));
        $scheduleYesterday = Utils::getSchedule($branch, date("l", strtotime('yesterday')));
        $currentTime = date('H:i:s');
        
        $currentDay= date('Y:m:d');
        $yesterday= date('Y:m:d', strtotime('yesterday'));
        $tomorrow = date("Y-m-d", strtotime('tomorrow'));
        
        $currentDate = new DateTime($currentDay . " " . $currentTime);
        $openDate = new DateTime($currentDay . " " . $schedule->open );
        $closeDate =  new DateTime($currentDay . " " . $schedule->close );
        $useScheduleYesterday = false;

        // Validate if schedule of yesterday is [00:00-11:59] and 
        // Current time is less than yesterday close schedule
        if($scheduleYesterday->close >="00:00:00" & $scheduleYesterday->close <="11:59:59"  & $currentTime <= $scheduleYesterday->close ){
            $openDate = new DateTime($yesterday . " " . $scheduleYesterday->open );
            // Use current day because is the begin of the new day
            $closeDate =  new DateTime($currentDay . " " . $scheduleYesterday->close );
            $useScheduleYesterday = true;
        }
        // Validate if schedule of yesterday is [00:00-11:59] and 
        // Current time is less than yesterday close schedule
        // No use Schedule of yesterday to assign tomorrow day
        if($schedule->close>="00:00:00" & $schedule->close<="11:59:59" & !$useScheduleYesterday){
            $closeDate = new DateTime($tomorrow . " " . $schedule->close );
        }
        if ($currentDate >= $openDate && $currentDate <= $closeDate) {
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

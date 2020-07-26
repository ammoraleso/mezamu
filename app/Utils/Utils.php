<?php


namespace App\Utils;


use App\Models\Restaurant;
use App\Token;

class Utils
{
    static function verifyBranch(Restaurant $restaurant, $branchName){
        $branch = $restaurant->branches()->where('location',$branchName)->first();
        if(is_null($branch)){
            abort(404);
        }
        return $branch;
    }

    static function isTokenValid($token){
        return !is_null(Token::where('token',$token)->first());
        //TODO check date for due tokens
        //TODO GUARDAR EL TOKEN EN LA SESION
    }

}

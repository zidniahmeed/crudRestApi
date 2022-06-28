<?php 

namespace App\helpers;


class ApiFormatter{
    protected static  $response = [
        'code' => null,
        'message' => null,
        'data'=> null,
    ];

    public static function createApi($code = null, $message = null,$data = null){
        self::$response['code'] = $code;
        self::$response['pesan'] = $message;
        self::$response['halooo'] = $data;

        return response()->json(self::$response, self::$response['code']);
    }
}

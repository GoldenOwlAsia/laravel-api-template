<?php

namespace App\Traits;

trait ResponseAPI
{
    public function coreReponse($message, $data = null, $statusCode, $isSuccess = true){
        // check the params
        if(!$message) return response()->json(['message' => 'Message is required'], 500);

        // send the response
        if($isSuccess){
            return response()->json([
                'message' => $message,
                'errors'   => false,
                'code'    => $statusCode,
                'results' => $data
            ], $statusCode);
        }else{
            return response()->json([
                'message' => $message,
                'errors'   => true,
                'code'    => $statusCode,
            ], $statusCode);
        }
    }

    // send any success response
    public function success($message, $data, $statusCode = 200){
        return $this->coreReponse($message, $data, $statusCode);
    }

    // send any error response
    public function error($message, $statusCode = 500){
        return $this->coreReponse($message, null, $statusCode, false);
    }
}
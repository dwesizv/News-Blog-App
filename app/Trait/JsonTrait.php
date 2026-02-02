<?php

namespace App\Trait;

trait JsonTrait {

    private function jsonResponse($data, $message, $success = true, $code = 200) {
        $response = [
            'success' => $success,
            'message' => $message,
            'data'    => $data
        ];
        return response()->json($response, $code);
    }

}
<?php

    function createErrorResponse($errorCode, $validationErrors = null){
        $response = [
            'error' => [
                'message' => '',
                'type' => '',
                'code' => $errorCode,
            ]
        ];

        switch($errorCode){
            case 400:
                $response['error']['type'] = 'Bad request';
                $response['error']['message'] = 'The server could not understand the request due to invalid syntax.';
                break;
            case 422:
                $response['error']['type'] = 'Unprocessable Entity';
                $response['error']['message'] = $validationErrors;
                break;
            default:
                $response['error']['type'] = 'Internal Server Error';
                $response['error']['message'] = "The server has encountered a situation it doesn't know how to handle.";
                break;
        }

        return $response;
    }


?>
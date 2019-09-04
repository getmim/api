<?php
/**
 * API Handler
 * @package api
 * @version 0.0.2
 */

namespace Api\Library;

class Handler
{
    private static function messageByError(int $code): string{
        $errors = [
            0   => 'OK',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            422 => 'Unprocessable Entity',
            500 => 'Internal Server Error',
            501 => 'Not Implemented'
        ];

        return $errors[$code] ?? 'Unknow';
    }

    static function resp($self, int $error=0, $data=null, string $message=null, array $meta=null): void{
        if(is_null($meta))
            $meta = [];

        if($error == 200)
            $error = 0;
        
        $meta['error'] = $error;

        if(!$message)
            $message = self::messageByError($error);
        $meta['message'] = $message;
        
        $meta['data']  = $data;
        
        $content = json_encode($meta, JSON_PRESERVE_ZERO_FRACTION);

        $self->res->addContent($content);
        $self->res->addHeader('Content-Type', 'application/json', false);
        $self->res->addHeader('Connection', 'close');
        $self->res->addHeader('Content-Length', strlen($content));
        // $self->res->addHeader('Access-Control-Allow-Origin', '*');
        // $self->res->addHeader('Access-Control-Allow-Methods', 'POST, GET, PUT, OPTIONS, DELETE');
        // $self->res->addHeader('Access-Control-Allow-Headers', 'Authorization, Content-Type');
        $self->res->send();
    }
}
<?php
/**
 * Api base controller
 * @package site
 * @version 0.0.1
 */

namespace Api;

class Controller extends \Mim\Controller
    implements \Mim\Iface\GateController
{
    private function messageByError(int $code): string{
        $errors = [
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

        return $errors[$code] ?? 'OK';
    }

    public function show404(): void{
        $this->resp(404);
    }

    public function show404Action(): void{
        $this->show404();
    }

    public function show500(object $error): void{
        $this->resp(500);
    }

    public function show500Action(object $error): void{
        $this->show500();
    }

    public function resp(int $error=0, $data=null, string $message=null, array $meta=null){
        if(is_null($meta))
            $meta = [];
        
        $meta['error'] = $error;
        $meta['data']  = $data;

        if(!$message)
            $message = $this->messageByError($error);
        $meta['message'] = $message;
        
        $this->res->addContent(json_encode($meta));
        $this->res->addHeader('Content-Type', 'application/json', false);
        $this->res->send();
    }
}
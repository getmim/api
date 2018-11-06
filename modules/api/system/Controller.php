<?php
/**
 * Api base controller
 * @package api
 * @version 0.0.1
 */

namespace Api;

use Api\Library\Handler;

class Controller extends \Mim\Controller
    implements \Mim\Iface\GateController
{
    public function show404(): void{
        $this->resp(404);
    }

    public function show404Action(): void{
        $this->show404();
    }

    public function show500(object $error): void{
        $data = null;
        if(is_dev())
            $data = $error;
        $this->resp(500, $data, $error->text);
    }

    public function show500Action(): void{
        $this->show500(\Mim\Library\Logger::$last_error);
    }

    public function resp(int $error=0, $data=null, string $message=null, array $meta=null): void{
        Handler::resp($this, $error, $data, $message, $meta);
    }
}
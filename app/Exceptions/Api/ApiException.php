<?php

namespace App\Exceptions\Api;

use Illuminate\Http\Response;
use Throwable;

class ApiException extends \Exception
{
    protected $message;
    protected $error;
    protected $front_message;
    protected $http_status = Response::HTTP_BAD_REQUEST;

    public function getError()
    {
        return $this->error;
    }

    public function getFrontMessage()
    {
        return $this->front_message;
    }

    public function getHttpStatus()
    {
        return $this->http_status;
    }
}

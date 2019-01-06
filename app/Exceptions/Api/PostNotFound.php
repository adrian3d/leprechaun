<?php

namespace App\Exceptions\Api;

use Illuminate\Http\Response;

class PostNotFound extends ApiException
{
    protected $message = 'Post not found';
    protected $error = 'POST_NOT_FOUND';
    protected $front_message = 'Le post que vous cherchez n\'existe pas.';
    protected $http_status = Response::HTTP_NOT_FOUND;
}
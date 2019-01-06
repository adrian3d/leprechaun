<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Response\Content as ApiContent;
use App\Models\Api\Response\Content\Pagination as ApiPagination;
use Illuminate\Http\Response;


class AbstractApiController extends Controller
{

    protected function sendResponse($data, ApiPagination $pagination = null, int $status_code = Response::HTTP_OK)
    {
        $api_response = new ApiContent();
        $api_response->setPagination($pagination);
        $api_response->setData($data);
        $api_response->setDuration(self::getDuration());

        return response()->json($api_response, $status_code);
    }

    private static function getDuration() {
        return microtime(true) - LARAVEL_START;
    }

}
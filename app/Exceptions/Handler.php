<?php

namespace App\Exceptions;

use App\Exceptions\Api\ApiException;
use App\Models\Api\Response\Content as ApiContent;
use App\Models\Api\Response\Content\Error as ApiError;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \League\OAuth2\Server\Exception\OAuthServerException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    protected function context()
    {
        return [];
    }

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * @param $request
     * @param AuthenticationException $exception
     * @return JsonResponse|Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    /**
     * Return if the exception is an API exception
     *
     * @param Exception $exception
     * @return bool
     */
    private static function isApiException(Exception $exception): bool
    {
        return $exception instanceof ApiException;
    }

    /**
     * Return the response generate with the ApiException
     *
     * @param Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    private function getUnauthorizedExceptionResponse(): JsonResponse
    {
        $api_response = new ApiContent();

        return response()->json($api_response, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Return the response generate with the ApiException
     *
     * @param ApiException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    private function getApiExceptionResponse(ApiException $exception): JsonResponse
    {
        $api_response = new ApiContent();
        $error = new ApiError();

        $error->setError($exception->getError());
        $error->setMessage($exception->getMessage());
        $error->setFrontMessage($exception->getFrontMessage());

        $api_response->setError($error);

        return response()->json($api_response, $exception->getHttpStatus());
    }

    /**
     * Return the response generate with the ApiException
     *
     * @param Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    private function getSimpleExceptionResponse(Exception $exception): JsonResponse
    {
        $api_response = new ApiContent();
        $error = new ApiError();

        $error->setError($exception->getCode());
        $error->setMessage($exception->getMessage());

        $api_response->setError($error);
        return response()->json($api_response, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        if ($request->is('api/*')) {
            if (($exception instanceof AuthenticationException)) {
                return self::getUnauthorizedExceptionResponse();
            }

            if (self::isApiException($exception)) {
                return $this->getApiExceptionResponse($exception);
            }

            return $this->getSimpleExceptionResponse($exception);
        }

        return parent::render($request, $exception);
    }
}

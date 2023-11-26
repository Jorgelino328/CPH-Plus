<?php
namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\{MethodNotAllowedHttpException, NotFoundHttpException};
use Throwable;

class Handler extends ExceptionHandler
{
    protected $levels = [
        //
    ];

    protected $dontReport = [
        //
    ];

    public function render($request, Throwable $e)
    {
        [$response, $code] = match (get_class($e))
        {
            AuthenticationException::class => [
                ['message' => 'Authentication required.'],
                401
            ],
            NotFoundHttpException::class,
            ModelNotFoundException::class => [
                ['message' => 'Resource not found.'],
                404
            ],
            MethodNotAllowedHttpException::class => [
                ['message' => 'Method not available for this resource.'],
                405
            ],
            ValidationException::class => [
                [
                    'message' => 'The provided data are invalid.',
                    'errors' => $e->validator->getMessageBag()
                ],
                422
            ],
            ThrottleRequestsException::class => [
                ['message' => 'Too many requests made, wait a moment to continue.'],
                429
            ],
            default => [
                env('APP_DEBUG')
                    ? [
                        'message' => $e->getMessage(),
                        'errorClass' => get_class($e)
                    ]
                    : ['message' => 'An unexpected error occurred.'],
                500
            ]
        };

        return response()->json($response, $code);
    }
}

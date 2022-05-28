<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function report(Throwable $exception) {
        parent::report($exception);
    }

    public function render($request, Throwable $exception) {
        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                    
             if (in_array('api', $exception->guards())){
                return \App\Http\Controllers\API\ApiController::error('Invalid AUTH Token', 401);
            }
            
//            return \App\Http\Controllers\API\ApiController::error('Invalid AUTH Token', 401);
        }
        return parent::render($request, $exception);
    }
}

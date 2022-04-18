<?php

namespace App\Exceptions;

use App\Http\Services\ResponseServise;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->wantsJson()) {
                return ResponseServise::notFound();
            }
        });

        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            if ($request->wantsJson()) {
                return ResponseServise::notFound();
            }
        });

        $this->renderable(function (\Exception $e, $request) {
            if ($request->wantsJson()) {
                return ResponseServise::ErrorApi();
            }
        });
    }
}

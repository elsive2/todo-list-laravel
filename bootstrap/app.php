<?php

use App\Exceptions\InvalidCredentialsException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (InvalidCredentialsException $e) {
            return response()->json(['exception' => $e->getMessage()], $e->getCode());
        });
        $exceptions->render(function (NotFoundHttpException $e) {
            return response()->json(['exception' => 'not_found'], Response::HTTP_NOT_FOUND);
        });
    })->create();

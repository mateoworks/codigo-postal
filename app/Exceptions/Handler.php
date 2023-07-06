<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException && $request->expectsJson()) {
            $model = class_basename($exception->getModel()); // Obtener el nombre del modelo
            $id = $exception->getIds(); // Obtener el ID buscado

            return response()->json([
                'error' => 'Recurso ' . $model . ' no encontrado, puede que el id no exista en la base de datos',
                'code' => 404,
            ], Response::HTTP_NOT_FOUND);
        }

        return parent::render($request, $exception);
    }
}

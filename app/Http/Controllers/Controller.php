<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Prueba Técnica API",
 *      description="Documentación de la prueba técnica de CRUD de pagos",
 *      @OA\Contact(
 *          email="jcastro.jcv@gmail.com"
 *      )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}

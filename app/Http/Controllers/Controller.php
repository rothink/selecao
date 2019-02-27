<?php

namespace App\Http\Controllers;

/**
 * @SWG\Swagger(
 *     schemes={"http"},
 *     host="localhost:8000",
 *     basePath="/api",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Api da seleção",
 *         description="Usando swagger, laravel e vue",
 *     )
 * )
 */

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

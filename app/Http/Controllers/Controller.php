<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API Tracking System",
 *      description="Tracking AWB for Mitra Adira Utama",
 *      @OA\Contact(
 *          email="wisnubaldas@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * 
 * @OA\Get(
 *     path="/",
 *     description="Home page",
 *     @OA\Response(response="default", description="Welcome page")
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

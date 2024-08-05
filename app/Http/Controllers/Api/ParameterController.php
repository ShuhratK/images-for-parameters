<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parameter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ParameterController extends Controller
{
    public function home(Request $request):JsonResponse
    {
        $parameters = Parameter::getParametersWhichCanHaveImagesWithImages()->map(
            function ($parameter) {
                $parameter = $parameter->toArray();
            }
        );
    }
}

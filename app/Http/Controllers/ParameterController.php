<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use App\Models\ParameterImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ParameterController extends Controller
{
    public function index():View
    {
        $parameters = Parameter::getAllParametersWithImages();
        return view('welcome', compact("parameters"));
    }

    public function upload(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            'image' => 'required|image:jpeg,png,jpg',
            'type' => 'required|in:icon,icon_gray',
            'parameter_id' => 'required',
        ]);

        ParameterImage::uploadImage(
            $validated['image'],
            $validated['parameter_id'],
            $validated['type']
        );

        return redirect()->route('home');
    }

    public function delete(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            'type' => 'required|in:icon,icon_gray',
            'parameter_id' => 'required',
        ]);

        ParameterImage::deleteImage(
            $validated['parameter_id'],
            $validated['type']
        );

        return redirect()->route('home');
    }


}

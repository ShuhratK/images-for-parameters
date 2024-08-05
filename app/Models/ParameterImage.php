<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ParameterImage extends Model
{
    use HasFactory;
    public $timestamps = false;

    public static function uploadImage(UploadedFile $image, $parameterId, $type): bool
    {
        $unique_name = hash('sha256', $image->getClientOriginalName().$parameterId.$type)
            .'.'.$image->getClientOriginalExtension();
        if(
            !Storage::put(
                'public/'.$unique_name,
                file_get_contents($image->getRealPath())
            )
        ) {
            return false;
        }

        $parameter_image = self::where('parameter_id', $parameterId)->where('type', $type)->first();
        if(!$parameter_image) {
            $parameter_image = new ParameterImage();
        } else {
            Storage::delete('public/'.$parameter_image->unique_name);
        }

        $parameter_image->parameter_id = $parameterId;
        $parameter_image->type = $type;
        $parameter_image->original_name = $image->getClientOriginalName();
        $parameter_image->unique_name = $unique_name;
        $parameter_image->save();

        return true;
    }

    public static function deleteImage($parameterId, $type): bool
    {
        $image = self::where('parameter_id', $parameterId)->where('type', $type)->first();
        Storage::delete('public/'.$image->unique_name);
        $image->delete();

        return true;
    }
}

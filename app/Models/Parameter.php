<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parameter extends Model
{
    use HasFactory;
    public $timestamps = false;

    public static function getAllParametersWithImages()
    {
        return Parameter::with('images')->get()->map(function (parameter $parameter) {
            $parameter = $parameter->toArray();
            foreach($parameter['images'] as $image) {
                $parameter[$image['type']] = 'storage/'.$image['unique_name'];
            }
            return $parameter;
        });
    }

    public static function getParametersWhichCanHaveImagesWithImages():array|Collection
    {
        return Parameter::with('images')->where('type', 2)->get();
    }

    public function images(): HasMany
    {
        return $this->hasMany(ParameterImage::class, 'parameter_id');
    }
}

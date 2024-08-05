<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class ParameterCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        foreach ($this->collection as &$item) {
            if(!empty($item->images)) {
                foreach($item->images as $image) {
                    $image['link'] = Storage::url($image['unique_name']);
                    unset($image['unique_name']);
                }
            }
        }
        return [$this->collection];
    }
}

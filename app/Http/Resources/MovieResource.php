<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd(print_r(value: $this->resource, true));

        return [
            'id' => $this['id'],
            'title' => $this['title'],
            'overview' => $this['overview'],
        ];
    }

}

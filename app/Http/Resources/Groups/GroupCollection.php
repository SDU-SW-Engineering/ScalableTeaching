<?php

namespace App\Http\Resources\Groups;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        dd($request, $this->collection->first(), $this->collection2);
        return parent::toArray($request);
    }
}

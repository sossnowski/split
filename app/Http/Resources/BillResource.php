<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return [
//            'name'          => $this->name,
//            'participants'  => $this->participants,
//            'total_amount'  => $this->total_amount
//        ];
        return parent::toArray($request);
    }
}

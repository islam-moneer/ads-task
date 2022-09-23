<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Enums\AdsConst;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'type' => AdsConst::TYPE[$this->type],
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => Carbon::parse($this->start_date)->format('Y-m-d H:i:s'),
        ];
    }
}

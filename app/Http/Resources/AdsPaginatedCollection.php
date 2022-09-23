<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Enums\AdsConst;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdsPaginatedCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {

        $result['data'] = $this->collection->transform(function ($data) {
            return [
                'id' => $data->id,
                'type' => AdsConst::TYPE[$data->type],
                'title' => $data->title,
                'description' => $data->description,
                'start_date' => Carbon::parse($data->start_date)->format('Y-m-d H:i:s'),
            ];
        });
        $result['pagination'] = $this->getPaginationMeta($request);

        return $result;
    }

    private function getPaginationMeta(Request $request): array
    {
        return [
            'total' => $this->total(),
            'count' => $this->count(),
            'per_page' => $this->perPage(),
            'current_page' => $this->currentPage(),
            'total_pages' => $this->lastPage(),
            'next_page_url' => $this->appends(request()->except(['page', 'user_id']))->nextPageUrl(),
        ];
    }
}

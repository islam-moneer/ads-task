<?php

namespace App\Http\Controllers\API;

use App\Mail\AdvertiserAdsReminder;
use App\Models\Ad;
use App\Models\Advertiser;
use App\Traits\ResponseTrait;
use App\Http\Resources\AdResource;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\API\Ad\FilterRequest;
use App\Http\Resources\AdsPaginatedCollection;
use App\Http\Requests\API\Ad\AdvertiserAdsRequest;
use Illuminate\Support\Facades\Mail;

class AdController extends Controller
{
    use ResponseTrait;

    public function filter(FilterRequest $request)
    {
        $ads = Ad::when($request->has('category_id'), function ($query) use ($request) {
            $query->where('category_id', $request->category_id);
        })
            ->when($request->has('tag_id'), function ($query) use ($request) {
                return $query->whereHas('tags', function (Builder $q) use ($request) {
                    $q->where('tags.id', $request->tag_id);
                });
            })->paginate();

        return $this->successResponseWithPaginatedData(AdsPaginatedCollection::make($ads));
    }

    public function advertisersAds(AdvertiserAdsRequest $request)
    {
        $advertiser = Advertiser::find($request->advertiser_id);

        return $this->successResponseWithData(AdResource::collection($advertiser->ads));
    }

    public function show(Ad $ad)
    {
        Mail::to($ad->advertiser->email)->send(new AdvertiserAdsReminder($ad));
    }
}

<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Tag;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Http\Requests\API\Tag\ShowRequest;
use App\Http\Requests\API\Tag\UpdateRequest;
use App\Http\Requests\API\Tag\CreateRequest;

class TagController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $categories = Tag::all();

        return $this->successResponseWithData(TagResource::collection($categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return JsonResponse
     */
    public function store(CreateRequest $request)
    {
        try {
            Tag::create($request->validated());
            return $this->successResponseCreated(__('response.tagCreatedSuccessfully'));
        } catch (Exception $e) {
            return $this->badRequest($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @return JsonResponse
     */
    public function show(ShowRequest $request)
    {
        $tag = Tag::find($request->tag_id);

        return $this->successResponseWithData(TagResource::make($tag));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request)
    {
        try {
            $tag = Tag::find($request->tag_id);

            $tag->update($request->validated());

            return $this->successResponseCreated(__('response.tagUpdatedSuccessfully'));
        } catch (Exception $e) {
            return $this->badRequest($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ShowRequest $request
     *
     * @return JsonResponse
     */
    public function destroy(ShowRequest $request)
    {
        try {
            $tag = Tag::find($request->tag_id);
            $tag->delete();

            return $this->successResponse(__('response.tagDeletedSuccessfully'));

        } catch (Exception $e) {
            return $this->badRequest($e->getMessage());
        }
    }
}

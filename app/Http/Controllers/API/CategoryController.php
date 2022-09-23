<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Category;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\API\Category\ShowRequest;
use App\Http\Requests\API\Category\UpdateRequest;
use App\Http\Requests\API\Category\CreateRequest;

class CategoryController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $categories = Category::all();

        return $this->successResponseWithData(CategoryResource::collection($categories));
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
            Category::create($request->validated());
            return $this->successResponseCreated(__('response.categoryCreatedSuccessfully'));
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
        $category = Category::find($request->category_id);

        return $this->successResponseWithData(CategoryResource::make($category));
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
            $category = Category::find($request->category_id);

            $category->update($request->validated());

            return $this->successResponseCreated(__('response.categoryUpdatedSuccessfully'));
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
            $category = Category::find($request->category_id);
            $category->delete();

            return $this->successResponse(__('response.categoryDeletedSuccessfully'));

        } catch (Exception $e) {
            return $this->badRequest($e->getMessage());
        }
    }
}

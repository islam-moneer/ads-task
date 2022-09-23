<?php

namespace App\Traits;

trait ResponseTrait
{

    /**
     * Manage response to be returned in json format.
     */

    /* success response  */
    function successResponse($message = null): \Illuminate\Http\JsonResponse
    {
        return response()->json(['status' => 'success', 'message' => $message], 200);
    }

    function successResponseCreated($message = null): \Illuminate\Http\JsonResponse
    {
        return response()->json(['status' => 'success', 'message' => $message], 201);
    }

    function successResponseCreatedWithData($data, $message = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data],
            201);
    }

    /* success response with data **/
    function successResponseWithData($data, $message = null): \Illuminate\Http\JsonResponse
    {
        $data = [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($data, 200);
    }

    /* success response with paginated data **/
    function successResponseWithPaginatedData($data, $message = null): \Illuminate\Http\JsonResponse
    {
        $dataToArray = $data->toArray(request());
        $data = [
            'status' => 'success',
            'message' => $message,
            'data' => $dataToArray['data'],
            'pagination' => $dataToArray['pagination'],
        ];

        return response()->json($data, 200);
    }

    /* error response  */
    function errorResponse($message = null, $code = 500): \Illuminate\Http\JsonResponse
    {
        return response()->json(['status' => 'error', 'message' => $message], $code);
    }

    function badRequest($message = null): \Illuminate\Http\JsonResponse
    {
        return response()->json(['status' => 'error', 'message' => $message], 400);
    }

}
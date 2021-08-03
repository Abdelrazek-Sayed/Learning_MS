<?php

namespace App\Http\Controllers\Api\Modules\Topics;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Traits\ApiResponseTrait;

use Illuminate\Support\Facades\Validator;

class TopicAPIController extends BaseController
{
    use ApiResponseTrait;
    /**
     * @OA\Post(
     * path="/api/topic_create",
     * summary="new topic",
     * description="store new topic",
     * operationId="create",
     * tags={"Topic"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass new topic name",
     *    @OA\JsonContent(
     *       required={"title","category_id"},
     *       @OA\Property(property="title", type="string", format="string", example="laravel"),
     *       @OA\Property(property="category_id", type="integer", format="integer", example="1"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="topic created")
     *     )
     *  ),
     * @OA\Response(
     *    response=422,
     *    description="invalid input",
     *    @OA\JsonContent(
     *       @OA\Property(property="validation error", type="string", example="Sorry, invalid topic name")
     *        )
     *     )
     * )
     *
     */
    public function create(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required|unique:topics,title',
                'category_id' => 'required|integer',
            ]
        );
        if ($validation->fails()) {
            return $this->ApiResponse(422, 'validation error', $validation->errors());
        }
        try {
            $category =   Topic::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
            ]);
            return $this->ApiResponse(200, 'topic created', null, $category);
        } catch (Exception $e) {
            return $this->ApiResponse(500, 'some bugs call the develper');
        }
    }
}

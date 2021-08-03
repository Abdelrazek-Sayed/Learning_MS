<?php

namespace App\Http\Controllers\Api\Modules\Questions;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Traits\ApiResponseTrait;

use Illuminate\Support\Facades\Validator;

class QuestionAPIController extends BaseController
{
    use ApiResponseTrait;
    /**
     * @OA\Post(
     * path="/api/question_create",
     * summary="new topic",
     * description="store new question",
     * operationId="create",
     * tags={"Questions"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass new question",
     *    @OA\JsonContent(
     *       required={"question","topic_id","difficulty"},
     *       @OA\Property(property="question", type="string", format="string", example="why.....?"),
     *       @OA\Property(property="topic_id", type="integer", format="integer", example="1"),
     *       @OA\Property(property="difficulty", type="integer", format="integer", example="1"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="question created")
     *     )
     *  ),
     * @OA\Response(
     *    response=422,
     *    description="invalid input",
     *    @OA\JsonContent(
     *       @OA\Property(property="validation error", type="string", example="Sorry, invalid question name")
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
                'question' => 'required',
                'topic_id' => 'required|exists:topics,id',
                'difficulty' => 'required|integer|between:1,3',
            ]
        );
        if ($validation->fails()) {
            return $this->ApiResponse(422, 'validation error', $validation->errors());
        }
        try {
            $question =   Question::create([
                'question' => $request->question,
                'topic_id' => $request->topic_id,
                'difficulty' => $request->difficulty,
            ]);
            return $this->ApiResponse(200, 'question created', null, $question);
        } catch (Exception $e) {
            return $this->ApiResponse(500, 'some bugs call the develper');
        }
    }
}

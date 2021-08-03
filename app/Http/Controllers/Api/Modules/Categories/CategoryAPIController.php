<?php

namespace App\Http\Controllers\Api\Modules\Categories;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Modules\Categories\Category;

class CategoryAPIController extends BaseController
{
    use ApiResponseTrait;
    /**
     * @OA\Post(
     * path="/api/category_create",
     * summary="new category",
     * description="store new category",
     * operationId="create",
     * tags={"category"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass new category name",
     *    @OA\JsonContent(
     *       required={"name","parent_id"},
     *       @OA\Property(property="name", type="string", format="string", example="software"),
     *       @OA\Property(property="parent_id", type="integer", format="integer", example="1"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="category created")
     *     )
     *  ),
     * @OA\Response(
     *    response=422,
     *    description="invalid input",
     *    @OA\JsonContent(
     *       @OA\Property(property="validation error", type="string", example="Sorry, invalid category name")
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
                'name' => 'required|unique:categories,name',
                'parent_id' => 'nullable|integer',
            ]
        );
        if ($validation->fails()) {
            return $this->ApiResponse(422, 'validation error', $validation->errors());
        }

        // $request->validate([
        //     'name' => 'required|unique:categories,name',
        //     'parent_id' => 'nullable',
        // ]);
        try {
            $category =   Category::create([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
            ]);
            return $this->ApiResponse(200, 'category created', null, $category);
        } catch (Exception $e) {
            return $this->ApiResponse(500, 'some bugs call the develper');
        }
    }

    /**
     * @OA\Post(
     * path="/api/category_update",
     * summary="new category",
     * description="update category",
     * operationId="create",
     * tags={"category"},
     * @OA\RequestBody(
     *    required=true,
     *    description="update category name",
     *    @OA\JsonContent(
     *       required={"name","parent_id"},
     *       @OA\Property(property="name", type="string", format="string", example="software"),
     *       @OA\Property(property="parent_id", type="integer", format="integer", example="1"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="category updated")
     *     )
     *  ),
     * @OA\Response(
     *    response=422,
     *    description="invalid input",
     *    @OA\JsonContent(
     *       @OA\Property(property="validation error", type="string", example="Sorry, invalid category name")
     *        )
     *     )
     * )
     *
     */
    public function update(Request $request)
    {
        // return $request;
        $validation = Validator::make(
            $request->all(),
            [
                'category_id' => 'required|exists:categories,id',
                'name' => [
                    'required',
                    Rule::unique('categories')->ignore($request->category_id)
                ],
                'parent_id' => 'nullable',
            ]
        );

        if ($validation->fails()) {
            return $this->ApiResponse(422, 'validation error', $validation->errors());
        }
        try {
            $category = Category::find($request->category_id);
            if (!$category) {
                return $this->ApiResponse(404, 'category not found');
            }
            $category->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
            ]);
            return $this->ApiResponse(200, 'category updated', null, $category);
        } catch (Exception $e) {
            return $this->ApiResponse(500, 'some bugs call the develper');
        }
    }
}

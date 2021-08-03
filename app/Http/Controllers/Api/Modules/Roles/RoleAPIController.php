<?php


namespace App\Http\Controllers\Api\Modules\Roles;


use PHPUnit\Exception;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

use App\Traits\ResponseMessages;

use App\Http\Requests\RoleRequest;

use App\Http\Resources\RoleResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Modules\Permissions\Permission;

class RoleAPIController extends BaseController
{
    use ApiResponseTrait;
    /**

     * @OA\Post(

     * path="/api/role_create",

     * summary="create",

     * description="create new role",

     * operationId="",

     * tags={"Role"},

     * @OA\RequestBody(

     *    required=true,

     *    description="valid role title",

     *    @OA\JsonContent(

     *       required={"name"},

     *       @OA\Property(property="name", type="string", example="admin"),

     *    ),

     * ),

     * @OA\Response(

     *     response=200,

     *     description="Success",

     *     @OA\JsonContent(

     *        @OA\Property(property="role", type="object", ref="#/components/schemas/Role"),

     *     )

     *  ),

     * @OA\Response(
     *    response=400,

     *    description="role title already exist",

     *    @OA\JsonContent(

     *       @OA\Property(property="message", type="string", example="Sorry, wrong Role title, Role title already exist")

     *        )

     *     )

     * )

     *

     */

    public function create(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            ['name' => 'required|unique:roles,name']
        );

        if ($validation->fails()) {
            return $this->ApiResponse(422, 'validation error', $validation->errors());
        }

        try {
            $role = Role::create(['name' => $request->name]);
            return $this->ApiResponse(200, 'role created', null, $role);
        } catch (Exception $e) {
            return $this->ApiResponse(500, 'some bugs call the develper');
        }
    }

    /**

     * @OA\Post(

     * path="/api/role_update",

     * summary="Update Role",

     * description="Update Role",

     * operationId="",

     * tags={"Role"},

     * @OA\RequestBody(
     *    required=true,
     *    description="valid role title",
     *    @OA\JsonContent(
     *       required={"role new name"},
     *       @OA\Property(property="name", type="string", format="string", example="user"),
     *     required={"role_id"},
     *       @OA\Property(property="role_id", type="number", format="number", example="10"),
     *    ),
     * ),

     * @OA\Response(

     *     response=200,

     *     description="Success",

     *     @OA\JsonContent(

     *        @OA\Property(property="role", type="object", ref="#/components/schemas/Role"),

     *     )

     *  ),

     * @OA\Response(

     *    response=422,

     *    description="invalid role_id",

     *    @OA\JsonContent(

     *       @OA\Property(property="message", type="string", example="invalid role_id")

     *        )

     *     ),

     * @OA\Response(

     *    response=205,

     *    description="You have No roles to show",

     *    @OA\JsonContent(

     *       @OA\Property(property="message", type="string", example="You have No roles to show")

     *        )

     *     )

     * )

     *

     */

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'role_id' => 'required|exists:roles,id',
            'name' => [
                'required',
                Rule::unique('roles')->ignore($request->role_id)
            ],
        ]);

        if ($validation->fails()) {
            return $this->ApiResponse(421, 'validation error', $validation->errors());
        }
        try {
            $role = Role::find($request->role_id);
            if (!$role) {
                return $this->ApiResponse(404, 'role not found');
            }
            $role->update(['name' => $request->name]);
            return $this->ApiResponse(200, 'role updated', null, $role);
        } catch (Exception $e) {
            return $this->ApiResponse(500, 'some bugs call the develper');
        }
    }

    /**

     * @OA\POST(

     * path="/api/role_view",

     * summary="get role by id",

     * description="get role by id",

     * operationId="",

     * tags={"Role"},

     * @OA\Response(

     *     response=200,

     *     description="Success",

     *     @OA\JsonContent(

     *        @OA\Property(property="role", type="object", ref="#/components/schemas/Role"),

     *     )

     *  ),

     * @OA\Response(

     *    response=422,

     *    description="invalid Role Id",

     *    @OA\JsonContent(

     *       @OA\Property(property="message", type="string", example="invalid Role Id")

     *        )

     *     ),

     * @OA\Response(

     *    response=205,

     *    description="You have No roles to show",

     *    @OA\JsonContent(

     *       @OA\Property(property="message", type="string", example="You have No roles to show")

     *        )

     *     )

     * )

     *

     */

    public function view(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'role_id' => 'required|exists:roles,id'
        ]);

        if ($validation->fails()) {
            return $this->ApiResponse(421, 'validation error', $validation->errors());
        }

        try {
            $role = Role::find($request->role_id);
            if (!$role) {
                return $this->ApiResponse(404, 'role not found');
            }
            return $this->ApiResponse(200, 'the role', null, $role);
        } catch (Exception $e) {
            return $this->ApiResponse(500, 'some bugs call the develper');
        }
    }

    /**
     * @OA\Post(
     * path="/api/role_delete",
     * summary="delete role",
     * description="delete role",
     * operationId="delete",
     * tags={"Role"},
     * @OA\RequestBody(
     *    required=true,
     *    description="return role ",
     *    @OA\JsonContent(

     *  required={"role_id"},
     *       @OA\Property(property="role_id", type="number", format="number", example="10"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="role deleted")
     *     )
     *  ),
     * @OA\Response(
     *    response=422,
     *    description="invalid input",
     *    @OA\JsonContent(
     *       @OA\Property(property="validation error", type="string", example="Sorry, invalid role_id")
     *        )
     *     )
     * )
     *
     */
    public function delete(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'role_id' => 'required|exists:roles,id'
        ]);

        if ($validation->fails()) {
            return $this->ApiResponse(421, 'validation error', $validation->errors());
        }

        try {
            $role = Role::find($request->role_id);
            if (!$role) {
                return $this->ApiResponse(404, 'role not found');
            }
            $role->delete();
            return $this->ApiResponse(200, 'role deleted');
        } catch (Exception $e) {
            return $this->ApiResponse(500, 'some bugs call the develper');
        }
    }
    /**
     * @OA\POST(
     * path="/api/role_index",
     * summary="Get All Role",
     * description="Get All Role",
     * operationId="",
     * tags={"Role"},
     * @OA\RequestBody(
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="role", type="object", ref="#/components/schemas/Role"),
     *     )
     *  ),
     * )
     *
     */
    public function index()
    {
        $roles = Role::all();
        if ($roles) {
            return $this->ApiResponse(200, 'all Roles', null, $roles);
        }
        return $this->ApiResponse(205, 'No Role Found');
    }
}

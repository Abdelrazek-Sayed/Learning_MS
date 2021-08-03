<?php


namespace App\Http\Controllers\Api\Modules\RolePermission;


use PHPUnit\Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\RolePermissionRequest;
use App\Http\Controllers\Api\Modules\RolePermission\RolePermission;


class RolePermissionAPIController extends BaseController
{
    use ApiResponseTrait;

    public function create(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'role_id' => 'required|unique:roles,id',
                'permission_id' => 'required|unique:permissions,id',
            ]
        );
        if ($validation->fails()) {
            return $this->ApiResponse(422, 'validation error', $validation->errors());
        }
        try {
            $rolePermission = RolePermission::create([
                'role_id' => $request->role_id,
                'permission_id' => $request->permission_id,
            ]);
            if ($rolePermission) { //['Role Peermission','created']
                return $this->ApiResponse(200, 'Role Permission created successfully');
            }
            return $this->ApiResponse(400, null, 'cant create Role permission', null);
        } catch (Exception $e) {
            return $this->ApiResponse(500, 'some bugs call the develper');
        }
    }



    // public function update(RolePermissionRequest $request)
    // {
    //     return $this->ApiResponse(422, null, 'invalid role permission id', null);
    //     $rolePermission = RolePermision::find($id);
    //     if ($rolePermission) {
    //         $update = $rolePermission->update([
    //             'role_id' => $request->role_id,
    //             'permission_id' => $request->permission_id,
    //         ]);
    //         if ($update) {
    //             return $this->ApiResponse(200, 'role permission updated successfully', null, null);
    //         }
    //         return $this->ApiResponse(
    //             400,
    //             null,
    //             'cant update this role permission',
    //             null
    //         );
    //     }
    //     return $this->ApiResponse(400, null, 'no role permission find to update', null);
    // }


    public function view(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'role_permission_id' => 'required|exists:role_permission,id'
        ]);
        if ($validation->fails()) {
            return $this->ApiResponse(421, 'validation error', $validation->errors());
        }
        try {
            $role_permission = RolePermission::find($request->role_permission_id);
            if (!$role_permission) {
                return $this->ApiResponse(404, 'role_permission not found');
            }
            return $this->ApiResponse(200, 'the role_permission', null, $role_permission);
        } catch (Exception $e) {
            return $this->ApiResponse(500, 'some bugs call the develper');
        }
    }

    // public function delete(Request $request)
    // {
    //     $validation = Validator::make($request->all(), [
    //         'role_permission_id' => 'required|exists:role_permission,id'
    //     ]);
    //     if ($validation->fails()) {
    //         return $this->ApiResponse(421, 'validation error', $validation->errors());
    //     }
    //     try {
    //         $role_permission = RolePermission::find($request->role_permission_id);
    //         if (!$role_permission) {
    //             return $this->ApiResponse(404, 'role_permission not found');
    //         }
    //         $role_permission->delete();
    //         return $this->ApiResponse(200, 'the role_permission deleted');
    //     } catch (Exception $e) {
    //         return $this->ApiResponse(500, 'some bugs call the develper');
    //     }
    // }
}

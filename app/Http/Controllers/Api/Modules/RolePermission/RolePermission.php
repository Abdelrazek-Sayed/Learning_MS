<?php

namespace App\Http\Controllers\Api\Modules\RolePermission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * required={"role_id","permission_id"},
 * @OA\Xml(name="RolePermission"),
 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="role_id", type="integer", readOnly="true", example="1"),
 * @OA\Property(property="permission_id", type="integer", readOnly="true", example="1"),
 * )
 */

class RolePermission extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'role_permission';
    protected $fillable = ['permission_id', 'role_id'];

    //    public function getRoleIdAttribute($value)
    //    {
    //        $value = Role::find($value)->first()->title;
    //        return $value;
    //    }
    //
    //    public function getPermissionIdAttribute($value)
    //    {
    //        // want to replace Role with Permission when permission modules is completed
    //        return $value;
    //    }
}

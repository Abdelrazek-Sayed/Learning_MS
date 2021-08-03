<?php


namespace App\Http\Controllers\Api\Modules\Roles;


use App\Http\Controllers\Api\Modules\Permissions\Permission;

use App\Http\Controllers\Api\Modules\RolesPermisions\RolePermision;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


/**

 *

 * @OA\Schema(

 * required={"title"},

 * @OA\Xml(name="Role"),

 * @OA\Property(property="id", type="integer", readOnly="true", example="1"),

 * @OA\Property(property="title", type="string", readOnly="true",  description="Role unique name ", example="admin"),

 * )

 */


class Role extends Model

{

    use HasFactory,SoftDeletes;

    // use SoftDeletes;


    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = ['name'];

    // public function permissions()
    // {
    //     return $this->belongsToMany(
    //         Permission::class,
    //         'roles_permissions',
    //         'role_id',
    //         'permission_id',
    //         'id',
    //         'id'
    //     );
    // }
}

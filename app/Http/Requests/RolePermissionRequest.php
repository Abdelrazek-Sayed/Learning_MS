<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RolePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role_id' => ['required', 'numeric'],
            'permission_id' => [
                'required', 'numeric',
                Rule::unique('roles_permissions')
                    ->where(
                        function ($query) {
                            return $query->where('role_id', $this->role_id);
                        }
                    )

            ]

        ];
    }
}

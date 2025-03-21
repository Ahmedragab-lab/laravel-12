<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $role = $this->route()->parameter('role');
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name' => 'required|unique:roles',
                    'permissions' => 'required|min:1',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|unique:roles,id,' . $role->id,
                    'permissions' => 'required|min:1',
                ];
            }
            default: break;
        }
    }

}//end of request

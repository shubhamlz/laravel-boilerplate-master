<?php

namespace App\Domains\Auth\Http\Requests\Backend\Product;

use App\Domains\Auth\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateRoleRequest.
 */
class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return true;
    //    return ! $this->role->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $oldimg=$img="";
        $img.=isset(request()->image)?request()->image:'';
        
        $oldimg=isset(request()->old_image)?request()->old_image:'';
        $required = empty($oldimg) || !isset($oldimg)?'required|image':'';
        return [
            'name' => ['required', 'max:100'],
            'price' => ['required',  'numeric'],
            'category_id' => ['required'],
            'description' =>['required'],
            'inStock' => ['required'],    
            'image' => $required,
               ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'permissions.*.exists' => __('One or more permissions were not found or are not allowed to be associated with this role type.'),
        ];
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('You can not edit the Administrator role.'));
    }
}

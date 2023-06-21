<?php

namespace App\Domains\Auth\Http\Requests\Backend\Team;

use App\Domains\Auth\Models\Team;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateUserRequest.
 */
class UpdateTeamRequest extends FormRequest
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
    public function rules()
    {
        $oldimg=$img="";
        $img.=isset(request()->image)?request()->image:'';
        
        $oldimg=isset(request()->old_image)?request()->old_image:'';
        $required = empty($oldimg) || !isset($oldimg)?'required|image':'';
        // dd(request()->hasFile($oldimg));
        return [
            'name' => ['required', 'max:100'],
            'email' => ['required', 'max:255', 'email'],
            'mobile' => ['required', 'numeric', 'digits:10'],
            'designation' =>['required'],
            'available_from' => ['required'],    
            'image' => $required,       
        ];
    
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'roles.*.exists' => __('One or more roles were not found or are not allowed to be associated with this user type.'),
            'permissions.*.exists' => __('One or more permissions were not found or are not allowed to be associated with this user type.'),
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
        throw new AuthorizationException(__('Only the administrator can update this team member.'));
    }
}

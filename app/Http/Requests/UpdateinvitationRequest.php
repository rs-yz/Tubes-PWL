<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateinvitationRequest extends FormRequest
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
        return [
            'bride_name' => 'string',
            'bride_nickname' => 'string',
            'bride_father' => 'string',
            'bride_mother' => 'string',
            'bride_child_nth' => 'integer|min:1',
            'bride_photo_url' => 'image',
            'groom_name' => 'string',
            'groom_nickname' => 'string',
            'groom_father' => 'string',
            'groom_mother' => 'string',
            'groom_child_nth' => 'integer|min:1',
            'groom_photo_url' => 'image',
            'thumbnail_url' => 'image',
            'quote' => 'string',
            'bride_first' => 'boolean',
            'is_release' => 'boolean',
        ];
    }
}

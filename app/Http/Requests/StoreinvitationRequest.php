<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreinvitationRequest extends FormRequest
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
            'ref' => 'required|unique:invitations,ref',
            'bride_name' => 'required|string',
            'bride_nickname' => 'required|string',
            'bride_father' => 'required|string',
            'bride_mother' => 'required|string',
            'bride_child_nth' => 'required|integer|min:1',
            'bride_photo_url' => 'required|image',
            'groom_name' => 'required|string',
            'groom_nickname' => 'required|string',
            'groom_father' => 'required|string',
            'groom_mother' => 'required|string',
            'groom_child_nth' => 'required|integer|min:1',
            'groom_photo_url' => 'required|image',
            'main_event_datetime' => 'required|date',
            'main_event_location' => 'required|string',
            'thumbnail_url' => 'image',
            'quote' => 'required|string',
            'bride_first' => 'boolean',
            'is_release' => 'boolean',
        ];
    }
}

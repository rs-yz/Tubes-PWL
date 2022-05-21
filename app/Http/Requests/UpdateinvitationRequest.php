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
            'nama_lengkap_pria' => 'required|regex:/^a-zA-Z.\' $/i',
            'nama_lengkap_wanita' => 'required|regex:/^a-zA-Z.\' $/i',
            'nama_panggilan_pria' => 'required|regex:/^a-zA-Z.\' $/i',
            'nama_panggilan_wanita' => 'required|regex:/^a-zA-Z.\' $/i',
            'nama_lengkap_ayah_pria' => 'required|regex:/^a-zA-Z.\' $/i',
            'nama_lengkap_ibu_pria' => 'required|regex:/^a-zA-Z.\' $/i',
            'nama_lengkap_ayah_wanita' => 'required|regex:/^a-zA-Z.\' $/i',
            'nama_lengkap_ibu_wanita' => 'required|regex:/^a-zA-Z.\' $/i',
            'anak_ke_pria' => 'required|integer|min:1',
            'anak_ke_wanita' => 'required|integer|min:1',
            'alamat_acara' => 'required|alpha_num', ,
            'tanggal_acara' => 'required|date|after_or_equal:now',
            'photo_pria' => 'file',
            'photo_wanita' => 'file'
        ];
    }
}

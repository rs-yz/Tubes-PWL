<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invitation extends Model
{
    use HasFactory;

    protected $table = 'invitations';

    protected $fillable = [
        'nama_lengkap_pria',
        'nama_lengkap_wanita',
        'nama_panggilan_pria',
        'nama_panggilan_wanita',
        'nama_lengkap_ayah_pria',
        'nama_lengkap_ibu_pria',
        'nama_lengkap_ayah_wanita',
        'nama_lengkap_ibu_wanita',
        'anak_ke_pria',
        'anak_ke_wanita',
        'alamat_acara',
        'tanggal_acara',
        'photo_pria',
        'photo_wanita'
    ];

    public function congratulations(){
        return $this->hasMany(congratulation::class, 'invitation_id');
    }

    public function invitationTheme()
    {
        return $this->belongsTo(invitationTheme::class, 'invitaion_theme_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

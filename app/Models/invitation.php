<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invitation extends Model
{
    use HasFactory;

    protected $table = 'invitation';

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

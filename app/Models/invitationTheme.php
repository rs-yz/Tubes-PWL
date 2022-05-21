<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invitationTheme extends Model
{
    use HasFactory;

    protected $table = 'invitation_themes';

    public function invitation()
    {
        return $this->hasOne(invitation::class, 'invitaion_theme_id');
    }
}

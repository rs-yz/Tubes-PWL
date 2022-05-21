<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class congratulation extends Model
{
    use HasFactory;

    protected $table = 'congratulations';

    public function invitation()
    {
        return $this->belongsTo(invitation::class, 'invitation_id');
    }
}

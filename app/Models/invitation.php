<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invitation extends Model
{
    use HasFactory;

    protected $table = 'invitations';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'ref';
    }

    public function expressions(){
        return $this->hasMany(expression::class, 'invitation_id');
    }

    public function events(){
        return $this->hasMany(event::class, 'invitation_id');
    }

    public function theme()
    {
        return $this->belongsTo(theme::class, 'theme_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{

    protected $fillable = [
        'name',
        'username',
        'password',
        'token'
    ];

    public function contact(): HasMany
    {
        return $this->hasMany(Contact::class, 'user_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'lastname', 'email', 'password', 'role'
    ];

    protected $hidden = ['password', 'remember_token'];

    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function resources()
    {
        return $this->hasMany(Resource::class, 'author_id');
    }

    public function savedResources()
    {
        return $this->belongsToMany(Resource::class, 'user_saved_resources')
                    ->withTimestamps();
    }
}
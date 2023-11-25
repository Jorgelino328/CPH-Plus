<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function pastes()
    {
        return $this->hasMany(Paste::class);
    }

    public function likes()
    {
        return $this->hasMany(PasteLike::class);
    }

    public function accessLogs()
    {
        return $this->hasMany(PasteAccessLog::class);
    }
}

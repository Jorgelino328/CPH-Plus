<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasteLike extends Model
{
    use HasFactory;

    const CREATED_AT = 'liked_at';
    const UPDATED_AT = null;

    protected $fillable = ['paste_id', 'user_id', 'liked_at'];

    public function paste()
    {
        return $this->belongsTo(Paste::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

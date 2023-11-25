<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasteLike extends Model
{
    public function paste()
    {
        return $this->belongsTo(Paste::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

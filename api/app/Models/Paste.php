<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    public function syntaxHighlights()
    {
        return $this->belongsTo(SyntaxHighlight::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

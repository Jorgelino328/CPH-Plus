<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'syntax_highlight_id',
        'user_id',
        'title',
        'tags',
        'content',
        'listable',
        'password',
        'expiration',
        'destroy_on_open'
    ];

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

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
    protected $with = [
        'syntax_highlight',
        'user'
    ];
    protected $casts = [
        'created_at' => 'datetime:M jS, Y, H:i',
        'expiration' => 'datetime:M jS, Y, H:i'
    ];

    public function syntax_highlight()
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

    public function access_logs()
    {
        return $this->hasMany(PasteAccessLog::class);
    }
}

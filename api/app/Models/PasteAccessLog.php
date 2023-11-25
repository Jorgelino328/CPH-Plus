<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasteAccessLog extends Model
{
    use HasFactory;

    const CREATED_AT = 'access_date';
    const UPDATED_AT = null;

    protected $fillable = [
        'paste_id',
        'user_id',
        'ip',
        'user_agent',
        'access_date'
    ];

    public function paste()
    {
        return $this->belongsTo(Paste::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

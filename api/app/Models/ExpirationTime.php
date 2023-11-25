<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpirationTime extends Model
{
    protected $primaryKey = 'seconds';
    protected $fillable = ['seconds', 'label'];
}

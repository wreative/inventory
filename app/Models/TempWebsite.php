<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempWebsite extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'temp_web';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'category',
        'due',
        'info',
    ];
}

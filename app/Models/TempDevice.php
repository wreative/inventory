<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempDevice extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'temp_device';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'type',
        'code_phone',
        'code_card',
        'no',
        'wa',
        'active',
        'division',
    ];
}

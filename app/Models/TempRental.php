<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempRental extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'temp_rental';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'address',
        'status',
        'pln',
        'pdam',
        'pbb',
        'wifi',
        'rental',
        'due',
        'info',
    ];
}

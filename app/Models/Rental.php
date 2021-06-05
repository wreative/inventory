<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'rental';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'code',
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
        'add',
        'edit',
        'del'
    ];
}

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
        'pln',
        'due_pln',
        'pdam',
        'due_pdam',
        'wifi',
        'due_wifi',
        'pbb',
        'rental',
        'due',
        'due_type',
        'info',
        'add',
        'edit',
        'del'
    ];
}

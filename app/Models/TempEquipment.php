<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempEquipment extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'temp_equip';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'brand',
        'qty',
        'price_acq',
        'date_acq',
        'condition',
        'img',
        'info',
        'location',
    ];
}

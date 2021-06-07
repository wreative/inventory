<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempVehicle extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'temp_vehicle';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'type',
        'brand',
        'plat',
        'step',
        'engine',
        'kir',
        'tax',
        'stnk',
        'info',
    ];
}

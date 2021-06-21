<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'equipment';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'brand',
        'qty',
        'price_acq',
        'date_acq',
        'condition',
        'img',
        'info',
        'location',
        'add',
        'edit',
        'del'
    ];

    public function relationRoom()
    {
        return $this->belongsTo('App\Models\Room', 'location', 'id');
    }
}

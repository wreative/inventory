<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'production';
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
        'category',
        'add',
        'edit',
        'del'
    ];

    public function relationCategory()
    {
        return $this->belongsTo('App\Models\CategoryProduction', 'category', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduction extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'cat_production';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function relationProduction()
    {
        return $this->hasMany('App\Models\Production', 'category', 'id');
    }
}

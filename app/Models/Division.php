<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'division';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function relationEquipment()
    {
        return $this->hasMany('App\Models\Device', 'division', 'id');
    }
}

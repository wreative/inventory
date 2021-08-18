<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'device';
    public $remember_token = false;
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'type',
        'code_phone',
        'no',
        'wa',
        'active',
        'grace',
        'acc',
        'division',
        'add',
        'edit',
        'del'
    ];

    public function relationDivision()
    {
        return $this->belongsTo('App\Models\Division', 'division', 'id');
    }
}

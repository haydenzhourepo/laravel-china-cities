<?php

namespace HaydenZhou\LaravelChinaCities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'code';

    protected $fillable = ['code', 'name', 'parent_code'];

    public function getRouteKeyName()
    {
        return 'code';
    }
    
}
<?php

namespace HaydenZhou\LaravelChinaCities;

use Illuminate\Database\Eloquent\Model;
use HaydenZhou\LaravelChinaCities\CityTrait;

class City extends Model
{
    use CityTrait;
    
    public $timestamps = false;

    protected $primaryKey = 'code';

    protected $fillable = ['code', 'name', 'parent_code'];

    public function getRouteKeyName()
    {
        return 'code';
    }
    
}
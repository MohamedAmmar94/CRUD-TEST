<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'website',
        'parent',
    ];
    public function products()
    {
        return $this->hasMany('App\Product',"category","id");
    }
    public function parent()
    {
        return $this->belongsTo('App\Category',"id","parent");
    }
}

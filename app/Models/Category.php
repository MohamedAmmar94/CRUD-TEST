<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\OrderCategoryScope;
use App\Models\AppImage;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'website',
        'parent',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderCategoryScope);
        static::saved(function ($data) {
            if (request()->hasFile('logo')) {
                if ($data->logo()->exists()) {
                    if (file_exists(storage_path('app/public/uploads/category' . "/" . $this->logo->image))) {
                        $image = \App\Http\Controllers\ImageController::delete_single_file($data->logo->image, 'app/public/uploads/category');
                    }
                    AppImage::where(['option'=>'logo','app_imageable_type' => 'App\Models\Category', 'app_imageable_id' => $data->id, 'image' => $data->logo->image])->delete();
                }
                $image = \App\Http\Controllers\ImageController::upload_single_file(request()->logo, 'app/public/uploads/category');
                $data->logo()->create(['image' => $image,'option'=>'logo']);
            }

        });
    }
    public function delete()
    {
        if ($this->logo()->exists()) {
            if (file_exists(storage_path('app/public/uploads/category' . "/" . $this->logo->image))) {
                \App\Http\Controllers\ImageController::delete_single_file($this->logo->image, 'app/public/uploads/category');
            }
            AppImage::where(['app_imageable_type' => 'App\Models\category', 'app_imageable_id' => $this->id, 'image' => $this->logo->image])->delete();
        }
        parent::delete();
    }
    public function getLogoUrlAttribute()
    {
        if ($this->logo()->exists()) {
            if (!file_exists(storage_path('app/public/uploads/category' . "/" . $this->logo->image))) {
                return false;
            }
            return asset('storage/uploads/category') . '/' . $this->logo->image;
        } else {
            return false;
        }
    }
    public function logo(){
        return $this->morphOne(AppImage::class, 'app_imageable');
    }
    public function products()
    {
        return $this->hasMany('App\Models\Product',"category","id");
    }
    public function parent_category()
    {
        return $this->belongsTo('App\Models\Category',"parent","id");
    }
}

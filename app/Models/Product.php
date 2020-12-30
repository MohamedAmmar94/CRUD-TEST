<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AppImage;


use App\Scopes\OrderProductScope;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'price',
        'category',
    ];
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderProductScope);
        static::saved(function ($data) {
            if (isset(request()->images) && !empty(request()->images)) {
                foreach (request()->images as $key ){
                    $image = \App\Http\Controllers\ImageController::upload_single_file($key, 'app/public/uploads/product');
                    $data->images()->create(['image' => $image,'option'=>'additional']);
                }
            }

        });
    }
    public function delete()
    {
        if ($this->images()->exists()) {
            foreach ($this->images as $key){
                if (file_exists(storage_path('app/public/uploads/job' . "/" . $key->image))) {
                    $image = \App\Http\Controllers\ImageController::delete_single_file($key->image, 'app/public/uploads/product');
                }
                AppImage::where(['app_imageable_type' => 'App\Models\Product', 'app_imageable_id' => $this->id, 'image' => $key->image])->delete();
            }
        }
        parent::delete();
    }
    public function images()
    {
        return $this->morphMany(AppImage::class, 'app_imageable');
    }
    public function getImagesUrlAttribute()
   {
       if ($this->images()->count() > 0) {
           $count = 0;
           foreach ($this->images as $image) {
               if (!file_exists(storage_path('app/public/uploads/product' . "/" . $image->image))) {
                   // $data[$count]['image_url'] = asset('storage/uploads/default.png');
                   // $data[$count]['option'] = $image->option;
               }else{
                   $data[$count]['image_url'] = asset('storage/uploads/product') . '/' . $image->image;
                   $data[$count]['id'] = $image->id;
               }
               $count++;
           }
       } else {
          return false;
       }
       return $data;
   }
    public function category_name()
    {
        return $this->belongsTo('App\Models\Category',"category","id");
    }
}

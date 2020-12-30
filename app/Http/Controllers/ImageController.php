<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public static function upload_single_image($request_file, $path)
    {
        $name =  Str::random(40) . '_' . time() . '.' . $request_file->getClientOriginalExtension();
        Image::make($request_file)->save(storage_path($path . '/org' . "/" . $name));
        Image::make($request_file)->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(storage_path($path . '/200' . "/" . $name));
        Image::make($request_file)->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(storage_path($path . '/400' . "/" . $name));
        Image::make($request_file)->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(storage_path($path . '/600' . "/" . $name));
        return $name;
    }

    public static function upload_single_file($request_file, $path)
    {
        $name = time() . '_' .  Str::random(40) . '.' . $request_file->getClientOriginalExtension();
        $request_file->move(storage_path($path), $name);
        return $name;
    }

    public static function upload_multi_files($request_files, $path)
    {
        foreach ($request_files as $request_file) {
            # code...
            $name = time() . '_' .  Str::random(40) . '.' . $request_file->getClientOriginalExtension();
            $request_file->move(storage_path($path), $name);
        }
        return $name;
    }

    public static function convert_base64_to_image($request_file, $path){
        $data = $request_file;

        $image_array_1 = explode(";", $data);

        $image_array_2 = explode(",", $image_array_1[1]);

        $data = base64_decode($image_array_2[1]);
        $name = time() . '_' .  Str::random(40)  . '.png';

        $imageName = storage_path($path . "/" . $name);

        file_put_contents($imageName, $data);
        return $name;

    }

    public static function delete_single_file($request_file, $path)
    {
        unlink(storage_path($path . "/" . $request_file));
    }

    public static function delete_image_from_folder($image_name, $path)
    {
        unlink(storage_path($path . '/org' . "/" . $image_name));
        unlink(storage_path($path . '/200' . "/" . $image_name));
        unlink(storage_path($path . '/400' . "/" . $image_name));
        unlink(storage_path($path . '/600' . "/" . $image_name));
    }
}

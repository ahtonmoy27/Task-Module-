<?php

namespace App\Traits;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
trait ImageUploadTrait
{
     public function uploadImage($file, $path)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $fullPath = rtrim(public_path($path), '/') . '/';

        // Ensure the directory exists
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

    
        $manager = new ImageManager(new Driver());

        $image = $manager->read($file->getRealPath());

      
        $image->resize(300, 400, function ($constraint) {
            $constraint->aspectRatio(); // Maintain aspect ratio
            $constraint->upsize();      // Prevent upsizing
        })->save($fullPath . $filename);

        return $filename;
    }
    public function deleteImage($path){
         //dd($path);
        if(file_exists($path)){
           // dd($path);
            unlink($path);
            return true ;
        }
        return false ;
    }


    public function uploadMultipleImages($files, $path){
      // dd($files);
        $allImages = [];

       // dd($allImages);
       foreach ($files as $key => $file) {
        $extension = $file->getClientOriginalExtension();
        $filename = $key . '-' . time() . '.' . $extension; // Include $key in the filename
        $fullPath = public_path($path);

        // Ensure the directory exists
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }

        // Move the file to the specified path
        $file->move($fullPath, $filename);

        $allImages[] = $filename; // Add the filename to the array
    }
       // dd($allImages);
         return $allImages;
    }




}
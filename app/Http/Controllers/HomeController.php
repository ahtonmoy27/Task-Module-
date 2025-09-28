<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
class HomeController extends Controller
{
//    public function index(){
//     return view('home');
//    }
   public function test(){
    $manager = new ImageManager(new Driver());

    $image = $manager->read(public_path('img/Tonmoy.jpg'));
    
    $image->scale(width: 300);
   
    $image->scale(width: 300, height:300);
        
    // save modified image in new format 
    $image->toPng()->save(public_path('img/foo.png'));
    dd($image);

     $image = Image::make(public_path('uploads/Tonmoy.jpg'));
    dd(public_path('uploads/Tonmoy.jpg'));
 
      $image->save(public_path('uploads/crop.jpg'));
   }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\ApiResponseTrait;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\User\CreateUserRequest;
use Intervention\Image\Drivers\Imagick\Driver;

class UserController extends Controller
{ 
    use ApiResponseTrait;

    protected $userService = null;

    public function __construct() {
        $this->userService = new UserService();
    }

function index(Request $request) {
      $users = $this->userService->getAllUsers($request);
    if ($request->ajax()) {
      

        return $this->sendResponse(
            appStatic()::SUCCESS, 
            'Successfully loaded the user.', 
            view('pages.users.load_users', ['users' => $users])->render()
        );
    }
return view('pages.users.index', ['users' => $users]);
}

    public function store(CreateUserRequest $request)
    {
        $data = $request->getUserData();
    
        $filename = NULL;
        $path = NULL;
        
        if($request->has('image')){
            $file = $request->file('image');

         $path = 'img/users/';
          $data['image'] = $this->uploadImage($file,$path);
          //dd($data['image']);
        }
        //  dd($data);
        $result = User::query()->create($data);
        return $this->sendResponse(appStatic()::SUCCESS, 'Successfully added the user.', $result);
    }


   
    function edit(Request $request, $id) {
        if ($request->ajax()) {
            $user = User::query()->where("id", $id)->first();
            return $this->sendResponse(appStatic()::SUCCESS, 'Successfully loaded the user.', $user);
        }
    }

    public function update(CreateUserRequest $request, $id) {
    
        
// create new manager instance with desired driver
        $manager = new ImageManager(new Driver());
        $data = $request->getUserData($id);
        $user = $this->userService->getUserById($id);

        $filename = NULL ;
        $path = NULL ;
        $allImages = [];
        
        if(!empty($user['image'])){
                unlink(public_path('img/users/'.$user['image']));
        }
          
      //  $image = $manager->read('images/Abul Hasnat_.jpg');
        
        if($request->has('image')){
            $file = $request->file('image');
            $path = 'img/users/';
          $data['image'] = $this->uploadImage($file,$path);
        }


        $result = $this->userService->updateUser($data,$id);
        return $this->sendResponse(appStatic()::SUCCESS, 'Successfully updated the user.', $result);
    }

    public function delete($id){
       $user =$this->userService->getUserById($id);
    if(!empty($user['image'])){
       $path = public_path().'/img/users/'.$user['image'];
       //dd($path);
       $this->deleteImage($path);
       }
       $result =  $this->userService->deleteUser($id);
        return $this->sendResponse(appStatic()::SUCCESS,'Successfully Deleted the user',$result);
    }
}

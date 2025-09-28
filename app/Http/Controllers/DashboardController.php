<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\ApiResponseTrait;

class DashboardController extends Controller
{ 
    use ApiResponseTrait;

    protected $userService = null;

    public function __construct() {
        $this->userService = new UserService();
    }

    function index(Request $request) {
       
        return view('auth.login');
    }

    
}

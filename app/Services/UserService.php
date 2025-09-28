<?php

namespace App\Services;

use App\Models\User;

class UserService {

    public function getAllUsers($request) {
        return User::query()->search()->orderByDesc('id')->paginate(5);
    }

    public function deleteUser($id){
        return User::query()->where('id', $id)->delete();
    }
    public function getUserById($id){
        return User::query()->findOrFail($id);
    }
    public function updateUser($data,$id){
        return User::query()->findOrFail($id)->update($data);
    }
}
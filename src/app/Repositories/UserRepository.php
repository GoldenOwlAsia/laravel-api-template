<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Traits\ResponseAPI;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    use ResponseAPI;

    public function getAllUsers()
    {
        try {
            $user = User::all();
            return $this->success("Get all users", $user);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getUserById($id)
    {
        try {
            $user = User::find($id);

            if(!$user) return $this->error("Not found user", 404);

            return $this->success("Get user by id", $user);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function requestUser(UserRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $user = $id ? User::find($id) : new User;

            // check user
            if(!$user && $id) return $this->error('user not found', 404);
            
            $user->name = $request->name;
            $user->email = preg_replace('/\s+/', '', strtolower($request->email));

            if(!$id) $user->password = Hash::make($request->password);

            $user->save();

            DB::commit();

            return $this->success(
              $id ? "User updated" : "User created",
              $user,
              $id ? 200 : 201 
            );
        } catch(\Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function deleteUser($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);

            // check user exist
            if (!$user) return $this->error('user not found', 404);

            $user->delete();

            DB::Commit();
        } catch(\Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
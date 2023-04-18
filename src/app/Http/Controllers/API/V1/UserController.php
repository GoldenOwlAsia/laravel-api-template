<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;

class UserController extends Controller
{
    protected $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function index(){
        return $this->userInterface->getAllUsers();
    }

    public function store(UserRequest $userRequest){
        return $this->userInterface->requestUser($userRequest);
    }

    public function show($id){
        return $this->userInterface->getUserById($id);
    }

    public function update(UserRequest $userRequest, $id){
        return $this->userInterface->requestUser($userRequest, $id);
    }

    public function destroy($id){
        return $this->userInterface->deleteUser($id);
    }
}
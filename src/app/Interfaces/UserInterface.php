<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;

interface UserInterface
{
	// get all User
	public function getAllUsers();

	// get user by id
	public function getUserById($id);

	// create, update user
	public function requestUser(UserRequest $request, $id = null);

	// delete user
	public function deleteUser($id);
}

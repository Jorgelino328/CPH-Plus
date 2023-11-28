<?php
namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function create(UserRequest $request)
    {
        User::create($request->validated());

        return response()->json([
            'message' => 'Account has been successfully created.'
        ], 201);
    }

    public function update(User $user, UserRequest $request)
    {
        $user->update($request->validated());

        return response()->json([
            'message' => 'Account has been successfully updated.'
        ], 201);
    }
}

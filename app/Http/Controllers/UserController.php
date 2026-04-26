<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    public function store(Request $request): UserResource
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255|unique:users',
            'password'    => 'required|string|min:8|confirmed',
            'branch_id'   => 'required|exists:branches,id',
            'position_id' => 'required|exists:positions,id',
            'role'        => 'required|in:admin,manager,employee',
        ]);

        $user = User::create($data);

        return new UserResource($user);
    }

    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function update(Request $request, User $user): UserResource
    {
        $data = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'email'       => "sometimes|required|email|max:255|unique:users,email,{$user->id}",
            'password'    => 'sometimes|required|string|min:8|confirmed',
            'branch_id'   => 'sometimes|required|exists:branches,id',
            'position_id' => 'sometimes|required|exists:positions,id',
            'role'        => 'sometimes|required|in:admin,manager,employee',
        ]);

        $user->update($data);

        return new UserResource($user->fresh());
    }

    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }
}

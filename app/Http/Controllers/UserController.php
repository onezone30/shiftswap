<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $totalUsers = User::count();

        $roleCounts = User::selectRaw('role, count(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role');

        $branches = User::with('branch')->get()->pluck('branch.name')->unique()->sort()->values();

        $users = User::query()
            ->when($request->filled('search'), fn($q) =>
                $q->where(fn($q) =>
                    $q->where('name', 'like', "%{$request->search}%")
                      ->orWhere('email', 'like', "%{$request->search}%")
                )
            )
            ->when($request->filled('role'), fn($q) =>
                $q->where('role', $request->role)
            )
            ->when($request->filled('branch'), fn($q) =>
                $q->whereHas('branch', fn($q) =>
                    $q->where('name', $request->branch)
                )
            )
            ->paginate(10)
            ->withQueryString();

        $roles = Role::cases();

        return view('users.index', compact('users', 'roleCounts', 'totalUsers', 'branches', 'roles'));
    }

    public function store(Request $request): UserResource
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255|unique:users',
            'password'    => 'required|string|min:8|confirmed',
            'branch_id'   => 'required|exists:branches,id',
            'position_id' => 'required|exists:positions,id',
            'role'        => ['required', \Illuminate\Validation\Rule::enum(Role::class)],
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

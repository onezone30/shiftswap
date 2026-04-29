<?php

namespace App\Http\Controllers;

use App\Enums\EmploymentType;
use App\Enums\Role;
use App\Http\Resources\UserResource;
use App\Models\Branch;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $totalUsers = User::count();

        $roleCounts = User::selectRaw('role, count(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role');

        $branches = Branch::orderBy('name')->pluck('name');

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
                $q->whereHas('branches', fn($q) =>
                    $q->where('name', $request->branch)
                )
            )
            ->paginate(10)
            ->withQueryString();

        $roles = Role::cases();

        return view('users.index', compact('users', 'roleCounts', 'totalUsers', 'branches', 'roles'));
    }

    public function create(): View
    {
        $branches          = Branch::orderBy('name')->get();
        $adminPosition     = Position::where('slug', 'admin')->first();
        $managerPosition   = Position::where('slug', 'manager')->first();
        $employeePositions = Position::where('is_active', true)
            ->whereNotIn('slug', ['admin', 'manager'])
            ->orderBy('name')
            ->get();
        $roles           = Role::cases();
        $employmentTypes = EmploymentType::cases();

        return view('users.create', compact(
            'branches', 'adminPosition', 'managerPosition', 'employeePositions', 'roles', 'employmentTypes'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|max:255|unique:users',
            'phone'           => 'nullable|string|max:20',
            'password'        => 'required|string|min:8|confirmed',
            'branch_ids'      => 'required|array|min:1',
            'branch_ids.*'    => 'exists:branches,id',
            'position_id'     => 'required|exists:positions,id',
            'role'            => ['required', Rule::enum(Role::class)],
            'employment_type' => ['required', Rule::enum(EmploymentType::class)],
            'hired_at'        => 'nullable|date',
        ]);

        $user = User::create($data);
        $user->branches()->sync($data['branch_ids']);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
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
            'branch_ids'   => 'sometimes|array|min:1',
            'branch_ids.*' => 'exists:branches,id',
            'position_id' => 'sometimes|required|exists:positions,id',
            'role'        => 'sometimes|required|in:admin,manager,employee',
        ]);

        $user->update($data);

        return new UserResource($user->fresh());
    }

    public function destroy(User $user): RedirectResponse
    {
        $name     = $user->name;
        $redirect = redirect()->route('users.index');

        try {
            $user->delete();
            return $redirect->with('success', "User \"{$name}\" was deleted.");
        } catch (\Exception) {
            return $redirect->with('error', "Could not delete \"{$name}\". They may have related records.");
        }
    }
}

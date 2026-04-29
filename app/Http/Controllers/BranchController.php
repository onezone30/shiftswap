<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BranchController extends Controller
{
    public function index(Request $request): View
    {
        $branches = Branch::withCount('users')->with('manager')
            ->when($request->filled('search'), fn($q) =>
                $q->where('name', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('address', 'like', '%' . $request->input('search') . '%')
            )
            ->get();

        $totalStaff = $branches->sum('users_count');

        return view('branches.index', compact('branches', 'totalStaff'));
    }

    public function create(): View
    {
        $managers = User::whereIn('role', [Role::Admin->value, Role::Manager->value])
            ->orderBy('name')
            ->get();

        return view('branches.create', compact('managers'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255|unique:branches,name',
            'address'    => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'email'      => 'nullable|email|max:255',
            'manager_id' => 'nullable|exists:users,id',
            'notes'      => 'nullable|string|max:512',
        ]);

        Branch::create($data);

        return redirect()->route('branches.index')->with('success', "Branch \"{$data['name']}\" was created.");
    }
}

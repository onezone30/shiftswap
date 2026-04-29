<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PositionController extends Controller
{
    public function index(Request $request): View
    {
        $totalPositions  = Position::count();
        $activeCount     = Position::where('is_active', true)->count();
        $inactiveCount   = $totalPositions - $activeCount;
        $totalAssigned   = Position::withCount('users')->get()->sum('users_count');

        $positions = Position::withCount('users')
            ->when($request->filled('search'), fn($q) =>
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%")
            )
            ->when($request->filled('status'), fn($q) =>
                $q->where('is_active', $request->status === 'active')
            )
            ->orderBy('name')
            ->get();

        return view('positions.index', compact(
            'positions', 'totalPositions', 'activeCount', 'inactiveCount', 'totalAssigned'
        ));
    }

    public function create(): View
    {
        return view('positions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255|unique:positions,name',
            'slug'        => 'nullable|string|max:255|unique:positions,slug',
            'description' => 'nullable|string|max:1000',
            'is_active'   => 'boolean',
        ]);

        $data['slug']      = $data['slug'] ? Str::slug($data['slug']) : Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active', true);

        Position::create($data);

        return redirect()->route('positions.index')->with('success', "Position \"{$data['name']}\" was created.");
    }
}

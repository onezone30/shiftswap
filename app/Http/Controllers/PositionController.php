<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
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
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminManagementController extends Controller
{
    public function index()
    {
        // Get all admins except the current one (or all admins)
        $admins = User::where('role', 'admin')->with('permissions')->get();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.admins.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'permissions' => 'array'
        ]);

        DB::transaction(function() use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'admin'
            ]);

            if ($request->has('permissions')) {
                $user->permissions()->sync($request->permissions);
            }
        });

        return redirect()->route('admin.admins.index')->with('success', 'Nouvel administrateur créé avec succès.');
    }

    public function edit(User $admin)
    {
        if ($admin->role !== 'admin') abort(404);
        
        $permissions = Permission::all();
        $adminPermissions = $admin->permissions->pluck('id')->toArray();
        
        return view('admin.admins.edit', compact('admin', 'permissions', 'adminPermissions'));
    }

    public function update(Request $request, User $admin)
    {
        if ($admin->role !== 'admin') abort(404);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|min:8|confirmed',
            'permissions' => 'array'
        ]);

        DB::transaction(function() use ($request, $admin) {
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $admin->update(['password' => Hash::make($request->password)]);
            }

            if ($request->has('permissions')) {
                $admin->permissions()->sync($request->permissions);
            } else {
                $admin->permissions()->detach();
            }
        });

        return redirect()->route('admin.admins.index')->with('success', 'Administrateur mis à jour.');
    }

    public function destroy(User $admin)
    {
        if ($admin->role !== 'admin' || $admin->id === auth()->id()) {
            return back()->with('error', 'Action non autorisée.');
        }
        
        $admin->delete();
        return back()->with('success', 'Administrateur supprimé.');
    }
}

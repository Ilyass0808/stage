<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::where('role', 'client')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function destroy(\App\Models\User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Impossible de supprimer un administrateur.');
        }
        $user->delete();
        return back()->with('success', 'Client supprimé avec succès.');
    }
}

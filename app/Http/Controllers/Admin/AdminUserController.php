<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->orderBy('name')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'roles' => 'nullable|array',
        ]);

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        } else {
            $user->syncRoles([]);
        }

        // Set or remove fallback is_admin column for backward compatibility
        $user->is_admin = $user->hasRole('admin');
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'User roles updated successfully!');
    }
}

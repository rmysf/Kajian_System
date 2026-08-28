<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::all();
        return view('admin.user.index', compact('users'));
    }

    public function update(Request $request, \App\Models\User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:user,organizer,admin'
        ]);
        
        $user->update(['role' => $validated['role']]);
        
        // If they became an organizer, create an empty organizer profile if it doesn't exist
        if ($validated['role'] === 'organizer' && !$user->organizer) {
            $user->organizer()->create([
                'name' => $user->name,
            ]);
        }

        return redirect()->route('user.index')->with('success', 'User role updated successfully.');
    }
}

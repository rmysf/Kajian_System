<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $organizer = auth()->user()->organizer;
        return view('organizer.profile.edit', compact('organizer'));
    }

    public function update(Request $request)
    {
        $organizer = auth()->user()->organizer;

        $request->validate([
            'organizer_name' => ['required', 'string', 'max:255'],
            'organizer_phone' => ['nullable', 'string', 'max:255'],
            'organizer_description' => ['nullable', 'string'],
            'organizer_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $organizer->name = $request->organizer_name;
        $organizer->phone = $request->organizer_phone;
        $organizer->description = $request->organizer_description;

        if ($request->hasFile('organizer_logo')) {
            if ($organizer->logo) {
                Storage::disk('public')->delete($organizer->logo);
            }
            $organizer->logo = $request->file('organizer_logo')->store('organizers/logos', 'public');
        }

        $organizer->save();

        return redirect()->route('organizer.profile.edit')->with('status', 'profile-updated');
    }
}


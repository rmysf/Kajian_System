<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mosque;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MosqueController extends Controller
{
    public function index()
    {
        $mosques = Mosque::with('organizer')->get();
        return view('admin.mosque.index', compact('mosques'));
    }

    public function create()
    {
        $organizers = Organizer::all();
        return view('admin.mosque.create', compact('organizers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('mosques', 'public');
        }

        Mosque::create($validated);

        return redirect()->route('admin.mosque.index')->with('success', 'Masjid berhasil ditambahkan.');
    }

    public function edit(Mosque $mosque)
    {
        $organizers = Organizer::all();
        return view('admin.mosque.edit', compact('mosque', 'organizers'));
    }

    public function update(Request $request, Mosque $mosque)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($mosque->photo) {
                Storage::disk('public')->delete($mosque->photo);
            }
            $validated['photo'] = $request->file('photo')->store('mosques', 'public');
        }

        $mosque->update($validated);

        return redirect()->route('admin.mosque.index')->with('success', 'Data Masjid berhasil diperbarui.');
    }

    public function destroy(Mosque $mosque)
    {
        if ($mosque->photo) {
            Storage::disk('public')->delete($mosque->photo);
        }
        $mosque->delete();

        return redirect()->route('admin.mosque.index')->with('success', 'Masjid berhasil dihapus.');
    }
}



<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mosque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MosqueController extends Controller
{
    public function index()
    {
        $mosques = Mosque::latest()->paginate(10);
        return view('admin.mosque.index', compact('mosques'));
    }



    public function show(Mosque $mosque)
    {
        return view('admin.mosque.show', compact('mosque'));
    }

    public function edit(Mosque $mosque)
    {
        return view('admin.mosque.edit', compact('mosque'));
    }

    public function update(Request $request, Mosque $mosque)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'google_maps_url' => 'nullable|url',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('photo')) {
            if ($mosque->photo && Storage::disk('public')->exists($mosque->photo)) {
                Storage::disk('public')->delete($mosque->photo);
            }
            $data['photo'] = $request->file('photo')->store('mosques', 'public');
        }

        $mosque->update($data);

        return redirect()->route('admin.mosque.index')->with('success', 'Masjid berhasil diperbarui.');
    }

    public function destroy(Mosque $mosque)
    {
        if ($mosque->photo && Storage::disk('public')->exists($mosque->photo)) {
            Storage::disk('public')->delete($mosque->photo);
        }

        $mosque->delete();

        return redirect()->route('admin.mosque.index')->with('success', 'Masjid berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Mosque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MosqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizerId = auth()->user()->organizer->id;
        $mosques = Mosque::where('organizer_id', $organizerId)->latest()->get();
        return view('organizer.mosque.index', compact('mosques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('organizer.mosque.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'google_maps_url' => 'nullable|url',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $organizerId = auth()->user()->organizer->id;
        $data = array_merge($validated, ['organizer_id' => $organizerId]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('mosques', 'public');
        }

        Mosque::create($data);

        return redirect()->route('organizer.mosque.index')->with('success', 'Masjid berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mosque $mosque)
    {
        if ($mosque->organizer_id !== auth()->user()->organizer->id) abort(403);
        
        return view('organizer.mosque.show', compact('mosque'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mosque $mosque)
    {
        if ($mosque->organizer_id !== auth()->user()->organizer->id) abort(403);

        return view('organizer.mosque.edit', compact('mosque'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mosque $mosque)
    {
        if ($mosque->organizer_id !== auth()->user()->organizer->id) abort(403);

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

        return redirect()->route('organizer.mosque.index')->with('success', 'Masjid berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mosque $mosque)
    {
        if ($mosque->organizer_id !== auth()->user()->organizer->id) abort(403);

        if ($mosque->photo && Storage::disk('public')->exists($mosque->photo)) {
            Storage::disk('public')->delete($mosque->photo);
        }

        $mosque->delete();

        return redirect()->route('organizer.mosque.index')->with('success', 'Masjid berhasil dihapus.');
    }
}

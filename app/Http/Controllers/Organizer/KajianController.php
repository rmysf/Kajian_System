<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Kajian;
use App\Models\Category;
use App\Models\Mosque;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KajianController extends Controller
{
    public function index()
    {
        $organizerId = auth()->user()->organizer->id;
        $kajians = Kajian::where('organizer_id', $organizerId)->latest()->get();
        return view('organizer.kajian.index', compact('kajians'));
    }

    public function create()
    {
        $organizerId = auth()->user()->organizer->id;
        $categories = Category::all();
        $mosques = Mosque::where('organizer_id', $organizerId)->get();
        $speakers = Speaker::all();
        return view('organizer.kajian.create', compact('categories', 'mosques', 'speakers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'mosque_name' => 'required|string|max:255',
            'speaker_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after_or_equal:start_at',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'audience' => 'required|in:umum,ikhwan,akhwat',
            'description' => 'nullable|string',
            'quota' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,published',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $organizerId = auth()->user()->organizer->id;

        $speaker = Speaker::firstOrCreate(['name' => $validated['speaker_name']]);
        $mosque = Mosque::firstOrCreate([
            'name' => $validated['mosque_name'],
            'organizer_id' => $organizerId
        ]);

        $data = array_merge($validated, [
            'organizer_id' => $organizerId,
            'speaker_id' => $speaker->id,
            'mosque_id' => $mosque->id,
            'is_family_friendly' => $request->has('is_family_friendly'),
            'is_free' => $request->has('is_free'),
        ]);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        } else {
            $data['poster'] = null;
        }

        Kajian::create($data);

        return redirect()->route('kajian.index')->with('success', 'Kajian created successfully.');
    }

    public function show(Kajian $kajian)
    {
        return view('organizer.kajian.show', compact('kajian'));
    }

    public function edit(Kajian $kajian)
    {
        $organizerId = auth()->user()->organizer->id;
        if ($kajian->organizer_id !== $organizerId) abort(403);

        $categories = Category::all();
        $mosques = Mosque::where('organizer_id', $organizerId)->get();
        $speakers = Speaker::all();
        return view('organizer.kajian.edit', compact('kajian', 'categories', 'mosques', 'speakers'));
    }

    public function update(Request $request, Kajian $kajian)
    {
        if ($kajian->organizer_id !== auth()->user()->organizer->id) abort(403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'mosque_name' => 'required|string|max:255',
            'speaker_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after_or_equal:start_at',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'audience' => 'required|in:umum,ikhwan,akhwat',
            'description' => 'nullable|string',
            'quota' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,published',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $speaker = Speaker::firstOrCreate(['name' => $validated['speaker_name']]);
        $mosque = Mosque::firstOrCreate([
            'name' => $validated['mosque_name'],
            'organizer_id' => auth()->user()->organizer->id
        ]);

        $data = array_merge($validated, [
            'speaker_id' => $speaker->id,
            'mosque_id' => $mosque->id,
            'is_family_friendly' => $request->has('is_family_friendly'),
            'is_free' => $request->has('is_free'),
        ]);

        if ($request->hasFile('poster')) {
            // Delete old poster if exists
            if ($kajian->poster && \Illuminate\Support\Facades\Storage::disk('public')->exists($kajian->poster)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($kajian->poster);
            }
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $kajian->update($data);

        return redirect()->route('kajian.index')->with('success', 'Kajian updated successfully.');
    }

    public function destroy(Kajian $kajian)
    {
        if ($kajian->organizer_id !== auth()->user()->organizer->id) abort(403);
        $kajian->delete();
        return redirect()->route('kajian.index')->with('success', 'Kajian deleted successfully.');
    }
}

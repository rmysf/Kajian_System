<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Speaker;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function index()
    {
        $speakers = Speaker::all();
        return view('admin.speaker.index', compact('speakers'));
    }

    public function create()
    {
        return view('admin.speaker.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Speaker::create($validated);

        return redirect()->route('admin.speaker.index')->with('success', 'Speaker created successfully.');
    }

    public function show(Speaker $speaker)
    {
        return view('admin.speaker.show', compact('speaker'));
    }

    public function edit(Speaker $speaker)
    {
        return view('admin.speaker.edit', compact('speaker'));
    }

    public function update(Request $request, Speaker $speaker)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $speaker->update($validated);

        return redirect()->route('admin.speaker.index')->with('success', 'Speaker updated successfully.');
    }

    public function destroy(Speaker $speaker)
    {
        $speaker->delete();
        return redirect()->route('admin.speaker.index')->with('success', 'Speaker deleted successfully.');
    }
}

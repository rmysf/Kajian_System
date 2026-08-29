<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Speaker;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $speakers = Speaker::latest()->paginate(10);
        return view('organizer.speaker.index', compact('speakers'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Speaker $speaker)
    {
        // Load the kajians associated with this speaker to show in the speaker profile view
        $speaker->load(['kajians' => function($query) {
            $query->where('organizer_id', auth()->user()->organizer->id)->latest();
        }]);

        return view('organizer.speaker.show', compact('speaker'));
    }
}

<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Kajian;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index(Kajian $kajian)
    {
        $organizerId = auth()->user()->organizer->id;
        
        if ($kajian->organizer_id !== $organizerId) {
            abort(403, 'Unauthorized access to this Kajian.');
        }

        $attendees = $kajian->attendees()->with('user')->latest()->get();

        return view('organizer.participant.index', compact('kajian', 'attendees'));
    }
    public function allParticipants()
    {
        $organizerId = auth()->user()->organizer->id;
        
        $attendees = \App\Models\KajianAttendee::whereHas('kajian', function($q) use ($organizerId) {
            $q->where('organizer_id', $organizerId);
        })->with(['user', 'kajian'])->latest()->get();

        return view('organizer.participant.all', compact('attendees'));
    }
}


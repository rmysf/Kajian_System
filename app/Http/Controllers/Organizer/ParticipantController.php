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
}

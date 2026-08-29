<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\KajianAttendee;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Menampilkan daftar semua peserta dari seluruh kajian milik organizer.
     */
    public function index()
    {
        $organizer = auth()->user()->organizer;

        if (!$organizer) {
            abort(403, 'Anda tidak memiliki akses penyelenggara.');
        }

        $attendees = KajianAttendee::whereHas('kajian', function ($query) use ($organizer) {
                $query->where('organizer_id', $organizer->id);
            })
            ->with(['user', 'kajian'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('organizer.participant.index', compact('attendees'));
    }
}



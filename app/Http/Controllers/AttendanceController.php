<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use App\Models\KajianAttendee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = KajianAttendee::where('user_id', auth()->id())
            ->with(['kajian.speaker', 'kajian.mosque'])
            ->latest()
            ->get();
            
        return view('user.my-kajian', compact('attendances'));
    }

    public function store(Request $request, Kajian $kajian)
    {
        // Cancel attendance if already registered
        $existing = KajianAttendee::where('kajian_id', $kajian->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            $existing->delete();
            return back()->with('success', 'Anda telah membatalkan pendaftaran kajian ini.');
        }

        // Validate quota if not null
        if (!is_null($kajian->quota)) {
            $currentAttendees = KajianAttendee::where('kajian_id', $kajian->id)->count();
            if ($currentAttendees >= $kajian->quota) {
                return back()->with('error', 'Maaf, kuota untuk kajian ini sudah penuh.');
            }
        }

        // Register new attendee
        KajianAttendee::create([
            'kajian_id' => $kajian->id,
            'user_id' => auth()->id(),
            'status' => 'registered'
        ]);

        return back()->with('success', 'Alhamdulillah, Anda berhasil mendaftar untuk kajian ini.');
    }
}

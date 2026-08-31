<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use App\Models\KajianAttendee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $kajians = Kajian::whereHas('attendees', function($q) {
            $q->where('user_id', auth()->id());
        })->with(['speaker', 'mosque', 'category'])
          ->latest()
          ->paginate(10);

        return view('user.my-kajian', compact('kajians'));
    }

    public function store(Request $request, Kajian $kajian)
    {
        $attendee = KajianAttendee::where('user_id', auth()->id())->where('kajian_id', $kajian->id)->first();
        
        if ($attendee) {
            $attendee->delete();
            return response()->json(['status' => 'removed', 'message' => 'Batal hadir']);
        } else {
            if ($kajian->quota && $kajian->attendees()->count() >= $kajian->quota) {
                return response()->json(['status' => 'error', 'message' => 'Kuota sudah penuh'], 422);
            }
            KajianAttendee::create([
                'user_id' => auth()->id(),
                'kajian_id' => $kajian->id,
                'status' => 'registered'
            ]);
            return response()->json(['status' => 'added', 'message' => 'Berhasil mendaftar kehadiran']);
        }
    }
}

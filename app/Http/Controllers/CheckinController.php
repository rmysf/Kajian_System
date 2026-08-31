<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use App\Models\KajianAttendee;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function store($uuid)
    {
        $kajian = Kajian::where('uuid', $uuid)->firstOrFail();
        
        $attendee = KajianAttendee::where('user_id', auth()->id())
            ->where('kajian_id', $kajian->id)
            ->first();

        if ($attendee) {
            if ($attendee->status === 'attended') {
                return redirect('/kajian-saya')->with('info', 'Anda sudah melakukan check-in sebelumnya.');
            }
            $attendee->update([
                'status' => 'attended',
                'checked_in_at' => now(),
            ]);
            return redirect('/kajian-saya')->with('success', 'Berhasil check-in kajian: ' . $kajian->title);
        } else {
            if ($kajian->quota && $kajian->attendees()->count() >= $kajian->quota) {
                return redirect('/')->with('error', 'Kajian sudah penuh, tidak dapat melakukan check-in.');
            }

            KajianAttendee::create([
                'user_id' => auth()->id(),
                'kajian_id' => $kajian->id,
                'status' => 'attended',
                'checked_in_at' => now(),
            ]);
            return redirect('/kajian-saya')->with('success', 'Berhasil mendaftar dan check-in kajian: ' . $kajian->title);
        }
    }
}

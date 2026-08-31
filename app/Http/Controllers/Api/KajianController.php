<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kajian;
use Illuminate\Http\Request;

class KajianController extends Controller
{
    /**
     * Get nearby kajians based on latitude and longitude using Haversine formula.
     */
    public function nearby(Request $request)
    {
        // Validasi input koordinat
        $request->validate([
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lng' => ['required', 'numeric', 'between:-180,180'],
            'radius' => ['nullable', 'numeric', 'min:1', 'max:100'],
        ]);

        $lat = (float) $request->query('lat');
        $lng = (float) $request->query('lng');
        $radius = (float) $request->query('radius', 5); // Default radius 5 km

        // Menggunakan scopeNearby dari model Kajian yang mengimplementasikan Haversine
        $kajians = Kajian::with(['organizer:id,name,logo', 'mosque:id,name,address', 'speaker:id,name,photo', 'category:id,name'])
                    ->nearby($lat, $lng, $radius)
                    ->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar kajian terdekat berhasil diambil.',
            'data' => [
                'kajians' => $kajians,
                'meta' => [
                    'latitude' => $lat,
                    'longitude' => $lng,
                    'radius_km' => $radius,
                    'total_results' => $kajians->count()
                ]
            ]
        ]);
    }

    /**
     * Get participants (attendees) for a specific kajian.
     */
    public function participants(Request $request, Kajian $kajian)
    {
        $participants = $kajian->attendees()->with('user:id,name,email,created_at')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data peserta berhasil diambil.',
            'data' => [
                'kajian_id' => $kajian->id,
                'kajian_title' => $kajian->title,
                'total_participants' => $participants->count(),
                'participants' => $participants
            ]
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KajianController extends Controller
{
    public function index(Request $request)
    {
        $query = Kajian::query()->where('status', 'published')->with(['organizer', 'mosque', 'speaker', 'category']);
        $query->where(function($q) {
            $q->where('start_at', '>=', now())
              ->orWhere(function($subQ) {
                  $subQ->where('start_at', '<=', now())
                       ->where('end_at', '>=', now());
              });
        });
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        if ($request->filled('date')) {
            $date = $request->date;
            if ($date === 'today') {
                $query->whereBetween('start_at', [now()->startOfDay(), now()->endOfDay()]);
            } elseif ($date === 'besok') {
                $query->whereBetween('start_at', [now()->addDay()->startOfDay(), now()->addDay()->endOfDay()]);
            } elseif ($date === 'malam-ini') {
                $query->whereBetween('start_at', [now()->startOfDay()->addHours(18), now()->endOfDay()]);
            }
        }
        if ($request->filled('audience')) {
            $query->where('audience', $request->audience);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($subQ) use ($q) {
                $subQ->where('title', 'like', "%{$q}%")
                     ->orWhere('description', 'like', "%{$q}%");
            });
        }
        $lat = $request->query('lat');
        $lng = $request->query('lng');

        if ($request->query('nearby') == 1 && $lat && $lng) {
            $query->nearby($lat, $lng, 50); 
        } else {
            $query->orderBy('start_at', 'ASC');
        }

        $kajians = $query->paginate(10)->appends($request->query());
        $categories = Category::orderBy('name')->get();

        return view('kajian.index', compact('kajians', 'categories'));
    }

    public function show($slug)
    {
        $kajian = Kajian::with(['organizer', 'speaker', 'mosque', 'category'])->where('slug', $slug)->firstOrFail();
        
        return view('kajian.show', compact('kajian'));
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $kajians = Kajian::whereHas('favoritedBy', function($q) {
            $q->where('user_id', auth()->id());
        })->with(['speaker', 'mosque', 'category'])
          ->latest()
          ->paginate(10);

        return view('user.saved', compact('kajians'));
    }

    public function toggle(Request $request, Kajian $kajian)
    {
        $favorite = Favorite::where('user_id', auth()->id())->where('kajian_id', $kajian->id)->first();
        
        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed', 'message' => 'Dihapus dari favorit']);
        } else {
            Favorite::create([
                'user_id' => auth()->id(),
                'kajian_id' => $kajian->id
            ]);
            return response()->json(['status' => 'added', 'message' => 'Ditambahkan ke favorit']);
        }
    }
}

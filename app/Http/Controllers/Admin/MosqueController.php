<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MosqueController extends Controller
{
    public function index()
    {
        // Currently the view is static dummy data, but this will pass the mosques soon.
        $mosques = \App\Models\Mosque::all();
        return view('admin.mosque.index', compact('mosques'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Award;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::where('user_id', auth()->id())->get();
        return view('awards', ['awards' => $awards]);
    }

    public function create()
    {
        return view('awards_add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'year' => ['nullable', 'integer'],
            'type' => ['required', 'in:award,honors'],
        ]);

        Award::create([
            'title' => $validated['title'],
            'year' => $validated['year'] ?? null,
            'type' => $validated['type'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Award / Honor added successfully!');
    }
}


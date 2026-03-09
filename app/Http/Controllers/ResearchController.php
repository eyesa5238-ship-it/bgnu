<?php

namespace App\Http\Controllers;
use App\Models\Research;

use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function index()
    {
        $researches=Research::all();
        return view('research', ['researches' => $researches]);
    }

    public function store()
    {
        return view("research_add");
    }

    public function add(Request $request)
    {
        Research::create([
        'title' => $request->title,
        'url' => $request->url,
        'date_of_publication' => $request->date_of_publication,
        'description' => $request->description,
        'user_id' => auth()->id,
        'country' => $request->country,
        ]);
        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
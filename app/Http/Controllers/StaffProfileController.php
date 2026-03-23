<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StaffProfileController extends Controller
{
    public function show(Request $request, User $user)
    {
        $user->load([
            'educations' => function ($q) {
                $q->orderByDesc('passing_year')->orderBy('degree_level');
            },
            'academicPositions' => function ($q) {
                $q->orderByDesc('from_date')->orderByDesc('to_date');
            },
            'researches' => function ($q) {
                $q->orderByDesc('date_of_publication')->orderByDesc('id');
            },
        ]);

        return view('staff.profile', [
            'user' => $user,
        ]);
    }
}


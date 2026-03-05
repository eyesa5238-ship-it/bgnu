<?php

namespace App\Http\Controllers;

use App\Models\AcademicPosition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends BaseController
{
    /**
     * Show the admin profile edit page.
     */
    public function edit()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    /**
     * Update the admin profile (name, bio, biography, email, type, profile image, teaching courses, academic positions).
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'bio' => ['nullable', 'string', 'max:1000'],
            'type' => ['required', 'in:admin,teacher,student'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->bio = $validated['bio'] ?? '';
        $user->type = $validated['type'];

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    /**
     * Show the biography edit page.
     */
    public function biographyEdit()
    {
        $user = auth()->user();
        return view('admin.biography', compact('user'));
    }

    /**
     * Update only the biography.
     */
    public function biographyUpdate(Request $request)
    {
        $request->validate([
            'biography' => ['nullable', 'string'],
        ]);
        $user = auth()->user();
        $user->biography = $request->input('biography', '');
        $user->save();
        return redirect()->route('biography.edit')->with('success', 'Biography updated successfully.');
    }

    /**
     * Show the teaching courses edit page.
     */
    public function teachingCoursesEdit()
    {
        $user = auth()->user();
        $teachingCourses = $user->teaching_courses;
        if (! is_array($teachingCourses)) {
            $teachingCourses = is_string($teachingCourses) ? (json_decode($teachingCourses, true) ?? []) : [];
        }
        return view('admin.teaching_courses', compact('user', 'teachingCourses'));
    }

    /**
     * Update only teaching courses.
     */
    public function teachingCoursesUpdate(Request $request)
    {
        $coursesRaw = $request->input('teaching_courses', []);
        if (! is_array($coursesRaw) || empty($coursesRaw)) {
            $json = $request->input('teaching_courses_json');
            if (is_string($json) && $json !== '') {
                $decoded = json_decode($json, true);
                $coursesRaw = is_array($decoded) ? $decoded : [];
            } else {
                $coursesRaw = [];
            }
        }
        if (! is_array($coursesRaw)) {
            $coursesRaw = [];
        }
        $courses = array_values(array_filter(array_map(function ($c) {
            return is_string($c) ? trim($c) : (string) $c;
        }, $coursesRaw), function ($c) {
            return $c !== '';
        }));
        $user = auth()->user();
        $user->teaching_courses = $courses;
        $user->save();
        return redirect()->route('teaching-courses.edit')->with('success', 'Teaching courses updated successfully.');
    }

    /**
     * Show the academic positions edit page.
     */
    public function academicPositionsEdit()
    {
        $user = auth()->user()->load('academicPositions');
        return view('admin.academic_positions', compact('user'));
    }

    /**
     * Update only academic positions.
     */
    public function academicPositionsUpdate(Request $request)
    {
        $validated = $request->validate([
            'positions' => ['nullable', 'array'],
            'positions.*.description' => ['nullable', 'string', 'max:255'],
            'positions.*.institute' => ['nullable', 'string', 'max:255'],
            'positions.*.from_date' => ['nullable', 'date'],
            'positions.*.to_date' => ['nullable', 'date'],
        ]);
        $user = auth()->user();
        $user->academicPositions()->delete();
        if (!empty($validated['positions'])) {
            foreach ($validated['positions'] as $row) {
                if (empty($row['description']) && empty($row['institute'])) {
                    continue;
                }
                $user->academicPositions()->create([
                    'description' => $row['description'] ?? '',
                    'institute' => $row['institute'] ?? '',
                    'from_date' => $row['from_date'] ?? null,
                    'to_date' => $row['to_date'] ?? null,
                ]);
            }
        }
        return redirect()->route('academic-positions.edit')->with('success', 'Academic positions updated successfully.');
    }
}

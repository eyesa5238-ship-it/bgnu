<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Education;
use App\Models\User;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function index()
  {
    $users = User::all();
    return view('faculty', ['users' => $users]);
  }

  public function faculty_index()
  {
    $educations = Education::all();
    $users = User::all();
    return view('education', compact('educations', 'users'));
  }

  public function faculty_store(Request $request)
  {
    Education::create([
      'degree_name' => $request->degree_name,
      'degree_level' => $request->degree_level,
      'passing_year' => $request->passing_year,
      'institute_name' => $request->institute_name,
      'user_id' => $request->user_id,
      'status' => $request->status,
    ]);
    return redirect()->back()->with('success', 'Form submitted successfully!');
  }



  public function edit($id)
  {
    $education = Education::findOrFail($id);
    $users = User::all();
    return view('education_edit', compact('education', 'users'));
  }

  public function update(Request $request, $id)
  {
    $education = Education::findOrFail($id);
    $education->update([
      'degree_name' => $request->degree_name,
      'degree_level' => $request->degree_level,
      'passing_year' => $request->passing_year,
      'institute_name' => $request->institute_name,
      'user_id' => $request->user_id,
      'status' => $request->status,
    ]);
    return redirect()->route('education.index')->with('success', 'Updated successfully!');
  }

  public function destroy($id)
  {
    $education = Education::find($id);
    $education->delete();
    return redirect()->back()->with('success', 'Deleted successfully!');
  }
}



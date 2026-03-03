@extends('layouts.admin')

@section('title', 'Edit Education')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('faculty.index') }}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ route('education.index') }}">Education</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-semibold">Edit Education</h4>
        <a href="{{ route('education.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Education
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">Update record</div>
        <div class="admin-card-body">
            <form action="{{ route('education.update', $education->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Degree Name</label>
                        <input type="text" name="degree_name" class="form-control" value="{{ old('degree_name', $education->degree_name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Degree Level</label>
                        <select name="degree_level" class="form-select">
                            <option value="">-- Select --</option>
                            @foreach(["Matric", "Intermediate", "Bachelor", "Master", "MPhil", "PhD"] as $level)
                                <option value="{{ $level }}" {{ $education->degree_level == $level ? 'selected' : '' }}>{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">User (Faculty)</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">-- Select User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $education->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} — {{ $user->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Institute Name</label>
                        <input type="text" name="institute_name" class="form-control" value="{{ old('institute_name', $education->institute_name) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Passing Year</label>
                        <input type="number" name="passing_year" class="form-control" value="{{ old('passing_year', $education->passing_year) }}" min="1950" max="2030">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="1" {{ $education->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $education->status == 0 ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>
                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="fa-solid fa-save me-1"></i> Update
                        </button>
                        <a href="{{ route('education.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('title', 'Education')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('faculty.index') }}">Admin</a></li>
    <li class="breadcrumb-item active">Education</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-semibold">Education</h4>
        <a href="{{ route('faculty.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-users me-1"></i> Faculty
        </a>
    </div>

    <div class="admin-card mb-4">
        <div class="admin-card-header">Add Education</div>
        <div class="admin-card-body">
            <form action="{{ route('education.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Degree Name</label>
                        <input type="text" name="degree_name" class="form-control" placeholder="e.g. BSc Computer Science" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Degree Level</label>
                        <select name="degree_level" class="form-select">
                            <option value="">-- Select --</option>
                            <option value="Matric">Matric</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Bachelor">Bachelor</option>
                            <option value="Master">Master</option>
                            <option value="MPhil">MPhil</option>
                            <option value="PhD">PhD</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">User (Faculty)</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">-- Select User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} — {{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Institute Name</label>
                        <input type="text" name="institute_name" class="form-control" placeholder="Institute name">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Passing Year</label>
                        <input type="number" name="passing_year" class="form-control" placeholder="e.g. 2020" min="1950" max="2030">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="1">Active</option>
                            <option value="0">Pending</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="fa-solid fa-save me-1"></i> Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">Education List</div>
        <div class="admin-card-body p-0">
            <div class="table-responsive">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Degree</th>
                            <th>Level</th>
                            <th>Institute</th>
                            <th>Year</th>
                            <th>Status</th>
                            <th style="width: 120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($educations as $education)
                            <tr>
                                <td>{{ $education->id }}</td>
                                <td>{{ $education->user->name ?? 'N/A' }}</td>
                                <td>{{ $education->degree_name }}</td>
                                <td>{{ $education->degree_level ?? '—' }}</td>
                                <td>{{ $education->institute_name ?? '—' }}</td>
                                <td>{{ $education->passing_year ?? '—' }}</td>
                                <td>
                                    @if($education->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('education.edit', $education->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('education.destroy', $education->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No education records yet. Add one above.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

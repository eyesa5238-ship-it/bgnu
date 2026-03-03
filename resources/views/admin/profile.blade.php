@extends('layouts.admin')

@section('title', 'Profile')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('faculty.index') }}">Admin</a></li>
    <li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-semibold">Profile</h4>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">Manage your profile</div>
        <div class="admin-card-body">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-4 text-center">
                        <label class="form-label d-block">Profile Image</label>
                        <div class="profile-image-wrap mb-3 mx-auto rounded-circle overflow-hidden bg-light d-inline-flex align-items-center justify-content-center" style="width: 140px; height: 140px;">
                            @if($user->profile_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->profile_image))
                                <img src="{{ asset('storage/'.$user->profile_image) }}" alt="Profile" class="w-100 h-100 object-fit-cover" style="object-fit: cover;">
                            @else
                                <i class="fa-solid fa-user fa-4x text-muted"></i>
                            @endif
                        </div>
                        <input type="file" name="profile_image" id="profile_image" class="form-control form-control-sm" accept="image/jpeg,image/png,image/jpg,image/gif">
                        <div class="form-text">JPEG, PNG or GIF. Max 2MB.</div>
                    </div>

                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role (Type)</label>
                            <select name="type" class="form-select" required>
                                @foreach(\App\Models\User::allRoles() as $value => $label)
                                    <option value="{{ $value }}" {{ old('type', $user->type) === $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bio</label>
                            <textarea name="bio" class="form-control" rows="2" placeholder="Short bio...">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Biography</label>
                            <textarea name="biography" class="form-control" rows="5" placeholder="Full biography...">{{ old('biography', $user->biography) }}</textarea>
                            @error('biography')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="mb-4">
                    <label class="form-label fw-semibold">Teaching Courses</label>
                    <p class="text-muted small mb-2">Add courses; they will be shown as a list.</p>
                    <ul id="teachingCoursesList" class="list-group mb-2">
                        @php
                            $coursesForDisplay = old('teaching_courses', $teachingCourses ?? $user->teaching_courses ?? []);
                            $coursesForDisplay = is_array($coursesForDisplay) ? $coursesForDisplay : [];
                        @endphp
                        @foreach($coursesForDisplay as $course)
                            @if(trim((string) $course) !== '')
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $course }}</span>
                                <input type="hidden" name="teaching_courses[]" value="{{ e($course) }}">
                                <button type="button" class="btn btn-sm btn-outline-danger remove-course">Remove</button>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="input-group">
                        <input type="text" id="newCourse" class="form-control" placeholder="Course name">
                        <button type="button" class="btn btn-outline-primary" id="addCourse">Add course</button>
                    </div>
                    <input type="hidden" name="teaching_courses_json" id="teaching_courses_json" value="">
                </div>

                <hr class="my-4">

                <div class="mb-4">
                    <label class="form-label fw-semibold">Academic Positions</label>
                    <p class="text-muted small mb-2">Description of position, institute, from and to dates.</p>
                    <div id="positionsContainer">
                        @php
                            $positions = old('positions', $user->academicPositions->map(fn($p) => [
                                'description' => $p->description,
                                'institute' => $p->institute,
                                'from_date' => $p->from_date?->format('Y-m-d'),
                                'to_date' => $p->to_date?->format('Y-m-d'),
                            ])->toArray());
                            if (empty($positions)) $positions = [['description' => '', 'institute' => '', 'from_date' => '', 'to_date' => '']];
                        @endphp
                        @foreach($positions as $i => $pos)
                        <div class="position-row border rounded p-3 mb-3 bg-light">
                            <div class="row g-2">
                                <div class="col-12">
                                    <label class="form-label small mb-0">Description of position</label>
                                    <input type="text" name="positions[{{ $i }}][description]" class="form-control form-control-sm" value="{{ $pos['description'] ?? '' }}" placeholder="e.g. Associate Professor">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small mb-0">Institute</label>
                                    <input type="text" name="positions[{{ $i }}][institute]" class="form-control form-control-sm" value="{{ $pos['institute'] ?? '' }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small mb-0">From</label>
                                    <input type="date" name="positions[{{ $i }}][from_date]" class="form-control form-control-sm" value="{{ $pos['from_date'] ?? '' }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small mb-0">To</label>
                                    <input type="date" name="positions[{{ $i }}][to_date]" class="form-control form-control-sm" value="{{ $pos['to_date'] ?? '' }}">
                                </div>
                                <div class="col-12">
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-position">Remove position</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="addPosition">+ Add position</button>
                </div>

                <hr class="my-4">
                <button type="submit" class="btn btn-admin-primary">
                    <i class="fa-solid fa-save me-1"></i> Update Profile
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.getElementById('profile_image').addEventListener('change', function(e) {
    var wrap = document.querySelector('.profile-image-wrap');
    if (e.target.files && e.target.files[0]) {
        var r = new FileReader();
        r.onload = function() { wrap.innerHTML = '<img src="' + r.result + '" alt="Preview" class="w-100 h-100" style="object-fit: cover;">'; };
        r.readAsDataURL(e.target.files[0]);
    }
});

// Teaching courses: add
var courseIndex = 0;
document.getElementById('addCourse').addEventListener('click', function() {
    var input = document.getElementById('newCourse');
    var name = (input.value || '').trim();
    if (!name) return;
    var li = document.createElement('li');
    li.className = 'list-group-item d-flex justify-content-between align-items-center';
    li.innerHTML = '<span>' + escapeHtml(name) + '</span><input type="hidden" name="teaching_courses[]" value="' + escapeHtml(name) + '"><button type="button" class="btn btn-sm btn-outline-danger remove-course">Remove</button>';
    document.getElementById('teachingCoursesList').appendChild(li);
    input.value = '';
});
document.getElementById('teachingCoursesList').addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-course')) e.target.closest('li').remove();
});
function escapeHtml(s) { var d = document.createElement('div'); d.textContent = s; return d.innerHTML; }
// Before submit: sync all course names to a hidden JSON field as backup
document.getElementById('profileForm').addEventListener('submit', function() {
    var names = [];
    document.querySelectorAll('#teachingCoursesList input[name="teaching_courses[]"]').forEach(function(inp) {
        var v = (inp.value || '').trim();
        if (v) names.push(v);
    });
    document.getElementById('teaching_courses_json').value = JSON.stringify(names);
});

// Academic positions: add row
var positionIndex = {{ count($positions) }};
document.getElementById('addPosition').addEventListener('click', function() {
    var html = '<div class="position-row border rounded p-3 mb-3 bg-light">' +
        '<div class="row g-2">' +
        '<div class="col-12"><label class="form-label small mb-0">Description of position</label><input type="text" name="positions[' + positionIndex + '][description]" class="form-control form-control-sm" placeholder="e.g. Associate Professor"></div>' +
        '<div class="col-md-6"><label class="form-label small mb-0">Institute</label><input type="text" name="positions[' + positionIndex + '][institute]" class="form-control form-control-sm"></div>' +
        '<div class="col-md-3"><label class="form-label small mb-0">From</label><input type="date" name="positions[' + positionIndex + '][from_date]" class="form-control form-control-sm"></div>' +
        '<div class="col-md-3"><label class="form-label small mb-0">To</label><input type="date" name="positions[' + positionIndex + '][to_date]" class="form-control form-control-sm"></div>' +
        '<div class="col-12"><button type="button" class="btn btn-sm btn-outline-danger remove-position">Remove position</button></div></div></div>';
    document.getElementById('positionsContainer').insertAdjacentHTML('beforeend', html);
    positionIndex++;
});
document.getElementById('positionsContainer').addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-position')) {
        var row = e.target.closest('.position-row');
        if (document.querySelectorAll('.position-row').length > 1) row.remove();
    }
});
</script>
@endpush

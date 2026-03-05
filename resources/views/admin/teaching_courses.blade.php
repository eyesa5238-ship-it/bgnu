@extends('layouts.admin')

@section('title', 'Teaching Courses')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('faculty.index') }}">Admin</a></li>
    <li class="breadcrumb-item active">Teaching Courses</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-semibold">Teaching Courses</h4>
        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Profile
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">Add or edit your teaching courses</div>
        <div class="admin-card-body">
            <p class="text-muted small mb-3">Add courses; they will be shown as a list.</p>
            <form action="{{ route('teaching-courses.update') }}" method="POST" id="teachingCoursesForm">
                @csrf
                @method('PUT')
                <ul id="teachingCoursesList" class="list-group mb-3">
                    @php
                        $coursesForDisplay = old('teaching_courses', $teachingCourses ?? []);
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
                <div class="input-group mb-3">
                    <input type="text" id="newCourse" class="form-control" placeholder="Course name">
                    <button type="button" class="btn btn-outline-primary" id="addCourse">Add course</button>
                </div>
                <input type="hidden" name="teaching_courses_json" id="teaching_courses_json" value="">
                <button type="submit" class="btn btn-admin-primary">
                    <i class="fa-solid fa-save me-1"></i> Save Teaching Courses
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function escapeHtml(s) { var d = document.createElement('div'); d.textContent = s; return d.innerHTML; }
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
document.getElementById('teachingCoursesForm').addEventListener('submit', function() {
    var names = [];
    document.querySelectorAll('#teachingCoursesList input[name="teaching_courses[]"]').forEach(function(inp) {
        var v = (inp.value || '').trim();
        if (v) names.push(v);
    });
    document.getElementById('teaching_courses_json').value = JSON.stringify(names);
});
</script>
@endpush

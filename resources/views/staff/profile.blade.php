@extends('layouts.public')

@section('title', $user->name)

@php
    $profileImageUrl = null;
    if ($user->profile_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->profile_image)) {
        $profileImageUrl = asset('storage/' . $user->profile_image);
    }
@endphp

@section('content')
    <section class="profile-hero py-4 py-md-5">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-md-2 text-center text-md-start">
                    <div class="avatar mx-auto mx-md-0">
                        @if($profileImageUrl)
                            <img src="{{ $profileImageUrl }}" alt="{{ $user->name }}">
                        @else
                            <i class="fa-solid fa-user fa-3x text-white-50"></i>
                        @endif
                    </div>
                </div>
                <div class="col-md-10">
                    <h1 class="h3 fw-bold mb-1">{{ $user->name }}</h1>
                    <div class="muted mb-2">
                        <span class="me-3"><i class="fa-solid fa-envelope me-1"></i>{{ $user->email }}</span>
                        @if($user->type)
                            <span class="badge bg-light text-dark text-uppercase">{{ $user->type }}</span>
                        @endif
                    </div>
                    @if($user->bio)
                        <p class="mb-0 muted">{{ $user->bio }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="container my-4 my-md-5">
        <div class="row g-4">
            <div class="col-lg-3">
                <div class="section-card">
                    <div class="p-3 border-bottom">
                        <div class="section-title">Profile Sections</div>
                    </div>
                    <div class="list-group list-group-flush toc rounded-bottom-3">
                        <a class="list-group-item list-group-item-action" href="#education">Education</a>
                        <a class="list-group-item list-group-item-action" href="#research-interests">Research Interests</a>
                        <a class="list-group-item list-group-item-action" href="#skills">Skills</a>
                        <a class="list-group-item list-group-item-action" href="#cv">Curriculum Vitae</a>
                        <a class="list-group-item list-group-item-action" href="#teaching-courses">Teaching Courses</a>
                        <a class="list-group-item list-group-item-action" href="#academic-positions">Academic Positions</a>
                        <a class="list-group-item list-group-item-action" href="#research-publications">Research / Publications</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div id="education" class="section-card mb-4">
                    <div class="p-3 border-bottom d-flex align-items-center justify-content-between">
                        <div class="section-title">Education</div>
                    </div>
                    <div class="p-3">
                        @if($user->educations->isEmpty())
                            <div class="empty">No education records added yet.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Degree</th>
                                            <th>Level</th>
                                            <th>Institute</th>
                                            <th>Year</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->educations as $edu)
                                            <tr>
                                                <td>{{ $edu->degree_name }}</td>
                                                <td>{{ $edu->degree_level }}</td>
                                                <td>{{ $edu->institute_name }}</td>
                                                <td>{{ $edu->passing_year }}</td>
                                                <td>{{ $edu->status }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

                <div id="research-interests" class="section-card mb-4">
                    <div class="p-3 border-bottom">
                        <div class="section-title">Research Interests</div>
                    </div>
                    <div class="p-3">
                        @if($user->biography)
                            <div style="white-space: pre-wrap;">{{ $user->biography }}</div>
                        @else
                            <div class="empty">No research interests added yet.</div>
                        @endif
                    </div>
                </div>

                <div id="skills" class="section-card mb-4">
                    <div class="p-3 border-bottom">
                        <div class="section-title">Skills</div>
                    </div>
                    <div class="p-3">
                        @php
                            $skills = is_array($user->teaching_courses) ? array_values(array_filter($user->teaching_courses)) : [];
                        @endphp
                        @if(empty($skills))
                            <div class="empty">No skills added yet.</div>
                        @else
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($skills as $skill)
                                    <span class="badge text-bg-secondary">{{ $skill }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="text-muted small mt-2">
                            Note: This section is mapped to your “Teaching Courses” data (until you add a separate Skills field).
                        </div>
                    </div>
                </div>

                <div id="cv" class="section-card mb-4">
                    <div class="p-3 border-bottom">
                        <div class="section-title">Curriculum Vitae</div>
                    </div>
                    <div class="p-3">
                        @if($user->biography)
                            <div class="empty">
                                CV file upload is not implemented yet in this project. Your biography text is shown above.
                            </div>
                        @else
                            <div class="empty">CV not uploaded yet.</div>
                        @endif
                    </div>
                </div>

                <div id="teaching-courses" class="section-card mb-4">
                    <div class="p-3 border-bottom">
                        <div class="section-title">Teaching Courses</div>
                    </div>
                    <div class="p-3">
                        @php
                            $courses = is_array($user->teaching_courses) ? array_values(array_filter($user->teaching_courses)) : [];
                        @endphp
                        @if(empty($courses))
                            <div class="empty">No teaching courses added yet.</div>
                        @else
                            <ul class="mb-0">
                                @foreach($courses as $c)
                                    <li>{{ $c }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div id="academic-positions" class="section-card mb-4">
                    <div class="p-3 border-bottom">
                        <div class="section-title">Academic Positions</div>
                    </div>
                    <div class="p-3">
                        @if($user->academicPositions->isEmpty())
                            <div class="empty">No academic positions added yet.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Description of Positions</th>
                                            <th>Institute</th>
                                            <th>From</th>
                                            <th>To</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->academicPositions as $pos)
                                            <tr>
                                                <td>{{ $pos->description }}</td>
                                                <td>{{ $pos->institute }}</td>
                                                <td>{{ optional($pos->from_date)->format('Y-m-d') }}</td>
                                                <td>{{ optional($pos->to_date)->format('Y-m-d') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

                <div id="research-publications" class="section-card">
                    <div class="p-3 border-bottom">
                        <div class="section-title">Research & Publications</div>
                    </div>
                    <div class="p-3">
                        @if($user->researches->isEmpty())
                            <div class="empty">No research/publications added yet.</div>
                        @else
                            <div class="list-group">
                                @foreach($user->researches as $r)
                                    <div class="list-group-item">
                                        <div class="d-flex justify-content-between flex-wrap gap-2">
                                            <div class="fw-semibold">{{ $r->title }}</div>
                                            <div class="text-muted small">{{ $r->date_of_publication }}</div>
                                        </div>
                                        @if($r->country)
                                            <div class="text-muted small">{{ $r->country }}</div>
                                        @endif
                                        @if($r->description)
                                            <div class="mt-2" style="white-space: pre-wrap;">{{ $r->description }}</div>
                                        @endif
                                        @if($r->url)
                                            <div class="mt-2">
                                                <a href="{{ $r->url }}" target="_blank" rel="noopener">View link</a>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


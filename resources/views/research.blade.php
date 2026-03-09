@extends('layouts.admin')

@section('title', 'Research')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('research.index') }}">Admin</a></li>
    <li class="breadcrumb-item active">Research</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-semibold">Research</h4>
        <a href="{{ route('research.store') }}" class="btn btn-admin-primary">
            <i class="fa-solid fa-plus me-1"></i> Add Research
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">Users List</div>
        <div class="admin-card-body p-0">
            <div class="table-responsive">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr>
                            <th>title</th>
                            <th>url</th>
                            <th>date_of_publication</th>
                            <th>description</th>
                            <th>country</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($researches as $research)
                            <tr>
                                <td>{{$research->title}}</td>
                                <td>{{$research->url}}</td>
                                <td>{{$research->date_of_publication }}</td>
                                <td>{{$research->description}}</td>
                                <td>{{$research->country }}</td>
                              
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No Research yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

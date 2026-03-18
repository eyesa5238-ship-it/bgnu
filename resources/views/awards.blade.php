@extends('layouts.admin')

@section('title', 'Awards & Honors')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('awards.index') }}">Admin</a></li>
    <li class="breadcrumb-item active">Awards & Honors</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-semibold">Awards & Honors</h4>
        <a href="{{ route('awards.create') }}" class="btn btn-admin-primary">
            <i class="fa-solid fa-plus me-1"></i> Add Award / Honor
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">List</div>
        <div class="admin-card-body p-0">
            <div class="table-responsive">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Year</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($awards as $award)
                            <tr>
                                <td>{{ $award->title }}</td>
                                <td>{{ $award->year ?? '-' }}</td>
                                <td class="text-capitalize">{{ $award->type }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">No Awards or Honors yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


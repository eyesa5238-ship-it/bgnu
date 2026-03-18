@extends('layouts.admin')

@section('title', 'Add Award / Honor')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('faculty.index') }}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ route('awards.index') }}">Awards & Honors</a></li>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-semibold">Add Award / Honor</h4>
        <a href="{{ route('awards.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Awards & Honors
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-body">
            <form action="{{ route('awards.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Title<span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Year (optional)</label>
                        <input type="number" name="year" class="form-control" min="1900" max="2100">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Type<span class="text-danger">*</span></label>
                        <select name="type" class="form-select" required>
                            <option value="">Select type</option>
                            <option value="award">Award</option>
                            <option value="honors">Honors</option>
                        </select>
                    </div>

                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="fa-solid fa-save me-1"></i> Save
                        </button>
                        <a href="{{ route('awards.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


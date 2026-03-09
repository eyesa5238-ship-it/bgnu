@extends('layouts.admin')

@section('title', 'Add research')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('faculty.index') }}">Admin</a></li>
    <li class="breadcrumb-item"><a href="{{ route('research.index') }}">Research</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-semibold">Add research</h4>
        <a href="{{ route('research.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Research
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-body">
            <form action="{{ route('research.add') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div
                    div class="col-md-6">
                        <label class="form-label">URL</label>
                        <input type="text" name="url" class="form-control"  required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date_of_publication</label>
                        <input type="date" name="date_of_publication" class="form-control"  required>
                    </div>
                     <div class="col-md-6">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" class="form-control"  required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-control"  required>
                    </div>


                    
                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="fa-solid fa-save me-1"></i> Update
                        </button>
                        <a href="{{ route('research.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

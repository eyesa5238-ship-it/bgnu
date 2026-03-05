@extends('layouts.admin')

@section('title', 'Biography')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('faculty.index') }}">Admin</a></li>
    <li class="breadcrumb-item active">Biography</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-semibold">Biography</h4>
        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Profile
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">Add or edit your biography</div>
        <div class="admin-card-body">
            <form action="{{ route('biography.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Biography</label>
                    <textarea name="biography" class="form-control" rows="12" placeholder="Write your full biography here...">{{ old('biography', $user->biography) }}</textarea>
                    @error('biography')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-admin-primary">
                    <i class="fa-solid fa-save me-1"></i> Save Biography
                </button>
            </form>
        </div>
    </div>
@endsection

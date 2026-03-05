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
                    </div>
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
</script>
@endpush

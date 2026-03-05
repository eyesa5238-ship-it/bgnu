@extends('layouts.admin')

@section('title', 'Academic Positions')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('faculty.index') }}">Admin</a></li>
    <li class="breadcrumb-item active">Academic Positions</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-semibold">Academic Positions</h4>
        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Profile
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">Add or edit your academic positions</div>
        <div class="admin-card-body">
            <p class="text-muted small mb-3">Description of position, institute, from and to dates.</p>
            <form action="{{ route('academic-positions.update') }}" method="POST">
                @csrf
                @method('PUT')
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
                <button type="button" class="btn btn-sm btn-outline-primary mb-3" id="addPosition">+ Add position</button>
                <div>
                    <button type="submit" class="btn btn-admin-primary">
                        <i class="fa-solid fa-save me-1"></i> Save Academic Positions
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
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

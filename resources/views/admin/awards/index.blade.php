@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-3">Awards and Honors</h2>

    <!-- ADD FORM -->
    <form action="{{ route('awards.honors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea name="description" class="form-control" placeholder="Enter description" required></textarea>
        </div>
        <button class="btn btn-primary">Save</button>
    </form>

    <hr>

    <!-- LIST -->
    @forelse($awards as $award)
        <div class="card mb-2 p-2">

            <!-- UPDATE -->
            <form action="{{ route('awards.honors.update', $award->id) }}" method="POST">
                @csrf
                @method('PUT')

                <textarea name="description" class="form-control mb-2">{{ $award->description }}</textarea>

                <button class="btn btn-success btn-sm">Update</button>
            </form>

            <!-- DELETE -->
            <form action="{{ route('awards.honors.delete', $award->id) }}" method="POST" class="mt-1">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm">Delete</button>
            </form>

        </div>
    @empty
        <p>No Awards yet.</p>
    @endforelse

</div>

@endsection
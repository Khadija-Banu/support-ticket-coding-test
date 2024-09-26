@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-4">Open a New Ticket</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf

        <!-- Ticket Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="subject" id="subject" class="form-control" value="{{ old('subject') }}" required>
        </div>

        <!-- Ticket Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="ticket_message" id="ticket_message" rows="5" class="form-control" required>{{ old('ticket_message') }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Submit Ticket</button>
        </div>
    </form>
</div>
@endsection

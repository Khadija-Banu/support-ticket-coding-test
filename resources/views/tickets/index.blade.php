@extends('layouts.app')

@section('content')
    <div class="container">
      

        <a href="{{ route('tickets.create') }}" class="btn btn-primary my-3">Open Tickets</a>
        <br>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($tickets->isEmpty())
            <div class="alert alert-info">No open tickets available.</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $role_id = auth()->user()->role_id;
                        $user_id = Auth::user()->id;
                    @endphp





                    @foreach ($tickets as $ticket)
                    @if($role_id == 1 || $user_id == $ticket->customer_id)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->subject }}</td>
                            <td>{{ Str::limit($ticket->ticket_message, 50) }}</td>
                            <td>{{ ucfirst($ticket->status) }}</td>
                            <td>
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-primary">View</a>
                                <form action="{{ route('tickets.close', $ticket->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to close this ticket?');">Close
                                        Ticket</button>
                                </form>


                            </td>
                        </tr>

                    @endif
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

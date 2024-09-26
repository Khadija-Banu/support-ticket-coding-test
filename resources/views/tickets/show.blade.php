@extends('layouts.app')

@section('content')
<div class="container mt-3">

    <div class="row">
        <div class="col col-lg-8 col-md-8">
            <div class="mt-2 bg-white p-3 mb-3 rounded">

                <h2><strong>Ticket #</strong>{{ $ticket->id }}</h2>

                <h4><strong>Subject:</strong> {{ $ticket->subject }}</h4>
                <p><strong>Message:</strong> {{ $ticket->ticket_message }}</p>
                <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
            </div>

            <div class="bg-white p-3 mb-3 rounded">
                <h5 class="mb-3">Ticket Replies</h5>
                @foreach ($ticket->ticket_replies as $reply)



                @if($reply->customer_id == $ticket->customer_id)
                <div class="mb-3 bg-secondary rounded p-3">
                    <h6>{{$reply->customer->name}}</h6>
                    <span>{{$reply->reply_message}}</span>
                </div>
                @else
                <div class="mb-3 bg-light rounded p-3">
                    <h6>{{$reply->customer->name}}</h6>
                    <span>{{$reply->reply_message}}</span>
                </div>
                @endif
                @endforeach
            </div>

            <form action="{{ route('tickets.respond', $ticket->id) }}" method="POST">
            @csrf
            <div class="form-group">
                
                <textarea name="response" id="response" rows="5" class="form-control" required
                    placeholder="type here..........."></textarea>
            </div>
            <button type="submit" class="btn btn-info mt-2">Go to Reply</button>
        </form>



         
        </div>













     
    </div>
    @endsection
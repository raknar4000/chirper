@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>{{ $chirp->title }}</h1>
            <p class="lead">{{ $chirp->body }}</p>
        </div>
        <div class="col-md-4">
            <div class="card my-4">
                <h5 class="card-header">Chirp Details</h5>
                <div class="card-body">
                    <p>Posted on {{ $chirp->created_at->format('M j, Y \a\t g:i a') }}</p>
                    <p>By {{ $chirp->user->name }}</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-8">
            <h3>Comments</h3>

            @if(count($chirp->comments))
                <ul class="list-unstyled">
                    @foreach($chirp->comments as $comment)
                        <li class="media">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">{{ $comment->user->name }}</h5>
                                {{ $comment->body }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else   
                <p>No comments yet.</p>
            @endif

            <!-- add the comment form -->
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('comments.store', $chirp->id) }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body" rows="3" placeholder="Type your comment here..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

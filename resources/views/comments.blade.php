<!-- comments.blade.php -->

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
        <form method="POST" action="{{ route('comments.store', $chirp) }}">
            @csrf
            <div class="form-group">
                <textarea class="form-control" name="body" rows="3" placeholder="Type your comment here..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

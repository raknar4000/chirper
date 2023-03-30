@foreach($chirps as $chirp)
    <div class="chirp">
        <h2>{{ $chirp->title }}</h2>
        <p>{{ $chirp->body }}</p>
        <p>By {{ $chirp->user->name }}</p>

        <!-- Display the comments section -->
        <div class="comments">
            @include('comments', ['chirp' => $chirp])
        </div>
    </div>
@endforeach

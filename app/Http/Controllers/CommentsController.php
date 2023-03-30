<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Chirp;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Chirp $chirp)
    {
        $comments = $chirp->comments()->with('user')->latest()->get();

        return view('comments', compact('comments', 'chirp'));
    }

    public function store(Request $request, Chirp $chirp)
    {
        // Validate the comment input
        $request->validate([
            'body' => 'required|max:255'
        ]);

        // Create a new comment and associate it with the chirp and current user
        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->user()->associate(auth()->user());
        $chirp->comments()->save($comment);

        // Redirect back to the chirp page with a success message
        return redirect()->route('chirps.show', $chirp)->with('success', 'Comment posted successfully.');
    }

public function show(Chirp $chirp): View
{
    $chirp->load('user', 'comments.user');

    return view('chirps.show', compact('chirp'));
}

    public function edit(Chirp $chirp): View
    {
        $this->authorize('update', $chirp);

        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
    }

    public function update(Request $request, Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $chirp->update($validated);

        return redirect(route('chirps.index'));
    }

    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return redirect(route('chirps.index'));
    }
}




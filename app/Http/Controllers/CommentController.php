<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Comment;

class CommentController extends Controller
{
    public function index(Video $video)
    {
        return $video->comments()->with('user')->paginate(20);
    }


    public function show(Comment $comment){
        return $comment->replies()->with('user')->paginate(5);
    }

    public function store(Request $request, Video $video)
    {
        return auth()->user()->comments()->create([
            'body' => $request->body,
            'video_id' => $video->id,
            'comment_id' => $request->comment_id
        ])->fresh();
    }
}

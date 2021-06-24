<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use App\Jobs\Videos\ConvertForStreaming;
use App\Jobs\Videos\CreateVideoThumbnail;

class UploadVideoController extends Controller
{
    public function index(Channel $channel) {
        return view('channels.upload', compact('channel'));
    }

    public function store(Channel $channel)
    {
        $video = $channel->videos()->create([
            'title' => request()->title,
            'path' => request()->video->store("channels/{$channel->id}")
        ]);

        CreateVideoThumbnail::dispatch($video);
        ConvertForStreaming::dispatch($video);

        return $video;
    }
}

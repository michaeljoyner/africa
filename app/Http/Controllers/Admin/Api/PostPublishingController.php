<?php

namespace App\Http\Controllers\Admin\Api;

use App\Blog\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostPublishingController extends Controller
{
    public function update(Request $request, Post $post)
    {
        $this->validate($request, ['publish' => 'required|boolean']);

        $new_state = $request->publish ? $post->publish() : $post->retract();

        return response()->json(['new_state' => $new_state]);
    }
}

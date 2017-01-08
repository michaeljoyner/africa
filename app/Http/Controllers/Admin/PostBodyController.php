<?php

namespace App\Http\Controllers\Admin;

use App\Blog\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostBodyController extends Controller
{

    public function edit(Post $post)
    {
        return view('admin.blog.body.edit')->with(compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, ['body' => '']);

        $content = $post->setBody($request->body);

        return response()->json(['body' => $content]);
    }
}

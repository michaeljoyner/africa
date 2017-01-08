<?php

namespace App\Http\Controllers\Admin;

use App\Blog\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostFeaturedImagesController extends Controller
{
    public function edit(Post $post)
    {
        return view('admin.blog.featuredimages.edit')->with(compact('post'));
    }
}

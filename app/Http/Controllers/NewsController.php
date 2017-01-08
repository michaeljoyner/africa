<?php

namespace App\Http\Controllers;

use App\Blog\Post;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $articles = Post::where('published', 1)->latest()->paginate(10);

        return view('front.news.index')->with(compact('articles'));
    }

    public function show($slug)
    {
        $article = Post::where('published', 1)->where('slug', $slug)->firstOrFail();

        return view('front.news.show')->with(compact('article'));
    }
}

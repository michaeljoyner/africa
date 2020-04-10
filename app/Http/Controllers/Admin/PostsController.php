<?php

namespace App\Http\Controllers\Admin;

use App\Blog\Post;
use App\Http\FlashMessaging\Flasher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.blog.index')->with(compact('posts'));
    }

    public function show(Post $post)
    {
        return view('admin.blog.show')->with(compact('post'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required|max:255']);

        $post = $request->user()->createPost($request->title, $request->description ?: null);

        $this->flasher->success('Post Created', 'Your post has been created. May it be well received');

        return redirect('admin/posts/' . $post->id . '/body/edit');
    }

    public function edit(Post $post)
    {
        return view('admin.blog.edit')->with(compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, ['title' => 'required|max:255']);

        $post->update([
            'title' => $request->title,
            'description' => $request->description ?: null
        ]);

        $this->flasher->success('Post Info Updated', 'You have successfully updated the post');

        return redirect("admin/posts/{$post->id}");
    }

    public function delete(Post $post)
    {
        $post->delete();

        $this->flasher->success('Post Deleted', 'The post has been deleted.');

        return redirect('admin');
    }
}

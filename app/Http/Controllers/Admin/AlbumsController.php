<?php

namespace App\Http\Controllers\Admin;

use App\Gallery\Album;
use App\Http\FlashMessaging\Flasher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumsController extends Controller
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
        $albums = Album::latest()->get();

        return view('admin.albums.index')->with(compact('albums'));
    }

    public function show(Album $album)
    {
        return view('admin.albums.show')->with(compact('album'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required|max:255']);

        $album = Album::create($request->only('title'));

        $this->flasher->success('Album Created', 'The album has been created, time to share those shots.');

        return redirect('admin/albums/' . $album->id);
    }

    public function edit(Album $album)
    {
        return view('admin.albums.edit')->with(compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $this->validate($request, ['title' => 'required|max:255']);

        $album->update($request->only('title'));

        $this->flasher->success('Changes Saved!', 'This album has been successfully updated.');

        return redirect('admin/albums/' . $album->id);
    }

    public function delete(Album $album)
    {
        $album->delete();

        $this->flasher->success('Album Deleted', 'The album has been deleted.');

        return redirect('admin/albums');
    }
}

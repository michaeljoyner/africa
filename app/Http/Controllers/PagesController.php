<?php

namespace App\Http\Controllers;

use App\Assocciates\Partner;
use App\Assocciates\Sponsor;
use App\Assocciates\TeamMember;
use App\Compliance\Document;
use App\Gallery\Album;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $members = TeamMember::where('published', 1)->get();
        $partners = Partner::where('published', 1)->get();
        $sponsors = Sponsor::where('published', 1)->get();
        $documents = Document::where('published', 1)->get();
        return view('front.home.page')->with(compact('members', 'partners', 'sponsors', 'documents'));
    }

    public function about()
    {
        return view('front.about.page');
    }

    public function gallery()
    {
        $albums = Album::where('published', 1)->latest()->get();
        return view('front.gallery.page')->with(compact('albums'));
    }
}

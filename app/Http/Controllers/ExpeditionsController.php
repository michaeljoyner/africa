<?php

namespace App\Http\Controllers;

use App\Expeditions\Expedition;
use Illuminate\Http\Request;

class ExpeditionsController extends Controller
{
    public function index()
    {
        $expeditions = Expedition::where('published', 1)->latest()->get();

        return view('front.expeditions.index')->with(compact('expeditions'));
    }

    public function show($slug)
    {
        $expedition = Expedition::where('slug', $slug)->firstOrFail();

        return view('front.expeditions.show')->with(compact('expedition'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index ($slug)
    {
        $tag = Tag::whereSlug($slug)->with('blogs')->first();
        return view('tag.index', compact('tag'));
    }
}

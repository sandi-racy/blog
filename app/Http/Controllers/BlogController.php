<?php

namespace App\Http\Controllers;

use Image;
use App\Blog;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::lists()->simplePaginate(6);
        $headline = $blogs->shift();

        $featureds = [];
        for ($i = 1; $i <= 2; $i++) {
            $blog = $blogs->shift();
            if ($blog) {
                array_push($featureds, $blog);
            }
        }

        return view('blog.index', compact('blogs', 'headline', 'featureds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::lists()->get();
        return view('blog.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlog $request)
    {
        try {
            $image = $this->saveImage($request->image);

            $data = $request->all();
            $data['image'] = $image;
            $data['user_id'] = 1;

            $blog = Blog::create($data);

            if ($request->tags) {
                $tags = $this->saveTags($request->tags);
                $blog->tags()->attach($tags);
            }
            
            return back()->with('success', 'Data have been saved successfully');
        } catch (Exception $e) {
            return back()->with('fail', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $blog = Blog::whereSlug($slug)->first();
        return view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saveImage ($image)
    {
        $path = [
            'banner' => public_path('images/banners/') . '/',
            'thumbnail' => public_path('images/thumbnails/') . '/'
        ];

        $name = uniqid() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->fit(1110, 362)->save($path['banner'] . $name);
        Image::make($image)->fit(200, 250)->save($path['thumbnail'] . $name);
        return $name;
    }

    public function saveTags ($tags)
    {
        $result = [];

        foreach ($tags as $tag) {
            $item = Tag::firstOrCreate([
                'id' => $tag
            ], [
                'name' => $tag
            ]);
            array_push($result, $item->id);
        }

        return $result;
    }

    public static function renderTags ($tags)
    {
        $result = [];
        foreach ($tags as $tag) {
            $link = '<a href="' . url('tags/' . $tag->slug) . '">' . $tag->name . '</a>';
            array_push($result, $link);
        }
        return implode(', ', $result);
    }
}

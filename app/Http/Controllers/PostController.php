<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $posts = Post::with('user')->latest()->get();
       return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content'=>'string',
            'image_path'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $fileName = time() . '.' . $request->image_path->extension();
        $request->image_path->storeAs('public/images', $fileName);
        $post_image = new Post();
        $post_image->image_path = $fileName;
        $post_image->save();

        $save_post = $request->user()->userprofile()->create($validated);
        $result = ($save_post) ? ['message'=>'Success', $save_post,]: ['message'=>'failed'];

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

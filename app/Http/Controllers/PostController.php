<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Website $website
     * @return \Illuminate\Http\Response
     */
    public function index(Website $website)
    {
        $posts = $website->posts()->paginate();

        return response()->json([
            'status' => true,
            'message' => 'Posts fetched successfully.',
            'data' => [
                'posts' => $posts,
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StorePostRequest $request
     * @param Website $website
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request, Website $website)
    {
        $post = new Post();
        $post->website()->associate($website);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return response()->json([
            'status' => true,
            'message' => 'Post created successfully.',
            'data' => [
                'post' => $post,
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}

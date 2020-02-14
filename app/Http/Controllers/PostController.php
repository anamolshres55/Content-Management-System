<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

use App\Post;

use App\Tag;    

use App\Storage;

use App\Http\Requests\Posts\CreatePostRequest;

use App\Http\Requests\Posts\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('verifyCategoriesCount')->only(['create','store']);
    }
    public function index()
    {
        return view('post.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //upload the image to storage
        //create the post   
        //flash message
        //redirect user
        $image = $request->image->store('posts');

       $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id
        ]);

        if($request->tags) {
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'Post Created Successfully');

        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.create')->with('post', $post)->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //check if new image 
        //upload the new image and delete the old one
        //update attributes
        // flash message
        // redirect user

        $data = $request->only(['title', 'description', 'published_at', 'content']);

        //check if new image

        if ($request->hasFile('image')) {

            //upload it

            $image = $request->image->store('posts');

            //deelete old one

            $post->deleteImage();

            $data['image'] = $image;
        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        $post->update($data);

        session()->flash('success', 'Post Updated Successfully');

        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if ($post->trashed()) {
            $post->deleteImage();
            $post->forceDelete();
        } else {
            $post->delete();
        }
        session()->flash('success', 'Post Deleted Successfully');

        return redirect(route('post.index'));
    }

    public function trashed()
    {
        /**
         * Display a list of all trash post
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */

        $trashed = Post::onlyTrashed()->get();
        return view('post.index')->withPosts($trashed);
    }

    public function restore($id){
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
            session()->flash('success','Post restored succesffully');

            return redirect()->back();
    }

}

<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;

use App\Post;

use App\Tag;

use App\Category;

use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function show(Post $post){
        return view('blog.show')->with('post', $post);

    }

    
    public function category(Category $category, Post $post){

        return view('blog.category')
        ->with('category',$category)
        ->with('categories', Category::all())
        ->with('tags', Tag::all())
        ->with('posts',$category->post()->searched()->simplePaginate(3));
    }

    public function tag(Tag $tag, Category $category){
        
        return view('blog.tag')
        ->with('tag',$tag)
        ->with('tags', Tag::all())
        ->with('categories', Category::all())
        ->with('category',$category)
        ->with('posts',$tag->posts()->searched()->simplePaginate(4));
    }
}

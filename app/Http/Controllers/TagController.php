<?php

namespace App\Http\Controllers;


use App\Models\BlogPost;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __invoke($slug)
    {

        //get the requested tag
        $tag = Tag::query()
            ->where('slug', $slug)
            ->firstOrFail();

        //get the posts with that tag
        $posts = $tag->blogPosts()
            ->where('is_published',true)
            ->orderBy('id','desc')
            ->get();

        //get all the categories
        $categories = Category::all();

        //get all the tags
        $tags = Tag::all();

        //get the recent 5 posts
        $recent_posts = BlogPost::query()
            ->where('is_published',true)
            ->orderBy('created_at','desc')
            ->take(5)
            ->get();

        //return the data to the corresponding view
        return view('tag', [
            'tag' => $tag,
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'recent_posts' => $recent_posts
        ]);
    }
}

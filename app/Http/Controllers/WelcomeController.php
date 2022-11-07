<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        //-------------this search method replaced by scope used in Post model ----------------
        // $search = request()->query('search');
        // if($search) {
        //     $posts = Post::where('name', 'LIKE', "%{$search}%")->simplePaginate(2);
        // }else{
        //     $posts = Post::simplePaginate(2);
        // }

        return view('welcome')
            ->with('posts', Post::searched()->paginate(4))  //Using scope method in post model
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }
}

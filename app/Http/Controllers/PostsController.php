<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\posts\CreatePostRequest;
use App\Http\Requests\posts\UpdatePostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only('create', 'store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //Upload The Image
        $image = $request->image->store('posts', 'public'); //should make the link [php artisan storage:link]
        //Create The Post
        $post = Post::create([
            'name' => $request->name,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id
        ]);

        //use attach() method for many to many relationship
        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        //Flash Session
        session()->flash('success', 'Post created successfully ');
        //Redirect user
        return redirect(route('posts.index'));
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
        //dd($post->tags->pluck('id')->toArray());
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
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
        $data = $request->only(['name', 'description', 'content', 'published_at']);
        //Check if there is anew image
        if($request->hasFile('image')){
            //uploade it
            $image = $request->image->store('posts', 'public');
            //delete old one
            $post->deleteImage(); //Storage::disk('public')->delete($post->image);

            $data['image'] = $image;
        }

        //use sync() method for many to many relationship
        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        //update attributes
        $post->update($data);

        //flash session
        session()->flash('success', 'Post updated successfully');

        //redirect user
        return redirect(route('posts.index'));
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

        if($post->trashed()){
            $post->deleteImage();//Storage::disk('public')->delete($post->image);  //========Use disk('public')======//
            $post->forceDelete();
        }else{
            $post->delete();
        }

        session()->flash('success', 'Post deleted successfully ');

        return redirect(route('posts.index'));
    }

    /**
     * Display trashed posts
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts', $trashed);
    }

    /**
     * restore trashed posts
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post restored successfully ');

        return redirect()->back();
    }
}

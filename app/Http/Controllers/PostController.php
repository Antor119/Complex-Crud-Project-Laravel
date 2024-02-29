<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts =Post::latest()->get();
        return view("pages.index",compact("posts"));

    }

    public function create(){
        return view("pages.create");

    }

    public function store(Request $request){
        //dd($request->all());
       $request->validate([
        "title"=> "required",
        "description"=> "required",
        "category"=> "required",
        "tags"=> "required|array",
        "status"=> "required",
        "featured_image"=> "required|image"

       ]) ;

       //image store

       if($request->hasFile("featured_image")){
        $image = $request->file("featured_image");
        $filename = 'post_image_'.md5('uniqid'). time() .".". $image->getClientOriginalExtension();
       $image->move(public_path("images"), $filename);
       }

       //post create

       Post::create([
        "title"=> $request->title,
        "description"=> $request->description,
        "category"=> $request->category,
        "tags"=> $request->tags,
        "status"=> $request->status,
        "featured_image"=>$filename

       ]);
       return redirect()->back()->with("success","post with successfuly");

    }

    public function show($id){
        $post = Post::findOrFail($id);
        return view("pages.show",compact("post"));
    }

    public function edit($id){
        $post = Post::findOrFail($id);
        return view("pages.edit",compact("post"));
    }

    public function update(Request $request, $id){

        $request->validate([
            "title"=> "required",
        "description"=> "required",
        "category"=> "required",
        "tags"=> "required|array",
        "status"=> "required",
        "featured_image"=> "nullable|image"
        ]);

        //Image Upload
        if($request->hasFile('featured_image')){
            $image = $request->file('featured_image');
            $filename = 'post_image_'.md5((uniqid())).time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'),$filename);
        }
        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'tags' => $request->tags,
            'status' => $request->status,
            'featured_image' =>  $request->hasFile('featured_image') ? $filename : $post->featured_image,
        ]);

        return redirect()->back()->with('success', 'Post updated Successfully');
    }

    public function destroy($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->back()->with("success","Post Deleted Success");
    }
}

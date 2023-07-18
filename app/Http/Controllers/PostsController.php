<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\User_Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //I return the posts
        //return view('dashboard',[
        //    'post'=>$post
        //]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        /*$request->validate([
            'InputPost'=>'required',
            'image'=>'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048',
        ]);*/
        //Méthode tutos

        /*$input=$request->all();
        if($image=$request->file('image')){
            $destinationPath='images/';
            $profileImage=date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath,$profileImage);
            $input['image']=$profileImage;
            //$post->image=$profileImage;
        }*/

        //Méthode Junior

        $obj=new Post();
        $obj->text=$request->input('InputPost');
        $obj->user_id=$request->input('id_user');
        if($request->hasfile('image')){
            $img=$request->file('image');
            $name=$img->getClientOriginalName();
            $fileName=$name;
            $img->move('imageposts/',$fileName);
            $obj->image=$fileName;
        }
        $obj->save();

        //Post::create(['text'=>$request->InputPost,'user_id'=>$request->id_user,'image'=>$input]);
        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     */


    public function show(Post $posts)
    {
        $posts=Post::all()->sortByDesc('created_at');

        // print_r($pub) ;
        return view('dashboard',compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return to_route('dashboard');
    }
}

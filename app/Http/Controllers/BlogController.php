<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Auth;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::all();
        return view('admin.blog.index', ['blogs' => $blogs]);
    }

    public function show($blogName){
        
        $blog = Blog::where('title', str_replace('-', ' ',$blogName))->firstOrFail();
            //dd($blog);

        $blog->posts = $blog->posts->split(2);
        //dd($posts);


        return view('blog.show', ['blog' => $blog]);
    }
    public function edit($blogName){
        $blog = Blog::where('title', str_replace('-', ' ',$blogName))->firstOrFail();

        return view('blog.edit', ['blog' => $blog]);
    }
    public function update(Request $request, $id){
        Blog::where('id', decrypt($id))->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);


        return redirect()->route('blog.show', str_replace(' ', '-', $request->title))->with('success', 'Your blog has been updated successfully!');
    }

    public function destroy($id){

        $decryptId = decrypt($id);

        $blog = Blog::findOrFail($decryptId);

        $blog->status = 'deleted';

        $blog->save();


        return redirect()->route('admin.blogs')->with('success', "The Blog: <b>".$blog->title."</b> has been updated<br> It's new status is </b>DELETED</b>");

    }
}

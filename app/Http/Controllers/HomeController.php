<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function search(Request $request){
        $searchTerm = $request->input('searchTerm');

    // Wydajne zapytanie SQL z użyciem indeksów, a nie wielu warunków 'like'
    $posts = Post::where(function ($query) use ($searchTerm) {
        $query->where('title', 'like', '%' . $searchTerm . '%')
              ->orWhere('content', 'like', '%' . $searchTerm . '%');
    })
    ->with('blog')
    ->select('id', 'title', 'content', 'blog_id', 'author')
    ->paginate(5); // Dodajemy paginację

    return view('blog.search', ['posts' => $posts]);
 
    //return response()->json(['posts' => $posts]);

    }
    public function editAboutUs(){
        return view('admin.about-us.edit');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Blog;
use App\Models\Tag;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    public function index(){
        $blog = Blog::where('user_id', Auth::id())->with('posts')->firstOrFail();

        return view('blog.post.index', ['blog' => $blog]);

    }
    public function show($postId){
                
        $post = Post::where('id', decrypt($postId))->firstOrFail();

        return view('blog.post.show', ['post' => $post]);

    }
    public function edit($id){
        $post = Post::where('id', decrypt($id))->firstOrFail();

        return view('blog.post.edit', ['post' => $post]);
    }

    public function update(Request $request, $id){
        $decryptedId = decrypt($id);
        $post = Post::with('blog.user')->findOrFail($decryptedId);
        $user = $post->blog->user;

        if(Auth::id() == $user->id){
            $post->update([
                'title' => $request->title,
                'content' => $request->editor_content,
            ]);

            // Pobierz aktualne ID tagów przypisanych do posta
            $currentTagIds = $post->tags->pluck('id')->toArray();

            // Stwórz tablicę ID nowych tagów
            $newTags = [];
            foreach ($request->tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                array_push($newTags, $tag->id);
            }

            // Znajdź tagi do odłączenia (te, które już nie są w przesłanych tagach)
            $tagsToDetach = array_diff($currentTagIds, $newTags);
            // Znajdź tagi do dołączenia (nowe tagi, które nie były wcześniej przypisane)
            $tagsToAttach = array_diff($newTags, $currentTagIds);

            // Odłącz stare tagi
            $post->tags()->detach($tagsToDetach);
            // Dołącz nowe tagi
            $post->tags()->attach($tagsToAttach);
        }
        return redirect()->route('post.index')->with('success', 'Your post has been updated successfly');
    }


    public function create(){
        $blog = Blog::where('user_id', Auth::id())->first();

        if($blog->count() == 0){
            return redirect()->route('dashboard');
        }

        return view('blog.post.create', ['blog_id' => $blog->id]);
    }

    public function store(Request $request){
    //    dd($request->tag);
 //       dd($request);
        $rules = [
            'blog_id' => 'required',
            'title' => 'required|max:255',
            'content' => 'required',
            'author' => 'required|max:255',
            'created_at' => 'required|date',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
    //    return response()->json($request->all());
    
    
    

        $post = Post::create($validator->validated());

        if(!empty($request->tags)){
                // Iteruj przez tagi i zapisz je
            foreach ($request->tags as $tagName) {
                // Sprawdź, czy tag o danej nazwie już istnieje
                if($tagName == null){
                    continue;
                }
                $tag = Tag::firstOrCreate(['name' => $tagName]);
            
                // Przypisz tag do posta
                $tag->posts()->attach($post->id);
            }
        }

        return redirect()->route('post.index')->with('success', 'Post został pomyślnie dodany!');
    //  return response()->json($request->all());
    }

    public function destroy($id)
    {
        $decryptedId = decrypt($id);
        $post = Post::with('blog.user')->findOrFail($decryptedId);
        $user = $post->blog->user;
    
        if (Auth::id() == $user->id) {
            Post::where('id', $decryptedId)->delete();
            return redirect()->route('post.index')->with('success', 'Post has been deleted!');
        } else {
            abort(404);
        }
    }
    
}

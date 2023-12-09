<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use DB;

class TagController extends Controller
{
    public function show($tagName){
        $tag = Tag::where('name', $tagName)->with('posts')->get();
        
        return view('tag.show', ['tag' => $tag]);

    }


    public function removeTag(Request $request, $tagId){
        // jak to zabezpieczyc
        $aa = DB::table('post_tag')->where('post_id', $request->post_id)->where('tag_id', $tagId)->delete();



//    dd($tagId, $request->post_id, $aa);
    // Kod usuwania taga z bazy danych
    
    return response()->json(['message' => 'Tag removed successfully']);
}

}

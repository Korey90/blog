<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AvatarController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096|dimensions:max_width=1024,max_height=1024',
        ]);
        

        $imageName = time().'.'.$request->avatar->extension();  
        $request->avatar->move(public_path('avatars'), $imageName);

        User::where('id', Auth::id())->update([
            'avatar' => $imageName,
        ]);

        // Tu możesz zapisać $imageName w bazie danych, jeżeli potrzebujesz

        return response()->json(['success' => 'Avatar przesłany pomyślnie.',
                                'image' => $imageName]);
    }

    public function destroy($avatar){

        User::where('avatar', decrypt($avatar))->update([
            'avatar' => null,
        ]);

        return redirect()->back()->with('message', 'Avatar has been removed successfly');
    }
}

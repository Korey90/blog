<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::with('roles', 'blog')->get();

        $roles = \App\Models\Role::pluck('name');

       // dd($roles);

        return view('admin.user.index', ['users' => $users, 'roles' => $roles]);

    }

    public function show($id){
        $decryptId = decrypt($id);

        $user = User::with('roles')->findOrFail($decryptId);

        return view('admin.user.show', ['user' => $user]);
    }

    public function edit($id){
        $decryptId = decrypt($id);
        
        $user = User::with('roles', 'blog')->findOrFail($decryptId);

        $roles = \App\Models\Role::all();

        return view('admin.user.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, $id){
        $decryptId = decrypt($id);

            // Znajdź użytkownika do zaktualizowania
        $user = User::findOrFail($decryptId);

        // Zaktualizuj podstawowe informacje o użytkowniku
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        // Zaktualizuj role użytkownika (usuwając wcześniejsze role i dodając nowe)
        $user->roles()->sync($request->input('roles'));

        // Zaktualizuj informacje o blogu użytkownika
        $blog = $user->blog;
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
        $blog->about_author = $request->input('blog_about_author');
        
        // Zapisz zmiany w bazie danych
        $user->save();
        $blog->save();

        return redirect()->route('admin.user.index')->with('success', 'The profile has been updated successfly');

    }


    public function destroy($id){
        return $id;

    }
}

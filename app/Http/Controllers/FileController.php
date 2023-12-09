<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $files = Storage::files('public');
        return view('files.index', compact('files'));
    }

    public function create()
    {
        return view('files.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $file = $request->file('file');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/', $fileName);

        return redirect()->route('files.index')->with('success', 'Plik został przesłany pomyślnie.');
    }

    public function edit($id)
    {
        $file = Storage::url('public/' . $id);
        return view('files.edit', compact('file'));
    }

    public function update(Request $request, $id)
    {
        // Obsługa zmiany nazwy pliku
        $newFileName = $request->input('newFileName');
        Storage::move('public/' . $id, 'public/uploads/' . $newFileName);

        return redirect()->route('files.index')->with('success', 'Nazwa pliku została zmieniona.');
    }

    public function destroy($id)
    {
        // Usunięcie pliku
       // $file = str_replace('public', 'storage', $id);
        //dd($id);
        Storage::delete('public/'.$id);

        return redirect()->route('files.index')->with('success', 'Plik został usunięty.');
    }
}

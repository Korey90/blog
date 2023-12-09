<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::first(); // Pobierz pierwszy rekord z tabeli "about_us"
        return view('admin.about-us.index', ['aboutUs' => $aboutUs]);
    }

    public function edit()
    {
        $aboutUs = AboutUs::first(); // Pobierz pierwszy rekord z tabeli "about_us"
        return view('admin.about-us.edit', ['aboutUs' => $aboutUs]);
    }

    public function update(Request $request)
    {
        $aboutUs = AboutUs::first(); // Pobierz pierwszy rekord z tabeli "about_us"

        $aboutUs->title = $request->input('title');
        $aboutUs->content = $request->input('content');
        $aboutUs->photo = $request->input('photo');
        // Przypisz wartości do innych pól, jeśli są

        $aboutUs->save();

        return redirect()->route('about-us')->with('success', 'Aktualizacja About Us zakończona sukcesem!');
    }
}

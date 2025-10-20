<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Http\Request;

class FilterMakanan extends Controller
{
    public function index(Request $request, $id=1){
      $kategori = $request->get('kategori');

      $menus = Menu::when($kategori, function($query, $kategori){
        return $query->where('kategori', $kategori);
      })->get();

      $meja_id = $id;


      return view('welcomeMenu', compact('menus', 'kategori', 'meja_id'));
    }

}

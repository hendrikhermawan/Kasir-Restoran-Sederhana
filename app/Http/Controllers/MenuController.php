<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('kategori')->get();
        $kategoris = Kategori::all();
        return view('menu', compact('menus', 'kategoris'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $newName = '';
        if ($request->hasFile('gambar')) {
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $newName = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('gambar')->storeAs('menu-images', $newName);
        }

        Menu::create([
            'nama' => $validatedData['nama'],
            'harga' => $validatedData['harga'],
            'gambar' => 'storage/menu-images/' . $newName,
            'kategori_id' => $validatedData['kategori_id'],
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        if ($request->hasFile('gambar')) {
            if (file_exists(public_path($menu->gambar))) {
                unlink(public_path($menu->gambar));
            }
            $newName = $request->nama . '-' . now()->timestamp . '.' . $request->gambar->getClientOriginalExtension();
            $request->file('gambar')->storeAs('menu-images', $newName);
            $menu->gambar = 'storage/menu-images/' . $newName;
        }

        $menu->update([
            'nama' => $validated['nama'],
            'harga' => $validated['harga'],
            'kategori_id' => $validated['kategori_id'],
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus!');
    }
}

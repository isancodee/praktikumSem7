<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SatuanController extends Controller
{
    public function index(): View
    {
        $satuans = Satuan::latest()->paginate(10);
        return View('satuan.index', compact('satuans'));
    }

    public function create(): view
    {
        return view('satuan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'deskripsi' => 'required',
        ]);

        Satuan::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi
        ]);
        return redirect()->route('satuan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        //get satuan by ID
        $satuan = Satuan::findOrFail($id);
        //render view with satuan
        return view('satuan.show', compact('satuan'));
    }

    public function edit(string $id): View
    {
        //get satuan by ID
        $satuan = Satuan::findOrFail($id);
        //render view with satuan
        return view('satuan.edit', compact('satuan'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required',
            'deskripsi' => 'required',
        ]);
        //get product by ID
        $satuan = Satuan::findOrFail($id);
        //update product without image
        $satuan->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi
        ]);

        //redirect to index
        return redirect()->route('satuan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        //get product by ID
        $satuan = Satuan::findOrFail($id);

        //delete satuan
        $satuan->delete();
        //redirect to index
        return redirect()->route('satuan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}

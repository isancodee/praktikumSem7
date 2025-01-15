<?php

namespace App\Http\Controllers;

//import return type View

use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class KategoriController extends Controller
{
    public function index(): view
    {
        $categorys = Kategori::latest()->paginate(10);
        return view('category.index', compact('categorys'));
    }

    public function create(): view
    {
        return view('category.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([

            'name' => 'required',

        ]);

        Kategori::create([

            'name' => $request->name,

        ]);
        return redirect()->route('category.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        //get category by ID
        $category = Kategori::findOrFail($id);
        //render view with category
        return view('category.show', compact('category'));
    }

    public function edit(string $id): View
    {
        //get category by ID
        $category = Kategori::findOrFail($id);
        //render view with category
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'name' => 'required',
        ]);
        //get category by ID
        $category = Kategori::findOrFail($id);
        //check if image is uploaded

        //update Kategori without image
        $category->update([
            'name' => $request->name,
        ]);

        //redirect to index
        return redirect()->route('category.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        //get product by ID
        $category = Kategori::findOrFail($id);

        //delete category
        $category->delete();
        //redirect to index
        return redirect()->route('category.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function printPdf()
    {
        $categorys = Kategori::get();
        $data = [
            'title' => 'Welcome To fti.uniska-bjm.ac.id',
            'date' => date('m/d/Y'),
            'categorys' => $categorys
        ];
        $pdf = PDF::loadview('category.categoryPdf', $data);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Data category.pdf', array("attachment"
        => false));
    }
}

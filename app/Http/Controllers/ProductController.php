<?php

namespace App\Http\Controllers;

// import model produkct
use App\Models\Product;

//import return type View
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\PDF;
//import return type redirectResponse
use Illuminate\Http\RedirectResponse;
//import Http Request
use Illuminate\Http\Request;
//import Facades Storage
use Illuminate\Support\Facades\Storage;

use function Ramsey\Uuid\v1;



class ProductController extends Controller
{
  public function index(): view
  {


    // ambil semua data dari product
    $products = product::latest()->paginate(10);

    return view('products.index', compact('products'));
  }

  public function create(): view
  {
    return view('products.create');
  }

  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
      'title' => 'required|min:5',
      'description' => 'required|min:10',
      'price' => 'required|numeric',
      'stock' => 'required|numeric'
    ]);

    $image = $request->file('image');
    $image->storeAs('public/products', $image->hashName());

    Product::create([
      'image' => $image->hashName(),
      'title' => $request->title,
      'description' => $request->description,
      'price' => $request->price,
      'stock' => $request->stock
    ]);
    return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
  }

  public function show(string $id): View
  {
    //get product by ID
    $product = Product::findOrFail($id);
    //render view with product
    return view('products.show', compact('product'));
  }

  public function edit(string $id): View
  {
    //get product by ID
    $product = Product::findOrFail($id);
    //render view with product
    return view('products.edit', compact('product'));
  }

  public function update(Request $request, $id): RedirectResponse
  {
    //validate form
    $request->validate([
      'image' => 'image|mimes:jpeg,jpg,png|max:2048',
      'title' => 'required|min:5',
      'description' => 'required|min:10',
      'price' => 'required|numeric',
      'stock' => 'required|numeric'
    ]);
    //get product by ID
    $product = Product::findOrFail($id);
    //check if image is uploaded
    if ($request->hasFile('image')) {
      //upload new image
      $image = $request->file('image');
      $image->storeAs('public/products', $image->hashName());
      //delete old image
      Storage::delete('public/products/' . $product->image);
      //update product with new image
      $product->update([
        'image' => $image->hashName(),
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock
      ]);
    } else {
      //update product without image
      $product->update([
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock
      ]);
    }
    //redirect to index
    return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
  }

  public function destroy($id): RedirectResponse
  {
    //get product by ID
    $product = Product::findOrFail($id);
    //delete image
    Storage::delete('public/products/' . $product->image);
    //delete product
    $product->delete();
    //redirect to index
    return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
  }

  public function printPdf()
  {
    $products = Product::get();
    $data = [
      'title' => 'Welcome To fti.uniska-bjm.ac.id',
      'date' => date('m/d/Y'),
      'products' => $products
    ];
    $pdf = PDF::loadview('products.productPdf', $data);
    $pdf->setPaper('A4', 'landscape');
    return $pdf->stream('Data product.pdf', array("attachment"
    => false));
  }
}

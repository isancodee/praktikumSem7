@extends('theme.default')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Product</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Products</li>
        </ol>

        <div class="card mb-4">
            <div class="card-body">
                <a href="{{ route('products.create') }}" class="btn btn-md btn-success mb-3">ADD PRODUCT</a>
                <a href="{{ route('printProduct') }}" class="btn btn-md btn-warning mb-3">PRINT Pdf</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">IMAGE</th>
                            <th scope="col">TITLE</th>
                            <th scope="col">PRICE</th>
                            <th scope="col">STOCK</th>
                            <th scope="col" style="width: 20%">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset('/storage/products/' . $product->image) }}" class="rounded"
                                        style="width: 150px" alt="">
                                </td>
                                <td>{{ $product->title }}</td>
                                <td>{{ 'Rp ' . number_format($product->price, 2, ',', ',') }}</td>
                                <td>{{ $product->stock }}</td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center">
                                        <!-- Tombol SHOW -->
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="btn btn-sm btn-dark me-2">SHOW</a>

                                        <!-- Tombol EDIT -->
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-sm btn-primary me-2">EDIT</a>

                                        <!-- Tombol DELETE -->
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Product tidak tersedia
                            </div>
                        @endforelse
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
@section('alertload')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bu
                                            ndle.min.js"></script>
@endsection

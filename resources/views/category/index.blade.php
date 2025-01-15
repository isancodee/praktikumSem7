@extends('theme.default')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kategori</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Kategori</li>
        </ol>

        <div class="card mb-4">
            <div class="card-body">
                <a href="{{ route('category.create') }}" class="btn btn-md btn-success mb-3">ADD PRODUCT</a>
                <a href="{{ route('printCategory') }}" class="btn btn-md btn-warning mb-3">PRINT Pdf</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">NAME</th>
                            <th scope="col" style="width: 20%">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorys as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center">
                                        <!-- Tombol SHOW -->
                                        <a href="{{ route('category.show', $category->id) }}"
                                            class="btn btn-sm btn-dark me-2">SHOW</a>
                                        <!-- Tombol EDIT -->
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-sm btn-primary me-2">EDIT</a>

                                        <!-- Tombol DELETE -->
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST"
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
                {{ $categorys->links() }}
            </div>
        </div>
    </div>
@endsection
@section('alertload')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bu
                                                    ndle.min.js"></script>
@endsection

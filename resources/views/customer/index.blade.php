@extends('theme.default')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Customer</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Customers</li>
        </ol>

        <div class="card mb-4">
            <div class="card-body">
                <a href="{{ route('customer.create') }}" class="btn btn-md btn-success mb-3">ADD CUSTOMER</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">NIK</th>
                            <th scope="col">NAME</th>
                            <th scope="col">TELPON</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">Alamat</th>
                            <th scope="col" style="width: 20%">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $customer)
                            <tr>
                                <td>{{ $customer->nik }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->telp }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->alamat }}</td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center">
                                        <!-- Tombol SHOW -->
                                        <a href="{{ route('customer.show', $customer->id) }}"
                                            class="btn btn-sm btn-dark me-2">SHOW</a>

                                        <!-- Tombol EDIT -->
                                        <a href="{{ route('customer.edit', $customer->id) }}"
                                            class="btn btn-sm btn-primary me-2">EDIT</a>

                                        <!-- Tombol DELETE -->
                                        <form action="{{ route('customer.destroy', $customer->id) }}" method="POST"
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
                                Data customer tidak tersedia
                            </div>
                        @endforelse
                    </tbody>
                </table>
                {{ $customers->links() }}
            </div>
        </div>
    </div>
@endsection
@section('alertload')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bu
                                                    ndle.min.js"></script>
@endsection

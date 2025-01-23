@php
    header('Content-type: application/vnd-ms-excel');
    header('Content-Disposition: attachment; filename=export_user.xls');
@endphp
<!DOCTYPE html>
<html>

<head>
    <title>Laravel 11 Generate PDF Example -
        ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap
.min.css">
    <style>
        table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
        do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.</p>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>IMAGE</th>
            <th>TITLE</th>
            <th>PRICE</th>
            <th>STOCK</th>

        </tr>
        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td> <img src="{{ public_path('storage/products/' . $product->image) }}"
                                    style="width: 80px; height: auto;">
                            </td>
                            <td>{{ $product->title }}</td>
                            <td>{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>

                        </tr>
                    @endforeach
    </table>
</body>

</html>

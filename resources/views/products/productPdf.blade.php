<!DOCTYPE html>
<html>

<head>
    <title>Laravel 11 Generate PDF Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        .table-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-primary">{{ $title }}</h1>
        <hr>
        <p class="text-muted text-right">{{ $date }}</p>
        <p>Ini adalah laporan data product</p>

        <div class="table-container">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>IMAGE</th>
                        <th>TITLE</th>
                        <th>PRICE</th>
                        <th>STOCK</th>

                    </tr>
                </thead>
                <tbody>
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
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

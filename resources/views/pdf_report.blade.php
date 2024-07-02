<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add the styles here -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            font-size: 10px;
            border: 1px solid black;
        }
        th, td {
            padding: 4px 8px;
            margin: 0;
        }
        tr {
            height: 20px;
        }
    </style>
    <!-- End of added styles -->

</head>
<body>

    <h2 style="text-align: center; margin-bottom: 35px;">Stock Report</h2>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr style="text-align: center;">
                <th>No.</th>
                <th>NameProduct</th>
                <th>TypeProduct</th>
                <th>Factory</th>
                <th>DateTime</th>
                <th>Price</th>
                <th>Units</th>
                <th>Amount</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
    <tr style="text-align: center;">
        <td>{{ $loop->iteration }}</td>
        <td>{{ $product->Pro_Name }}</td>
        <td>{{ $product->Type_Name }}</td>
        <td>{{ $product->Fac_Name }}</td>
        <td>{{ $product->Pro_OnDate }}</td>
        <td>{{ $product->Pro_Price }}</td>
        <td>{{ $product->Un_Name }}</td>
        <td>{{ $product->Pro_Amount }}</td>
        <!-- Add the image column -->
        <td>
            {{-- <img src="{{asset('images')}}/{{ $product->Pro_image }}" class="rounded-image" style="max-width: 60px; margin-right: 10px;"> --}}
        </td>
    </tr>
        @endforeach
        </tbody>
    </table>

</body>
</html>

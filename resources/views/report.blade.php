<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report</title>
    <link rel="stylesheet" href="{{asset('css/type.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

    <header>
        <ul>
          <a href="{{ route('TableProduct') }}" class="{{ (request()->routeIs('TableProduct')) ? 'active' : '' }}">หน้าแรก</a>
          <a href="{{ route('TableType') }}" class="{{ (request()->routeIs('TableType')) ? 'active' : '' }}">ตารางประเภท</a>
          <a href="{{ route('TableFac') }}" class="{{ (request()->routeIs('TableFac')) ? 'active' : '' }}">ตารางโรงงาน</a>
          <a href="{{ route('TableUnit') }}" class="{{ (request()->routeIs('TableUnit')) ? 'active' : '' }}">ตารางหน่วยนับ</a>
          <a href="{{ route('TableReport') }}" class="{{ (request()->routeIs('TableReport')) ? 'active' : '' }}">ตารางรายงาน</a>

        </ul>

        <form action="{{ route('report.searchByDate') }}" class="search" method="GET" id="search-form">
            <input type="text" class="form-control" name="search_day" id="search-input-day" placeholder="Day" style="text-align: center">
            <input type="text" class="form-control" name="search_month" id="search-input-month" placeholder="Month" style="text-align: center">
            <button type="submit" class="btn"><i class='bx bx-search' style="color: rgb(0, 0, 0); font-size: 36px;"></i></button>
        </form>


      <div class="logout"><a href="{{url('logout')}}">Logout   <i class='bx bx-log-out' style="margin-bottom: 5px"></i></a></div>
      </header>

      <nav class="navber">
        <div class="nav-content">
            <a href="{{ route('download-pdf', ['search_day' => request('search_day'), 'search_month' => request('search_month'), 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}">Download PDF</a>
            <a href="{{ url('chart') }}">Dashboard</a>
        </div>
    </nav>

    <div class="container">
        <h2 style="text-align: center; margin-bottom: 35px;">Stock Report</h2>

        <form method="GET" action="{{ route('report.result') }}">
            <div class="row">
                <div class="col-md-5">
                    <label for="start_date">Start Date:</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>
                <div class="col-md-5">
                    <label for="end_date">End Date:</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Generate Report</button>

                    <button type="button" class="btn btn-secondary mt-2" id="clearTable">Clear Table</button>
                </div>
            </div>
        </form>

        <hr>

        @if(isset($products) && count($products) > 0)
    <h3>Report Results:</h3>
    <table class="table table-bordered" id="product-table">
        <thead class="table-dark">
            <tr style="text-align: center;">
                <th>No.</th>
                <th>ชื่อสินค้า</th>
                <th>ประเภทสินค้า</th>
                <th>โรงงานนำเข้า</th>
                <th>เวลานำเข้า</th>
                <th>ราคาสินค้า</th>
                <th>หน่วยนับ</th>
                <th>จำนวน</th>
                <th>รูป</th>
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
                    <td>
                        <img src="{{asset('images')}}/{{ $product->Pro_image }}" class="rounded-image" style="max-width: 60px; margin-right: 10px;">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h4 style="text-align: center; padding:10%;">No results found.</h4>
@endif



    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        document.getElementById("clearTable").addEventListener("click", function() {

            let tableBody = document.querySelector("#product-table tbody");
            tableBody.innerHTML = "<tr><td colspan='8' style='text-align: center; padding:10%;'>No results found.</td></tr>";
        });
    </script>


</body>
</html>

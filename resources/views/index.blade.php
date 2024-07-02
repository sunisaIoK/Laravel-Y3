<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TypProduct</title>
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

        <form action="{{ route('product.search') }}" class="search" method="GET" id="search-form">
          <input type="text" class="form-control" name="search" id="search-input" placeholder="Search.....">
          <button type="submit" class="btn"><i class='bx bx-search' style="color: rgb(0, 0, 0); font-size: 36px;"></i></button>
      </form>

      <div class="logout"><a href="{{url('logout')}}">Logout   <i class='bx bx-log-out' style="margin-bottom: 5px"></i></a></div>
      </header>



  <nav>
    <!-- Button trigger modal -->
    <button type="button" class="addgroup1" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class='bx bx-plus-circle'></i>
    </button>

    <!-- Modal Structure -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="card">
                        <div class="crad-header" style="margin-left: 15px; display:flex; justify-content: center; align-items: center;">
                            <h3>Add Product</h3>
                        </div>

                        <div class="card-body">
                            <!-- Form for adding product -->
                            <form action="{{route('product.add')}}" enctype="multipart/form-data" method="POST">
                                @csrf

                                <!-- Product Name -->
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="Pro_Name" class="form-control" placeholder="Name.........">
                                </div><br>

                                <!-- Product Type -->
                                <div class="form-group">
                                    <label for="type-product">Type</label>
                                    <select name="Type_product_id" class="form-control">
                                        <option value=""></option>
                                        @foreach($typeProducts as $type)
                                            <option value="{{ $type->Type_Id }}">{{ $type->Type_Name }}</option>
                                        @endforeach
                                    </select>
                                </div><br>

                                <!-- Product Factory -->
                                <div class="form-group">
                                    <label for="fac-product">Factory</label>
                                    <select name="Factory_id" class="form-control">
                                        <option value=""></option>
                                        @foreach($factories as $factory)
                                            <option value="{{ $factory->Fac_Id }}">{{ $factory->Fac_Name }}</option>
                                        @endforeach
                                    </select>
                                </div><br>

                                <!-- Date of Product -->
                                <div class="form-group">
                                    <label for="Date">Date</label>
                                    <input type="datetime-local" name="Pro_OnDate" class="form-control">
                                </div><br>

                                <!-- Product Price -->
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" name="Pro_Price" class="form-control" placeholder="Price.........">
                                </div><br>

                                <!-- Product Unit -->
                                    <div class="form-group">
                                        <label for="un-product">Unit</label>
                                        <select name="Unit_id" class="form-control">
                                        <option value=""></option>
                                        @foreach($units as $unit)
                                             <option value="{{ $unit->Un_Id }}">{{ $unit->Un_Name }}</option>
                                        @endforeach
                                        </select>
                                </div><br>

                                <!-- Product Amount -->
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="text" name="Pro_Amount" class="form-control" placeholder="Amount.........">
                                </div><br>

                                <!-- Product Image -->
                                <div class="form-group">
                                    <label for="file">Profile Image</label>
                                    <input type="file" name="file" class="form-control">
                                </div><br>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" style="margin-right: 18px; font-size: 16px;" data-bs-dismiss="modal" onclick="resetForm()">Close</button>
                                    <button type="submit" class="btn btn-success" style="margin-right: 15px; font-size: 16px;">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!--///////////////////// -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(0, 140, 255);">
                        <h3 style="text-align: center; color:white;">ตารางสต็อกสินค้า</h3>
                    </div>
                    <div class="card-body">
                        <div id="search-results">
                            <!-- ตารางสำหรับแสดงข้อมูลสินค้า -->
                            <table class="table table-bordered" id="product-table">
                                <thead class="table-dark">
                                    <tr style="text-align: center;">
                                        <th>No.</th>
                                        <th>ชื่อสินค้า & รูปภาพ</th>
                                        <th>ประเภทสินค้า</th>
                                        <th>โรงงานนำเข้า</th>
                                        <th>เวลานำเข้า</th>
                                        <th>ราคาสินค้า</th>
                                        <th>หน่วยนับ</th>
                                        <th>จำนวน</th>
                                        <th>ราคารวม</th>
                                        <th class="action-buttons">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr style="text-align: center;">
                                        <td>{{ $loop->iteration }}</td>

                                        <td data-bs-toggle="modal" data-bs-target="#productModal" style="cursor: pointer;" onclick="showProductDetails('{{ json_encode($product) }}')">
                                            <div style="display: flex; align-items: center;">
                                                <img src="{{asset('images')}}/{{ $product->Pro_image }}" class="rounded-image" style="max-width: 60px; margin-right: 10px;">
                                                {{ $product->Pro_Name }}
                                            </div>
                                        </td>

                                        <td>{{ $product->Type_Name }}</td>

                                        <td style="cursor: pointer;" onclick="showFactoryDetails({{ $product->Factory_id }})">
                                            {{ $product->Fac_Name }}
                                        </td>

                                        <td>{{ $product->Pro_OnDate }}</td>
                                        <td>{{ $product->Pro_Price }}</td>
                                        <td>{{ $product->Un_Name }}</td>
                                        <td>{{ $product->Pro_Amount }}</td>
                                        <td>{{ number_format($product->Pro_Price * $product->Pro_Amount, 2) }}</td>

                                        <td style="display: flex; justify-content: right; align-items: center;">
                                            <button type="button" class="btn btn-primary btn-flat show_edit"
                                            data-type-id="{{ $product->Pro_Id }}" data-type-name="{{ $product->Pro_Name }}"
                                            data-type-image="{{ $product->Pro_image }}"
                                            data-type-typeid="{{ $product->Type_Id }}" data-type-facid="{{ $product->Fac_Id }}" data-type-unid="{{ $product->Un_Id }}"
                                            data-type-typeName="{{ $product->Type_Name }}" data-type-facName="{{ $product->Fac_Name }}" data-type-unName="{{ $product->Un_Name }}"
                                            data-type-date="{{ $product->Pro_OnDate }}" data-type-price="{{ $product->Pro_Price }}" data-type-Amount="{{ $product->Pro_Amount }}">
                                            Edit
                                        </button>

                                            <!-- Add the Delete button -->
                                            <form action="{{ route('product.delete', ['Pro_Id' => $product->Pro_Id]) }}" method="POST"
                                                style="margin-left: 25px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-flat show_confirm"
                                                    data-name="{{ $product->Pro_Name }}">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>



<!--///////////////////// -->

<footer style="margin-left: 50px; padding-right: 40%;">{{ $products->links('pagination::bootstrap-5') }}</footer>

<!--///////////////////// -->


<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="productModalLabel">ข้อมูลสินค้า</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Content will be filled using JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="factoryModal" tabindex="-1" role="dialog" aria-labelledby="factoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="factoryModalLabel">ข้อมูลโรงงานนำเข้า</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Content will be filled using JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div id="confirmation-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>คุณต้องการลบ "<span id="pro-name"></span>" ใช่หรือไม่?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <form id="delete-form" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">ลบ</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Product Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="pro_id" id="editPro_id">
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" id="editName" name="Pro_Name">
                    </div>

                    <div class="form-group">
                        <label for="editType">Type</label>
                        <select class="form-control" id="editType" name="Type_product_id">

                            @foreach($typeProducts as $type)
                                <option value="{{ $type->Type_Id }}">{{ $type->Type_Name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editFac">Factory</label>
                        <select class="form-control" id="editFac" name="Factory_id">

                            @foreach($factories as $factory)
                                <option value="{{ $factory->Fac_Id }}">{{ $factory->Fac_Name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editDate">Date</label>
                        <input type="text" class="form-control" id="editDate" name="Pro_OnDate" disabled>
                    </div>
                    <div class="form-group">
                        <label for="editPrice">Price</label>
                        <input type="text" class="form-control" id="editPrice" name="Pro_Price">
                    </div>

                    <div class="form-group">
                        <label for="editUnit">Type</label>
                        <select class="form-control" id="editUnit" name="Unit_id">

                            @foreach($units as $unit)
                                <option value="{{ $unit->Un_Id }}">{{ $unit->Un_Name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editAmount">Amount</label>
                        <input type="text" class="form-control" id="editAmount" name="Pro_Amount">
                    </div>

                    <div class="form-group">
                        <label for="file">Profile Image</label>
                        <input type="file" name="Pro_image" class="form-control" onchange="previeFile(this)">
                        @if(isset($product) && !empty($product->Pro_image))
                            <img id="editImage" src="{{asset('images')}}/{{$product->Pro_image}}" alt="image" style="max-width: 120px;margin-top:20px;">
                        @else
                            <img id="editImage" src="{{asset('images/default-image.png')}}" alt="Default image" style="max-width: 120px;margin-top:20px;">
                        @endif
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" id="editSaveButton">Update</button>
            </div>
        </div>
    </div>
</div>


<!-- JavaScript code -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


<script>
    function showProductDetails(product) {
    product = JSON.parse(product);

    let content = `
        <p><strong>ชื่อสินค้า : </strong> ${product.Pro_Name}</p>
        <p><strong>ประเภทสินค้า : </strong> ${product.Type_Name}</p>
        <p><strong>โรงงานนำเข้า : </strong> ${product.Fac_Name}</p>
        <p><strong>เวลานำเข้า : </strong> ${product.Pro_OnDate}</p>
        <p><strong>ราคาสินค้า : </strong> ${product.Pro_Price}</p>
        <p><strong>หน่วยนับ : </strong> ${product.Un_Name}</p>
        <p><strong>จำนวน : </strong> ${product.Pro_Amount}</p>
        <p><strong>ราคารวม : </strong> ${numberFormat(product.Pro_Price * product.Pro_Amount, 2)}</p>
        <img src="{{asset('images')}}/${product.Pro_image}" alt="${product.Pro_Name}" style="width: 100%;">
    `;

    document.querySelector('#productModal .modal-body').innerHTML = content;
}

function numberFormat(value, decimals) {
    return parseFloat(value).toFixed(decimals).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

</script>


<script>
    function showFactoryDetails(factoryId) {
    axios.get(`/get-factory-details/${factoryId}`)
    .then(response => {
        let factory = response.data;
        let content = `
            <p><strong>ชื่อโรงงาน : </strong> ${factory.Fac_Name}</p>
            <p><strong>ที่อยุ่ : </strong> ${factory.Fac_Address}</p>
            <p><strong>Email : </strong> ${factory.Fac_Email}</p>
            <p><strong>เบอร์โทร : </strong> ${factory.Fac_Phone}</p>
        `;
        document.querySelector('#factoryModal .modal-body').innerHTML = content;
        $('#factoryModal').modal('show');
    });
}


</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.show_edit');
    const editSaveButton = document.getElementById('editSaveButton');
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    const editForm = document.getElementById('editForm');

    editSaveButton.addEventListener('click', function() {
        editForm.submit();
    });

    editButtons.forEach((button) => {
    button.addEventListener('click', function() {
        const pro_Id = this.getAttribute('data-type-id');
        const proName = this.getAttribute('data-type-name');
        const proimage = this.getAttribute('data-type-image');
        const typeName = this.getAttribute('data-type-typeName');
        const facName = this.getAttribute('data-type-facName');
        const date = this.getAttribute('data-type-date');
        const price = this.getAttribute('data-type-price');
        const unit = this.getAttribute('data-type-unName');
        const amount = this.getAttribute('data-type-Amount');

        editForm.querySelector('#editPro_id').value = pro_Id;
        editForm.querySelector('#editName').value = proName;

        const imgPreview = document.getElementById('editImage');
        imgPreview.src = `{{asset('images')}}/${proimage}`;



        const editTypeSelect = document.getElementById('editType');
        for (let i = 0; i < editTypeSelect.options.length; i++) {
            if (editTypeSelect.options[i].text === typeName) {
                editTypeSelect.selectedIndex = i;
                break;
            }
        }

        const editFacSelect = document.getElementById('editFac');
        for (let i = 0; i < editFacSelect.options.length; i++) {
            if (editFacSelect.options[i].text === facName) {
                editFacSelect.selectedIndex = i;
                break;
            }
        }

        const editUnSelect = document.getElementById('editUnit');
        for (let i = 0; i < editUnSelect.options.length; i++) {
            if (editUnSelect.options[i].text === unit) {
                editUnSelect.selectedIndex = i;
                break;
            }
        }

        editForm.querySelector('#editDate').value = date;
        editForm.querySelector('#editPrice').value = price;
        editForm.querySelector('#editAmount').value = amount;

        editModal.show();
        });
    });
});
</script>

<script>
    function previewFile(input){
        const file = input.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(){
                const imgPreview = document.getElementById('editImage');
                imgPreview.src = reader.result;
            }
            reader.readAsDataURL(file);
        }
    }
    </script>


<script>
    const searchForm = document.getElementById('search-form');


    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.trim();

        fetch(`{{ route('product.search') }}?search=${searchTerm}`)
            .then(response => response.text())
            .then(data => {
                const searchResultsDiv = document.getElementById('search-results');
                const productTable = document.getElementById('product-table');
                const originalTableHTML = productTable.innerHTML.trim();

                if (data.trim() !== '') {
                    productTable.innerHTML = data;
                } else {
                    productTable.innerHTML = originalTableHTML;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
    </script>


<script>

const deleteBtns = document.querySelectorAll('.show_confirm');

deleteBtns.forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();

        const proName = this.getAttribute('data-name');
        const userConfirmed = confirm(`คุณต้องการลบ "${proName}" ใช่หรือไม่?`);

        if (userConfirmed) {
            this.closest('form').submit();
        }
    });
});


</script>

<script>
    function resetForm() {
        const form = document.querySelector("#exampleModal form");
        form.reset();
    }
</script>


</body>
</html>

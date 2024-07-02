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

        <form action="{{ route('factory.search') }}" class="search" method="GET" id="search-form">
          <input type="text" class="form-control" name="search" id="search-input" placeholder="Search.....">
          <button type="submit" class="btn"><i class='bx bx-search' style="color: rgb(0, 0, 0); font-size: 36px;"></i></button>
      </form>

      <div class="logout"><a href="{{url('logout')}}">Logout   <i class='bx bx-log-out' style="margin-bottom: 5px"></i></a></div>
      </header>

  <nav>
    <button type="button" class="addgroup1" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class='bx bx-plus-circle'></i>
    </button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Factory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="crad-header" style="margin-left: 15px; display:flex; justify-content: center; align-items: center;">
                            <h3>Add Factory</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('factory.add')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="Fac_Name" class="form-control" placeholder="Name.........">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="Fac_Address" class="form-control" placeholder="Address.........">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="Fac_Email" class="form-control" placeholder="Email.........">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="name">Phone</label>
                                    <input type="text" name="Fac_Phone" class="form-control" placeholder="Phone.........">
                                </div>
                                <br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="margin-right: 17px; font-size: 18px;" data-bs-dismiss="modal" onclick="resetForm()">Close</button>
                    <button type="submit" class="btn btn-success" style="margin-right: 15px; font-size: 18px;">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</nav>

<article>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background: rgb(0, 140, 255);">
                        <h3 style="text-align: center; color:white;">ตารางข้อมูลโรงงาน</h3>
                    </div>
                    <div class="card-body">
                        <div id="search-results">
                            <table class="table table-bordered" id="fac-table">
                                <thead class="table-dark">
                                    <tr style="text-align: center;">
                                        <th>No.</th>
                                        <th>ชื่อโรงงานนำเข้า</th>
                                        <th>ที่อยู่</th>
                                        <th>Email</th>
                                        <th>เบอร์โทร</th>
                                        <th class="action-buttons">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($facts as $fact)
                                    <tr style="text-align: center;">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $fact->Fac_Name }}</td>
                                        <td>{{ $fact->Fac_Address }}</td>
                                        <td>{{ $fact->Fac_Email }}</td>
                                        <td>{{ $fact->Fac_Phone }}</td>
                                        <td style="display: flex; justify-content: right; align-items: center;">
                                        <button type="button" class="btn btn-primary btn-flat show_edit"
                                            data-type-id="{{ $fact->Fac_Id }}" data-type-name="{{ $fact->Fac_Name }}"
                                            data-type-address="{{ $fact->Fac_Address }}" data-type-email="{{ $fact->Fac_Email }}" data-type-phone="{{ $fact->Fac_Phone }}">
                                            Edit
                                        </button>

                                            <form action="{{ route('factory.delete', ['Fac_Id' => $fact->Fac_Id]) }}" method="POST"
                                                style="margin-left: 25px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-flat show_confirm"
                                                    data-name="{{ $fact->Fac_Name }}">
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


<footer style="margin-left: 50px; padding-right: 40%;">{{ $facts->links('pagination::bootstrap-5') }}</footer>

<!--///////////////////// -->

<div id="confirmation-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>คุณต้องการลบ "<span id="fac-name"></span>" ใช่หรือไม่?</p>
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

<!-- Edit Factoey Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Factoey</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('factory.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="fac_id" id="editFac_id">
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" id="editName" name="Fac_Name">
                    </div>
                    <div class="form-group">
                        <label for="editAddress">Address</label>
                        <input type="text" class="form-control" id="editAddress" name="Fac_Address">
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="text" class="form-control" id="editEmail" name="Fac_Email">
                    </div>
                    <div class="form-group">
                        <label for="editPhone">Phone</label>
                        <input type="text" class="form-control" id="editPhone" name="Fac_Phone">
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


<!--///////////////////// -->
<script>
// JavaScript code for edit functionality
const editButtons = document.querySelectorAll('.show_edit');
const editSaveButton = document.getElementById('editSaveButton');

editButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const fac_id = button.getAttribute('data-type-id');
        const name = button.getAttribute('data-type-name');
        const address = button.getAttribute('data-type-address');
        const email = button.getAttribute('data-type-email');
        const phone = button.getAttribute('data-type-phone');

        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
        const editFac_idInput = document.getElementById('editFac_id');
        const editNameInput = document.getElementById('editName');
        const editAddressInput = document.getElementById('editAddress');
        const editEmailInput = document.getElementById('editEmail');
        const editPhoneInput = document.getElementById('editPhone');

        editFac_idInput.value = fac_id;
        editNameInput.value = name;
        editAddressInput.value = address;
        editEmailInput.value = email;
        editPhoneInput.value = phone;

        editModal.show();
    });
});

editSaveButton.addEventListener('click', () => {
    const editForm = document.querySelector('#editModal form');
    editForm.submit();
});

</script>

<!--///////////////////// -->

<script>
    const searchForm = document.getElementById('search-form');


    // รอเหตุการณ์การพิมพ์ข้อมูลในช่องค้นหา
    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.trim();

        // เมื่อมีการพิมพ์ข้อมูล ส่งคำขอค้นหาไปยังเซิร์ฟเวอร์
        fetch(`{{ route('factory.search') }}?search=${searchTerm}`)
            .then(response => response.text())
            .then(data => {
                const searchResultsDiv = document.getElementById('search-results');
                const facTable = document.getElementById('fac-table');
                const searchInput = document.getElementById('search-input');
                const originalTableHTML = document.getElementById('fac-table').innerHTML.trim(); // บันทึกตารางเริ่มต้น


                // ถ้ามีผลลัพธ์ค้นหา
                if (data.trim() !== '') {
                    // แสดงตารางผลลัพธ์การค้นหา
                    typeTable.innerHTML = data;
                } else {
                    // ไม่มีผลลัพธ์ค้นหา
                    // ใช้ตารางเริ่มต้น
                    typeTable.innerHTML = originalTableHTML;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>


<!--///////////////////// -->
<script>
    // เรียกใช้งานโมดัลและแสดงเด้งแจ้งเตือนเมื่อคลิกที่ปุ่ม Delete
    const deleteButtons = document.querySelectorAll('.show_confirm');

    deleteButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const facName = button.getAttribute('data-name');
            const deleteForm = button.closest('form');
            const confirmationModal = document.getElementById('confirmation-modal');
            const facNameSpan = document.getElementById('fac-name');
            const deleteFormElement = document.getElementById('delete-form');

            facNameSpan.textContent = facName;
            deleteFormElement.action = deleteForm.action;

            // เปิดเด้งแจ้งเตือน
            const bootstrapModal = new bootstrap.Modal(confirmationModal);
            bootstrapModal.show();
        });
    });
</script>

<script>
    function resetForm() {
        const form = document.querySelector("#exampleModal form");
        form.reset();
    }
</script>

<script>
    function resetForm() {
        const form = document.querySelector("#exampleModal form");
        form.reset();
    }
</script>

</body>
</html>

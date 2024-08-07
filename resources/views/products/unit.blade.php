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

        <form action="{{ route('unit.search') }}" class="search" method="GET" id="search-form">
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
                        <h5 class="modal-title" id="exampleModalLabel">Add Unit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="crad-header" style="margin-left: 15px; display:flex; justify-content: center; align-items: center;">
                                <h3>Add Unit</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{route('unit.product')}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="Un_Name" class="form-control" placeholder="Name.........">
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
                        <h3 style="text-align: center; color:white;">ตารางข้อมูลหน่วยนับ</h3>
                    </div>
                    <div class="card-body">
                        <div id="search-results">
                            <table class="table table-bordered" id="un-table">
                                <thead class="table-dark">
                                    <tr style="text-align: center;">
                                        <th>No.</th>
                                        <th>หน่วยนับ</th>
                                        <th class="action-buttons">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($uns as $un)
                                    <tr style="text-align: center;">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $un->Un_Name }}</td>
                                        <td style="display: flex; justify-content: right; align-items: center;">
                                            <button type="button" class="btn btn-primary btn-flat show_edit"
                                                data-type-id="{{ $un->Un_Id }}" data-type-name="{{ $un->Un_Name }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('unit.delete', ['Un_Id' => $un->Un_Id]) }}" method="POST"
                                                style="margin-left: 25px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-flat show_confirm"
                                                    data-name="{{ $un->Un_Name }}">
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

<footer style="margin-left: 50px; padding-right: 40%;">{{ $uns->links('pagination::bootstrap-5') }}</footer>

<!--///////////////////// -->
<div id="confirmation-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>คุณต้องการลบ "<span id="un-name"></span>" ใช่หรือไม่?</p>
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

<!--///////////////////// -->

<!-- Edit Unit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('unit.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="un_id" id="editUn_id">
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" id="editName" name="Un_Name">
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


<script>

    const editButtons = document.querySelectorAll('.show_edit');
    const editSaveButton = document.getElementById('editSaveButton');

    editButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const un_id = button.getAttribute('data-type-id');
            const name = button.getAttribute('data-type-name');
            const editModal = new bootstrap.Modal(document.getElementById('editModal'));
            const editUn_idInput = document.getElementById('editUn_id');
            const editNameInput = document.getElementById('editName');

            editUn_idInput.value = un_id;
            editNameInput.value = name;


            editModal.show();
        });
    });


    editSaveButton.addEventListener('click', () => {
        const form = document.querySelector('#editModal form');
        form.submit();
    });
</script>

<!--///////////////////// -->

<script>
    const searchForm = document.getElementById('search-form');

    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.trim();

        fetch(`{{ route('unit.search') }}?search=${searchTerm}`)
            .then(response => response.text())
            .then(data => {
                const searchResultsDiv = document.getElementById('search-results');
                const typeTable = document.getElementById('un-table');
                const searchInput = document.getElementById('search-input');
                const originalTableHTML = document.getElementById('un-table').innerHTML.trim();

                if (data.trim() !== '') {

                    typeTable.innerHTML = data;
                } else {
                    typeTable.innerHTML = originalTableHTML;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>

<!--///////////////////// -->

<!--///////////////////// -->
<script>

const deleteButtons = document.querySelectorAll('.show_confirm');

deleteButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const unName = button.getAttribute('data-name');
        const deleteForm = button.closest('form');
        const confirmationModal = document.getElementById('confirmation-modal');
        const unNameSpan = document.getElementById('un-name');
        const deleteFormElement = document.getElementById('delete-form');

        unNameSpan.textContent = unName;
        deleteFormElement.action = deleteForm.action;

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

</body>
</html>

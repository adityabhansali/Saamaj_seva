<?php
//echo "<pre>";print_r($_SERVER);echo"</pre>";
require_once($_SERVER['DOCUMENT_ROOT'] . '/Saamj_seva/config.php');
require_once('Header.php');
?>
<div class="wrapper">
    <?php require_once 'Navbar.php' ?>
    <!-- Main Sidebar Container -->
    <?php require_once 'Leftsidebar.php' ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Family Members</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DataTable with default features</h3>  <a
                                        href="<?= AdminURL ?>FamilyMember-create.php">Add New Family Member</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require_once 'Footer.php' ?>
    <!-- ./wrapper -->

    <?php require_once 'FooterScripts.php' ?>
    <script>
        $(document).ready(function () {
            var familytable = $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "ajax": {
                    "url": "<?php echo Controllers; ?>FamilyMember-Select.php",
                    "type": "POST",
                    "dataSrc": function (data) {
                        return data;
                    }
                },
                "buttons": ["excel", "pdf", "print"],
                "columns": [
                    {"data": null, "title": "<input type='checkbox' id='selectAll'>", "orderable": false},
                    {
                        "data": null,
                        "title": "Full Name",
                        "render": function (data, type, full, meta) {
                            return full.Firstname + " " + full.Middlename + " " + full.Lastname;
                        }
                    },
                    {"data": "Mobilenumber", "title": "Mobile Number"},
                    {"data": null, "title": "Actions"}
                ],
                "columnDefs": [
                    {
                        "targets": 0,
                        "render": function (data, type, full, meta) {
                            return '<input type="checkbox" class="select-checkbox" data-id="' + full.ID + '">';
                        }
                    },
                    {
                        "targets": -1, // Target the last column (Actions column)
                        "data": null,
                        "render": function (data, type, full, meta) {
                            return '<a href="#" class="view text-dark" data-id="' + full.ID + '">View</a>  &nbsp' +
                                '<a href="#" class="edit" data-id="' + full.ID + '">Edit</a>  &nbsp' +
                                '<a href="#" class="delete text-danger" data-id="' + full.ID + '">Delete</a>';
                        }
                    }]
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#example1').on('change', '#selectAll', function () {
                $('.select-checkbox').prop('checked', $(this).prop('checked'));
            });
            $('#example1').on('change', '.select-checkbox', function () {
                var allChecked = $('.select-checkbox:checked').length === $('.select-checkbox').length;
                $('#selectAll').prop('checked', allChecked);
            });
            $('#example1').on('click', '.delete', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                console.log("DELETE ID:", id);
                $.ajax({
                    url: "<?php echo Controllers; ?>FamilyMember-Delete.php",
                    method: 'POST',
                    data: {id: id},
                    dataType: 'json',
                    success: function (response) {
                        if (response.Status === "Passed") {
                            Swal.fire({
                                title: "Admin!",
                                text: "Delete was Successful",
                                icon: "success"
                            });
                            familytable.ajax.reload();
                        }
                        else if(response.Status === "Failed"){
                            Swal.fire({
                                title: "Admin!",
                                text: "Delete was Unsuccessful",
                                icon: "error"
                            });
                        }
                        else{
                            console.log(response);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error response
                        console.error("Error deleting data:", error);
                    }
                });
            });
            $('#example1').on('click', '.view', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                console.log("VIEW ID:", id);
            });
            $('#example1').on('click', '.edit', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                console.log("EDIT ID:", id);
            });
        });
    </script>
    </body>
    </html>
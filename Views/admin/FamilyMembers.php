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
    <div class="modal fade" id="viewFamilyDetailsModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewFamilyDetailsModalTitle">View Family Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="viewFamilyDetailsModalBody">
                </div>
            </div>
        </div>
    </div>
    <div class="model-card d-none" id="modalCardTemplate"
         style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px; padding: 15px; margin-bottom: 15px;">
        <h4 class="text-navy title" style="margin-bottom: 10px;margin-left: 60px;font-weight: 600;">Head of Family</h4>
        <div class="d-flex justify-content-around align-items-start">
            <img src="<?php echo APPURL ?>Assets/Photos/1712956010_LinuxVsWindowsWallpaper.jpg" alt="Model Image"
                 width="200px" class="model-image" style="border-radius: 5px;">
            <div class="model-details pl-3">
                <p class="text-bold fullname" style="font-size: 18px;">Krushkant Navinchndra Pachchigar</p>
                <p class="text-primary">Basic Information</p>
                <hr class="text-primary" style="border-color: #007bff;">
                <p><strong>Education:</strong> Lorem Ipsam</p>
                <p><strong>Business/Job:</strong> Lorem Ipsam</p>
                <p><strong>Blood Group:</strong> A+</p>
                <p><strong>Marital Status:</strong> Married</p>
                <p><strong>Birth Date:</strong> 31st May, 1995</p>
                <p><strong>Gender:</strong> Male</p>
            </div>
        </div>
        <p><strong>Phone:</strong> +91 74125 89632</p>
        <p class="email"><strong>Email-Id:</strong> XYZ@gmail.com</p>
    </div>
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
                            return '<a href="#" class="view text-dark" data-id="' + full.FamilyNumber + '">View</a>  &nbsp' +
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
                        } else if (response.Status === "Failed") {
                            Swal.fire({
                                title: "Admin!",
                                text: "Delete was Unsuccessful",
                                icon: "error"
                            });
                        } else {
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
                $.ajax({
                    url: "<?php echo Controllers; ?>FamilyNumber-Select.php",
                    method: 'POST',
                    data: {id: id},
                    dataType: 'json',
                    success: function (response) {
                        if (response.length === 0) {
                            $('#viewFamilyDetailsModalBody').text("No Details");
                        } else {
                            var htmlContent = "";
                            $.each(response, function (index, value) {
                                var $template = $('#modalCardTemplate').clone();
                                $template.removeAttr('id').removeClass('d-none');
                                var title = (value.RelationWithHead === 'own') ? 'Head of Family' : 'Family Member';
                                $template.find('.title').text(title);
                                $template.find('.fullname').text(value.Firstname + ' ' + value.Middlename + ' ' + value.Lastname);
                                $template.find('.model-image').attr('src', '<?php echo APPURL ?>Assets/Photos/' + value.Photo);
                                $template.find('.model-details').html(
                                    '<p class="text-primary">Basic Information</p>' +
                                    '<hr class="text-primary">' +
                                    '<p><strong>Education:</strong> ' + value.Education + '</p>' +
                                    '<p><strong>Business/Job:</strong> ' + value.Business + '</p>' +
                                    '<p><strong>Blood Group:</strong> ' + value.BloudGroup + '</p>' +
                                    '<p><strong>Marital Status:</strong> ' + value.MaritalStatus + '</p>' +
                                    '<p><strong>Birth Date:</strong> ' + moment(value.DOB).format('Do MMMM YYYY') + '</p>' +
                                '<p><strong>Gender:</strong> ' + value.Gender + '</p>'
                                );
                                $template.find('p:eq(8)').text('Phone: ' + value.Mobilenumber);
                                $template.find('.email').html('<strong>Email-Id:</strong> ' + value.Email);
                                htmlContent += $template.html();
                            });
                            $('#viewFamilyDetailsModalBody').empty();
                            $('#viewFamilyDetailsModalBody').html(htmlContent);
                        }
                        $('#viewFamilyDetailsModal').modal('show');
                    },
                    error: function (xhr, status, error) {
                        // Handle error response
                        console.error("Error deleting data:", error);
                    }
                });
                // console.log("VIEW ID:", id);
            });
            $("#viewFamilyDetailsModal").on('hidden.bs.modal', function () {

            })
            $('#example1').on('click', '.edit', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                console.log("EDIT ID:", id);
            });
        });
    </script>
    </body>
    </html>
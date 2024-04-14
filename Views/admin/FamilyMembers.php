<?php
//echo "<pre>";print_r($_SERVER);echo"</pre>";
require_once($_SERVER['DOCUMENT_ROOT'] . '/SocietyManagement/config.php');
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
                                <h3 class="card-title">DataTable with default features</h3>
                                <a href="<?= AdminURL ?>FamilyMember-create.php">Add New Family Member</a>
                                <button id="generatePdfBtn">Generate PDF</button>
                                <div class="dynamic-content">
                                    <!-- This container will hold the dynamically generated content -->
                                </div>
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
    <div class="model-card d-none" id="modalCardTemplate" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px; padding: 15px; margin-bottom: 15px;">
        <h4 class="text-navy title" style="margin-bottom: 10px; font-weight: 600;">Head of Family</h4>
        <div class="d-flex justify-content-around align-items-start">
            <img class="model-image" style="border-radius: 5px;max-width: 350px;max-height: 300px;">
            <div class="model-details pl-3">
                <p class="text-bold fullname" style="font-size: 18px;"></p>
                <p class="text-primary">Basic Information</p>
                <hr class="text-primary" style="border-color: #007bff;">
                <p><strong class="education-label">Education:</strong> <span class="education"></span></p>
                <p><strong class="business-label">Business/Job:</strong> <span class="business"></span></p>
                <p><strong class="bloodGroup-label">Blood Group:</strong> <span class="bloodGroup"></span></p>
                <p><strong class="maritalStatus-label">Marital Status:</strong> <span class="maritalStatus"></span></p>
                <p><strong class="birthDate-label">Birth Date:</strong> <span class="birthDate"></span></p>
                <p><strong class="gender-label">Gender:</strong> <span class="gender"></span></p>
            </div>
        </div>
        <p><strong class="phone-label">Phone:</strong> <span class="phone"></span></p>
        <p><strong class="email-label">Email-Id:</strong> <span class="email"></span></p>
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
                                '<a href="#" class="edit" data-id="' + full.FamilyNumber + '">Edit</a>  &nbsp' +
                                '<a href="#" class="delete text-danger" data-id="' + full.ID + '">Delete</a>';
                        }
                    }],
            });

            $('#generatePdfBtn').on('click', function() {
                var counter = 1;
                var $container = $('<div>').addClass('dynamic-content');
                var rowsData = familytable.rows().data();
                var $row = null; // Initialize row variable

                rowsData.each(function(rowData, index) {
                    if (index % 6 === 0) {
                        // Create a new row after every 6 columns
                        $row = $('<div>').addClass('row').css({"margin": "10px","display":"flex","justify-content":"space-around"});
                        $container.append($row);
                    }

                    var familyNumber = rowData['FamilyNumber'];
                    var firstName = rowData['Firstname'];
                    var middleName = rowData['Middlename'];
                    var lastName = rowData['Lastname'];
                    var address = rowData['Address'];
                    var phoneNumber = rowData['Mobilenumber'];
                    var $col = $('<div>').addClass('col-md-2').css({'padding': '20px', 'background-color': '#f9f9f9', 'border': '1px solid #ddd', 'font-size': '12px', 'margin': '0'});

                    $col.append(
                        $('<p>').addClass('m-0').append($('<strong>').addClass('bold-text').text(counter++ + ". " + firstName + ' ' + middleName + ' ' + lastName)),
                        $('<p>').addClass('m-0').text(address),
                        $('<p>').addClass('m-0').append($('<strong>').addClass('bold-text').text(phoneNumber))
                    );

                    $row.append($col);
                });

                $container.css({
                    'font-family': 'Arial, sans-serif',
                    'margin': '0',
                    'padding': '0'
                });
                var html = $container.html();
                // console.log(html);
                $.ajax({
                    url: "<?php echo Controllers; ?>generate-pdf.php",
                    method: 'POST',
                    data: {html: html},
                    success: function (response) {
                        var responseData = JSON.parse(response);
                        if (responseData && responseData.pdf_location) {
                            var downloadLink = document.createElement('a');
                            downloadLink.href = responseData.pdf_location;
                            downloadLink.download = 'generated_pdf.pdf';
                            document.body.appendChild(downloadLink);
                            downloadLink.click();
                            document.body.removeChild(downloadLink);
                        } else {
                            console.error("PDF location not found in response");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error deleting data:", error);
                    }
                });

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
                                $template.find('.education-label').text('Education:');
                                $template.find('.education').text(value.Education);
                                $template.find('.business-label').text('Business/Job:');
                                $template.find('.business').text(value.Business);
                                $template.find('.bloodGroup-label').text('Blood Group:');
                                $template.find('.bloodGroup').text(value.BloudGroup);
                                $template.find('.maritalStatus-label').text('Marital Status:');
                                $template.find('.maritalStatus').text(value.MaritalStatus);
                                $template.find('.birthDate-label').text('Birth Date:');
                                $template.find('.birthDate').text(moment(value.DOB).format('Do MMMM YYYY'));
                                $template.find('.gender-label').text('Gender:');
                                $template.find('.gender').text(value.Gender);
                                $template.find('.phone-label').text('Phone:');
                                $template.find('.phone').text(value.Mobilenumber);
                                $template.find('.email-label').text('Email-Id:');
                                $template.find('.email').text(value.Email);
                                htmlContent += $template.prop('outerHTML');
                            });
                            $('#viewFamilyDetailsModalBody').empty().html(htmlContent);
                        }
                        $('#viewFamilyDetailsModal').modal('show');
                    },
                    error: function (xhr, status, error) {
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
                window.location.href = "FamilyMember-edit.php?id="+id;
                console.log("EDIT ID:", id);
            });
        });
    </script>
    </body>
    </html>
<?php
//echo "<pre>";print_r($_SERVER);echo"</pre>";
require_once($_SERVER['DOCUMENT_ROOT'] . '/Saamj_seva/config.php');
require_once('Header.php');
?>
<div id="memberadd" class="d-none">
    <div class="card">
        <div class="card-header bg-secondary">
            <div class="row">
                <div class="col text-light">Add Member</div>
                <div class="col text-right">
                    <button type="button" class="close text-light" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="Firstname">First Name</label>
                        <input type="text" class="form-control" id="Firstname" name="Firstname"
                               placeholder="First Name">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="Middlename">Middle Name</label>
                        <input type="text" class="form-control" id="Middlename" name="Middlename"
                               placeholder="Middle Name">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="Lastname">Last Name</label>
                        <input type="text" class="form-control" id="Lastname" name="Lastname" placeholder="Last Name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="Mobilenumber">Mobile</label>
                        <input type="text" class="form-control" id="Mobilenumber" name="Mobilenumber"
                               placeholder="Mobile Number">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="Email">Email address</label>
                        <input type="email" class="form-control" id="Email" name="Email" placeholder="Enter email">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="DOB">Birth Date</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" id="DOB" name="DOB"
                                   data-target="#reservationdate"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="Lastname">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Gender" value="Male" checked="">
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Gender" value="Female">
                            <label class="form-check-label">Female</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Address</label>
                <textarea class="form-control" name="Address" id="Address" rows="3" placeholder="Enter ..."></textarea>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="Education">Education</label>
                        <input type="text" class="form-control" id="Education" name="Education"
                               placeholder="B.com, M.com, etc...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="Business">Business/Job</label>
                        <input type="text" class="form-control" id="Business" name="Business"
                               placeholder="Business/Job">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="BloudGroup">Blood Group</label>
                        <select class="form-control select2" id="BloudGroup" name="BloudGroup">
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="MaritalStatus">Maritial Status</label>
                        <select class="form-control select2" id="MaritalStatus" name="MaritalStatus">
                            <option value="Married">Married</option>
                            <option value="Un-married">Un-married</option>
                            <option value="Divorceee">Divorceee</option>
                            <option value="Widow">Widow</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="Age">Age</label>
                        <input type="text" class="form-control" id="Age" name="Age" placeholder="Age">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="Photo">Photo</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="Photo" name="Photo">
                        <label class="custom-file-label" for="Photo">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="RelationToHead">Relation to Head Member</label>
                <input type="text" class="form-control" id="RelationToHead" name="RelationToHead"
                       placeholder="Relation to Head Member">
            </div>
            <div class="response alert">
            </div>
        </div>
    </div>
</div>
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
                        <h1>Create Family Member</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Create Family Member</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Head of Family</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form name="AddFamilyForm" id="AddFamilyForm" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="Firstname">First Name</label>
                                                <input type="text" class="form-control" id="Firstname" name="Firstname"
                                                       placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="Middlename">Middle Name</label>
                                                <input type="text" class="form-control" id="Middlename"
                                                       name="Middlename" placeholder="Middle Name">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="Lastname">Last Name</label>
                                                <input type="text" class="form-control" id="Lastname" name="Lastname"
                                                       placeholder="Last Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="Mobilenumber">Mobile</label>
                                                <input type="text" class="form-control" id="Mobilenumber"
                                                       name="Mobilenumber" placeholder="Mobile Number">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="Email">Email address</label>
                                                <input type="email" class="form-control" id="Email" name="Email"
                                                       placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="DOB">Birth Date</label>
                                                <div class="input-group date" id="reservationdate"
                                                     data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                           id="DOB" name="DOB" data-target="#reservationdate"/>
                                                    <div class="input-group-append" data-target="#reservationdate"
                                                         data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="Lastname">Gender</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="Gender"
                                                           value="Male" checked="">
                                                    <label class="form-check-label">Male</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="Gender"
                                                           value="Female">
                                                    <label class="form-check-label">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Address</label>
                                        <textarea class="form-control" name="Address" id="Address" rows="3"
                                                  placeholder="Enter ..."></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Education">Education</label>
                                                <input type="text" class="form-control" id="Education" name="Education"
                                                       placeholder="B.com, M.com, etc...">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Business">Business/Job</label>
                                                <input type="text" class="form-control" id="Business" name="Business"
                                                       placeholder="Business/Job">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="BloudGroup">Blood Group</label>
                                                <select class="form-control select2" id="BloudGroup" name="BloudGroup">
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="MaritalStatus">Maritial Status</label>
                                                <select class="form-control select2" id="MaritalStatus"
                                                        name="MaritalStatus">
                                                    <option value="Married">Married</option>
                                                    <option value="Un-married">Un-married</option>
                                                    <option value="Divorceee">Divorceee</option>
                                                    <option value="Widow">Widow</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="Age">Age</label>
                                                <input type="text" class="form-control" id="Age" name="Age"
                                                       placeholder="Age">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Photo">Photo</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="Photo" name="Photo">
                                                <label class="custom-file-label" for="Photo">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="response alert">
                                    </div>
                                    <div id="AddMembersContent">

                                    </div>
                                    <div>
                                        <button type="button" id="AddMembers" class="btn btn-primary">Add New Member
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
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
            $('#reservationdate').datetimepicker({
                format: 'L',
                maxDate: new Date
            });
            $("#AddFamilyForm").submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo Controllers; ?>Family-member-Create.php",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.Status === "Failed") {
                            var ErrorMessages = "";
                            //console.log(response.Message);
                            response.Message.forEach(function (item) {
                                ErrorMessages += item + "<br>";
                            });
                            $(".response").addClass('alert-danger').html(ErrorMessages);
                        } else {
                            Toast.fire({
                                icon: 'success',
                                title: response.Message
                            });
                            setTimeout(function () {
                                window.location = "<?php echo AdminURL; ?>FamilyMembers.php";
                            }, 1000);
                        }
                        // Handle the response from the server
                    }
                });
            });
        });
        $('#AddMembers').on('click', function () {
            var clonedContent = $('#memberadd').clone();
            clonedContent.removeClass('d-none');
            $('#AddMembersContent').append(clonedContent);
        });
        $(document).on('click', '#memberadd .close', function () {
            $(this).closest('.card').remove();
        });
    </script>
    </body>

    </html>
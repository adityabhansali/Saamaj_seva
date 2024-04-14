<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/SocietyManagement/config.php');
require_once('Header.php');
$data = null;
if (!@$_GET['id']) {
    echo "No Access here";
    die;
} else {
    $familymember = new FamilyMembers(array("Action" => "FetchData"));
    $data = $familymember->fetchFamilyListByNumber($_GET['id']);
}
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
                    <input type="hidden" class="form-control" id="ID" name="ID">
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
                <label for="Photo" class="">Photo</label>
                <input type="file" class="form-control" id="Photo" name="Photo">
                <div class="mt-2"><b>Photo Uploaded:</b><img src="" style="border-radius: 5px;max-width: 350px;max-height: 300px;" id="ShowPhoto" alt=""></div>
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
                        <h1>Update Family Member</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Update Family Member</li>
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
                                            <input type="hidden" class="form-control" id="ID-0" name="ID-0">
                                            <div class="form-group">
                                                <label for="Firstname">First Name</label>
                                                <input type="text" class="form-control" id="Firstname-0"
                                                       name="Firstname-0"
                                                       placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="Middlename">Middle Name</label>
                                                <input type="text" class="form-control" id="Middlename-0"
                                                       name="Middlename-0" placeholder="Middle Name">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="Lastname">Last Name</label>
                                                <input type="text" class="form-control" id="Lastname-0" name="Lastname-0"
                                                       placeholder="Last Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="Mobilenumber">Mobile</label>
                                                <input type="text" class="form-control" id="Mobilenumber-0"
                                                       name="Mobilenumber-0" placeholder="Mobile Number">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="Email">Email address</label>
                                                <input type="email" class="form-control" id="Email-0" name="Email-0"
                                                       placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="DOB">Birth Date</label>
                                                <div class="input-group date" id="reservationdate"
                                                     data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                           id="DOB-0" name="DOB-0" data-target="#reservationdate"/>
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
                                                    <input class="form-check-input" type="radio" name="Gender-0"
                                                           value="Male" checked="">
                                                    <label class="form-check-label">Male</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="Gender-0"
                                                           value="Female">
                                                    <label class="form-check-label">Female</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Address</label>
                                        <textarea class="form-control" name="Address-0" id="Address-0" rows="3"
                                                  placeholder="Enter ..."></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Education">Education</label>
                                                <input type="text" class="form-control" id="Education-0"
                                                       name="Education-0"
                                                       placeholder="B.com, M.com, etc...">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="Business">Business/Job</label>
                                                <input type="text" class="form-control" id="Business-0" name="Business-0"
                                                       placeholder="Business/Job">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="BloudGroup">Blood Group</label>
                                                <select class="form-control select2" id="BloudGroup-0"
                                                        name="BloudGroup-0">
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
                                                <select class="form-control select2" id="MaritalStatus-0"
                                                        name="MaritalStatus-0">
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
                                                <input type="text" class="form-control" id="Age-0" name="Age-0"
                                                       placeholder="Age">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Photo">Photo</label>
                                        <input type="file" class="form-control" id="Photo-0" name="Photo-0">
                                        <div class="mt-2"><b>Photo Uploaded:</b><img src="" style="border-radius: 5px;max-width: 350px;max-height: 300px;" id="ShowPhoto-0" alt=""></div>
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
            var jsondata = <?php echo $data; ?>;

            function populateFormFields(member, index) {
                // console.log(index);
                $('#ID-' + index).val(member.ID);
                $('#Firstname-' + index).val(member.Firstname);
                $('#Middlename-' + index).val(member.Middlename);
                $('#Lastname-' + index).val(member.Lastname);
                $('#Mobilenumber-' + index).val(member.Mobilenumber);
                $('#Email-' + index).val(member.Email);
                $('#DOB-' + index).val(member.DOB);
                $('input[name="Gender-' + index + '"][value="' + member.Gender + '"]').prop('checked', true);
                $('#Address-' + index).val(member.Address);
                $('#Education-' + index).val(member.Education);
                $('#Business-' + index).val(member.Business);
                $('#BloudGroup-' + index).val(member.BloudGroup);
                $('#MaritalStatus-' + index).val(member.MaritalStatus);
                $('#Age-' + index).val(member.Age);
                // Assuming you have a photo field as well
                $('#ShowPhoto-' + index).attr('src','../../Assets/Photos/'+member.Photo);
                if(index != 0)
                {
                    $('#RelationToHead-' + index).val(member.RelationWithHead);
                }
            }

            for (var i = 0; i < jsondata.length; i++) {
                var member = jsondata[i];

                if (i > 0) {
                    // If there are additional members, click "Add New Member" button
                    $('#AddMembers').click();
                }

                // Populate form fields for the current member
                populateFormFields(member, i);
            }

            var familyform = $('#AddFamilyForm').validate({
                rules: {
                    Firstname: {
                        required: true,
                        minlength: 2
                    },
                    Lastname: {
                        required: true,
                        minlength: 2
                    },
                    Mobilenumber: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    Email: {
                        required: true,
                        email: true
                    },
                    DOB: {
                        required: true,
                        date: true
                    },
                    Address: {
                        required: true
                    },
                    Education: {
                        required: true
                    },
                    Business: {
                        required: true
                    },
                    Age: {
                        required: true,
                        digits: true
                    },
                    Photo: {
                        accept: "image/*"
                    }
                },
                messages: {
                    Firstname: {
                        required: "Please enter your first name",
                        minlength: "First name must be at least 2 characters long"
                    },
                    Lastname: {
                        required: "Please enter your last name",
                        minlength: "Last name must be at least 2 characters long"
                    },
                    Mobilenumber: {
                        required: "Please enter your mobile number",
                        digits: "Mobile number must contain only digits",
                        minlength: "Mobile number must be 10 digits long",
                        maxlength: "Mobile number must be 10 digits long"
                    },
                    Email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    DOB: {
                        required: "Please enter your date of birth",
                        date: "Please enter a valid date"
                    },
                    Address: {
                        required: "Please enter your address"
                    },
                    Education: {
                        required: "Please enter your education"
                    },
                    Business: {
                        required: "Please enter your business/job"
                    },
                    Age: {
                        required: "Please enter your age",
                        digits: "Age must be a number"
                    },
                    Photo: {
                        accept: "Please choose a valid image file (JPEG, PNG, JPG)"
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    var parent = element.closest('.form-group');
                    parent.append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            $('#reservationdate').datetimepicker({
                format: 'L',
                maxDate: new Date
            });
            $("#AddFamilyForm").submit(function (e) {
                e.preventDefault();
                var valid = familyform.valid();
                if (!valid)
                    return;
                var formData = new FormData(this);
                formData.append("FamilyNumber",<?php echo $_GET['id']?>);
                formData.append("membercount", memberCounter);

                var headPhotoSrc = $('#ShowPhoto-0').attr('src');
                if (!headPhotoSrc) {
                    $(".response").addClass('alert-danger').html("Please upload a photo for the head member.");
                    return;
                }
                var parts = headPhotoSrc.split("/");
                var lastPart = parts[parts.length - 1];
                formData.append("Photo-0",lastPart);
                // Validate dynamic members' photos
                for (var i = 0; i < memberCounter; i++) {
                    var photoSrc = $('#ShowPhoto-' + i).attr('src');
                    var fileInput = document.getElementById('Photo-' + i);
                    var files = fileInput.files;
                    if (!photoSrc) {
                        if(files == 0)
                        {
                            $(".response").addClass('alert-danger').html("Please upload a photo for all members.");
                            return;
                        }
                    }
                    parts = photoSrc.split("/");
                    lastPart = parts[parts.length - 1];
                    formData.append("Photo-"+i,lastPart);
                }
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo Controllers; ?>Family-member-Edit.php",
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
                    }
                });
            });
        });

        function addValidationRules(element) {
            element.rules("add", {
                required: true,
                messages: {
                    required: 'Please enter a value for ' + element.attr('id')
                }
            });
        }

        let memberCounter = 1;
        $('#AddMembers').on('click', function () {
            var clonedContent = $('#memberadd').clone();
            clonedContent.removeClass('d-none');
            clonedContent.find('[id]').each(function () {
                var newId = $(this).attr('id') + '-' + memberCounter;
                $(this).attr('id', newId);
                addValidationRules($(this));
            });

            clonedContent.find('[name]').each(function () {
                var newName = $(this).attr('name') + '-' + memberCounter;
                $(this).attr('name', newName);
            });
            clonedContent.find('label').each(function () {
                var forAttr = $(this).attr('for');
                if (forAttr) {
                    var newForAttr = forAttr + '-' + memberCounter;
                    $(this).attr('for', newForAttr);
                }
            });
            $('#AddMembersContent').append(clonedContent);
            memberCounter++;
        });
        $(document).on('click', '#memberadd .close', function () {
            memberCounter--;
            $(this).closest('.card').remove();
        });
    </script>
    </body>

    </html>
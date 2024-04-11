<?php
require_once('../config.php');
require_once('header.php');
?>

<h2>User Information Form</h2>
<form name="UserForm" id="UserForm" method="post">
  
  <label for="fname">First Name:</label><br>
  <input type="text" id="fname" name="fname"><br>
  
  <label for="lname">Last Name:</label><br>
  <input type="text" id="lname" name="lname"><br>
  
  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email"><br>
  
  <label for="phone">Phone Number:</label><br>
  <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"><br>
  
  <label for="dob">Date of Birth:</label><br>
  <input type="date" id="dob" name="dob"><br>
  
  <label for="gender">Gender:</label><br>
  <input type="radio" id="male" name="gender" value="male">
  <label for="male">Male</label><br>
  <input type="radio" id="female" name="gender" value="female">
  <label for="female">Female</label><br>
  <input type="radio" id="other" name="gender" value="other">
  <label for="other">Other</label><br>
  
  <label for="country">Country:</label><br>
  <select id="country" name="country">
    <option value="USA">United States</option>
    <option value="Canada">Canada</option>
    <option value="UK">United Kingdom</option>
    <option value="Australia">Australia</option>
    <!-- Add more countries as needed -->
  </select><br>
  
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password"><br>
  
  <label for="confirm_password">Confirm Password:</label><br>
  <input type="password" id="confirm_password" name="confirm_password"><br>
  
  <label for="hobbies">Hobbies:</label><br>
  <input type="checkbox" id="hobby1" name="hobbies" value="reading">
  <label for="hobby1">Reading</label><br>
  <input type="checkbox" id="hobby2" name="hobbies" value="sports">
  <label for="hobby2">Sports</label><br>
  <input type="checkbox" id="hobby3" name="hobbies" value="music">
  <label for="hobby3">Music</label><br>
  <!-- Add more hobbies as needed -->
  <div class="response"></div>
  <input type="submit" value="Submit">
</form> 
<script>
    $(document).ready(function(){
        $("#UserForm").validate({
            rules:{
                fname: "required",
                lname: "required",
                email: "required",
                phone: "required",
            },
            messages: {
				fname: "Please enter your firstname",
                lname: "Please enter your lastname",
                email: "Please enter your emaile",
                phone: "Please enter your phone",
            },
            submitHandler: function(form) {
                // Submit the form using AJAX
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo Controllers; ?>users-create.php",
                    data: $(form).serialize(),
                    success: function(response) {
                    if(response.Status ===  "Failed"){
                        var ErrorMessages = "";
                        //console.log(response.Message);
                        response.Message.forEach(function(item) {
                            ErrorMessages += item +"<br>";
                        });
                        $(".response").html(ErrorMessages);
                    }else{
                        $(".response").html(response.Message);
                        setTimeout(function(){
                            window.location = "<?php echo APPURL; ?>/Views/Users.php";
                        },2000);
                    }
                    // Handle the response from the server
                    }
                });
            }
        });
    });
</script>
<?php 
require_once('footer.php');
?>

<?php
require_once('../config.php');
require_once('header.php');
?>

<h2>User Login Form</h2>
<form name="LoginForm" id="LoginForm" method="post">
  
  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email"><br>
  
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password"><br>
  <!-- Add more hobbies as needed -->
  <div class="response"></div>
  <input type="submit" value="Submit">
</form> 
<script>
    $(document).ready(function(){
        $("#LoginForm").validate({
            rules:{
                email: "required",
                password: "required"
            },
            messages: {
				email: "Please enter your email",
                password: "Please enter your password",
            },
            submitHandler: function(form) {
                // Submit the form using AJAX
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo Controllers; ?>Login.php",
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
                            window.location = "<?php echo APPURL; ?>Views/Dashboard.php";
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

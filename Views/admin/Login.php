<?php
//echo "<pre>";print_r($_SERVER);echo"</pre>";
require_once($_SERVER['DOCUMENT_ROOT'].'/TEMP/config.php');
require_once('header.php');
?>
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form   name="LoginForm" id="LoginForm"method="post">
        <div class="input-group mb-3">
          <input type="email" id="email" name="email" class="form-control" placeholder="example@email.com">
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <div class="response alert">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<?php require_once('FooterScripts.php');?>
<!-- /.login-box -->
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
                    url: "<?php echo Controllers; ?>Admin-Login.php",
                    data: $(form).serialize(),
                    success: function(response) {
                    if(response.Status ===  "Failed"){
                        var ErrorMessages = "";
                        //console.log(response.Message);
                        response.Message.forEach(function(item) {
                            ErrorMessages += item +"<br>";
                        });
                        $(".response").addClass('alert-danger').html(ErrorMessages);
                    }else{
                      Toast.fire({
                        icon: 'success',
                        title: response.Message
                      });
                        setTimeout(function(){
                            window.location = "<?php echo AdminURL; ?>Dashboard.php";
                        },1000);
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

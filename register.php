<?php
include "includes/DBConfig.php";
include "includes/login_model.php";
$auth = new login_model();

if(isset($_POST['submit']))
{
    $man_no = $_POST['man_no'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $title = $_POST['title'];
    $role = "User";
    $usr_pass = $_POST['password'];
    $register_user = $auth->registerUser($man_no,$fullname,$email, $department, $title, $role, $usr_pass);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MWSC - IT Help Desk</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="card shadow-lg border-0 rounded-lg mt-3">
                                    <div class="card-header"><h5 class="text-center font-weight-light my-3">Sign Up</h5></div>
                                    <div class="card-body">
                                    <form method='POST' class='form-horizontal'>
                         <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="man_no">Man Number</label>
                                    <input class="form-control" name="man_no" id="man_no" type="text" placeholder="Enter Man No" required>
                                 </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="f_name">Fullname</label>
                                    <input class="form-control" name="fullname" id="f_name" type="text" placeholder="Enter Full Name" required>
                                 </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="email">Email Address</label>
                                    <input class="form-control" name="email" id="email" type="email" placeholder="Enter Email Address" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="department">Department</label>
                                    <input class="form-control" name="department" id="department" type="text" placeholder="Enter Department" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">

                         <div class="col-md-12">
                                <div class="form-group">
                                    <label class="small mb-1" for="title">Title / Position</label>
                                    <input class="form-control" name="title" id="title" type="text" placeholder="Enter Title / Position" required>
                                 </div>
                            </div>

                        </div>

                        <div class="form-row">
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" name="password" id="password" type="password" placeholder="Enter Password" required>
                                 </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="password2">Confirm Password</label>
                                    <input class="form-control" name="password2" id="password2" type="password" placeholder="Confirm Password" required>
                                    <span id='message'></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small" href="index.php">Already Have An Account...? Click Here</a>
                            <input class="btn btn-primary" id="submit" type="submit" name="submit" value="Create Account" >                     
                        </div>
                      </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

$('#password, #password2').on('keyup', function () {
  if ($('#password').val() == $('#password2').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Password Not Matching').css('color', 'red');
});

</script>

</body>
</html>

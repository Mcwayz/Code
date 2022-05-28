<?php
session_start();
include "includes/dao.php";
include "includes/header.php";
include "includes/navbar.php";
include "includes/DBConfig.php";
include "includes/admin_model.php";

$admin = new admin_model();

if(isset($_POST['submit']))
{
    $man_no = $_POST['man_no'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $title = $_POST['title'];
    $role = "Administrator";
    $usr_pass = $_POST['password'];
    $register_user = $admin->registerStaff($man_no,$fullname,$email, $department, $title, $role, $usr_pass);
}
?>
<div id="layoutSidenav_content">
             <main>
                    <div class="container-fluid">
                    <br>
                        <div class="card mb-4">
                        <div class="card-header">
                               Add User
                            </div>
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
                        
                        <div class="form-group">
                            <input class="btn btn-secondary" id="submit" type="submit" name="submit" value="Add User" >
                        </div>

                      </form>
                      
                    </div>

                </div>

            </div>

        </main>

<?php  
    include 'includes/footer.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

$('#password, #password2').on('keyup', function () {
  if ($('#password').val() == $('#password2').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Password Not Matching').css('color', 'red');
});

</script>

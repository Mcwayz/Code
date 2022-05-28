<?php
session_start();
include "includes/dao.php";
include "includes/header.php";
include "includes/navbar.php";
include "includes/DBConfig.php";
include "includes/user_model.php";

$user_model = new user_model();

$id = intval($_SESSION['user_id']);
$getuser = $user_model->getUser($id);
$user = $getuser->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit']))
{
    $man_no = $_POST['man_no'];
    $fullname = $_POST['fullname'];
    $usr_pass = $_POST['password'];
    $usr_pass2 = $_POST['password2'];
    if($usr_pass != $usr_pass2)
    {
        echo"<script>alert('Passwords Don't Much);</script>";
    }
    else
    {
        $register_user = $user_model->updatePassword($man_no, $usr_pass);
    }
}
?>
<div id="layoutSidenav_content">
             <main>
                    <div class="container-fluid">
                        <h4 class="mt-4">Profile Details</h4>
                        <ol class="breadcrumb mb-4">
                        </ol>
                       
                     <div class="container-fluid">
                        <div class="card mb-4">
                        <div class="card-header">
                               My Profile
                            </div>
                        <div class="card-body">
                        <form method='POST' class='form-horizontal'>
                         <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="man_no">Man Number</label>
                                    <input class="form-control" value="<?=$user['man_no']?>" name="man_no" id="man_no" type="text" placeholder="Enter Man No" disabled>
                                 </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="fullname">Fullname</label>
                                    <input class="form-control" value="<?=$user['full_name']?>" name="fullname" id="f_name" type="text" placeholder="Enter Full Name" disabled>
                                 </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="email">Email Address</label>
                                    <input class="form-control" value="<?=$user['email_address']?>" name="email" id="email" type="email" placeholder="Enter Email Address" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="department">Department</label>
                                    <input class="form-control" value="<?=$user['department']?>"name="department" id="department" type="text" placeholder="Enter Department" disabled>
                                </div>
                            </div>

                        </div>

                        <div class="form-row">

                         <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="title">Title / Position</label>
                                    <input class="form-control" value="<?=$user['job_title']?>" name="title" id="title" type="text" placeholder="Enter Title / Position" disabled>
                                 </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="title">System Rights</label>
                                    <input class="form-control" value="<?=$user['role']?>" name="role" id="role" type="text" disabled>
                                 </div>
                            </div>
                    </div>

                        <div class="form-row">
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="password">Change Password</label>
                                    <input class="form-control"  name="password" id="password" type="password" placeholder="Enter Password" required>
                                 </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="password2">Confirm Password</label>
                                    <input class="form-control"  name="password2" id="password2" type="password" placeholder="Confirm Password" required>
                                    <span id='message'></span>
                                 </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <input class="btn btn-secondary" id="submit" type="submit" onclick="return confirm('Update Password..?');" name="submit" value="Update Password" >
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
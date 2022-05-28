<?php
session_start();
include "includes/dao.php";
include "includes/header.php";
include "includes/navbar.php";
include "includes/DBConfig.php";
include "includes/admin_model.php";

$admin = new admin_model();

$id = intval($_GET['id']);
$getuser = $admin->getUser($id);
$user = $getuser->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit']))
{
    $id = intval($_GET['id']);
    $man_no = $_POST['man_no'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $title = $_POST['title'];
    $role = $_POST['role'];
    $usr_pass = $_POST['password'];
    $register_user = $admin->editUser($id, $man_no,$fullname,$email, $department, $title, $role, $usr_pass);
}

if(isset($_POST['delete']))
{
    $id = intval($_GET['id']);
    $admin->deleteUser($id);
}

?>
<div id="layoutSidenav_content">
             <main>
                    <div class="container-fluid">
                        <h4 class="mt-4">User Details</h4>
                        <ol class="breadcrumb mb-4">
                        </ol>
                       
                     <div class="container-fluid">
                        <div class="card mb-4">
                        <div class="card-header">
                               Edit User
                            </div>
                        <div class="card-body">
                        <form method='POST' class='form-horizontal'>
                         <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="man_no">Man Number</label>
                                    <input class="form-control" value="<?=$user['man_no']?>" name="man_no" id="man_no" type="text" placeholder="Enter Man No" required>
                                 </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="fullname">Fullname</label>
                                    <input class="form-control" value="<?=$user['full_name']?>" name="fullname" id="f_name" type="text" placeholder="Enter Full Name" required>
                                 </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="email">Email Address</label>
                                    <input class="form-control" value="<?=$user['email_address']?>" name="email" id="email" type="email" placeholder="Enter Email Address" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="department">Department</label>
                                    <input class="form-control" value="<?=$user['department']?>"name="department" id="department" type="text" placeholder="Enter Department" required>
                                </div>
                            </div>

                        </div>

                        <div class="form-row">

                         <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="title">Title / Position</label>
                                    <input class="form-control" value="<?=$user['job_title']?>" name="title" id="title" type="text" placeholder="Enter Title / Position" required>
                                 </div>
                            </div>


                            <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="role">Role</label>
                                    <select class='form-control' name="role" id="role"  required>
                                       <option value="<?=$user['role']?>"><?=$user['role']?></option>
                                       <option value="User">User</option>
                                       <option value="Administrator">Administrator</option>
                                    </select>
                             </div>
                        </div>
                    </div>

                        <div class="form-row">
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" value="<?=$user['usr_password']?>" name="password" id="password" type="password" placeholder="Enter Password" required>
                                 </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="password2">Confirm Password</label>
                                    <input class="form-control" value="<?=$user['usr_password']?>" name="password2" id="password2" type="password" placeholder="Confirm Password" required>
                                 </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <input class="btn btn-secondary" id="submit" type="submit" onclick="return confirm('Are You Sure You Want to Update User Details?');" name="submit" value="Update Record" >
                            <input class="btn btn-danger" style="float: right;" id="submit" type="submit" onclick="return confirm('Are You Sure You Want to Delete User?');" name="delete" value="Delete Record" >
                        </div>
                      </form>
                      
                    </div>

                </div>

            </div>

        </main>

<?php  
    include 'includes/footer.php';
?>

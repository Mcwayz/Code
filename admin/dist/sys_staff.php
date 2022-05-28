<?php
session_start();
include "includes/dao.php";
include "includes/header.php";
include "includes/navbar.php";
include "includes/DBConfig.php";
include "includes/admin_model.php";

$admin = new admin_model();
$user = $admin->getITDepartment();

?>
<div id="layoutSidenav_content">
             <main>
                   
                       
                <div class="container-fluid">
                    <br>
                    <div class="card mb-4">
                        <div class="card-header">
                               Registered Staff
                    </div>
                  </div>

                    <div class="card mb-4">
                         <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Users
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <?php $style = 'style="font-size: 12px";';?>
                                            <tr <?php echo $style;?>>
                                                <th>Name</th>
                                                <th>Title</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                        <tr <?php echo $style;?>>
                                                <th>Name</th>
                                                <th>Title</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php while ($row = $user->fetch(PDO::FETCH_ASSOC)) {?>
                                            <tr <?php echo $style;?>>
                                                <td><?=$row['full_name']?></td>
                                                <td><?=$row['job_title']?></td>
                                                <td><?=$row['role']?></td>
                                                <td align="center">
                                                    <a title="Edit " href="edit_staff.php?id=<?=$row['staff_id']?>"  <?php echo $style;?> class=" btn-sm btn-warning">Edit</a>
                                                    <a title="Delete" href="sys_staff.php?del=<?=$row['staff_id']?>" <?php echo $style;?> onclick="return confirm('Are You Sure You Want to Delete User?');" class="btn-sm delete btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>                            
                        </div>
                </div>
            </main>

<?php  
    include 'includes/footer.php';
?>

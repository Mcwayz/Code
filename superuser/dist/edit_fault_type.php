<?php
session_start();
include "includes/dao.php";
include "includes/header.php";
include "includes/navbar.php";
include "includes/DBConfig.php";
include "includes/admin_model.php";

$admin = new admin_model();

$id = intval($_GET['id']);
$category = $admin->ticketAssignment($id);
$row = $category->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit']))
{
    $id = intval($_GET['id']);
    $fault_type = $_POST['faulty_type'];
    $officer = $_POST['officer'];
    $problem = $_POST['problem_desc'];
    $sla = $_POST['sla'];
    $editType = $admin->editTicketType($id, $fault_type, $officer, $problem, $sla);
}

if(isset($_POST['delete']))
{
    $id = intval($_GET['id']);
    $delete = $admin->deleteTicketCategory($id);
}

?>
<div id="layoutSidenav_content">
             <main>
                 <br><br>
                 <br><br>
                    <div class="container-fluid">
                        <br>
                        <div class="card mb-4">
                        <div class="card-header">
                              Update Fault Type / IT Officer
                    </div>
                <div class="card-body">
                <form method='POST' class='form-horizontal'>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="fault_type">Fault Type</label>
                                    <input class="form-control" value="<?=$row['ticket_type']?>" name="faulty_type" id="faulty_type" type="text" placeholder="Enter Fault Type" required>
                                 </div>
                            </div>
                         

                            <div class="col-md-6">
                               <div class="form-group">
                                <label class="small mb-1" for="officer">Officer</label>
                                    <select class='form-control' name='officer' id='officer'  required>
                                        <option value="<?=$row['staff_id'] ?>"><?=$row['full_name'] ?></option>
                                        <?php 
                                        $ITOfficer = $admin->getITDepartment(); 
                                        while ($list = $ITOfficer->fetch(PDO::FETCH_ASSOC)) {?>
                                       <option value="<?=$list['staff_id'] ?>"><?=$list['full_name'] ?></option>
                                       <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="fault_type">Fault Description</label>
                                    <input class="form-control" name="problem_desc" value="<?=$row['problem_desc']?>" id="problem_desc" type="text" placeholder="E.g.. Printer not working" required>
                                 </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="sla">Max SLA - (Minutes)</label>
                                    <input class="form-control" name="sla" value="<?=$row['ticket_sla']?>" id="sla" type="text" placeholder="E.g.. 30" required>
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

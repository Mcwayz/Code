<?php
session_start();
include "includes/dao.php";
include "includes/header.php";
include "includes/navbar.php";
include "includes/DBConfig.php";
include "includes/admin_model.php";

$admin = new admin_model();

if(isset($_POST['assign']))
{
    $staff_id = $_POST['officer'];
    $fault_type = $_POST['faulty_type'];
    $problem = $_POST['problem_desc'];
    $sla = $_POST['sla'];
    $addType =$admin->addTicketType($staff_id, $fault_type, $problem, $sla);
}
?>
<div id="layoutSidenav_content">
             <main>
                    <div class="container-fluid">
                        <br>
                        <div class="card mb-4">
                        <div class="card-header">
                               Fault Types / IT Officers
                    </div>
                <div class="card-body">
                <form method='POST' class='form-horizontal'>
                         <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="fault_type">Fault Type</label>
                                    <input class="form-control" name="faulty_type" id="faulty_type" type="text" placeholder="E.g.. Software" required>
                                 </div>
                            </div>


                            <?php $ITOfficer = $admin->getITDepartment(); ?>
                            <div class="col-md-6">
                               <div class="form-group">
                                <label class="small mb-1" for="officer">Officer</label>
                                    <select class='form-control' name='officer' id='officer'  required>
                                        <option value="">- Select Officer -</option>
                                        <?php while ($row = $ITOfficer->fetch(PDO::FETCH_ASSOC)) {?>
                                       <option value="<?=$row['staff_id'] ?>"><?=$row['full_name'] ?></option>
                                       <?php }?>
                                    </select>
                                </div>
                            </div>

                            </div>

                            <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="fault_type">Fault Description</label>
                                    <input class="form-control" name="problem_desc" id="problem_desc" type="text" placeholder="E.g.. Printer not working" required>
                                 </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="sla">Max SLA - (Minutes)</label>
                                    <input class="form-control" name="sla" id="sla" type="text" placeholder="E.g.. 30" required>
                                 </div>
                            </div>
                            
                            </div>

                            <div class="form-group">
                                <input class="btn btn-secondary" id="submit" type="submit" name="assign" value="Assign" >
                            </div>
                         
                         </form>
                    </div>
                    <br>


                </div>

                    <div class="card mb-4">
                         <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Active
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <?php 
                                $getType = $admin->getTicketCategory();
                                ?>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <?php $style = 'style="font-size: 12px";';?>
                                            <tr <?php echo $style;?>>
                                                <th>No</th>
                                                <th>Fault Desc</th>
                                                <th>Fault Type</th>
                                                <th>IT Officer</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                        <tr <?php echo $style;?>>
                                                <th>No</th>
                                                <th>Fault Desc</th>
                                                <th>Fault Type</th>
                                                <th>IT Officer</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php while ($row = $getType->fetch(PDO::FETCH_ASSOC)) {?>
                                            <tr <?php echo $style;?>>
                                                <td><?=$row['ticket_type_id']?></td>
                                                <td><?=$row['problem_desc']?></td>
                                                <td><?=$row['ticket_type']?></td>
                                                <td><?=$row['full_name']?></td>
                                                <td align="center">
                                                    <a title="Update" href="edit_fault_type.php?id=<?=$row['ticket_type_id']?>"  class=" btn-sm btn-success" <?php echo $style;?>>View Details</a>
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

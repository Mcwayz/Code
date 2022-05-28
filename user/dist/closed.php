<?php
session_start();
include "includes/dao.php";
include "includes/header.php";
include "includes/navbar.php";
include "includes/DBConfig.php";
include "includes/user_model.php";

$model = new user_model();

$id = $_SESSION['user_id'];
$tickets = $model->closedTickets($id);
?>
<div id="layoutSidenav_content">
             <main>
                   
                <div class="container-fluid">
                    <br>
                    <div class="card mb-4">
                        <div class="card-header" style="text-align: center;">
                            <b>Closed Tickets</b>
                    </div>
                  </div>
                    <div class="card mb-4">
                         <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Tickets
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <?php $style = 'style="font-size: 12px";';?>
                                        <tr <?php echo $style;?>>
                                                <th>Tracking No</th>
                                                <th>Assigned To</th>
                                                <th>Fault Type</th>
                                                <th>SLA (Mins)</th>
                                                <th>Reported Time</th>
                                                <th>Time Taken (Mins)</th>
                                                <th>Status</th>
                                                <th>Time Closed </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                        <tr <?php echo $style;?>>
                                                <th>Tracking No</th>
                                                <th>Assigned To</th>
                                                <th>Fault</th>
                                                <th>SLA (Mins)</th>
                                                <th>Reported Time</th>
                                                <th>Time Taken (Mins)</th>
                                                <th>Status</th>
                                                <th>Time Closed</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                        <?php 
                                          while ($row = $tickets->fetch(PDO::FETCH_ASSOC)) 
                                          {
                                            $fault_time = new DateTime($row['fault_time']);
                                            $closed = new DateTime($row['date_closed']);
                                            $stamp =  $fault_time->diff($closed)->format("%i");
                                            $FT = $fault_time->format('d M Y H:i:s');
                                            $CT = $closed->format('d M Y H:i:s');
                                        ?>
                                            <tr <?php echo $style;?>>
                                                <td><?=$row['ticket_id'];?></td>
                                                <td><?=$row['name'];?></td>
                                                <td><?=$row['ticket_type'];?></td>
                                                <td><?=$row['ticket_sla'];?></td>
                                                <td><?=$FT;?></td>
                                                <td><?=$stamp;?></td>
                                                <td><?=$row['ticket_status'];?></td>
                                                <td><?=$CT;?></td>
                                                <td align="center">
                                                    <a title="View Ticket" href="view_closed.php?id=<?=$row['ticket_id']?>" <?php echo $style;?>  class=" btn-sm btn-success">Details</a>
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

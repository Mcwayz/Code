<?php
session_start();
include "includes/dao.php";
include "includes/header.php";
include "includes/navbar.php";
include "includes/DBConfig.php";
include "includes/user_model.php";

$rejected = new user_model();
$id = $_SESSION['user_id'];
$tickets = $rejected->rejectedTickets($id);
?>
<div id="layoutSidenav_content">
             <main>
                   
                <div class="container-fluid">
                    <br>
                    <div class="card mb-4">
                        <div class="card-header" style="text-align: center;">
                            <b>Reopened Tickets</b>
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
                                                <th>Reported </th>
                                                <th>Status</th>
                                                <th>Closed</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                        <tr <?php echo $style;?>>
                                                <th>Tracking No</th>
                                                <th>Assigned To</th>
                                                <th>Fault Type</th>
                                                <th>Reported</th>
                                                <th>Status</th>
                                                <th>Closed</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php 
                                          while ($row = $tickets->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <tr <?php echo $style;?>>
                                                <td><?=$row['ticket_id']?></td>
                                                <td><?=$row['name']?></td>
                                                <td><?=$row['ticket_type']?></td>
                                                <td><?=$row['fault_time']?></td>
                                                <td><?=$row['ticket_status']?></td>
                                                <td><?=$row['date_closed']?></td>
                                                <td align="center">
                                                    <a title="View " href="view_ticket.php?id=<?=$row['ticket_id']?>" <?php echo $style;?>  class=" btn-sm btn-success">View Ticket</a>
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

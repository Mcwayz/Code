<?php
session_start();
include "includes/dao.php";
include "includes/header.php";
include "includes/navbar.php";
include "includes/DBConfig.php";
include "includes/user_model.php";

$all_tickets = new user_model();

$id = $_SESSION['user_id'];
$tickets = $all_tickets->allTickets($id);

?>
<div id="layoutSidenav_content">
             <main>

                <div class="container-fluid">
                    <br>
                    <div class="card mb-4">
                        <div class="card-header" style="text-align: center;">
                            <b>My Tickets</b>
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
                                                <th>Est Completion</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                        <tr <?php echo $style;?>>
                                                <th>Tracking No</th>
                                                <th>Assigned To</th>
                                                <th>Fault Type</th>
                                                <th>SLA (Mins)</th>
                                                <th>Reported Time</th>
                                                <th>Est Completion</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php
                                          while ($row = $tickets->fetch(PDO::FETCH_ASSOC)) {
                                            $fault_time = new DateTime($row['fault_time']);
                                            $now = date('D, d M Y H:i:s');
                                            $today = new DateTime($now);
                                            $sla = $row['ticket_sla'];

                                            $est = $fault_time;
                                            $est->add(new DateInterval('PT' .$sla. 'M'));
                                            $stamp = $est->format('d M Y H:i:s');
                                        ?>
                                            <tr <?php echo $style;?>>
                                                <td><?=$row['ticket_id']?></td>
                                                <td ><?=$row['name']?></td>
                                                <td><?=$row['ticket_type']?></td>
                                                <td><?=$row['ticket_sla']?></td>
                                                <td><?=$row['fault_time']?></td>
                                                <td><?=$stamp?></td>
                                                <td><?=$row['ticket_status']?></td>
                                                <td align="center">
                                                    <a title="View " href="view_ticket.php?id=<?=$row['ticket_id']?>" <?php echo $style;?>  class=" btn-sm btn-success">Details</a>
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

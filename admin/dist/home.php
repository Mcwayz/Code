<?php
session_start();
include "includes/dao.php";
include "includes/header.php";
include "includes/navbar.php";
include "includes/DBConfig.php";
include "includes/admin_model.php";

$dashboard = new admin_model();

$id = $_SESSION['user_id'];
$check_tickets = $dashboard->setOverdue()

?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4" style="text-align: center;">Admin - Dashboard</h1>
                        <ol class="breadcrumb mb-4" style="text-align: center;">
                        <?php
                            $TTickets = $dashboard->getTotalTickets($id);
                            $total = $TTickets->fetch(PDO::FETCH_ASSOC);
                             ?>
                            <li class="breadcrumb-item active">Showing Ticket Summary - &nbsp; <a href="all_tickets.php"> Total Tickets  : <?php echo $total['Total']; ?> </a></li>
                        </ol>

                        <div class="row">

                          <!---Overdue Tickets---->

                        <div class="col-xl-3 col-md-4">
                            <?php
                            $oTickets = $dashboard->OverdueTickets($id);
                            $overdue = $oTickets->fetch(PDO::FETCH_ASSOC);
                             ?>
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Overdue: <?php echo $overdue['Overdue'];?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="overdue.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>



                            <!---Pending Tickets---->

                            <div class="col-xl-3 col-md-6">
                            <?php
                             $pTickets = $dashboard->getPendingTickets($id);
                             $pending = $pTickets->fetch(PDO::FETCH_ASSOC);
                            ?>
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Pending : <?php echo $pending['Pending'];?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="tickets.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>


                            <!---Total Tickets---->

                            <div class="col-xl-3 col-md-6">
                            <?php
                                $reopened = $dashboard->getReopenedTickets($id);
                                $opened = $reopened->fetch(PDO::FETCH_ASSOC);
                            ?>
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Re-opened : <?php echo $opened['Reopened'];?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="reopened.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>

                            </div>

                             <!---Closed Tickets---->

                            <div class="col-xl-3 col-md-6">
                            <?php
                             $cTickets = $dashboard->getClosedTickets($id);
                             $closed = $cTickets->fetch(PDO::FETCH_ASSOC);
                            ?>
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Closed : <?php echo $closed['Closed'];?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="closed.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Overall Tickets
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
<?php
include "includes/footer.php";
?>

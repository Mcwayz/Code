<?php
session_start();
include "includes/dao.php";
include "includes/header.php";
include "includes/navbar.php";
include "includes/DBConfig.php";
include "includes/admin_model.php";

$view = new admin_model();
$id = $_GET['id'];
$person = $_SESSION['name'];
$data = $view->getTicket($id);
$ticket = $data->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['back']))
{
    echo"<script>window.location.href='closed.php'</script>";
}

?>
<div id="layoutSidenav_content">
             <main>
             <div class="container-fluid">
                        <br>
                        <div class="card mb-4">
                        <div class="card-header" style="text-align: center;">
                               <b>My Ticket Details</b>
                    </div>
                <div class="card-body">
                <form method='POST' class='form-horizontal'>
                    <div class="form-row">

                        <div class="col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="date_time">Fault Type</label>
                                    <input class="form-control" value="<?=$ticket['ticket_type'];?>" name="fault_type"  type="text" disabled>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="email">Fault</label>
                                    <input class="form-control" value="<?=$ticket['problem_desc']?>" name="fault" id="fault" type="text" disabled>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="date_time">Date / Time Reported</label>
                                    <input class="form-control" value="<?=$ticket['fault_time'];?>" name="date_time" id="date_time" type="text" disabled>
                                </div>
                            </div>

                    </div>


                    <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="desc">Fault Description</label>
                                    <input class="form-control" value="<?=$ticket['ticket_desc'];?>" id="desc" name="desc"   placeholder="Description" type="text" disabled>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="date_time">Assigned To</label>
                                    <input class="form-control" value="<?=$ticket['staff'];?>" name="it_staff" type="text" disabled>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="small mb-1" for="title">Ticket Status</label>
                                    <input class="form-control" value="<?=$ticket['ticket_status'];?>" name="status" id="status" type="text" disabled>
                                 </div>
                            </div>

                        </div>
                      </form>

                    </div>

                </div>
                
             </div>


    <?php
        $id = intval($_GET['id']); 
        $comments = $view->getComments($id);
        while ($row = $comments->fetch(PDO::FETCH_ASSOC)){ 
    ?>
    <div class="container-fluid"><br>
         <div class="card mb-4">
         <div class="card-header">
         <strong><i><?=$row['person'];?>'s Comment : <?=$row['comment_date']?></i></strong>
         </div>
                    <div class="card-body">
     <div class="col-md-9">
	
     		<div class="post">
					<div class="post_info clearfix">
					</div>
					
					<p>
					<?=$row['comment_desc']?>
					</p>
				</div>
	
    	        </div><!-- End col-md-9--> 
                    </div>
                </div>
             </div>
             <?php } ?>  

             </div>



             </div>


        </main>

<?php  
    include 'includes/footer.php';
?>

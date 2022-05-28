<?php
session_start();
include "includes/dao.php";
include "includes/header.php";
include "includes/navbar.php";
include "includes/DBConfig.php";
include "includes/user_model.php";

$view = new user_model();
$id = $_GET['id'];
$person = $_SESSION['name'];
$data = $view->getTicket($id);
$ticket = $data->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['add_comment']))
{
    $comment_date = date('D, d M Y H:i:s');
    $comment_desc = $_POST['comment_desc'];
    $ticket_id = $_GET['id'];
    $add_comment = $view->addComment($comment_date, $comment_desc, $ticket_id, $person);
}


if(isset($_POST['close_ticket']))
{
    $ticket_id = $_GET['id'];
    $comment_date = date('D, d M Y H:i:s');
    $comment_desc = $_POST['comment_desc'];
    if(empty($comment_desc))
    {
        $close = $view->closeTicket($ticket_id);
    }
    else
    {
        $close = $view->closeTicket($ticket_id);
        $add_comment = $view->addComment($comment_date, $comment_desc, $ticket_id, $person);
    }
    
}


if(isset($_POST['delete_ticket']))
{
    $ticket_id = $_GET['id'];
    $close = $view->deleteTicket($ticket_id);
}

if(isset($_POST['submit']))
{
    $ticket_id = $_GET['id'];
    $Officer = $view->getFaultType($id); 
}


?>
<div id="layoutSidenav_content">
             <main>
             <div class="container-fluid">
                        <br>
                        <div class="card mb-4">
                        <div class="card-header">
                               My Ticket Details
                    </div>
                <div class="card-body">
                <form method='POST' class='form-horizontal'>
                <div class="form-row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="small mb-1" for="tracking_no">Tracking No</label>
                        <input class="form-control" value="<?=$ticket['ticket_id'];?>" name="tracking_no"  type="text" disabled>
                    </div>
                </div>

                </div>
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
                                    <input class="form-control" value="<?=$ticket['full_name'];?>" name="it_staff" type="text" disabled>
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



             <div class="container-fluid">
                        <br>
                        <div class="card mb-4">
                        <div class="card-header">
                               Add Comment
                    </div>
                    <div class="card-body">
                    <form method='POST' class='form-horizontal'>

                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control"  id="desc" name="comment_desc"  rows="4" placeholder="Comment Here..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="col-md-4">
                        <div class="form-group">
                            <input class="btn btn-primary" id="submit" type="submit" name="add_comment" value="Add Comment" >
                        </div>
                        </div>

                        <div class="col-md-4" align="center">
                            <div class="form-group">
                            <input type="submit" value="Delete Ticket" onclick="return confirm('Delete  Ticket..?');"  class="btn btn-danger"  name="delete_ticket">
                            </div>
                        </div>

            
                        <div class="col-md-4" align="right">
                            <div class="form-group">
                            <input type="submit" value="Close Ticket" onclick="return confirm('Close  Ticket..?');"  class="btn btn-secondary"  name="close_ticket">
                            </div>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
             </div>






        </main>

<?php  
    include 'includes/footer.php';
?>

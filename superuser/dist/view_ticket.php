<?php
session_start();
include "includes/dao.php";
include "includes/header.php";
include "includes/navbar.php";
include "includes/DBConfig.php";
include "includes/admin_model.php";

$admin = new admin_model();
$id = $_GET['id'];
$person = $_SESSION['name'];
$data = $admin->getTicket($id);
$ticket = $data->fetch(PDO::FETCH_ASSOC);
$check_due = $admin->setOverdue();

if(isset($_POST['add_comment']))
{
    $ticket_id = $_GET['id'];
    $comment_date = date('D, d M Y H:i:s');
    $comment_desc = $_POST['comment_desc'];
    $add_comment = $admin->addComment($comment_date, $comment_desc, $ticket_id, $person);
}


if(isset($_POST['close_ticket']))
{
    $ticket_id = intval($_GET['id']);
    $comment_desc = $_POST['comment_desc'];
    if(empty($comment_desc))
    {
        $comment_desc = "NULL";
        $close = $admin->closeTicket($ticket_id, $comment_desc);
    }
    else
    {
        $close = $admin->closeTicket($ticket_id, $comment_desc);
        $add_comment = $view->addComment($comment_date, $comment_desc, $ticket_id, $person);
    }
}


if(isset($_POST['re_assign']))
{
    $ticket_id = $_GET['id'];
    $id = $_POST['officer'];
    $assign = $admin->Re_Assign($ticket_id, $id);
}

?>
<div id="layoutSidenav_content">
             <main>
             <div class="container-fluid">
                        <br>
                        <div class="card mb-4">
                        <div class="card-header">
                               Ticket Details
                    </div>
                <div class="card-body">
                <form method='POST' class='form-horizontal'>
                         <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="man_no">Complainant</label>
                                    <input class="form-control" value="<?=$ticket['username']?>" name="full_name" id="full_name" type="text" disabled>
                                 </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="department">Department</label>
                                    <input class="form-control" value="<?=$ticket['department']?>" name="department" id="department" type="text" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                         <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="title">Job Title</label>
                                    <input class="form-control" value="<?=$ticket['job_title'];?>" name="title" id="title" type="text" disabled>
                                 </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="title">Ticket Status</label>
                                    <input class="form-control" value="<?=$ticket['ticket_status'];?>" name="status" id="status" type="text" disabled>
                                 </div>
                            </div>
                       </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="email">Fault</label>
                                    <input class="form-control" value="<?=$ticket['ticket_type']?>" name="fault" id="fault" type="text" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="date_time">Date / Time Reported</label>
                                    <input class="form-control" value="<?=$ticket['fault_time'];?>" name="date_time" id="date_time" type="text" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">

                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="email">Summary</label>
                                    <input class="form-control"  id="desc" name="desc" value="<?=$ticket['problem_desc'];?>" placeholder="Description" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small mb-1" for="email">User Description</label>
                                    <input class="form-control"  id="desc" name="desc" value="<?=$ticket['ticket_desc'];?>" placeholder="Description" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                               <div class="form-group">
                                <label class="small mb-1" for="officer">Officer</label>
                                    <select class='form-control' name='officer' id='officer'  required>
                                    <?php $ITOfficer = $admin->getITDepartment(); ?> 
                                    <option value="<?=$ticket['staff_id']?>"><?=$ticket['staff'] ?></option>
                                    <option value="">- Select Officer -</option>
                                        <?php while ($row = $ITOfficer->fetch(PDO::FETCH_ASSOC)) {?>
                                       <option value="<?=$row['staff_id']?>"><?=$row['full_name'] ?></option>
                                       <?php }?>
                                    </select>
                                </div>
                            </div>
                       </div>

                       <div class="form-group">
                            <input class="btn btn-danger" style="float: left;" type="submit" value="Re-Assign" onclick="return confirm('Re-assign  Ticket..?');"  name="re_assign">
                        </div>

                      </form>

                    </div>

                </div>
                
             </div>


             <?php
        $id = intval($_GET['id']); 
        $comments = $admin->getComments($id);
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

                
                        <div class="form-group">
                            <input class="btn btn-primary" id="submit" type="submit" name="add_comment" value="Add Comment" onclick="return confirm('Add Comment..?');">
                            <input class="btn btn-secondary" style="float: right;" type="submit" value="Close Ticket" onclick="return confirm('Close  Ticket..?');"  name="close_ticket">
                        </div>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
             </div>
        </main>
\
<?php  
    include 'includes/footer.php';
?>

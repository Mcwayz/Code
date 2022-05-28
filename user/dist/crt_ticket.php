<?php
session_start();
include "includes/dao.php";
include "includes/header.php";
include "includes/navbar.php";
include "includes/DBConfig.php";
include "includes/user_model.php";

$model = new user_model();

if(isset($_POST['submit']))
{
    //Variables For System Ticket
    $fault_time = date('d M Y H:i:s');
    $type_id = $_POST['problem_fault'];
    $user_id = $_SESSION['user_id'];
    $ticket_desc = $_POST['desc'];
    $ticket_no = $_SESSION['number'];
    $ticket = $model->addTicket($type_id, $user_id, $fault_time, $ticket_desc, $ticket_no);

    //Variables For Email Ticket

    // $pro_email = "it@mwsc.com.zm";
    // $fault = $_POST['fault'];
    // $issuer_email = "niza.tembo@mwsc.com.zm";
    // $email_pass = "Mcwayz@2020";
    // $desc  = $ticket_desc. "\r\n".
    // "The issue occurred at ".$fault_time.
    // " Ticket No: ".
    // $send_mail = $model->sendMail($issuer_email, $pro_email, $fault, $desc, $email_pass);
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
                <?php
                    $number = mt_rand(1,1000);
                    $day = date('Y-m-d');
                    $cmp_no = $day.'-'.$number;
                    $_SESSION['number'] =  $cmp_no;
                ?>
                <form method='POST' class='form-horizontal'>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="small mb-1" for="date_time">Date / Time Reported</label>
                                    <input class="form-control" name="date_time" id="date_time" type="text"  value="<?php echo date('d M Y H:i:s');?>" disabled>
                                </div>
                            </div>

                        </div>

                        <div class="form-row">

                        <div class="col-md-6">
                              <div class="form-group">
                                <label class="small mb-1" for="fault">Fault Type</label>
                                <select class='form-control' id='fault' name='fault' onChange="getFaultType(this.value);" required>
                                     <option value="">- Select Fault Type -</option>
                                     <?php 
                                        $getFault = $model->getFaultTypes(); 
                                        while ($list = $getFault->fetch(PDO::FETCH_ASSOC)) {?>
                                       <option value="<?=$list['ticket_type'] ?>"><?=$list['ticket_type'] ?></option>
                                       <?php } ?>
                                    </select>
                                </div>
                           
                            </div>

                            <div class="col-md-6" id="some_div">
                              <div class="form-group">
                                <label class="small mb-1" for="fault">Fault Description Summary</label>
                                <select class='form-control' id='problem_fault' name='problem_fault' required>
                                     <option value="">- Select Fault Description -</option>
                                    </select>
                                </div>
                            </div>    
                        </div>


                        <div class="form-row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="small mb-1" for="desc">Fault Description</label>
                                    <textarea class="form-control"  id="desc" name="desc"  rows="5" placeholder="Description"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                            <input class="btn btn-secondary" id="submit" type="submit" onclick="return confirm('Create  Ticket..?');"  name="submit" value="Create Ticket" >
                            </div>
                        </div>
                      </form>

                    </div>

                </div>
                
             </div>
        </main>
<?php  
    include 'includes/footer1.php';
?>
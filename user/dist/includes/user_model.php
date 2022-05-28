<?php 

//Include required PHPMailer files

require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

//Define name spaces

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class user_model
{

    //Function that displays an Error Message 
    

    public function Error($func)
    {
        echo"<script>alert('Data Processing Error From The' +$func);</script>";
    }


    //Function that Sends An Email Message 
    

    public function sendMail($issuer_email, $pro_email, $fault, $ticket_desc, $email_pass)
    {
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;

        //Set smtp encryption type (ssl/tls)
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";

        //Set gmail username
        $mail->Username = $issuer_email;
        $mail->Password = $email_pass;

        //Email subject
        $mail->Subject = $fault;
        $mail->setFrom($issuer_email);
        $mail->isHTML(true);
        $mail->Body = $ticket_desc;
        $mail->addAddress($pro_email);

        //Send email
            if ( $mail->send()) 
            {
                echo "Email Sent..!";
            }
            else
            {
                $func = "The Send Email Ticket Function";
                $this->Error($func);
            }
        //Closing smtp connection
            $mail->smtpClose();
    }


    // Function to Update user Password


    public function updatePassword($man_no, $usr_pass)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "UPDATE `users` SET usr_password=:usr_password WHERE man_no=:man_no";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':man_no', $man_no);
        $query->bindparam(':usr_password', $usr_pass);
        if($query->execute())
        {
            echo"<script>window.location.href = 'home.php'</script>";
        }
        else
        {
            $Error = "Update Password Function";
            $this->Error($Error);
        }
    }


    //Function that creates a ticket


    public function addTicket($type_id, $user_id, $fault_time, $ticket_desc, $ticket_no)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $status = "Pending";
        $date_closed = "";
        $sql = "INSERT INTO `tickets`(`ticket_type_id`, `user_id`, `fault_time`, `ticket_desc`, `ticket_status`, `date_closed`, `ticket_no`)
        VALUES (:ticket_type_id, :user_id, :fault_time, :ticket_desc, :ticket_status, :date_closed, :ticket_no)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':ticket_type_id', $type_id);
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':fault_time', $fault_time);
        $query->bindParam(':ticket_desc', $ticket_desc);
        $query->bindParam(':ticket_status', $status);
        $query->bindParam(':date_closed', $date_closed);
        $query->bindParam(':ticket_no', $ticket_no);
        if($query->execute())
        {
            echo"<script>window.location.href = 'my_tickets.php'</script>";
        }
    }



    //Function to get users details


    
    public function getUser($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT * FROM `users` WHERE user_id='$id' LIMIT 1";
        return $dbConn->query($sql);
    }


    // Function that gets a Faulty / IT Officer


    public function getFaultType($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT users.user_id, ticket_type.user_id as staff, users.full_name, ticket_type.ticket_type_id, 
        ticket_type.ticket_type 
        FROM users 
        INNER JOIN ticket_type ON users.user_id = ticket_type.user_id 
        INNER JOIN tickets ON tickets.ticket_type_id = ticket_type.ticket_type_id 
        WHERE ticket_type.ticket_type_id";
        return $dbConn->query($sql);
    }


    //Function that Deletes a Ticket


    public function deleteTicket($ticket_id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "DELETE FROM `tickets` WHERE ticket_id=:ticket_id";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':ticket_id', $ticket_id);
        if($query->execute())
        {
            echo"<script>window.location.href = 'my_tickets.php'</script>";
        }
        else
        {
            $Error = "Delete Ticket Function";
            $this->Error($Error);
        }
        
    }



    // Function that gets Available Ticket Categories



    public function getTicketCategory()
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT users.user_id, users.full_name, users.email_address, ticket_type.ticket_type_id, ticket_type.ticket_type
        FROM users
        INNER JOIN ticket_type ON users.user_id = ticket_type.user_id ORDER BY `ticket_type_id` DESC";
        return $dbConn->query($sql);
    }



    //Function that gets all my tickets



    public function myTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT it_staff.full_name as name, tickets.ticket_id, tickets.ticket_status, ticket_type.ticket_type, 
        tickets.fault_time, tickets.date_closed, tickets.ticket_no, ticket_type.ticket_sla 
        FROM tickets 
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id 
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id 
        WHERE tickets.user_id='$id' AND NOT tickets.ticket_status='Closed'  ORDER BY tickets.ticket_id DESC";
        return $dbConn->query($sql);
    }



    
    //Function that gets all my tickets



    public function my_Tickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT it_staff.full_name as name, tickets.ticket_id, tickets.ticket_status, ticket_type.ticket_type, 
        tickets.fault_time, tickets.date_closed, tickets.ticket_no, ticket_type.ticket_sla 
        FROM tickets 
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id 
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id 
        WHERE tickets.user_id='$id' AND NOT tickets.ticket_status='Closed' AND NOT tickets.ticket_status='Reopened' ORDER BY tickets.ticket_id DESC";
        return $dbConn->query($sql);
    }



    // Function that gets Total Number Of Ticket 



    public function getTotalTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT Count(*)AS Total FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        WHERE tickets.user_id='$id'";
        return $dbConn->query($sql);
    }



    //Function that gets a single ticket


    public function getTicket($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT it_staff.full_name, ticket_type.problem_desc,tickets.ticket_id, 
        tickets.ticket_desc, tickets.ticket_status, ticket_type.ticket_type, tickets.date_closed,
        tickets.fault_time, tickets.ticket_no, ticket_type.ticket_sla 
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id 
        WHERE tickets.ticket_id='$id'";
        return $dbConn->query($sql);
    }


    // Function that gets Pending Tickets


    public function getPendingTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT Count(*)AS Pending FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id 
        WHERE  tickets.user_id='$id' AND tickets.ticket_status='Pending' AND NOT tickets.ticket_status='Closed' AND NOT tickets.ticket_status='Reopened'";
        return $dbConn->query($sql);
    }


    // Function that gets Closed Tickets

    public function getClosedTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT Count(*)AS Closed 
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id 
        WHERE ticket_status='Closed' AND tickets.user_id='$id'";
        return $dbConn->query($sql);
    }


    // Function that gets Pending Tickets


    public function getRejectedTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT Count(*)AS Rejected 
        FROM tickets 
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id 
        WHERE ticket_status='Reopened' AND tickets.user_id='$id'";
        return $dbConn->query($sql);
    }



    // Function that gets Overdue Tickets


    public function getOverdueTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT Count(*)AS Overdue 
        FROM tickets 
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id 
        WHERE ticket_status='Overdue' AND tickets.user_id='$id'";
        return $dbConn->query($sql);
    }


    // Function that gets Pending Tickets


    public function getReopenedTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT Count(*)AS Reopened 
        FROM tickets 
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id 
        WHERE ticket_status='Reopened' AND tickets.user_id='$id'";
        return $dbConn->query($sql);
    }


    //Funtion that returns tickets to be evaluated


    public function evaluate()
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT tickets.ticket_id, tickets.ticket_status, ticket_type.ticket_type, 
        tickets.fault_time, tickets.date_closed, tickets.ticket_no, ticket_type.ticket_sla 
        FROM tickets 
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id 
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id 
        WHERE tickets.ticket_status='Pending'";
        return $dbConn->query($sql);
    }
    


    // Function that checks if a ticket is past its SLA



    public function checkDate($date_reported, $date_today)
    {
        $difference = date_diff($date_reported, $date_today); 
        $minutes = $difference->days * 24 * 60;
        $minutes += $difference->h * 60;
        $minutes += $difference->i;
        return $minutes;
    }



    // Function that overdues tickets


    public function setOverdue()
    {
        $tickets = $this->evaluate();
        while ($row = $tickets->fetch(PDO::FETCH_ASSOC))
        {
            $fault_time = new DateTime($row['fault_time']);
            $now = date('D, d M Y H:i:s');
            $today = new DateTime($now);
            $sla = intval($row['ticket_sla']);
            $minutes = $this->checkDate($fault_time, $today);
            if($minutes > $sla)
            {
                $status  = "Overdue";
                $db = new DBconnection();
                $dbConn = $db->getConnection();
                $sql = "UPDATE tickets 
                INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
                SET tickets.ticket_status='$status' 
                WHERE ticket_type.ticket_sla < '$minutes' AND NOT tickets.ticket_status='Reopened' AND NOT tickets.ticket_status='Closed' ";
                return $dbConn->query($sql);
            }
        }  

    }
    

    // Function that gets a Fault Type


    public function getFaultTypes()
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT DISTINCT ticket_type FROM ticket_type ";
        return $dbConn->query($sql);
    }



    //Function that Closes Tickets


    public function closeTicket($ticket_id)
    {   $status = "Closed";
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "UPDATE `tickets` SET ticket_status=:ticket_status WHERE ticket_id =:ticket_id";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':ticket_id', $ticket_id);
        $query->bindparam(':ticket_status', $status);
        if($query->execute())
        {
            echo"<script>window.location.href = 'closed.php'</script>";
        }
        else
        {
            $Error = "Close Ticket Function";
            $this->Error($Error);
        }

    }



    //Function that Rejects Tickets



    public function rejectTicket($ticket_id)
    {   $status = "Reopened";
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "UPDATE `tickets` SET ticket_status=:ticket_status WHERE ticket_id =:ticket_id";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':ticket_id', $ticket_id);
        $query->bindparam(':ticket_status', $status);
        if($query->execute())
        {
            echo"<script>window.location.href = 'reopened.php'</script>";
        }
        else
        {
            $Error = "Reopen Ticket Function";
            $this->Error($Error);
        }

    }


    //Function that Adds Progressive Comments on a Ticket


    public function addComment($comment_date, $comment, $ticket_id, $person_id)
    {
        $comment_date = date('D, d M Y H:i:s');
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "INSERT INTO `comments`(`comment_date`, `comment_desc`, `ticket_id`, `person`)
        VALUES(:comment_date, :comment_desc, :ticket_id, :person)";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':comment_date', $comment_date);
        $query->bindparam(':comment_desc', $comment);
        $query->bindparam(':ticket_id', $ticket_id);
        $query->bindparam(':person', $person_id);
        if($query->execute())
        {
            echo"<script>window.location.href = 'my_tickets.php'</script>";
        }
        else
        {
            $Error = "Add Comment Function";
            $this->Error($Error);
        }
    }



    // Function that gets all Ticket Comments


    public function getComments($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT * FROM `comments` WHERE ticket_id='$id' ORDER BY `comment_date` DESC";
        return $dbConn->query($sql);
    }



    //Function that Adds Closure Comments on a Ticket


    public function closeComment($ticket_id, $close_date, $report)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "INSERT INTO `close_ticket`(`ticket_id`, `close_date`, `report`)
         VALUES(:ticket_id, :close_date, :report)";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':ticket_id', $ticket_id);
        $query->bindparam(':close_date', $close_date);
        $query->bindparam(':report', $report);
        if($query->execute())
        {
            echo"<script>window.location.href = 'tickets.php'</script>";
        }
        else
        {
            $Error = "Close Ticket Function";
            $this->Error($Error);
        }
    }



        //Function that gets all rejected tickets


        public function rejectedTickets($id)
        {
            $db = new DBconnection();
            $dbConn = $db->getConnection();
            $sql = "SELECT it_staff.full_name as name, tickets.ticket_id, tickets.ticket_status, ticket_type.ticket_type, 
            tickets.fault_time, tickets.date_closed, tickets.ticket_no
            FROM tickets 
            INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id 
            INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id 
            WHERE tickets.ticket_status='Reopened' AND tickets.user_id='$id' ORDER BY tickets.ticket_id DESC";
            return $dbConn->query($sql);
        }


        //Function that gets all rejected tickets


        public function overdueTickets($id)
        {
            $db = new DBconnection();
            $dbConn = $db->getConnection();
            $sql = "SELECT it_staff.full_name as name, tickets.ticket_id, tickets.ticket_status, ticket_type.ticket_type, 
            tickets.fault_time, tickets.date_closed, ticket_type.ticket_sla, tickets.ticket_no
            FROM tickets 
            INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id 
            INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id 
            WHERE tickets.ticket_status='Overdue' AND tickets.user_id='$id' ORDER BY tickets.ticket_id DESC";
            return $dbConn->query($sql);
        }
    
    
    
        //Function that gets all closed tickets
    
    
        public function closedTickets($id)
        {
            $db = new DBconnection();
            $dbConn = $db->getConnection();
            $sql = "SELECT it_staff.full_name as name, tickets.ticket_id, tickets.ticket_status, ticket_type.ticket_type, 
            tickets.fault_time, tickets.date_closed, tickets.ticket_no, ticket_type.ticket_sla 
            FROM tickets 
            INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id 
            INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id 
            WHERE tickets.ticket_status='Closed' AND tickets.user_id='$id' ORDER BY tickets.ticket_id DESC";
            return $dbConn->query($sql);
        }
        

                //Function that gets all closed tickets
    
    
        public function allTickets($id)
        {
            $db = new DBconnection();
            $dbConn = $db->getConnection();
            $sql = "SELECT it_staff.full_name as name, tickets.ticket_id, tickets.ticket_status, ticket_type.ticket_type, 
            tickets.fault_time, tickets.date_closed, tickets.ticket_no, ticket_type.ticket_sla
            FROM tickets 
            INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id 
            INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id 
            WHERE tickets.user_id='$id' ORDER BY tickets.ticket_id DESC";
            return $dbConn->query($sql);
        }

    
}
<?php
class admin_model
{

    //Function that displays an Error Message


    public function Error($func)
    {
        echo"<script>alert('Data Processing Error From The' +$func);</script>";
    }
    //Function that Registers a User


    public function registerStaff($man_no, $fullname, $email, $department, $title, $role, $password)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "INSERT INTO `users`(`man_no`, `full_name`, `email_address`, `department`, `job_title`, `role`, `usr_password`)
         VALUES(:man_no, :fullname, :email, :department, :job_title, :sys_role, :usr_password)";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':man_no', $man_no);
        $query->bindparam(':fullname', $fullname);
        $query->bindparam(':email', $email);
        $query->bindparam(':department', $department);
        $query->bindparam(':job_title', $title);
        $query->bindparam(':sys_role', $role);
        $query->bindparam(':usr_password', $password);
        if($query->execute())
        {
            echo"<script>window.location.href = 'staff_user.php'</script>";
        }
        else
        {
            $Error = "User Registration Function";
            $this->Error($Error);
        }
    }

    //Function that Registers a User


    public function registerUser($man_no, $fullname, $email, $department, $title, $role, $password)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "INSERT INTO `users`(`man_no`, `full_name`, `email_address`, `department`, `job_title`, `role`, `usr_password`)
         VALUES(:man_no, :fullname, :email, :department, :job_title, :sys_role, :usr_password)";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':man_no', $man_no);
        $query->bindparam(':fullname', $fullname);
        $query->bindparam(':email', $email);
        $query->bindparam(':department', $department);
        $query->bindparam(':job_title', $title);
        $query->bindparam(':sys_role', $role);
        $query->bindparam(':usr_password', $password);
        if($query->execute())
        {
            echo"<script>window.location.href = 'add_user.php'</script>";
        }
        else
        {
            $Error = "User Registration Function";
            $this->Error($Error);
        }
    }

        // Function to Update user Password


    public function updateStaffPassword($man_no, $usr_pass)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "UPDATE `it_staff` SET usr_password=:usr_password WHERE man_no=:man_no";
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



    public function editStaff($id, $man_no, $fullname, $email, $department, $title, $role, $password)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "UPDATE `it_staff` SET man_no=:man_no, full_name=:fullname, email_address=:email,
        department=:department, job_title=:job_title, `role`=:sys_role, usr_password=:usr_password
        WHERE user_id=:user_id";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':user_id', $id);
        $query->bindparam(':man_no', $man_no);
        $query->bindparam(':fullname', $fullname);
        $query->bindparam(':email', $email);
        $query->bindparam(':department', $department);
        $query->bindparam(':job_title', $title);
        $query->bindparam(':sys_role', $role);
        $query->bindparam(':usr_password', $password);
        if($query->execute())
        {
            echo"<script>window.location.href = 'sys_users.php'</script>";
        }
        else
        {
            $Error = "Update User Function";
            $this->Error($Error);
        }
    }



    //Function that Edits User Details


    public function editUser($id, $man_no, $fullname, $email, $department, $title, $role, $password)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "UPDATE `users` SET man_no=:man_no, full_name=:fullname, email_address=:email,
        department=:department, job_title=:job_title, `role`=:sys_role, usr_password=:usr_password
        WHERE user_id=:user_id";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':user_id', $id);
        $query->bindparam(':man_no', $man_no);
        $query->bindparam(':fullname', $fullname);
        $query->bindparam(':email', $email);
        $query->bindparam(':department', $department);
        $query->bindparam(':job_title', $title);
        $query->bindparam(':sys_role', $role);
        $query->bindparam(':usr_password', $password);
        if($query->execute())
        {
            echo"<script>window.location.href = 'sys_users.php'</script>";
        }
        else
        {
            $Error = "Update User Function";
            $this->Error($Error);
        }
    }


    //Function to get all registered user


    public function getUser($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT * FROM `users` WHERE user_id='$id' LIMIT 1";
        return $dbConn->query($sql);
    }




    //Function to get all registered users


    public function getStaff($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT * FROM `it_staff` WHERE staff_id='$id' LIMIT 1";
        return $dbConn->query($sql);
    }



    //Function to get all registered users


    public function getUsers()
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT * FROM `users`  ORDER BY `user_id` DESC";
        return $dbConn->query($sql);
    }


    // Function that get all IT Officers


    public function getITDepartment()
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT * FROM `it_staff` WHERE department='IT' AND NOT `job_title`='IT Manager'  ORDER BY `staff_id` DESC";
        return $dbConn->query($sql);
    }


    //Function that Deletes Staff


    public function deleteStaff($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "DELETE FROM `it_staff` WHERE staff_id='$id'";
        return $dbConn->query($sql);
    }


    //Function that Deletes a User


    public function deleteUser($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "DELETE FROM `users` WHERE user_id='$id'";
        return $dbConn->query($sql);
    }


    //Function that adds Ticket Fault Types


    public function addTicketType($staff_id, $ticket_type, $problem_desc, $sla)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "INSERT INTO `ticket_type`(`staff_id`, `ticket_type`, `problem_desc`, `ticket_sla`)
         VALUES(:staff_id, :ticket_type, :problem_desc, :sla)";
        $query = $dbConn->prepare($sql);-
        $query->bindparam(':staff_id', $staff_id);
        $query->bindparam(':ticket_type', $ticket_type);
        $query->bindparam(':problem_desc', $problem_desc);
        $query->bindparam(':sla', $sla);
        if($query->execute())
        {
            echo"<script>window.location.href = 'add_fault_type.php'</script>";
        }
        else
        {
            $Error = "Add Ticket Type Function";
            $this->Error($Error);
        }
    }


    //Function that gets all my tickets


    public function myTickets()
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT users.full_name as username, ticket_type.staff_id, ticket_type.ticket_sla, it_staff.full_name as staff,
        users.department, users.job_title, tickets.ticket_id, tickets.ticket_status, ticket_type.ticket_type,
        tickets.fault_time FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        INNER JOIN users ON users.user_id = tickets.user_id
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id
        WHERE NOT tickets.ticket_status='Closed' ORDER BY tickets.fault_time DESC";
        return $dbConn->query($sql);
    }


        //Function that gets all my tickets


    public function my_Tickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT users.full_name as username, ticket_type.staff_id, ticket_type.ticket_sla, it_staff.full_name as staff,
        users.department, users.job_title, tickets.ticket_id, tickets.ticket_status, ticket_type.ticket_type,
        tickets.fault_time FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        INNER JOIN users ON users.user_id = tickets.user_id
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id
        WHERE ticket_type.staff_id = '$id' AND NOT tickets.ticket_status='Closed' AND NOT tickets.ticket_status='Reopened' ORDER BY tickets.ticket_id DESC";
        return $dbConn->query($sql);
    }



    //Function that gets all my tickets


    public function Tickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT users.full_name as username, ticket_type.staff_id, it_staff.full_name as staff,
        users.department, users.job_title, tickets.ticket_id, tickets.ticket_status, tickets.action, ticket_type.ticket_type,
        tickets.fault_time, ticket_type.ticket_sla
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        INNER JOIN users ON users.user_id = tickets.user_id
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id
        WHERE ticket_type.staff_id ='$id' AND NOT tickets.ticket_status='Closed' ORDER BY tickets.ticket_id DESC";
        return $dbConn->query($sql);
    }



    //Function that filters reports


    public function getReport($from, $to)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT users.full_name as username, ticket_type.staff_id, it_staff.full_name as staff,
        users.department, users.job_title, tickets.ticket_id, tickets.date_closed,tickets.action, tickets.ticket_status, tickets.ticket_no, ticket_type.ticket_type,
        tickets.fault_time, ticket_type.ticket_sla
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        INNER JOIN users ON users.user_id = tickets.user_id
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id
        WHERE tickets.fault_time >= '$from'  AND tickets.fault_time <= '$to' ORDER BY tickets.ticket_id DESC ";
        return $dbConn->query($sql);
    }


    // function that gets all closed


    public function getClosedReport($from, $to)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT users.full_name as username, ticket_type.staff_id, it_staff.full_name as staff,
        users.department, users.job_title, tickets.ticket_id, tickets.date_closed,tickets.action, tickets.ticket_status, tickets.ticket_no, ticket_type.ticket_type,
        tickets.fault_time, ticket_type.ticket_sla
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        INNER JOIN users ON users.user_id = tickets.user_id
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id
        WHERE tickets.ticket_status= 'Closed' AND tickets.fault_time >= '$from'  AND tickets.fault_time <= '$to' ORDER BY tickets.ticket_id DESC ";
        return $dbConn->query($sql);
    }


        // function that gets all reopened tickets


        public function getReopenedReport($from, $to)
        {
            $db = new DBconnection();
            $dbConn = $db->getConnection();
            $sql = "SELECT users.full_name as username, ticket_type.staff_id, it_staff.full_name as staff,
            users.department, users.job_title, tickets.ticket_id, tickets.date_closed,tickets.action, tickets.ticket_status, tickets.ticket_no, ticket_type.ticket_type,
            tickets.fault_time, ticket_type.ticket_sla
            FROM tickets
            INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
            INNER JOIN users ON users.user_id = tickets.user_id
            INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id
            WHERE tickets.ticket_status= 'Reopened' AND tickets.fault_time >= '$from'  AND tickets.fault_time <= '$to' ORDER BY tickets.ticket_id DESC ";
            return $dbConn->query($sql);
        }



        // function that gets all Overdue
    

        public function getOverdueReport($from, $to)
        {
            $db = new DBconnection();
            $dbConn = $db->getConnection();
            $sql = "SELECT users.full_name as username, ticket_type.staff_id, it_staff.full_name as staff,
            users.department, users.job_title, tickets.ticket_id, tickets.date_closed,tickets.action, tickets.ticket_status, tickets.ticket_no, ticket_type.ticket_type,
            tickets.fault_time, ticket_type.ticket_sla
            FROM tickets
            INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
            INNER JOIN users ON users.user_id = tickets.user_id
            INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id
            WHERE tickets.ticket_status= 'Overdue' AND tickets.fault_time >= '$from'  AND tickets.fault_time <= '$to' ORDER BY tickets.ticket_id DESC ";
            return $dbConn->query($sql);
        }



        // function that gets all Overdue
    

        public function getPendingReport($from, $to)
        {
            $db = new DBconnection();
            $dbConn = $db->getConnection();
            $sql = "SELECT users.full_name as username, ticket_type.staff_id, it_staff.full_name as staff,
            users.department, users.job_title, tickets.ticket_id, tickets.date_closed,tickets.action, tickets.ticket_status, tickets.ticket_no, ticket_type.ticket_type,
            tickets.fault_time, ticket_type.ticket_sla
            FROM tickets
            INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
            INNER JOIN users ON users.user_id = tickets.user_id
            INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id
            WHERE tickets.ticket_status= 'Pending' AND tickets.fault_time >= '$from'  AND tickets.fault_time <= '$to' ORDER BY tickets.ticket_id DESC ";
            return $dbConn->query($sql);
        }



    //Function that filters reports


    public function exportReport($from, $to)
    {
        $res = $this->getReport($from, $to);
        $html='<table>
            <tr>
                <th>Tracking No</th> 
                <th>User</th> 
                <th>Title</th> 
                <th>IT Officer</th> 
                <th>Fault Type</th> 
                <th>SLA (Mins)</th>
                <th>Reported Time</th> 
                <th>Time Taken (Mins)</th> 
                <th>Time Closed</th> 
                <th>Status</th>
            </tr>';
        while ($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            $fault_time = new DateTime($row['fault_time']);
            $closed = new DateTime($row['date_closed']);
            $stamp =  $closed->diff($fault_time)->format("%i");
            $RT = $fault_time->format('d M Y H:i:s');
            $TC = $closed->format('d M Y H:i:s');
            $html.='
            <tr>
                <td>'.$row['ticket_id'].'</td>
                <td>'.$row['username'].'</td>
                <td>'.$row['job_title'].'</td>
                <td>'.$row['staff'].'</td>
                <td>'.$row['ticket_type'].'</td>
                <td>'.$row['ticket_sla'].'</td>
                <td>'.$RT.'</td>
                <td>'.$stamp.'</td>
                <td>'.$TC.'</td>
                <td>'.$row['ticket_status'].'</td>
            </tr>';
        }

        $html.='</table>';
        $now = date('d M Y H:i');
        $file_name = 'Report-'.$now.'.xls';
        header('Content-Type:application/vnd-ms-excel');
        header("Content-Disposition:attachment; filename=\"$file_name\"");
        echo $html;
    }





    //Function that gets reports on all tickets


    public function Reports($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT users.full_name as username, ticket_type.staff_id, it_staff.full_name as staff,
        users.department, users.job_title, tickets.ticket_id, tickets.date_closed,tickets.action, tickets.ticket_status, tickets.ticket_no, ticket_type.ticket_type,
        tickets.fault_time, ticket_type.ticket_sla
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        INNER JOIN users ON users.user_id = tickets.user_id
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id
        WHERE ticket_type.staff_id ='$id'  ORDER BY tickets.ticket_id DESC";
        return $dbConn->query($sql);
    }




    //Function that gets all my tickets


    public function allTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT users.full_name as username, ticket_type.staff_id, it_staff.full_name as staff,
        users.department, users.job_title, tickets.ticket_id, tickets.ticket_status, tickets.ticket_no, ticket_type.ticket_type,
        tickets.fault_time, ticket_type.ticket_sla, tickets.date_closed 
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        INNER JOIN users ON users.user_id = tickets.user_id
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id
        WHERE ticket_type.staff_id ='$id' ORDER BY tickets.ticket_id DESC";
        return $dbConn->query($sql);
    }


    //Function that gets a single ticket


    public function getTicket($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT users.full_name as username, ticket_type.staff_id, it_staff.full_name as staff,
        users.department, users.job_title, tickets.user_id, users.job_title,tickets.ticket_desc,
        tickets.ticket_status, ticket_type.ticket_type, ticket_type.problem_desc,
        tickets.fault_time, ticket_type.ticket_sla, tickets.ticket_no FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        INNER JOIN users ON users.user_id = tickets.user_id
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id
        WHERE tickets.ticket_id='$id'";
        return $dbConn->query($sql);
    }


    //Function update Ticket Type / IT Officer


    public function editTicketType($id, $fault_type, $officer, $problem, $sla)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "UPDATE `ticket_type` SET `ticket_type`=:ticket_type, `staff_id`=:staff_id,
        `problem_desc`=:problem, `ticket_sla`=:sla
        WHERE ticket_type_id=:ticket_type_id";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':ticket_type_id', $id);
        $query->bindparam(':ticket_type', $fault_type);
        $query->bindparam(':staff_id', $officer);
        $query->bindparam(':problem', $problem);
        $query->bindparam(':sla', $sla);
        if($query->execute())
        {
            echo"<script>window.location.href = 'add_fault_type.php'</script>";
        }
        else
        {
            $Error = "Upate Ticket Type Function";
            $this->Error($Error);
        }
    }


    // Function that gets Available Ticket Categories


    public function getTicketCategory()
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT it_staff.staff_id, it_staff.full_name, ticket_type.ticket_type_id, ticket_type.ticket_type,ticket_type.problem_desc
        FROM it_staff
        INNER JOIN ticket_type ON it_staff.staff_id = ticket_type.staff_id ORDER BY ticket_type.ticket_type_id DESC";
        return $dbConn->query($sql);
    }


    // Function that gets Available Ticket Categories


    public function ticketAssignment($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT it_staff.staff_id, ticket_type.problem_desc, it_staff.full_name, ticket_type.ticket_type_id, ticket_type.ticket_type,
        ticket_type.ticket_sla FROM ticket_type
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id
        WHERE `ticket_type_id`='$id'";
        return $dbConn->query($sql);
    }

    // Function that gets Total Number Of Ticket


    public function getTotalTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT Count(*)AS Total
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        WHERE ticket_type.staff_id='$id'";
        return $dbConn->query($sql);
    }


    // Function that gets Pending Tickets


    public function getPendingTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT Count(*)AS Pending
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        WHERE ticket_status='Pending' AND ticket_type.staff_id='$id'";
        return $dbConn->query($sql);
    }


    // Function that gets Closed Tickets

    public function getClosedTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT Count(*) AS Closed
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        WHERE ticket_status='Closed' AND ticket_type.staff_id='$id'";
        return $dbConn->query($sql);
    }


    // Function that gets Pending Tickets

    public function getReopenedTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT Count(*) AS Reopened
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        WHERE tickets.ticket_status='Reopened' AND ticket_type.staff_id='$id'";
        return $dbConn->query($sql);
    }



    // Function that gets Over Tickets


    public function OverdueTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT Count(*)AS Overdue
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        WHERE ticket_status='Overdue' AND ticket_type.staff_id='$id'";
        return $dbConn->query($sql);
    }

    // Function that gets Available Ticket Categories


    public function deleteTicketCategory($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "DELETE FROM ticket_type WHERE ticket_type_id='$id'";
        return $dbConn->query($sql);
        echo"<script>window.location.href = 'add_fault_type.php'</script>";
    }


    // Function that Deletes a Ticket


    public function deleteTicket($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "DELETE FROM tickets WHERE ticket_id='$id'";
        return $dbConn->query($sql);
        echo"<script>window.location.href = 'tickets.php'</script>";
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
        WHERE ticket_type.ticket_type_id ='$id'";
        return $dbConn->query($sql);
    }



    // Function that gets a Faulty / IT Officer



    public function getStaffTicket($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT ticket_type.user_id AS staff, users.full_name, ticket_type.ticket_type_id,
        ticket_type.ticket_type FROM users
        INNER JOIN ticket_type ON users.user_id = ticket_type.user_id
        INNER JOIN tickets ON tickets.ticket_type_id = ticket_type.ticket_type_id
        WHERE ticket_type.ticket_type_id ='$id'";
        return $dbConn->query($sql);
    }


    //Function that Re_Assigns Tickets


    public function Re_Assign($ticket_id, $user_id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "UPDATE `ticket_type` SET user_id=:user_id WHERE ticket_id =:ticket_id";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':ticket_id', $ticket_id);
        $query->bindparam(':user_id', $user_id);
        if($query->execute())
        {
            echo"<script>window.location.href = 'add_fault_type.php'</script>";
        }
        else
        {
            $Error = "Ticket Re-Assignment Function";
            $this->Error($Error);
        }

    }



    //Function that Closes Tickets


    public function closeTicket($ticket_id, $action)
    {   $status = "Closed";
        $date_closed = date('D, d M Y H:i:s');
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "UPDATE `tickets` SET `ticket_status`=:ticket_status, `action`=:act_ion, `date_closed`=:date_closed
        WHERE `ticket_id` =:ticket_id";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':ticket_id', $ticket_id);
        $query->bindparam(':ticket_status', $status);
        $query->bindparam(':date_closed', $date_closed);
        $query->bindparam(':act_ion', $action);
        if($query->execute())
        {
            echo"<script>window.location.href='closed.php'</script>";
        }
        else
        {
            $Error = "Close Ticket Function";
            $this->Error($Error);
        }
    }



    //Function that Adds Progressive Comments on a Ticket


    public function addComment($comment_date, $comment, $ticket_id, $person)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "INSERT INTO `comments`(`comment_date`, `comment_desc`, `ticket_id`, `person`)
        VALUES(:comment_date, :comment_desc, :ticket_id, :person)";
        $query = $dbConn->prepare($sql);
        $query->bindparam(':comment_date', $comment_date);
        $query->bindparam(':comment_desc', $comment);
        $query->bindparam(':ticket_id', $ticket_id);
        $query->bindparam(':person', $person);
        if($query->execute())
        {
            echo"<script>window.location.href = 'tickets.php'</script>";
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


    // Function that gets Ticket Closure Report Comment


    public function getStatus($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT * FROM `close_ticket` WHERE ticket_id='$id' LIMIT 1";
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
                WHERE  ticket_type.ticket_sla < $minutes AND tickets.ticket_status='Pending'
                AND NOT tickets.ticket_status='Reopened' AND NOT tickets.ticket_status='Closed'";
                return $dbConn->query($sql);
               
            }
        }
    }



    //Function that gets all my tickets


    public function myOpenTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT users.full_name as name, ticket_type.user_id as staff, users.department, users.job_title, tickets.ticket_id, tickets.ticket_status, tickets.ticket_no, ticket_type.ticket_type, tickets.fault_time
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        INNER JOIN users ON users.user_id = tickets.user_id
        WHERE ticket_type.user_id ='$id' AND NOT tickets.ticket_status='Closed'
        ORDER BY tickets.ticket_id DESC";
        return $dbConn->query($sql);
    }



    //Function that gets all rejected tickets


    public function reopenedTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT users.full_name as name, ticket_type.staff_id, it_staff.full_name as staff,
        users.department, users.job_title, tickets.ticket_id, tickets.ticket_status, tickets.ticket_no, ticket_type.ticket_type,
        tickets.fault_time, ticket_type.ticket_sla, tickets.date_closed 
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        INNER JOIN users ON users.user_id = tickets.user_id
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id
        WHERE  tickets.ticket_status='Reopened' AND ticket_type.staff_id='$id' ORDER BY tickets.ticket_id DESC";
        return $dbConn->query($sql);
    }



    //Function that gets all closed tickets



    public function closedTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT users.full_name as name, ticket_type.staff_id, it_staff.full_name as staff,
        users.department, users.job_title, tickets.ticket_id, tickets.ticket_status, tickets.ticket_no, ticket_type.ticket_type,
        tickets.fault_time, ticket_type.ticket_sla, tickets.date_closed 
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        INNER JOIN users ON users.user_id = tickets.user_id
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id
        WHERE  tickets.ticket_status='Closed' AND ticket_type.staff_id='$id' ORDER BY tickets.ticket_id DESC";
        return $dbConn->query($sql);
    }


    // Function that nabs overdue tickets



    public function getOverdueTickets($id)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT users.full_name as name, ticket_type.staff_id, it_staff.full_name as staff,
        users.department, users.job_title, tickets.ticket_id, tickets.ticket_status, tickets.ticket_no, ticket_type.ticket_type,
        tickets.fault_time, ticket_type.ticket_sla, tickets.date_closed 
        FROM tickets
        INNER JOIN ticket_type ON ticket_type.ticket_type_id = tickets.ticket_type_id
        INNER JOIN users ON users.user_id = tickets.user_id
        INNER JOIN it_staff ON it_staff.staff_id = ticket_type.staff_id
        WHERE  tickets.ticket_status='Overdue' AND ticket_type.staff_id='$id' ORDER BY tickets.ticket_id DESC";
        return $dbConn->query($sql);
    }


}

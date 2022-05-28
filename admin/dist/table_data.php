<?php
session_start();
$from = $_SESSION['start_date'];
$to = $_SESSION['end_date'];

require_once "includes/DBConfig.php";

function getReport($from, $to)
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

$res = getReport($from, $to);
        $html='<table>
        <thead>
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
            </tr>
        </thead>';
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
?>


<?php
header('Content-Type: application/json');
include 'includes/DBConfig.php';

$db = new DBconnection();
$dbConn = $db->getConnection();
$sql = "SELECT Count(*)AS Total,
 Count(CASE WHEN `ticket_status` LIKE '%Closed%' THEN 1 END) AS Closed,
 Count(CASE WHEN `ticket_status` LIKE '%Pending%' THEN 1 END) AS Pending,
 Count(CASE WHEN `ticket_status` LIKE '%Overdue%' THEN 1 END) AS Overdue
  FROM tickets";
$results = $dbConn->query($sql);

$data = array();
foreach($results as $row)
{
    $data[] = $row;
}

print json_encode($data);

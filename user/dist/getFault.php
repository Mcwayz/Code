<?php
include "includes/DBConfig.php";

if (! empty($_POST['fault'])) 
{
    $problem_type = $_POST['fault'];
    $db = new DBconnection();
    $dbConn = $db->getConnection();
    $sql = "SELECT * FROM `ticket_type` WHERE ticket_type = '$problem_type' ORDER BY `ticket_type_id`";
    $result = $dbConn->query($sql);

?>

<option value disabled selected> - Select Problem Summary - </option>

<?php  
    foreach ($result as $problem)
    {
        ?>
        <option value="<?=$problem['ticket_type_id']?>"><?=$problem['problem_desc']?></option>
<?php       
    }

}
?>




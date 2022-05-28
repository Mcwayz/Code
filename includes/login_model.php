<?php
class login_model
{

    //Function that displays an Error Message 
    

    public function Error($func)
    {
        echo"<script>alert('Data Processing Error From The' +$func);</script>";
    }
    // Function that authenticates users

    public function login($email, $user_pass)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT * FROM `users` WHERE email_address = '$email' AND usr_password = '$user_pass' LIMIT 1";
        $query = $dbConn->query($sql);
        if ($query->rowCount() > 0) 
        {
           $result = $query->fetch(PDO::FETCH_ASSOC);
           $_SESSION['user_id'] = $result['user_id'];
           $_SESSION['email'] = $result['email_address'];
           $_SESSION['name'] = $result['full_name'];
           $_SESSION['role'] = $result['role'];
           $_SESSION['user_pass'] = $result['usr_password'];
           $role =  $_SESSION['role'];
            if ($role == 'User')
            {
                echo"<script>window.location.href='user/dist/home.php'</script>";
            }
            else 
            {
                echo "<script>alert('Invalid Username / Password Error');</script>";
            }

        } 
        else 
        {
            
            return $this->staffLogin($email, $user_pass);
        }
    }




    public function staffLogin($email, $user_pass)
    {
        $db = new DBconnection();
        $dbConn = $db->getConnection();
        $sql = "SELECT * FROM `it_staff` WHERE email_address = '$email' AND usr_password = '$user_pass' LIMIT 1";
        $query = $dbConn->query($sql);
        if ($query->rowCount() > 0) 
        {
           $result = $query->fetch(PDO::FETCH_ASSOC);
           $_SESSION['user_id'] = $result['staff_id'];
           $_SESSION['email'] = $result['email_address'];
           $_SESSION['name'] = $result['full_name'];
           $_SESSION['role'] = $result['role'];
           $_SESSION['user_pass'] = $result['usr_password'];
           $role =  $_SESSION['role'];
            if($role == 'Administrator')
            {
                echo"<script>window.location.href='admin/dist/home.php'</script>";
            }
            elseif ($role == 'Super User')
            {
                echo"<script>window.location.href='superuser/dist/home.php'</script>";
            }
        } 
        else 
        {
            echo "<script>alert('Invalid Username / Password Error');</script>";
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
            echo"<script>window.location.href = 'index.php'</script>";
        }
        else
        {
            $Error = "User Registration Function (Login Model)";
            $this->Error($Error);
        }
    }
}

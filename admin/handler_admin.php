<?php
$req=$_GET['req'] ?? null;
switch($req)
{
    case 'logout':
        session_destroy();
        echo "<script>location.href='login_admin.php'</script>";
        break;
    case 'bank_approve':
        require 'database.php';
        require 'admin_user.php';
        $db=new database();
        $admin=new admin($db->connect());
        $admin->token=$_GET['token'];
        echo $admin->approve_plasma_bank();
        break;
    case 'bank_reject':
            require 'database.php';
            require 'admin_user.php';
            $db=new database();
            $admin=new admin($db->connect());
            $admin->token=$_GET['token'];
            echo $admin->sendRejectMessage_organizationaluser();
            break;
    case 'donar_approve':
        require 'database.php';
        $db=new database();
        $conn=$db->connect();
        $token=$_GET['token'];
        $sql="UPDATE donar_requests SET request_status=1 WHERE token='$token';";
        mysqli_query($conn,$sql);
        echo'<script>alert("Donar status updated.")</script>';
        echo "<script>location.href='donar_request.php'</script>";
        break;
    case 'donar_id_reject':
        require 'database.php';
        require 'admin_user.php';
        $db=new database();
        $admin=new admin($db->connect());
        $admin->token=$_GET['token'];
        echo $admin->sendRejectMessage_donarid();
        break;
    case 'donar_noteligible_reject':
            require 'database.php';
            require 'admin_user.php';
            $db=new database();
            $admin=new admin($db->connect());
            $admin->token=$_GET['token'];
            echo $admin->sendRejectMessage_donarineligible();
            break;
    case 'receiver_approve':
        require 'database.php';
        $db=new database();
        $conn=$db->connect();
        $token=$_GET['token'];
        $sql="UPDATE receiver_requests SET request_status=1 WHERE token='$token';";
        mysqli_query($conn,$sql);
        echo'<script>alert("Receiver status updated.")</script>';
        echo "<script>location.href='receiver_request.php'</script>";
        break;
    case 'receiver_reject':
        require 'database.php';
            require 'admin_user.php';
            $db=new database();
            $admin=new admin($db->connect());
            $admin->token=$_GET['token'];
            echo $admin->sendRejectMessage_receiver();
        break;
    case 'delete_user':
            require 'database.php';
            require 'admin_user.php';
            $db=new database();
            $admin=new admin($db->connect());
            $admin->token=$_GET['token'];
            echo $admin->delete_user();
        break;
    case 'delete_bankuser':
            require 'database.php';
            require 'admin_user.php';
            $db=new database();
            $admin=new admin($db->connect());
            $admin->token=$_GET['token'];
            echo $admin->delete_bank();
        break;
    default:
        echo'<script>alert("Invalid request!")</script>';
        echo "<script>location.href='login_admin.php'</script>";
        break;
}
?>

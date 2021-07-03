<?php
$req=$_GET['req'] ?? null;
switch($req)
{
    case 'logout':
        session_destroy();
        echo "<script>location.href='../index.php'</script>";
        break;
    case 'allot_donar':
        require 'database.php';
        require 'user_org.php';
        $db=new database();
        $user=new user_org($db->connect());
        $user->donar_token=$_GET['token'];
        $user->date=$_POST['date'];
        $user->time=$_POST['time'];
        echo $user->allot_donar();
        break;
    case 'allot_receiver':
            require 'database.php';
            require 'user_org.php';
            $db=new database();
            $user=new user_org($db->connect());
            $user->receiver_token=$_GET['token'];
            $user->date=$_POST['date'];
            $user->time=$_POST['time'];
            echo $user->allot_receiver();
            break;
    case 'delete_account':
                require 'database.php';
                    require 'user_org.php';
                    $db=new database();
                    $user= new user_org($db->connect());
                    $user->token=$_GET['token'];
                    echo $user->delete_account();
            break;
    case 'forgot_pass':
        session_destroy();
        echo "<script>location.href='../forgot_password.php'</script>";
        break;
    default:
        echo'<script>alert("Invalid request!")</script>';
        echo "<script>location.href='home.php'</script>";
        break;
}

?>
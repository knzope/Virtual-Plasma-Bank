<?php
$req=$_GET['req'] ?? null;
switch($req)
{
    case 'logout':
        session_destroy();
        echo "<script>location.href='../index.php'</script>";
        break;
    case 'forgot_pass':
            session_destroy();
            echo "<script>location.href='../forgot_password.php'</script>";
            break;
    case 'delete_account':
        require 'database.php';
            require 'user_ind.php';
            $db=new database();
            $user= new user_ind($db->connect());
            $user->token=$_GET['token'];
            echo $user->delete_account();
    break;
    // case 'update':
    //     update($_POST);
    // break;
    default:
        echo'<script>alert("Invalid request!")</script>';
        echo "<script>location.href='home.php'</script>";
        break;
}
// function update($form)
// {
//     require 'database.php';
//     require 'user_ind.php';
//     $db=new database();
//     $user= new user_ind($db->connect());
//     $user->fname=$form['fname'];
//     $user->lname=$form['lname'];
//     $user->age=$form['age'];
//     $user->gender=$form['gender'];
//     $user->adl1=$form['address1'];
//     $user->adl2=$form['address2'];
//     $user->city=$form['addressCity'];
//     $user->state=$form['addressState'];
//     $user->pin=$form['addressPIN'];
//     echo $user->update_ind();
// }
?>
<?php
// header("Content-Type: application/json; charset=UTF-8");

$req=$_GET['req'] ?? null;

switch($req)
{
    // case 'reg_ind_user':
    //     get_ind_detail($_POST);
    //     break;
    // case 'oragnizational_user':
    //     get_org_detail($_POST);
    //     break;
    case 'verify_ind':
        require 'database.php';
        require 'user.php';
        $db=new database();
        $user= new user($db->connect());
        $user->token=$_GET['token'];
        echo $user->verifyToken_individualuser();
        break;
    case 'verify_org':
            require 'database.php';
            require 'user.php';
            $db=new database();
            $user= new user($db->connect());
            $user->token=$_GET['token'];
            echo $user->verifyToken_organizationaluser();
            break;
    // case 'login':
    //     require 'database.php';
    //     require 'user.php';
    //     $db=new database();
    //     $user= new user($db->connect());
    //     $user->email=$_POST['email'];
    //     $user->password=$_POST['pass'];
    //     $user->usertype=$_POST['usertype'];
    //     if($user->usertype=='individual')
    //     {
    //         echo $user->login_individual_user();
    //     }
    //     else
    //     {
    //         echo $user->login_organizational_user();
    //     }
    //     break;
    // case 'forgot_pass':
    //     require 'database.php';
    //     require 'user.php';
    //     $db=new database();
    //     $user= new user($db->connect());
    //     $user->email=$_POST['email'];
    //     $user->usertype=$_POST['usertype'];
    //     if($user->usertype=='individual')
    //     {
    //         echo $user->forgot_pass_individual_user_link();
    //     }
    //     else{
    //         echo $user->forgot_pass_organizational_user_link();
    //     }
    //     break;
    case 'forgot_pass_ind':
        require 'database.php';
        require 'user.php';
        $db=new database();
        $user= new user($db->connect());
        $user->token=$_GET['token'];
        session_start();
        $_SESSION['token']=$user->token;
        echo "<script>location.href='change_pass_ind.php?token=$user->token'</script>";
        break;
    // case 'change_pass_ind':
    //     require 'database.php';
    //     require 'user.php';
    //     $db=new database();
    //     $user= new user($db->connect());
    //     $user->pass=$_POST['pass'];
    //     $user->repass=$_POST['repass'];
    //     $user->token=$_GET['token'];
    //     if($user->pass==$user->repass)
    //     {
    //         echo $user->change_pass_individual();
    //     }  
    //     else
    //     {
    //         echo'<script>alert("Reentered password do not match")</script>';
    //         echo "<script>location.href='change_pass_ind.php?token=$user->token'</script>";
    //     }
    //     break;
    case 'forgot_pass_org':
            require 'database.php';
            require 'user.php';
            $db=new database();
            $user= new user($db->connect());
            $user->token=$_GET['token'];
            session_start();
            $_SESSION['token']=$user->token;
            echo "<script>location.href='change_pass_org.php?token=$user->token'</script>";
            break;
    // case 'change_pass_org':
    //         require 'database.php';
    //         require 'user.php';
    //         $db=new database();
    //         $user= new user($db->connect());
    //         $user->pass=$_POST['pass'];
    //         $user->repass=$_POST['repass'];
    //         $user->token=$_GET['token'];
    //         if($user->pass==$user->repass)
    //         {
    //             echo $user->change_pass_organizational();
    //         }  
    //         else
    //         {
    //             echo'<script>alert("Reentered password do not match")</script>';
    //             echo "<script>location.href='change_pass_org.php?token=$user->token'</script>";
    //         }
    //         break;
    default:
        echo'<script>alert("Invalid request!")</script>';
        echo "<script>location.href='index.php'</script>";
        break;
}
// function get_org_detail($form)
// {
    
//     require 'database.php';
//     require 'user.php';
//     $db=new database();
//     $user= new user($db->connect());
//     $user->email=$form['email'];
//     $user->pbname=$form['pbname'];
//     $user->password=$form['pass'];
//     $user->repassword=$form['repass'];
//     $user->adl1=$form['address1'];
//     $user->adl2=$form['address2'];
//     $user->city=$form['addressCity'];
//     $user->state=$form['addressState'];
//     $user->pin=$form['addressPIN'];
//     $user->file=$_FILES['file'];

//         $user->fileName=$_FILES['file']['name'];
//         $user->fileTmpName=$_FILES['file']['tmp_name'];
//         $user->fileSize=$_FILES['file']['size'];
//         $user->fileError=$_FILES['file']['error'];
//         $user->fileType=$_FILES['file']['type'];
        
//         if($user->fileError===0){
            
//             echo $user->register_organizational_user();
//         }else{
//             echo'<script>alert("There was an error uploading your file!")</script>';
//             echo "<script>location.href='registration_organization.php'</script>";
//         }
// }
// function get_ind_detail($form)
// {
//     require 'database.php';
//     require 'user.php';
//     $db=new database();
//     $user= new user($db->connect());
//     $user->fname=$form['fname'];
//     $user->lname=$form['lname'];
//     $user->age=$form['age'];
//     $user->gender=$form['gender'];
//     $user->email=$form['email'];
//     $user->password=$form['pass'];
//     $user->repassword=$form['repass'];
//     $user->adl1=$form['address1'];
//     $user->adl2=$form['address2'];
//     $user->city=$form['addressCity'];
//     $user->state=$form['addressState'];
//     $user->pin=$form['addressPIN'];
//     if($user->password!=$user->repassword)
//     {
//         echo'<script>alert("Re-entered password do not match.")</script>';
//         echo "<script>location.href='registration_individual.php'</script>";
//     }
//     else{
//         echo $user->register_individual_user();
//     }
    
// }
?>
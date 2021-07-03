<?php
class admin{
    public $username;
    public $password;
   
    private $conn;

    public function __construct($conn)
    {
        $this->conn=$conn;
        
    }
    public function admin_login()
    {
        $sql="SELECT * FROM admin_detail WHERE username='$this->username';";
        $result=mysqli_query($this->conn,$sql);
        if($result==true)
        {   
            if(mysqli_num_rows($result)>0)
            {
                $row=mysqli_fetch_assoc($result);
                if($this->password==$row['password'])
                {
                    session_start();
                    $_SESSION['username']=$this->username;
                    echo'<script>alert("Login Successfull.")</script>';
                    echo "<script>location.href='plasma_bank_request.php'</script>";
                }
                else{
                    echo'<script>alert("Password do not match.")</script>';
                    echo "<script>location.href='login_admin.php'</script>";
                }
            }
            else{
                echo'<script>alert("Username not found.")</script>';
                echo "<script>location.href='login_admin.php'</script>";
            }
        }
        else{
            echo'<script>alert("Error occurred while login. Please try again later.")</script>';
                echo "<script>location.href='login_admin.php'</script>";
        }
    }
    public function approve_plasma_bank()
    {
        $sql="UPDATE organizational_user SET approval_status=1 WHERE initialtoken='$this->token';";
        $result=mysqli_query($this->conn,$sql);
        if($result==true)
        {
            $this->sendApprovalMessage_organizationaluser();
            echo'<script>alert("Bank approved.")</script>';
                echo "<script>location.href='plasma_bank_request.php'</script>";
        }
        else{
            echo'<script>alert("Error occurred while approving bank. Please try again later.")</script>';
                echo "<script>location.href='plasma_bank_request.php'</script>";
        }
    }
    public function sendApprovalMessage_organizationaluser() {

        
        $sql1="SELECT * FROM organizational_user WHERE initialtoken='$this->token';";
        $result1=mysqli_query($this->conn,$sql1);
        if($result1==true)
        {
            if(mysqli_num_rows($result1)>0)
            {
                $row1=mysqli_fetch_assoc($result1);
                $subject = "Welcome to Virtual Plasma Bank";
                $content = "Dear {$row1[pbname]}<br><br>
                Your Plasma bank is approved.<br>
                Now you can login to your account.<br>";
                
        
                require 'email/mailer.php';
                Mailer::sendMail($row1['email'], $subject, $content);
                
            }
            
        }
        

    }
    public function sendRejectMessage_organizationaluser() {

        
        $sql1="SELECT * FROM organizational_user WHERE initialtoken='$this->token';";
        $result1=mysqli_query($this->conn,$sql1);
        if($result1==true)
        {
            if(mysqli_num_rows($result1)>0)
            {
                $row1=mysqli_fetch_assoc($result1);
                $subject = "Sorry";
                $content = "Dear $row1[pbname]<br><br>
                Your Plasma bank is not approved.<br>
                You have submitted the document which does not indicate the approval from State territory licensing authority.<br>
                You can register again with correct document.";
                
        
                require 'email/mailer.php';
                Mailer::sendMail($row1['email'], $subject, $content);
                $file="../organization/Approval_plasma_bank_upload/$row1[approvalfile]";
                unlink($file);
                $sql2="DELETE FROM organizational_user WHERE initialtoken='$this->token';";
                mysqli_query($this->conn,$sql2);
                
                echo "<script>location.href='plasma_bank_request.php'</script>";
            }
            
        }
        

    }

    public function sendRejectMessage_donarid() {

        
        $sql1="SELECT * FROM donar_requests WHERE token='$this->token';";
        $result1=mysqli_query($this->conn,$sql1);
        if($result1==true)
        {
            if(mysqli_num_rows($result1)>0)
            {
                $row1=mysqli_fetch_assoc($result1);
                $subject = "Sorry";
                $content = "Dear $row1[donar_name]<br><br>
                Your application has been rejected by the admin.<br>
                Document you submitted does not prove your identity.<br>
                You can reapply by uploading valid proof.";
                
        
                require 'email/mailer.php';
                Mailer::sendMail($row1['user_email'], $subject, $content);
                $file="../individual/donar_aadhar_PAN_card/$row1[donar_proof]";
                unlink($file);
                $sql2="DELETE FROM donar_requests WHERE token='$this->token';";
                mysqli_query($this->conn,$sql2);
                
                echo "<script>location.href='donar_request.php'</script>";
            }
            
        }
        

    }
    public function sendRejectMessage_donarineligible() {

        
        $sql1="SELECT * FROM donar_requests WHERE token='$this->token';";
        $result1=mysqli_query($this->conn,$sql1);
        if($result1==true)
        {
            if(mysqli_num_rows($result1)>0)
            {
                $row1=mysqli_fetch_assoc($result1);
                $subject = "Sorry";
                $content = "Dear $row1[donar_name]<br><br>
                Your application has been rejected by the admin.<br>
                Document you submitted does not prove your identity.<br>
                You can reapply by uploading valid proof.";
                
        
                require 'email/mailer.php';
                Mailer::sendMail($row1['user_email'], $subject, $content);
                $file="../individual/donar_aadhar_PAN_card/$row1[donar_proof]";
                unlink($file);
                $sql2="DELETE FROM donar_requests WHERE token='$this->token';";
                mysqli_query($this->conn,$sql2);
                
                echo "<script>location.href='donar_request.php'</script>";
            }
            
        }
        

    }
    public function sendRejectMessage_receiver() {

        
        $sql1="SELECT * FROM receiver_requests WHERE token='$this->token';";
        $result1=mysqli_query($this->conn,$sql1);
        if($result1==true)
        {
            if(mysqli_num_rows($result1)>0)
            {
                $row1=mysqli_fetch_assoc($result1);
                $subject = "Sorry";
                $content = "Dear $row1[receiver_name]<br><br>
                Your application has been rejected by the admin.<br>
                Document you submitted does not prove your identity.<br>
                You can reapply by uploading valid proof.";
                
        
                require 'email/mailer.php';
                Mailer::sendMail($row1['user_email'], $subject, $content);
                $file="../individual/receiver_aadhar_PAN_card/$row1[receiver_proof]";
                unlink($file);
                $sql2="DELETE FROM receiver_requests WHERE token='$this->token';";
                mysqli_query($this->conn,$sql2);
                
                echo "<script>location.href='receiver_request.php'</script>";
            }
            
        }
        

    }
    public function delete_user()
    {
        $sql="SELECT * FROM individual_user where initialtoken='$this->token';";
        $result=mysqli_query($this->conn,$sql);
        if($result==true)
        {
            $row=mysqli_fetch_assoc($result);
            $sql1="SELECT * FROM donar_requests where user_email='$row[email]';";
            $result1=mysqli_query($this->conn,$sql1);
            if($result1==true)
            {
                if(mysqli_num_rows($result1)>0)
                {
                    while($row1=mysqli_fetch_assoc($result1))
                    {
                        $sql2="DELETE FROM donar_appointments where donar_id='$row1[donar_id]';";
                        mysqli_query($this->conn,$sql2);
                        $file="../individual/donar_aadhar_PAN_card/$row1[donar_proof]";
                        unlink($file);
                    }
                    $sql3="DELETE FROM donar_requests where user_email='$row[email]';";
                    mysqli_query($this->conn,$sql3);
                }
            }
            $sql4="SELECT * FROM receiver_requests where user_email='$row[email]';";
            $result4=mysqli_query($this->conn,$sql4);
            if($result4==true)
            {
                if(mysqli_num_rows($result4)>0)
                {
                    while($row4=mysqli_fetch_assoc($result4))
                    {
                        $sql5="DELETE FROM receiver_appointments where receiver_id='$row4[receiver_id]';";
                        mysqli_query($this->conn,$sql5);
                        $file="../individual/receiver_aadhar_PAN_card/$row4[receiver_proof]";
                        unlink($file);
                    }
                    $sql6="DELETE FROM receiver_requests where user_email='$row[email]';";
                    mysqli_query($this->conn,$sql6);
                }
            }
            
            $subject = "Account Deleted";
                $content = "Your account is deleted by admin.<br>
                Based on your activity it is observed that you are misusing your account.<br>
                All the details regarding your appointments and data will be deleted and in fuure you will be allowed to register.";
                
        
                require 'email/mailer.php';
                Mailer::sendMail($row['email'], $subject, $content);
                $sql8="INSERT into blacklist(email) VALUES('$row[email]');";
                mysqli_query($this->conn,$sql8);
                $sql7="DELETE FROM individual_user where initialtoken='$this->token';";
                mysqli_query($this->conn,$sql7);
                echo "<script>location.href='search_users.php'</script>";
        }
        else
        {
            echo'<script>alert("Error occured. Please try again later.")</script>';
            echo "<script>location.href='user_page.php?token=$this->token'</script>";
        }
    }

    public function delete_bank()
    {
        require 'email/mailer.php';
        $sql="SELECT * FROM organizational_user where initialtoken='$this->token';";
        $result=mysqli_query($this->conn,$sql);
        if($result==true)
        {
            $row=mysqli_fetch_assoc($result);
            $sql1="SELECT * FROM donar_appointments where bank_email='$row[email]';";
            $result1=mysqli_query($this->conn,$sql1);
            if($result1==true)
            {
                if(mysqli_num_rows($result1)>0)
                {
                    while($row1=mysqli_fetch_assoc($result1))
                    {
                        $sql2="UPDATE donar_requests SET allotment_status=0 where donar_id='$row1[donar_id]';";
                        mysqli_query($this->conn,$sql2);
                        $sql22="SELECT * FROM donar_requests where donar_id='$row1[donar_id]';";
                        $result22=mysqli_query($this->conn,$sql22);
                        $row22=mysqli_fetch_assoc($result22);
                        $subject = "Application Status";
                            $content = "The plasma bank which alloted you the appointment timing is deleted by the admin.<br>
                            You will receive the another appointment confirmation mail from some other bank.<br>
                            Please sorry for the inconvenience";
                    
                            
                            Mailer::sendMail($row22['user_email'], $subject, $content);
                    }
                    $sql3="DELETE FROM donar_appointments where bank_email='$row[email]';";
                    mysqli_query($this->conn,$sql3);
                }
            }
            $sql4="SELECT * FROM receiver_appointments where bank_email='$row[email]';";
            $result4=mysqli_query($this->conn,$sql4);
            if($result4==true)
            {
                if(mysqli_num_rows($result4)>0)
                {
                    while($row4=mysqli_fetch_assoc($result4))
                    {
                        $sql5="UPDATE receiver_requests SET allotment_status=0 where receiver_id='$row4[receiver_id]';";
                        mysqli_query($this->conn,$sql5);
                        
                        $sql55="SELECT * FROM receiver_requests where receiver_id='$row4[receiver_id]';";
                        $result55=mysqli_query($this->conn,$sql55);
                        $row55=mysqli_fetch_assoc($result55);
                        $subject = "Application Status";
                            $content = "The plasma bank which alloted you the appointment timing is deleted by the admin.<br>
                            You will receive the another appointment confirmation mail from some other bank.<br>
                            Please sorry for the inconvenience";
                    
                            
                            Mailer::sendMail($row55['user_email'], $subject, $content);
                    }
                    $sql6="DELETE FROM receiver_appointments where bank_email='$row[email]';";
                    mysqli_query($this->conn,$sql6);
                }
            }
            
            $subject = "Account Deleted";
                $content = "Your account is deleted by admin.<br>
                Based on your activity it is observed that you are misusing your account.<br>
                All the details regarding your appointments and data will be deleted and in future you will be allowed to register.";
                
        
                
                Mailer::sendMail($row['email'], $subject, $content);
                $sql8="INSERT into blacklist(email) VALUES('$row[email]');";
                mysqli_query($this->conn,$sql8);
                $file="../organization/Approval_plasma_bank_upload/$row[approvalfile]";
                unlink($file);
                $sql7="DELETE FROM organizational_user where initialtoken='$this->token';";
                mysqli_query($this->conn,$sql7);
                echo "<script>location.href='search_plasmabank.php'</script>";
        }
        else
        {
            echo'<script>alert("Error occured. Please try again later.")</script>';
            echo "<script>location.href='plasmabank_page.php?token=$this->token'</script>";
        }
    }
}
?>
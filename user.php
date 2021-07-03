<?php
class user{
    public $fname;
    public $lname;
    public $age;
    public $gender;
    public $mail;
    public $password;
    public $addressline1;
    public $addressline2;
    public $city;
    public $state;
    public $pincode;
    public $checktoken;
    public $initialtoken;
    

    private $conn;

    public function __construct($conn)
    {
        $this->conn=$conn;
        
    }
    public function register_individual_user()
    {
        $this->checktoken=$this->getToken($this->email);
        $this->initialtoken=$this->checktoken;
        $sql="INSERT INTO individual_user (fname,lname,age,gender,email,phone,password,addressline1,addressline2,city,state,pincode,checkedtoken,initialtoken) VALUES('$this->fname','$this->lname','$this->age','$this->gender','$this->email','$this->phone','$this->password','$this->adl1','$this->adl2','$this->city','$this->state','$this->pincode','$this->checktoken','$this->initialtoken');";
        $result=mysqli_query($this->conn,$sql);
            if($result==TRUE)
            {
                $this->sendVerificationToken_individualuser();
                echo'<script>alert("Registered Successfully.")</script>';
                echo "<script>location.href='login.php'</script>";
            }
            else
            {
                echo'<script>alert("Error occurred while submitting information. Please try again later.")</script>';
                echo "<script>location.href='registration_individual.php'</script>";
            }
            
            
    }
    public function register_organizational_user()
    {
            $this->fileExt=explode('.',$this->fileName);
            $this->fileActualExt=strtolower(end($this->fileExt));

            $this->allowed=array('jpg','jpeg','png');

            if(in_array($this->fileActualExt,$this->allowed)){
                if($this->fileError===0){
                    if($this->fileSize<1000000){
                        $this->newfileid=$this->gettoken($this->email);
                        $this->fileNameNew=$this->newfileid.".".$this->fileActualExt;
                        $this->filesDestination='organization/Approval_plasma_bank_upload/'.$this->fileNameNew;
                        move_uploaded_file($this->fileTmpName,$this->filesDestination);
                            $this->checktoken=$this->getToken($this->email);
                            $this->initialtoken=$this->checktoken;
                            $this->sendVerificationToken_organizationaluser();
                            $sql1="INSERT INTO organizational_user(pbname,email,phone,password,addressline1,addressline2,city,state,pincode,approvalfile,checkedtoken,initialtoken,approval_status) VALUES('$this->pbname','$this->email','$this->phone','$this->password','$this->adl1','$this->adl2','$this->city','$this->state','$this->pin','$this->fileNameNew','$this->checktoken','$this->initialtoken',0);";
                            $result=mysqli_query($this->conn,$sql1);
                            if($result==TRUE)
                            {
                                echo'<script>alert("Successfully registered")</script>';
                                echo "<script>location.href='login.php'</script>";
                            }
                            else{
                                echo'<script>alert("Error occured while registering. Please try again later")</script>';
                                echo "<script>location.href='registration_organization.php'</script>";
                            }
                            

                    }else{
                        echo'<script>alert("Your file is two big!")</script>';
                        echo "<script>location.href='registration_organization.php'</script>";
                    }
                }else{
                    echo'<script>alert("There was an error uploading your file!")</script>';
                    echo "<script>location.href='registration_organization.php'</script>";
                }
            }else{
                echo'<script>alert("You cannot upload files of this type!")</script>';
                echo "<script>location.href='registration_organization.php'</script>";
            }
    }
    

    public function sendVerificationToken_individualuser() {

        $subject = "Verification link";
        $url = "http://localhost/wtproject/handler_reg_login.php?req=verify_ind&token=".$this->checktoken;
        $content = "Dear {$this->fname}<br><br>
        This is a verification email to verify your email id.<br>
        Click on the link to complete the registration process.<br><br>
        <a href='$url'>$url</a>";

        require 'email/mailer.php';
        Mailer::sendMail($this->email, $subject, $content);

    }
    public function verifyToken_individualuser() {
        $sql = "SELECT * from individual_user where checkedtoken='$this->token';";
        $result=mysqli_query($this->conn,$sql);
            if($result==TRUE)
            {
                if(mysqli_num_rows($result)>0)
                {
                    $row=mysqli_fetch_assoc($result);
                    $this->token=$this->getToken($row['password']);
                    $sql1="UPDATE individual_user SET checkedtoken='$this->token' WHERE email='$row[email]';";
                    $result1=mysqli_query($this->conn,$sql1);
                    if($result1==true)
                    {
                        echo'<script>alert("Account verified.")</script>';
                        echo "<script>location.href='login.php'</script>";
                    }
                    else
                    {
                        echo'<script>alert("Error occured. Please try again.")</script>';
                        echo "<script>location.href='index.php'</script>";
                    }
                }
                else{
                    echo'<script>alert("Error occured. Please try again.")</script>';
                    echo "<script>location.href='index.php'</script>";
                }
            }
            else
            {
                echo'<script>alert("Error occurred. Please try again later.")</script>';
                echo "<script>location.href='index.php'</script>";
            }
    }
    public function sendVerificationToken_organizationaluser() {

        $subject = "Verification link";
        $url = "http://localhost/wtproject/handler_reg_login.php?req=verify_org&token=".$this->checktoken;
        $content = "Dear {$this->pbname}<br><br>
        This is a verification email to verify your email id.<br>
        Click on the link to complete the registration process.<br><br>
        <a href='$url'>$url</a>";

        require 'email/mailer.php';
        Mailer::sendMail($this->email, $subject, $content);

    }
    public function verifyToken_organizationaluser() {
        $sql = "SELECT * from organizational_user where checkedtoken='$this->token';";
        $result=mysqli_query($this->conn,$sql);
            if($result==TRUE)
            {
                if(mysqli_num_rows($result)>0)
                {
                    $row=mysqli_fetch_assoc($result);
                    $this->token=$this->getToken($row['password']);
                    $sql1="UPDATE organizational_user SET checkedtoken='$this->token' WHERE email='$row[email]';";
                    $result1=mysqli_query($this->conn,$sql1);
                    if($result1==true)
                    {
                        echo'<script>alert("Account verified.")</script>';
                        echo "<script>location.href='login.php'</script>";
                    }
                    else
                    {
                        echo'<script>alert("Error occured. Please try again.")</script>';
                        echo "<script>location.href='index.php'</script>";
                    }
                }
                else{
                    echo'<script>alert("Error occured. Please try again.")</script>';
                    echo "<script>location.href='index.php'</script>";
                }
            }
            else
            {
                echo'<script>alert("Error occurred. Please try again later.")</script>';
                echo "<script>location.href='index.php'</script>";
            }
    }
    public function login_individual_user()
    {
        $sql="SELECT * FROM individual_user WHERE email='$this->email';";
        $result=mysqli_query($this->conn,$sql);
        if($result==true)
        {
           
            if(mysqli_num_rows($result)>0)
            {
                $row=mysqli_fetch_assoc($result);
                if($this->password==$row['password'])
                {
                    if($row['checkedtoken']==$row['initialtoken'])
                    {
                        echo'<script>alert("Your email is not verified. Verification link has been sent to your email. Please verify you email and then try login.")</script>';
                        echo "<script>location.href='index.php'</script>";
                    }
                    else
                    {
                        session_start();
                        $_SESSION['email']=$this->email;
                        echo'<script>alert("Login successfull.")</script>';
                        echo "<script>location.href='individual/home.php'</script>";
                    }
                   
                }
                else
                {
                    echo'<script>alert("Incorrect Password.")</script>';
                    echo "<script>location.href='login.php'</script>";
                }
                
            }
            else
            {
                echo'<script>alert("Email not registered.")</script>';
                echo "<script>location.href='registration_individual.php'</script>";
            }
        }
        else{
            echo'<script>alert("Error occurred. Please try again later.")</script>';
                echo "<script>location.href='index.php'</script>";
        }


    }
    public function login_organizational_user()
    {
        $sql="SELECT * FROM organizational_user WHERE email='$this->email';";
        $result=mysqli_query($this->conn,$sql);
        if($result==true)
        {
            if(mysqli_num_rows($result)>0)
            {
                $row=mysqli_fetch_assoc($result);
                if($this->password==$row['password'])
                {
                    if($row['checkedtoken']==$row['initialtoken'])
                    {
                        echo'<script>alert("Your email is not verified. Verification link has been sent to your email. Please verify you email and then try login.")</script>';
                        echo "<script>location.href='index.php'</script>";
                    }
                    else
                    {
                        if($row['approval_status']==0)
                        {
                            echo'<script>alert("Your plasma bank is not approved yet. Wait till you receive approval message from us.")</script>';
                            echo "<script>location.href='index.php'</script>";
                        }
                        else
                        {
                            session_start();
                            $_SESSION['email']=$this->email;
            
                            echo'<script>alert("Login successfull.")</script>';
                            echo "<script>location.href='organization/home.php'</script>";
                        }
                        
                    }
                }
                else{
                    echo'<script>alert("Incorrect Password.")</script>';
                    echo "<script>location.href='login.php'</script>";
                }
                
            }
            else
            {
                echo'<script>alert("Email not registered.")</script>';
                echo "<script>location.href='registration_organization.php'</script>";
            }
        }
        else{
            echo'<script>alert("Error occurred. Please try again later.")</script>';
                echo "<script>location.href='index.php'</script>";
        }


    }
    public function forgot_pass_individual_user_link()
    {   
        $sql="SELECT * FROM individual_user where email='$this->email';";
        $result=mysqli_query($this->conn,$sql);
        if($result==true)
        {
            if(mysqli_num_rows($result)>0)
            {
                $row=mysqli_fetch_assoc($result);
                if($row['checkedtoken']==$row['initialtoken'])
                {
                    echo'<script>alert("Your email is not verified. Verification link has been sent to your email. Verify your email and then change password.")</script>';
                    echo "<script>location.href='login.php'</script>";
                }
                else
                {
                    $subject = "Link to change password";
                    $url = "http://localhost/wtproject/handler_reg_login.php?req=forgot_pass_ind&token=".$row['initialtoken'];
                    $content = "Dear {$row[fname]}<br><br>
                    This is a link to change your password.<br>
                    Click on the link to complete the registration process.<br><br>
                    <a href='$url'>$url</a>";
    
                    require 'email/mailer.php';
                    Mailer::sendMail($this->email, $subject, $content);
                    echo'<script>alert("Link to change password is sent to your email.")</script>';
                    echo "<script>location.href='login.php'</script>";
                }
                
            }
            else{
                echo'<script>alert("Email is not registered. Check your email.")</script>';
                echo "<script>location.href='index.php'</script>";
            }
        }
        else
        {
                echo'<script>alert("Error occurred. Please try again later.")</script>';
                echo "<script>location.href='index.php'</script>";
        }
        
    }
    public function change_pass_individual()
    {
        session_start();
        $sql="UPDATE individual_user SET password='$this->pass' WHERE initialtoken='$_SESSION[token]';";
        $result=mysqli_query($this->conn,$sql);
        if($result==true)
        {
            session_destroy();
            echo'<script>alert("Password changed successfully.")</script>';
            echo "<script>location.href='login.php'</script>";
        }
        else{
            echo'<script>alert("Error occurred. Please try again.")</script>';
            echo "<script>location.href='change_pass_ind.php?token=$this->token'</script>";
        }
    }
    public function forgot_pass_organizational_user_link()
    {
        $sql="SELECT * FROM organizational_user where email='$this->email';";
        $result=mysqli_query($this->conn,$sql);
        if($result==true)
        {
            if(mysqli_num_rows($result)>0)
            {
                $row=mysqli_fetch_assoc($result);
                if($row['checkedtoken']==$row['initialtoken'])
                {
                    echo'<script>alert("Your email is not verified. Verification link has been sent to your email. Verify your email and then change password.")</script>';
                    echo "<script>location.href='login.php'</script>";
                }
                else
                {
                    $subject = "Link to change password";
                    $url = "http://localhost/wtproject/handler_reg_login.php?req=forgot_pass_org&token=".$row['initialtoken'];
                    $content = "Dear {$row[pbname]}<br><br>
                    This is a link to change your password.<br>
                    Click on the link to complete the registration process.<br><br>
                    <a href='$url'>$url</a>";
    
                    require 'email/mailer.php';
                    Mailer::sendMail($this->email, $subject, $content);
                    echo'<script>alert("Link to change password is sent to your email.")</script>';
                    echo "<script>location.href='login.php'</script>";
                }
                
            }
            else{
                echo'<script>alert("Email is not registered. Check your email.")</script>';
                echo "<script>location.href='index.php'</script>";
            }
        }
        else
        {
                echo'<script>alert("Error occurred. Please try again later.")</script>';
                echo "<script>location.href='index.php'</script>";
        }
    }
    public function change_pass_organizational()
    {
        session_start();
        $sql="UPDATE organizational_user SET password='$this->pass' WHERE initialtoken='$_SESSION[token]';";
        $result=mysqli_query($this->conn,$sql);
        if($result==true)
        {
            session_destroy();
            echo'<script>alert("Password changed successfully.")</script>';
            echo "<script>location.href='login.php'</script>";
        }
        else{
            echo'<script>alert("Error occurred. Please try again.")</script>';
            echo "<script>location.href='change_pass_org.php?token=$this->token'</script>";
        }
    }
    public static function getToken($hash=null) {
        return sha1( $hash ?? date('ymdhi') );
    }
    
      
}
?>
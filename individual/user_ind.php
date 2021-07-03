<?php
class user_ind{
    public $fname;
    public $lname;
    public $age;
    public $gender;
    public $email;
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
    public function update_ind()
    {
        session_start();
        $this->email=$_SESSION['email'];
        $sql="UPDATE individual_user SET fname='$this->fname', lname='$this->lname', age='$this->age', gender='$this->gender', phone='$this->phone',addressline1='$this->adl1', addressline2='$this->adl2', city='$this->city', state='$this->state', pincode='$this->pin' WHERE email='$this->email';";
        $result=mysqli_query($this->conn,$sql);
        if($result==true)
        {
            echo'<script>alert("Successfully updated details.")</script>';
            echo "<script>location.href='profile_ind.php'</script>";
        }
        else{
            echo'<script>alert("Error occured while updating information. Please try again later.")</script>';
            echo "<script>location.href='profile_ind.php'</script>";
        }
    }
    public function donate_plasma()
    {
        session_start();
        $this->email=$_SESSION['email'];
        $sql="SELECT * FROM individual_user where email='$this->email';";
        $result=mysqli_query($this->conn,$sql);
        if($result==true)
        {
            $row=mysqli_fetch_assoc($result);
            $this->fileExt=explode('.',$this->fileName);
            $this->fileActualExt=strtolower(end($this->fileExt));

            $this->allowed=array('jpg','jpeg','png');
            if(in_array($this->fileActualExt,$this->allowed))
            {
                if($this->fileError===0)
                {
                    if($this->fileSize<1000000)
                    {
                        
                        
                        $sql1="INSERT INTO donar_requests (user_email,user_phone,donar_name,donar_age,donar_gender,donar_bgroup,donar_city,donar_proof,donar_q1,donar_q2,donar_q3,donar_q4,donar_q5,donar_q6,token,request_status,allotment_status) 
                        VALUES('$row[email]','$row[phone]','$this->dname','$this->age','$this->gender','$this->bgroup','$this->city','none','$this->q1','$this->q2','$this->q3','$this->q4','$this->q5','$this->q6','none',0,0);";
                        $result1=mysqli_query($this->conn,$sql1);
                        if($result1==true)
                        {
                            $sql2="SELECT * FROM donar_requests order by donar_id desc;";
                            $result2=mysqli_query($this->conn,$sql2);
                            while($row2=mysqli_fetch_assoc($result2))
                            {
                                $this->token=$this->gettoken($row2['donar_id']);
                                $this->donar_id=$row2['donar_id'];
                                break;
                            }
                            $this->newfileid=$this->token;
                            $this->fileNameNew=$this->newfileid.".".$this->fileActualExt;
                            $this->filesDestination='donar_aadhar_PAN_card/'.$this->fileNameNew;
                            move_uploaded_file($this->fileTmpName,$this->filesDestination);
                            $sql4="UPDATE donar_requests SET donar_proof='$this->fileNameNew',token='$this->token' WHERE donar_id='$this->donar_id';";
                            mysqli_query($this->conn,$sql4);
                            echo'<script>alert("Your form has been submitted successfully. In 1 to 3 days your request will get processed.")</script>';
                            echo "<script>location.href='your_requests.php'</script>";
                        }   
                        else{
                            echo'<script>alert("Error occured while submitting information. Please try again later.")</script>';
                            echo "<script>location.href='your_requests.php'</script>";
                        }                 
                    }
                    else
                    {
                        echo'<script>alert("Your file is two big!")</script>';
                        echo "<script>location.href='your_requests.php'</script>";
                    }
                }
                else
                {
                    echo'<script>alert("There was an error uploading your file!")</script>';
                    echo "<script>location.href='your_requests.php'</script>";
                }
            }
            else
            {
                echo'<script>alert("You cannot upload files of this type!")</script>';
                echo "<script>location.href='your_requests.php'</script>";
            }
        }
        else
        {
            echo'<script>alert("Error occured while submitting information. Please try again later.")</script>';
            echo "<script>location.href='your_requests.php'</script>";
        }
    }
    public function receive_plasma()
    {
        session_start();
        $this->email=$_SESSION['email'];
        $sql="SELECT * FROM individual_user where email='$this->email';";
        $result=mysqli_query($this->conn,$sql);
        if($result==true)
        {
            $row=mysqli_fetch_assoc($result);
            $this->fileExt=explode('.',$this->fileName);
            $this->fileActualExt=strtolower(end($this->fileExt));

            $this->allowed=array('jpg','jpeg','png');
            if(in_array($this->fileActualExt,$this->allowed))
            {
                if($this->fileError===0)
                {
                    if($this->fileSize<1000000)
                    {
                        
                        
                        $sql1="INSERT INTO receiver_requests (user_email,user_phone,receiver_name,receiver_age,receiver_gender,receiver_bgroup,receiver_city,receiver_proof,token,request_status,allotment_status) 
                        VALUES('$row[email]','$row[phone]','$this->rname','$this->age','$this->gender','$this->bgroup','$this->city','none','none',0,0);";
                        $result1=mysqli_query($this->conn,$sql1);
                        if($result1==true)
                        {
                            $sql2="SELECT * FROM receiver_requests order by receiver_id desc;";
                            $result2=mysqli_query($this->conn,$sql2);
                            while($row2=mysqli_fetch_assoc($result2))
                            {
                                $this->token=$this->gettoken($row2['receiver_id']);
                                $this->receiver_id=$row2['receiver_id'];
                                break;
                            }
                            $this->newfileid=$this->token;
                            $this->fileNameNew=$this->newfileid.".".$this->fileActualExt;
                            $this->filesDestination='receiver_aadhar_PAN_card/'.$this->fileNameNew;
                            move_uploaded_file($this->fileTmpName,$this->filesDestination);
                            $sql4="UPDATE receiver_requests SET receiver_proof='$this->fileNameNew',token='$this->token' WHERE receiver_id='$this->receiver_id';";
                            mysqli_query($this->conn,$sql4);
                            echo'<script>alert("Your form has been submitted successfully. In 1 to 3 days your request will get processed.")</script>';
                            echo "<script>location.href='your_requests.php'</script>";
                        }   
                        else{
                            echo'<script>alert("Error occured while submitting information. Please try again later.")</script>';
                            echo "<script>location.href='your_requests.php'</script>";
                        }                 
                    }
                    else
                    {
                        echo'<script>alert("Your file is two big!")</script>';
                        echo "<script>location.href='your_requests.php'</script>";
                    }
                }
                else
                {
                    echo'<script>alert("There was an error uploading your file!")</script>';
                    echo "<script>location.href='your_requests.php'</script>";
                }
            }
            else
            {
                echo'<script>alert("You cannot upload files of this type!")</script>';
                echo "<script>location.href='your_requests.php'</script>";
            }
        }
        else
        {
            echo'<script>alert("Error occured while submitting information. Please try again later.")</script>';
            echo "<script>location.href='your_requests.php'</script>";
        }
    }
    public function delete_account()
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
                $content = "Dear $row[fname]<br><br>
                Your Account deleted successfully.<br>
                Sorry to see you go.";
                
        
                require 'email/mailer.php';
                Mailer::sendMail($row['email'], $subject, $content);
                
                $sql7="DELETE FROM individual_user where initialtoken='$this->token';";
                mysqli_query($this->conn,$sql7);
                echo "<script>location.href='../index.php'</script>";
        }
        else
        {
            echo'<script>alert("Error occured. Please try again later.")</script>';
            echo "<script>location.href='profile_ind.php?token=$this->token'</script>";
        }
    }
    public static function getToken($hash=null) {
        return sha1( $hash ?? date('ymdhi') );
    }
}
?>
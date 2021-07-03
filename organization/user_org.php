<?php
class user_org{
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
    public function update_org()
    {
        session_start();
        $this->email=$_SESSION['email'];
        $sql="UPDATE organizational_user SET pbname='$this->pbname', phone='$this->phone', addressline1='$this->adl1', addressline2='$this->adl2', city='$this->city', state='$this->state', pincode='$this->pin' WHERE email='$this->email';";
        $result=mysqli_query($this->conn,$sql);
        if($result==true)
        {
            echo'<script>alert("Successfully updated details.")</script>';
            echo "<script>location.href='profile_org.php'</script>";
        }
        else{
            echo'<script>alert("Error occured while updating information. Please try again later.")</script>';
            echo "<script>location.href='profile_org.php'</script>";
        }
    }
    public function allot_donar()
    {
        session_start();
        $email=$_SESSION['email'];
        $sql="SELECT * FROM organizational_user WHERE email='$email';";
        $result=mysqli_query($this->conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $sql1="SELECT * FROM donar_requests WHERE token='$this->donar_token';";
        $result1=mysqli_query($this->conn,$sql1);
        $row1=mysqli_fetch_assoc($result1);
        $sql2="INSERT INTO donar_appointments (donar_id,bank_name,bank_email,bank_phone,address_line_1,address_line_2,city,state,pincode,date,time)
        VALUE('$row1[donar_id]','$row[pbname]','$row[email]','$row[phone]','$row[addressline1]','$row[addressline2]','$row[city]','$row[state]','$row[pincode]','$this->date','$this->time');";
        mysqli_query($this->conn,$sql2);
        $sql3="UPDATE donar_requests SET allotment_status=1 WHERE donar_id='$row1[donar_id]';";
        mysqli_query($this->conn,$sql3);
        $subject = "Status of your application";
                $content = "Dear $row1[donar_name]<br><br>
                Your application to donate plasma has been accepted by the plasma bank $row[pbname].<br>
                Please bring your id proof at the time of appointment.<br>
                Appointment Date: $this->date<br>
                Appointment Time: $this->Time<br>
                Bank Email: $row[email]<br>
                Bank Phone: $row[phone]<br>
                Bank address: $row[addressline1],<br>
                              $row[addressline2],<br>
                              $row[city],<br>
                              $row[state],<br>
                              $row[pincode].<br>";
                
        
                require 'email/mailer.php';
                Mailer::sendMail($row1['user_email'], $subject, $content);
                echo'<script>alert("Donar application approved and mail regarding the details of appointment has been send to the donar..")</script>';
                echo "<script>location.href='donar_appointment.php'</script>";
    }
    public function allot_receiver()
    {
        session_start();
        $email=$_SESSION['email'];
        $sql="SELECT * FROM organizational_user WHERE email='$email';";
        $result=mysqli_query($this->conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $sql1="SELECT * FROM receiver_requests WHERE token='$this->receiver_token';";
        $result1=mysqli_query($this->conn,$sql1);
        $row1=mysqli_fetch_assoc($result1);
        $sql2="INSERT INTO receiver_appointments (receiver_id,bank_name,bank_email,bank_phone,address_line_1,address_line_2,city,state,pincode,date,time)
        VALUE('$row1[receiver_id]','$row[pbname]','$row[email]','$row[phone]','$row[addressline1]','$row[addressline2]','$row[city]','$row[state]','$row[pincode]','$this->date','$this->time');";
        mysqli_query($this->conn,$sql2);
        $sql3="UPDATE receiver_requests SET allotment_status=1 WHERE receiver_id='$row1[receiver_id]';";
        mysqli_query($this->conn,$sql3);
        $subject = "Status of your application";
                $content = "Dear $row1[receiver_name]<br><br>
                Your application to receive plasma has been accepted by the plasma bank $row[pbname].<br>
                Please bring your id proof at the time of appointment.<br>
                Appointment Date: $this->date<br>
                Appointment Time: $this->Time<br>
                Bank Email: $row[email]<br>
                Bank Phone: $row[phone]<br>
                Bank address: $row[addressline1],<br>
                              $row[addressline2],<br>
                              $row[city],<br>
                              $row[state],<br>
                              $row[pincode].<br>";
                
        
                require 'email/mailer.php';
                Mailer::sendMail($row1['user_email'], $subject, $content);
                echo'<script>alert("Receiver application approved and mail regarding the details of appointment has been send to the donar..")</script>';
                echo "<script>location.href='receiver_appointment.php'</script>";
    }
    public function delete_account()
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
                            $content = "The plasma bank which alloted you the appointment timing deleted its account.<br>
                            You will receive the another appointment confirmation mail from some other bank.<br>
                            Please sorry for the inconvenience.";
                    
                            
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
                            $content = "The plasma bank which alloted you the appointment timing deleted its account.<br>
                            You will receive the another appointment confirmation mail from some other bank.<br>
                            Please sorry for the inconvenience";
                    
                            
                            Mailer::sendMail($row55['user_email'], $subject, $content);
                    }
                    $sql6="DELETE FROM receiver_appointments where bank_email='$row[email]';";
                    mysqli_query($this->conn,$sql6);
                }
            }
            
            $subject = "Account Deleted";
                $content = "Dear $row[pbname]<br><br>
                Your Account deleted successfully.<br>
                Sorry to see you go.";
                
        
                
                Mailer::sendMail($row['email'], $subject, $content);
                $file="../organization/Approval_plasma_bank_upload/$row[approvalfile]";
                unlink($file);
                $sql7="DELETE FROM organizational_user where initialtoken='$this->token';";
                mysqli_query($this->conn,$sql7);
                echo "<script>location.href='../index.php'</script>";
        }
        else
        {
            echo'<script>alert("Error occured. Please try again later.")</script>';
            echo "<script>location.href='profile_org.php?token=$this->token'</script>";
        }
    }
    
}
?>
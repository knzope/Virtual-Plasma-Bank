<html>
    <head>
        <title>ABOUT - Virtual Plasma Bank</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </head>
    <style>
        body{
            font-family: 'Times New Roman', Times, serif;
        }
        .container{
            font-size: 20px;
        }
        table{
            font-size: 20px;
        }
        .c1{
                border: 1px solid rgba(0, 0, 0, 0.219);
                padding: 20px;
                margin-top: 50px;
                border-radius: 5px;
            }
            .c1:hover{
                box-shadow: 0px 0px 10px 0.5px rgba(0, 0, 0, 0.521);
            }
 /* table {
     position: relative;
     left: 8%;
    color: black;
    font-family: arial, sans-serif;
    border-collapse: collapse;
    background-color: rgb(228, 198, 158);
    
    
  } */
  
  /* td, th {
    border: 2px solid black;
    text-align: left;
    padding: 8px;
  }
  
  tr:hover{
    background-color: orangered;
    color: white;
  } */

    </style>
    <body>
    <?php
            $nameerr=$emailerr=$phoneerr=$messageerr="";
              if($_SERVER["REQUEST_METHOD"] == "POST")
              {
                    $checkname= "/^[A-Za-z ]{2,30}$/";
                    
                    $checkemail="/^[a-zA-Z][\.]?([a-zA-Z0-9]{1,8})?(([a-zA-Z0-9]{1,8}[\.]{0,1}){1,5})?[a-zA-Z0-9]{1,4}[@]{1}([a-zA-Z0-9]{1,10}([\-][a-zA-Z0-9]{2,10})?\.){1,3}[a-zA-Z]{2,8}$/";
                    //var checkemail= /^[a-zA-Z][a-zA-Z0-9]{1,8}([a-zA-Z0-9]{1,4}[\.\_\-]{0,1}){1,2}[a-zA-Z0-9]{1,4}[@]{1}([a-zA-Z0-9]{2,10}\.){1,3}[a-zA-Z]{2,8}$/;
                    //$checkemail= "/^[a-zA-Z]([a-zA-Z0-9]{1,8})?(([a-zA-Z0-9]{1,8}[\.\_\-\+]{0,1}){1,5})?([a-zA-Z0-9]{1,4})?[@]{1}([a-zA-Z0-9]{1,10}([\-][a-zA-Z0-9]{2,10})?\.){1,3}[a-zA-Z]{2,8}$/";
                    $checknumber = "/^(\+91)?[6+7+8+9][0-9]{9}$/";
                   
                    require 'database.php';
                    $db=new database();
                    $conn=$db->connect();
                    $name=$_POST['uname'];
                    $email=$_POST['email'];
                    $phone=$_POST['phone'];
                    $message=$_POST['message'];
                    if($name==" ")
                    {
                      $nameerr="**Name cannot be empty";
                    }
                    else if (!preg_match($checkname,$name)){  
                      $nameerr="**Enter name properly";
                    }
                    if (!preg_match($checkemail,$email)){  
                      $emailerr="**Invalid email";
                    }
                    if (!preg_match($checknumber,$phone)){  
                      $phoneerr="**Invalid mobile number";
                    }
                    if (strlen($message)<20){  
                      $messageerr="**Length of characters in message ust be greater than 20";
                    }
                    if($nameerr=="" && $emailerr=="" && $phoneerr=="" && $messageerr=="")
                    {
                        $sql="INSERT INTO contact_info (name,email,phone,message) VALUES('$name','$email','$phone','$message');";
                        $result=mysqli_query($conn,$sql);
                        if($result==true)
                        {
                          echo'<script>alert("Your message submitted.")</script>';
                          echo "<script>location.href='contact.php'</script>";
                        }
                    }
              }
       ?>

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="navbar-brand"><h1><i>PlasmaBank</i></h1></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
          
            <div class="collapse navbar-collapse" id="navbarColor01">
              <ul class="navbar-nav mr-auto">
                
                <li class="nav-item">
                  <a class="nav-link"  href="home.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"  href="browse_plasma_bank.php">Browse Plasma Bank</a>
                </li>
                
                <li class="nav-item">
                  <a class="nav-link" href="your_requests.php">Your Requests</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="your_appointments.php">Your Appointments</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="profile_ind.php">Your Profile</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="logout.php">Logot</a>
                </li>
                 -->
              </ul>
              
            </div>
          </nav>


        <hr>
        <div>
            <p class="container">
                &nbsp &nbsp &nbsp &nbsp We, the Students of MIT Academy of Engineering as a part of Web Technology Course has taken an initiative to build a Plasma donation Website under the Guidance of 
                   Pankaj Chaudhari Sir. We all are aware of this pandemic and everyone of us wants that this pandemic to be get cured as soon as possible. As a procedural outcome
                   many of the scientists has an eye on <b>Plasma Technique</b> . So here ; We team members decided to create an online platform <b style="color: orangered;"> [VIRTUAL PLASMA BANK] </b>for such activities which will reduce the Bridging 
                   gap between the donars and the receivers.


            </p>
           
                           
    <div class="container uk-panel uk-margin">
        <h2> Our Main Objective is to :</h2>
    <ul>
    <li>Administer standards programs that help ensure the quality and safety of plasma collection and manufacturing and protect both donors and patients</li>
    <li>Advocate for access to and affordability of therapies for patients</li>
    <li>Engage in constructive dialogue with regulatory agencies</li>
    <li>Collaborate with patient advocacy organizations<br /><br /></li>
    </ul>
    <p style="text-align: left;">&nbsp &nbsp &nbsp &nbsp You will find donating plasma a rewarding experience. You can take pride in the fact that your donation is helping to save and improve lives. We are committed to the highest standards of safety and quality.</p>
   
   
    <div class="container">
      <h2 class="text-center" style="margin-bottom:-30px;margin-top: 20px;">Contact Form</h2>
      <div class="col-lg-6 m-auto d-block">
          <div class="c1">
          <form action="contact.php" method="POST">
      <div class="form-group">
          <lable for="uname">Name : </lable> <br>
          <input type="text" class="form-control" id="uname" name="uname" placeholder="Name" value="<?php if(isset($_POST['uname'])){echo $_POST['uname'];}?>" required>
          <span id="alt3" class="text-danger font-weight-bold"> <?php echo $nameerr;?></span>  
      </div>
      <div class="form-group">
        <lable for="email">Email Address : </lable> <br>
    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" required> 
    <span id="alt3" class="text-danger font-weight-bold"> <?php echo $emailerr;?></span> 
    </div>
    
    <div class="form-group">
        <lable for="phone">Phone No. : </lable> <br>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone No." value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];}?>" required> 
    <span id="alt3" class="text-danger font-weight-bold"> <?php echo $phoneerr;?></span> 
    </div>
                    
    <div class="form-group">
      <label for="message">Message : </label> <br>
      <textarea id="message"class="form-control" name="message" placeholder="Message" rows="5" cols="30" ><?php if(isset($_POST['message'])){echo $_POST['message'];}?></textarea> 
      <span id="alt3" class="text-danger font-weight-bold"> <?php echo $messageerr;?></span> 
  </div>
      <input type="submit" class="btn btn-primary" value="Submit"> <br>
  </form>
</div>
</div>
</div>
        <hr>
        <h2>Our Team</h2>
        <table class="table table-striped table-bordered table-hover"style="float: left;">
            <thead class="thead-dark">
                <tr>
                    <th><b>Sr.no</b></th>
                    <th><b>Name</b></th>
                    <th><b>PRN</b></th>
                    <th><b>Roll no.</b></th>
                    <th><b>Branch</b></th>
                    <th><b>Email</b></th>
                  </tr>
            </thead>
            
            <tr>
                <td>1</td>
                <td>Rohit Suryawanshi</td>
                <td>0120180155</td>
                <td>112</td>
                <td>Computer</td>
                <td>rsuryawanshi@mitaoe.ac.in</td>

            </tr>
            <tr>
                <td>2</td>
                <td>Kunal Zope</td>
                <td>0120180032</td>
                <td>131</td>
                <td>Computer</td>
                <td>knzope@mitaoe.ac.in</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Pranjal Rai</td>
                <td>0120180412</td>
                <td>135</td>
                <td>Computer</td>
                <td>prai@mitaoe.ac.in</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Shubham Sapkal</td>
                <td>0120180257</td>
                <td>091</td>
                <td>Computer</td>
                <td>sksapkal@mitaoe.ac.in</td>
            </tr>
            
          </table>
        <!-- <img  class="img-responsive" src="MIT.jpg" alt="logo" height="170px" width="520px" style="position: relative;left: 10%;" >  -->
        
    </body>
</html>

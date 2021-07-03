<html>
    <head>
        <title>Individual Update details - Virtual Plasma Bank</title>
        <!-- <link rel="stylesheet" type="text/css" href="stylesheet.css"> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <style>
            body{
                font-family: 'Times New Roman', Times, serif;
                font-size: 20px;
            }
            .jumbotron{
               margin-top:20px;
               /* height: 40px;
               
               padding-top: 10px;
               color: white;
               border-radius: 0px;
               background-color: black; */
            }
            /* h1{
                margin-left: -950px;
            } */
            .c1{
                border: 1px solid rgba(0, 0, 0, 0.219);
                padding: 20px;
                margin-top: 50px;
                margin-bottom: 50px;
                border-radius: 5px;
            }
            .c1:hover{
                box-shadow: 0px 0px 10px 0.5px rgba(0, 0, 0, 0.521);
            }
        </style>
    </head>
    <body>
        <?php
        session_start();
        $email=$_SESSION['email'];
        require 'database.php';
        
               
                $db=new database();
                $conn=$db->connect();
            $fnameerr=$lnameerr=$ageerr=$phoneerr=$adl1err=$adl2err=$cityerr=$stateerr=$pincodeerr="";
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
              $checknumber = "/^(\+91)?[6+7+8+9][0-9]{9}$/";
                  $checkfname= "/^[A-Za-z]{2,15}$/";
                  $checklname= "/^[A-Za-z]{2,15}$/";
                  $checkage= "/^[0-9]{1,3}$/";
                  $checkadl1= "/^[A-Za-z0-9\-\_\.\, ]{5,30}$/";
                  $checkadl2= "/^[A-Za-z0-9\-\_\.\, ]{5,30}$/";
                  //var checkpincode= /^[0-9]{6}$/;
                  $checkpincode= "/^[1-9]{1}[0-9]{5}$/";
                  
                  require 'user_ind.php';
                  $db=new database();
                  $user= new user_ind($db->connect());
                    $user->fname=$_POST['fname'];
                    $user->lname=$_POST['lname'];
                    $user->age=$_POST['age'];
                    $user->gender=$_POST['gender'];
                    $user->phone=$_POST['phone'];
                    $user->adl1=$_POST['address1'];
                    $user->adl2=$_POST['address2'];
                    $user->city=$_POST['addressCity'];
                    $user->state=$_POST['addressState'];
                    $user->pin=$_POST['addressPIN'];
                      
                      
                      if (!preg_match($checkfname,$user->fname)){  
                          $fnameerr="**Enter first name properly";
                      }
                      if (!preg_match($checklname,$user->lname)){  
                            $lnameerr="**Enter last name properly";
                      }
                      if($user->age==0)
                      {
                        $ageerr="**Enter age properly";
                      }
                      if (!preg_match($checknumber,$user->phone)){  
                        $phoneerr="**Invalid mobile number";
                      }
                      if (!preg_match($checkage,$user->age)){
                            
                          $ageerr="**Enter age properly";
                      }
                      
                      if (!preg_match($checkadl1,$user->adl1)){  
                        $adl1err="**Address length must be between 5 to 30";
                      }
                      if (!preg_match($checkadl2,$user->adl2)){  
                        $adl2err="**Address length must be between 5 to 30";
                      }
                      if ($user->city==""){  
                        $cityerr="**Select your city";
                      }
                      if ($user->state==""){  
                        $stateerr="**Select your state";
                      }
                      if (!preg_match($checkpincode,$user->pin)){  
                        $pincodeerr="**Please enter proper pincode";
                      }
                    
                      if($fnameerr=="" && $lnameerr=="" && $ageerr=="" && $phoneerr=="" && $adl1err=="" && $adl2err=="" && $cityerr=="" && $stateerr=="" && $pincodeerr=="")
                      {
                        echo $user->update_ind();
                        // echo $user->register_individual_user();
                         //echo'<script>alert("Success.")</script>';
                        // echo "Success";
                      }
              }
              ?>

        
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="navbar-brand"><h1><I>PlasmaBank</I></h1></div>
            
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
                  <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="profile_ind.php">Your Profile</a>
                </li>
                
                
              </ul>
              
            </div>
          </nav>



            <?php
                
                $sql="SELECT * FROM individual_user WHERE email='$email';";
                $result=mysqli_query($conn,$sql);
                if($result==true)
                {
                    if(mysqli_num_rows($result)>0)
                    {
                        $row=mysqli_fetch_assoc($result);
                    } 
                    else
                    {
                        echo'<script>alert("Error occured. Please try again later.")</script>';
                        echo "<script>location.href='home.php'</script>";
                    }   
                }
                else{
                    echo'<script>alert("Error occured. Please try again later.")</script>';
                    echo "<script>location.href='home.php'</script>";
                }
            ?>
        <div class="container">
            <h2 class="text-center" style="margin-bottom:-30px;margin-top: 20px;">Update details</h2>
            <div class="col-lg-6 m-auto d-block">
                <div class="c1">
                    <!-- <div class="text-success" id="temp"></div>
                    <div class="text-danger" id="temp1"></div> -->
        <form id="form_register" method="POST" action="update_ind.php">
            <div class="form-group">
                <lable for="fname">First Name : </lable> <br>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php if(isset($_POST['fname'])){echo $_POST['fname'];}else{echo $row['fname'];} ?>" required> 
                <span id="alt1" class="text-danger font-weight-bold"><?php echo $fnameerr;?> </span> 
            </div>
            <div class="form-group">
                <lable for="lname">Last Name : </lable> <br>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php if(isset($_POST['lname'])){echo $_POST['lname'];}else{echo $row['lname'];} ?>" required> 
            <span id="alt1" class="text-danger font-weight-bold"><?php echo $lnameerr;?> </span> 
        </div>
            <div class="form-group">
                <lable for="age">Age : </lable> <br>
            <input type="number" class="form-control" id="age" name="age" placeholder="Age" value="<?php if(isset($_POST['age'])){echo $_POST['age'];}else{echo $row['age'];} ?>" required> 
            <span id="alt1" class="text-danger font-weight-bold"><?php echo $ageerr;?> </span> 
        </div>
            
            <div class="form-group">
                <label> Gender : </label> <br>
                <input type="radio" id="male" name="gender" value="male" <?php if(isset($_POST['gender'])){if($_POST['gender']=='male'){ echo 'checked';}}else{if($row['gender']=='male'){ echo 'checked';}}?> required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female" <?php if(isset($_POST['gender'])){if($_POST['gender']=='female'){ echo 'checked';}}else{if($row['gender']=='female'){ echo 'checked';}}?> required>
                <label for="female">Female</label>
                <input type="radio" id="other" name="gender" value="other" <?php if(isset($_POST['gender'])){if($_POST['gender']=='other'){ echo 'checked';}}else{if($row['gender']=='other'){ echo 'checked';}}?> required>
                <label for="other">Other</label> 
            </div>
            
            <div class="form-group">
                <lable for="phone">Mobile Number : </lable> <br>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Mobile Number" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];}else{echo $row['phone'];} ?>" required> 
                <span id="alt1" class="text-danger font-weight-bold"> <?php echo $phoneerr;?></span> 
            </div>
            
            
            <div class="form-group">
                <label>Address : </label> <br>
                <input type="text" class="form-control" id="address1" name="address1" placeholder="Address Line 1" value="<?php if(isset($_POST['address1'])){echo $_POST['address1'];}else{echo $row['addressline1'];} ?>" required> 
                <span id="alt1" class="text-danger font-weight-bold"><?php echo $adl1err;?> </span> 
                <input type="text" class="form-control" id="address2" name="address2" placeholder="Address Line 2" value="<?php if(isset($_POST['address2'])){echo $_POST['address2'];}else{echo $row['addressline2'];} ?>" required> 
                <span id="alt1" class="text-danger font-weight-bold"><?php echo $adl2err;?> </span> 
                <select class="form-control"id="addressCity" name="addressCity" required>
                    <option value="<?php if(isset($_POST['addressCity'])){echo $_POST['addressCity'];}else{echo $row['city'];} ?>"><?php if(isset($_POST['addressCity'])){echo $_POST['addressCity'];}else{echo $row['city'];} ?></option>
                    <option value = "Mumbai">Mumbai</option>
                    <option value = "Pune">Pune</option>
                    <option value = "Surat">Surat</option>
                </select> 
                <span id="alt1" class="text-danger font-weight-bold"><?php echo $cityerr;?> </span> 
                <select class="form-control"id="addressState" name="addressState" required>
                    <option value="<?php if(isset($_POST['addressState'])){echo $_POST['addressState'];}else{echo $row['state'];} ?>"><?php if(isset($_POST['addressState'])){echo $_POST['addressState'];}else{echo $row['state'];} ?></option>
                    <option value = "Maharashtra">Maharashtra</option>
                    <option value = "Gujrat">Gujrat</option>
                </select> 
                <span id="alt1" class="text-danger font-weight-bold"><?php echo $stateerr;?> </span> 
                <input type="text" class="form-control" id="addressPIN" name="addressPIN" placeholder="PIN CODE" value="<?php if(isset($_POST['addressPIN'])){echo $_POST['addressPIN'];}else{echo $row['pincode'];} ?>" patters="[0-9]{6}" required> 
                <span id="alt1" class="text-danger font-weight-bold"><?php echo $pincodeerr;?> </span> 
            </div>
            

            <input type="submit" class="btn btn-primary" value="Update">
        </form>
</div>
</div>
</div>

        
        <script src="jquery-3.5.1.min.js"></script>
       
    </body>
</html>
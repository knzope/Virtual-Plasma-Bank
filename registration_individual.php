<html>
    <head>
        <title>Individual Registration - Virtual Plasma Bank</title>
        <!-- <link rel="stylesheet" type="text/css" href="stylesheet.css"> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <style>
            body{
                font-family: 'Times New Roman', Times, serif;
                font-size:20px;
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
                border-radius: 5px;
                margin-bottom: 50px;

            }
            .c1:hover{
                box-shadow: 0px 0px 10px 0.5px rgba(0, 0, 0, 0.521);
            }
        </style>
    </head>
    <body>
        

    <?php
            $fnameerr=$lnameerr=$ageerr=$emailerr=$phoneerr=$adl1err=$adl2err=$cityerr=$stateerr=$pincodeerr=$passerr=$repasserr="";
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                  $checkfname= "/^[A-Za-z]{2,15}$/";
                  $checklname= "/^[A-Za-z]{2,15}$/";
                  $checkage= "/^[0-9]{1,3}$/";
                  $checkemail="/^[a-zA-Z][\.]?([a-zA-Z0-9]{1,8})?(([a-zA-Z0-9]{1,8}[\.]{0,1}){1,5})?[a-zA-Z0-9]{1,4}[@]{1}([a-zA-Z0-9]{1,10}([\-][a-zA-Z0-9]{2,10})?\.){1,3}[a-zA-Z]{2,8}$/";
                  //var checkemail= /^[a-zA-Z][a-zA-Z0-9]{1,8}([a-zA-Z0-9]{1,4}[\.\_\-]{0,1}){1,2}[a-zA-Z0-9]{1,4}[@]{1}([a-zA-Z0-9]{2,10}\.){1,3}[a-zA-Z]{2,8}$/;
                  //$checkemail= "/^[a-zA-Z]([a-zA-Z0-9]{1,8})?(([a-zA-Z0-9]{1,8}[\.\_\-\+]{0,1}){1,5})?([a-zA-Z0-9]{1,4})?[@]{1}([a-zA-Z0-9]{1,10}([\-][a-zA-Z0-9]{2,10})?\.){1,3}[a-zA-Z]{2,8}$/";
                  $checknumber = "/^(\+91)?[6+7+8+9][0-9]{9}$/";
                  $checkpass= "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\!\@\#\$\^\&\*\-\_\.])[a-zA-Z0-9\!\@\#\$\%\^\&\*\-\_\.]{8,16}$/";
                  $checkadl1= "/^[A-Za-z0-9\-\_\.\, ]{5,30}$/";
                  $checkadl2= "/^[A-Za-z0-9\-\_\.\, ]{5,30}$/";
                  //var checkpincode= /^[0-9]{6}$/;
                  $checkpincode= "/^[1-9]{1}[0-9]{5}$/";
                  require 'database.php';
                  require 'user.php';
                  $db=new database();
                  $user= new user($db->connect());
                    $user->fname=$_POST['fname'];
                    $user->lname=$_POST['lname'];
                    $user->age=$_POST['age'];
                    $user->gender=$_POST['gender'];
                    $user->email=$_POST['email'];
                    $user->phone=$_POST['phone'];
                    $user->password=$_POST['pass'];
                    $user->repassword=$_POST['repass'];
                    $user->adl1=$_POST['address1'];
                    $user->adl2=$_POST['address2'];
                    $user->city=$_POST['addressCity'];
                    $user->state=$_POST['addressState'];
                    $user->pincode=$_POST['addressPIN'];
                      
                      
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
                      
                      if (!preg_match($checkage,$user->age)){
                            
                          $ageerr="**Enter age properly";
                      }
                      
                      if (!preg_match($checkemail,$user->email)){  
                        $emailerr="**Invalid email";
                      }
                      else
                      {
                          
                          $conn=$db->connect();
                          $sql="SELECT * FROM individual_user;";
                          $result=mysqli_query($conn,$sql);
                          if(mysqli_num_rows($result)>0)
                          {
                              while($row=mysqli_fetch_assoc($result))
                              {
                                if($row['email']==$user->email)
                                {
                                    $emailerr="**Your email is already registered. Use Sign-In.";
                                    break;
                                }  
                              }
                          }
                          $sql1="SELECT * FROM blacklist;";
                          $result1=mysqli_query($conn,$sql1);
                          if(mysqli_num_rows($result1)>0)
                          {
                              while($row1=mysqli_fetch_assoc($result1))
                              {
                                if($row1['email']==$user->email)
                                {
                                    $emailerr="**You will not be allwoed to register as your email is in our blacklist.";
                                    break;
                                }  
                              }
                          }
                      }
                      if (!preg_match($checknumber,$user->phone)){  
                        $phoneerr="**Invalid mobile number";
                      }
                      if (!preg_match($checkpass,$user->password)){  
                        $passerr="For a strong password<br>->password size must be greater than 8 and less than 16<br>->At least one character must be lower case<br>->At least one character must be Upper case<br>->At least one character must be number<br>->At least one character must be special symbol";
                      }
                      if ($user->password!=$user->repassword){  
                        $repasserr="**Password do not match";
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
                      if (!preg_match($checkpincode,$user->pincode)){  
                        $pincodeerr="**Please enter proper pincode";
                      }
                    
                      if($fnameerr=="" && $lnameerr=="" && $ageerr=="" && $emailerr=="" && $phoneerr=="" && $passerr=="" && $repasserr=="" && $adl1err=="" && $adl2err=="" && $cityerr=="" && $stateerr=="" && $pincodeerr=="")
                      {
                        echo $user->register_individual_user();
                        // echo'<script>alert("Success.")</script>';
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
                  <a class="nav-link"  href="index.php">Welcome</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.php">About Us</a>
                </li>
                
                
              </ul>
              
            </div>
          </nav>




        <div class="container">
            <h2 class="text-center" style="margin-bottom:-30px;margin-top: 20px;">Individual User Registration Form</h2>
            <div class="col-lg-6 m-auto d-block">
                <div class="c1">
                    <!-- <div class="text-success" id="temp"></div>
                    <div class="text-danger" id="temp1"></div> -->
        <form id="form_register" method="POST" action="registration_individual.php">
            <div class="form-group">
                <lable for="fname">First Name : </lable> <br>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php if(isset($_POST['fname'])){echo $_POST['fname'];}?>" required>
                <span id="alt1" class="text-danger font-weight-bold"><?php echo $fnameerr;?> </span>  
            </div>
            <div class="form-group">
                <lable for="lname">Last Name : </lable> <br>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php if(isset($_POST['lname'])){echo $_POST['lname'];}?>" required>
                <span id="alt2" class="text-danger font-weight-bold"><?php echo $lnameerr;?> </span>  
            </div>
            <div class="form-group">
                <lable for="age">Age : </lable> <br>
                <input type="number" class="form-control" id="age" name="age" placeholder="Age" value="18" value="<?php if(isset($_POST['age'])){echo $_POST['age'];}?>" required>
                <span id="alt3" class="text-danger font-weight-bold"> <?php echo $ageerr;?></span>  
            </div>
            
            <div class="form-group">
                <label> Gender : </label> <br>
                <input type="radio" id="male" name="gender" value="male" <?php if(isset($_POST['gender'])){if($_POST['gender']=='male'){ echo 'checked';}}?> required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female" <?php if(isset($_POST['gender'])){if($_POST['gender']=='female'){ echo 'checked';}}?> required>
                <label for="female">Female</label>
                <input type="radio" id="other" name="gender" value="other" <?php if(isset($_POST['gender'])){if($_POST['gender']=='other'){ echo 'checked';}}?> required>
                <label for="other">Other</label> 
                <span id="alt4" class="text-danger font-weight-bold"> </span> 
            </div>
            
            <div class="form-group">
                <lable for="email">Email Address: </lable> <br>
            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" required> 
            <span id="alt5" class="text-danger font-weight-bold"><?php echo $emailerr;?> </span> 
            </div>

            <div class="form-group">
                <lable for="phone">Mobile number : </lable> <br>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Mobile Number" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];}?>" required> 
                <span id="altphone" class="text-danger font-weight-bold"> <?php echo $phoneerr;?></span> 
            </div>
            
            <div class="form-group">
                <lable for="pass">Password: </lable> <br>
            <input type="text" class="form-control" id="pass" name="pass" placeholder="Enter password" value="<?php if(isset($_POST['pass'])){echo $_POST['pass'];}?>" required>
            <span id="alt6" style="font-size:15px;" class="text-danger font-weight-bold"> <?php echo $passerr;?></span>  
            </div>
            <div class="form-group">
                <lable for="repass">Re-enter Password: </lable> <br>
            <input type="text" class="form-control" id="repass" name="repass" placeholder="Re-enter password" value="<?php if(isset($_POST['repass'])){echo $_POST['repass'];}?>" required>
            <span id="alt7" class="text-danger font-weight-bold"> <?php echo $repasserr;?></span>  
            </div>
            
            <div class="form-group">
                <label>Address : </label> <br>
                <input type="text" class="form-control" id="address1" name="address1" placeholder="Address Line 1" value="<?php if(isset($_POST['address1'])){echo $_POST['address1'];}?>" required>
                <span id="alt8" class="text-danger font-weight-bold"><?php echo $adl1err;?> </span>  
                <input type="text" class="form-control" id="address2" name="address2" placeholder="Address Line 2" value="<?php if(isset($_POST['address2'])){echo $_POST['address2'];}?>" required>
                <span id="alt9" class="text-danger font-weight-bold"><?php echo $adl2err;?> </span>  
                <select class="form-control"id="addressCity" name="addressCity" required>
                    <option value="<?php if(isset($_POST['addressCity'])){echo $_POST['addressCity'];}?>"><?php if(isset($_POST['addressCity'])){echo $_POST['addressCity'];}else{echo "Select City";}?></option>
                    <option value = "Mumbai">Mumbai</option>
                    <option value = "Pune">Pune</option>
                    <option value = "Surat">Surat</option>
                </select> 
                <span id="alt10" class="text-danger font-weight-bold"><?php echo $cityerr;?> </span> 
                <select class="form-control"id="addressState" name="addressState" required>
                    <option value="<?php if(isset($_POST['addressState'])){echo $_POST['addressState'];}?>"><?php if(isset($_POST['addressState'])){echo $_POST['addressState'];}else{echo "Select State";}?></option>
                    <option value = "Maharashtra">Maharashtra</option>
                    <option value = "Gujrat">Gujrat</option>
                    <!-- <option value = "AB"> AB</option>
                    <option value = "O">  O</option> -->
                </select> 
                <span id="alt11" class="text-danger font-weight-bold"><?php echo $stateerr;?> </span> 
                <input type="text" class="form-control" id="addressPIN" name="addressPIN" placeholder="PIN CODE" value="<?php if(isset($_POST['addressPIN'])){echo $_POST['addressPIN'];}?>" required>
                <span id="alt12" class="text-danger font-weight-bold"><?php echo $pincodeerr;?> </span>  
            </div>
            
            <div class="form-group">
            <input type="submit" id="submit-button" class="btn btn-primary" value="Submit"> 
            <a class="btn btn-link"  href="login.php" style="font-size: 20px; float: right;">Sign-In</a>
            </div>
        </form>
</div>
</div>
</div>

        
        <script src="jquery-3.5.1.min.js"></script>
        <!-- <script>
            $(document).ready(function(){
                // var fname=document.getElementById('fname').value;
                // var lname=document.getElementById('lname').value;
                // var age=document.getElementById('age').value;
                // var email=document.getElementById('email').value;
                // var pass=document.getElementById('pass').value;
                // var repass=document.getElementById('repass').value;
                // var adl1=document.getElementById('address1').value;
                // var adl2=document.getElementById('address2').value;
                // var city=document.getElementById('addressCity').value;
                // var state=document.getElementById('addressState').value;
                // var pincode=document.getElementById('addressPIN').value;
                // const rbs = document.querySelectorAll('input[name="gender"]');
                // let gender;
                // for (const rb of rbs) {
                //     if (rb.checked) {
                //         gender = rb.value;
                //         break;
                //     }
                // }
                var checkfname= /^[A-Za-z]{2,15}$/;
                var checklname= /^[A-Za-z]{2,15}$/;
                var checkage= /^[0-9]{1,3}$/;
                //var checkemail= /^[a-zA-Z][a-zA-Z0-9]{1,8}([a-zA-Z0-9]{1,4}[\.\_\-]{0,1}){1,2}[a-zA-Z0-9]{1,4}[@]{1}([a-zA-Z0-9]{2,10}\.){1,3}[a-zA-Z]{2,8}$/;
                var checkemail= /^[a-zA-Z]([a-zA-Z0-9]{1,8})?(([a-zA-Z0-9]{1,8}[\.\_\-\+]{0,1}){1,5})?([a-zA-Z0-9]{1,4})?[@]{1}([a-zA-Z0-9]{1,10}([\-][a-zA-Z0-9]{2,10})?\.){1,3}[a-zA-Z]{2,8}$/;
                var checkpass= /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\!\@\#\$\^\&\*\-\_\.])[a-zA-Z0-9\!\@\#\$\%\^\&\*\-\_\.]{8,16}$/;
                var checkadl1= /^[A-Za-z0-9\-\_\.\, ]{5,30}$/;
                var checkadl2= /^[A-Za-z0-9\-\_\.\, ]{5,30}$/;
                //var checkpincode= /^[0-9]{6}$/;
                var checkpincode= /^[1-9]{1}[0-9]{5}$/;
                $("#fname").keyup(function(){
                    var fname=document.getElementById('fname').value;
                    if(checkfname.test(fname))
                    {
                        document.getElementById("submit-button").disabled = false;
                        document.getElementById('alt1').innerHTML =" ";
                    
                    }
                    else
                    {
                        document.getElementById("submit-button").disabled = true;
                        document.getElementById('alt1').innerHTML ="**Please enter first name properly";
                        return false;
                    }
                });
                $("#lname").keyup(function(){
                    var lname=document.getElementById('lname').value;
                    if(checklname.test(lname))
                    {
                        document.getElementById("submit-button").disabled = false;
                        document.getElementById('alt2').innerHTML =" ";
                    
                    }
                    else
                    {
                        document.getElementById("submit-button").disabled = true;
                        document.getElementById('alt2').innerHTML ="**Please enter last name properly";
                        return false;
                    }
                });
                $("#age").keyup(function(){
                    var age=document.getElementById('age').value;
                    if(checkage.test(age))
                    {
                        if(age==0)
                        {
                            document.getElementById("submit-button").disabled = true;
                            document.getElementById('alt3').innerHTML ="**Please enter age properly";
                            return false;
                        }
                        else
                        {
                            document.getElementById("submit-button").disabled = false;
                            document.getElementById('alt3').innerHTML =" ";
                        }
                        
                        
                    }
                    else
                    {
                        document.getElementById("submit-button").disabled = true;
                        document.getElementById('alt3').innerHTML ="**Please enter age properly";
                        return false;
                    } 
                });
                
                $("#email").keyup(function(){
                    var email=document.getElementById('email').value;
                    if(checkemail.test(email))
                    {
                        document.getElementById("submit-button").disabled = false;
                        document.getElementById('alt5').innerHTML =" ";
                        
                    }
                    else
                    {
                        document.getElementById("submit-button").disabled = true;
                        document.getElementById('alt5').innerHTML ="**Invalid email";
                        return false;
                    }
                });
                
                $("#pass").keyup(function(){
                    var pass=document.getElementById('pass').value;
                    if(checkpass.test(pass))
                    {
                        document.getElementById("submit-button").disabled = false;
                        document.getElementById('alt6').innerHTML =" ";
                    
                    }
                    else
                    {
                        document.getElementById("submit-button").disabled = true;
                        document.getElementById('alt6').innerHTML ="->password size must be greater than 8 and less than 16<br>->At least one character must be lower case<br>->At least one character must be Upper case<br>->At least one character must be number<br>->At least one character must be special symbol";
                        
                        return false;
                    }
                });
                
                $("#repass").keyup(function(){
                    var pass=document.getElementById('pass').value;
                    var repass=document.getElementById('repass').value;
                    if(pass==repass)
                    {
                        document.getElementById("submit-button").disabled = false;
                        document.getElementById('alt7').innerHTML =" ";
                    }
                    else
                    {
                        document.getElementById("submit-button").disabled = true;
                        document.getElementById('alt7').innerHTML ="**Password do not match";
                        return false;
                    }
                });
                
                $("#address1").keyup(function(){
                    var adl1=document.getElementById('address1').value;
                    if(checkadl1.test(adl1))
                    {
                        document.getElementById("submit-button").disabled = false;
                        document.getElementById('alt8').innerHTML =" ";
                        
                    }
                    else
                    {
                        document.getElementById("submit-button").disabled = true;
                        document.getElementById('alt8').innerHTML ="**Address length must be between 5 to 30";
                        return false;
                    }
                });
                
                $("#address2").keyup(function(){
                    var adl2=document.getElementById('address2').value;
                    if(checkadl2.test(adl2))
                    {
                        document.getElementById("submit-button").disabled = false;
                        document.getElementById('alt9').innerHTML =" ";
                        
                    }
                    else
                    {   
                        document.getElementById("submit-button").disabled = true;
                        document.getElementById('alt9').innerHTML ="**Address length must be between 5 to 30";
                        return false;
                    }
                });
                
                $("#addressCity").keyup(function(){
                    var city=document.getElementById('addressCity').value;
                    if(city=="")
                    {
                        document.getElementById("submit-button").disabled = true;
                        document.getElementById('alt10').innerHTML ="**Please select your city";
                        return false;
                    }
                    else{
                        document.getElementById("submit-button").disabled = false;
                        document.getElementById('alt10').innerHTML =" ";
                    }
                });
                
                $("#addressState").keyup(function(){
                    var state=document.getElementById('addressState').value;
                    if(state=="")
                    {
                        document.getElementById("submit-button").disabled = true;
                        document.getElementById('alt11').innerHTML ="**Please select your state";
                        return false;
                    }
                    else{
                        document.getElementById("submit-button").disabled = false;
                        document.getElementById('alt11').innerHTML =" ";
                    }
                });
                
                $("#addressPIN").keyup(function(){
                    var pincode=document.getElementById('addressPIN').value;
                    if(checkpincode.test(pincode))
                    {
                        document.getElementById("submit-button").disabled = false;
                        document.getElementById('alt12').innerHTML =" ";
                        
                    }
                    else
                    {
                        document.getElementById("submit-button").disabled = true;
                        document.getElementById('alt12').innerHTML ="**Please enter proper pincode";
                        return false;
                    }
                });
                
        }); -->
        </script>
    </body>
</html>
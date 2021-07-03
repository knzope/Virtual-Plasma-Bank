
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
                border-radius: 5px;
                /* height:400px; */
            }
            .c1:hover{
                box-shadow: 0px 0px 10px 0.5px rgba(0, 0, 0, 0.521);
            }
        </style>
    </head>
    <body>
        <!-- <div class="Header" id="individualRegistrationHeader">
            <h1>Individual Registration Form</h1>
        </div> -->
        <!-- <hr> -->
        <!-- <div class="jumbotron text-center"><h1>Individual Registration Form</h1></div>
        <nav class="Footer" id=individualRegistrationFooter>
            <a href="index.html"><div class="button">Home</div></a>
            <a href="about.html"><div class="button">Contact</div></a>
            <a href="diagnosis.html"><div class="button">Diagnosis</div></a>
        </nav> -->

<?php
       $msgemailerr="";
       $msgpasserr="";
       if($_SERVER["REQUEST_METHOD"] == "POST")
       {
           require 'database.php';
           require 'user.php';
           $db=new database();
           $user= new user($db->connect());
           $checkemail= "/^[a-zA-Z]([a-zA-Z0-9]{1,8})?(([a-zA-Z0-9]{1,8}[\.\_\-\+]{0,1}){1,5})?([a-zA-Z0-9]{1,4})?[@]{1}([a-zA-Z0-9]{1,10}([\-][a-zA-Z0-9]{2,10})?\.){1,3}[a-zA-Z]{2,8}$/";
           $user->email=$_POST['email'];
           $user->password=$_POST['pass'];
           $user->usertype=$_POST['usertype'];
           if (preg_match($checkemail,$user->email) ){  
              if($user->password==" ")
              {
                $msgpasserr="**Password cannot be empty";
              }
              else
              {
                    if($user->usertype=='individual')
                    {
                        echo $user->login_individual_user();
                    }
                    else
                    {
                        echo $user->login_organizational_user();
                    }
              }
           }
           else{
              $msgemailerr="**Invalid Email";
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
                <li class="nav-item active">
                    <a class="nav-link"  href="login.php">Sign-in</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.php">About Us</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="diagnosis.html">Diagonsis</a>
                </li> -->
                
              </ul>
              
            </div>
          </nav>


          

        <div class="container">
            <h2 class="text-center" style="margin-bottom:-30px;margin-top: 20px;">Login Form</h2>
            <div class="col-lg-6 m-auto d-block">
                <div class="c1">
        <form method="POST" action="login.php" >
            
            
            <div class="form-group">
                <lable for="email">Email Address: </lable> <br>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" required>
                <span id="alt1" class="text-danger font-weight-bold"><?php echo $msgemailerr;?> </span> 
            </div>
            <div class="form-group">
                <label> User Type : </label> <br>
                <input type="radio" id="indi_user" name="usertype" value="individual" required>
                <label for="male">Individual</label>
                <input type="radio" id="org_user" name="usertype" value="organization" required>
                <label for="female">Organization</label>
                
            </div>
            
            <div class="form-group">
                <lable for="pass">Password: </lable> <br>
            <input type="text" class="form-control" id="pass" name="pass" placeholder="Enter password" value="<?php if(isset($_POST['pass'])){echo $_POST['pass'];}?>" required>
            <span id="alt2" class="text-danger font-weight-bold"> <?php echo $msgpasserr;?></span>  
            </div>
            
                
            
            
            
            <div class="form-group">

            <input type="submit" id="submit-button" class="btn btn-primary" value="Login"> 
            <a class="btn btn-link"  href="forgot_password.php" style="font-size: 20px;float: right; position: relative;">Forgot Password?</a>
            </div>
            <div class="form-group">
            <a class="btn btn-link"  href="registration_individual.php" style="padding-top: 0px;  font-size: 20px;float: left; position: relative;">Register as User</a>
            <a class="btn btn-link"  href="registration_organization.php" style=" padding-top: 0px;  font-size: 20px; float: right; position: relative;">Register as Plasma Bank</a>
            <br> </div>
        </form>
</div>
</div>
</div>

        <!-- <hr> -->
        <!-- <nav class="Footer" id=individualRegistrationFooter>
            <a href="index.html"><div class="button">Home</div></a>
            <a href="about.html"><div class="button">Contact</div></a>
            <a href="diagnosis.html"><div class="button">Diagnosis</div></a>
        </nav> -->
    </body>
    <script>
          // $(document).ready(function(){
          //   document.getElementById("submit-button").disabled = true;
                  
          //         var checkemail= /^[a-zA-Z]([a-zA-Z0-9]{1,8})?(([a-zA-Z0-9]{1,8}[\.\_\-\+]{0,1}){1,5})?([a-zA-Z0-9]{1,4})?[@]{1}([a-zA-Z0-9]{1,10}([\-][a-zA-Z0-9]{2,10})?\.){1,3}[a-zA-Z]{2,8}$/;
          //       $("#email").keyup(function(){
          //           var email=document.getElementById('email').value;
          //           if(checkemail.test(email))
          //           {
          //             // document.getElementById("submit-button").disabled = false;
          //               document.getElementById('alt1').innerHTML =" ";
                        
          //           }
          //           else
          //           {
          //             // document.getElementById("submit-button").disabled = true;
          //               document.getElementById('alt1').innerHTML ="**Invalid email";
          //               return false;
          //           }
          //       });
          //       $("#pass").keyup(function(){
          //           var pass=document.getElementById('pass').value;
          //           if(pass=="")
          //           {
          //               // document.getElementById("submit-button").disabled = true;
          //               document.getElementById('alt2').innerHTML ="**Enter your password";
          //               return false;
          //           }
          //           else
          //           {
                      
          //             // document.getElementById("submit-button").disabled = false;
          //               document.getElementById('alt2').innerHTML =" ";
                      
          //           }
          //       });
               
          //       initial();
                
          //       // if(checkemail.test(email)){
          //       //     if(pass=="")
          //       //     {
          //       //       document.getElementById("submit-button").disabled = true;
          //       //     }
          //       //     else
          //       //     {
          //       //       document.getElementById("submit-button").disabled = false;
          //       //     }
          //       // }
                
          //   });
          //   function initial()
          //   { 
          //       var checkemail= /^[a-zA-Z]([a-zA-Z0-9]{1,8})?(([a-zA-Z0-9]{1,8}[\.\_\-\+]{0,1}){1,5})?([a-zA-Z0-9]{1,4})?[@]{1}([a-zA-Z0-9]{1,10}([\-][a-zA-Z0-9]{2,10})?\.){1,3}[a-zA-Z]{2,8}$/;
          //       var email=document.getElementById('email').value;
          //       var pass=document.getElementById('pass').value;
          //       if(checkemail.test(email)){
          //           if(pass=="")
          //           {
          //             document.getElementById("submit-button").disabled = true;
          //           }
          //           else
          //           {
          //             document.getElementById("submit-button").disabled = false;
          //           }
          //       }
          //   }
    </script>
</html>
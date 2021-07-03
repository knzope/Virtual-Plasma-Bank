<html>
    <head>
        <title>Change Password- Virtual Plasma Bank</title>
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
                /* height:250px; */
            }
            .c1:hover{
                box-shadow: 0px 0px 10px 0.5px rgba(0, 0, 0, 0.521);
            }
        </style>
    </head>
    <body>
        <?php
            $passerr=$repasserr="";
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
              $checkpass= "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\!\@\#\$\^\&\*\-\_\.])[a-zA-Z0-9\!\@\#\$\%\^\&\*\-\_\.]{8,16}$/";
              require 'database.php';
              require 'user.php';
              $db=new database();
              $user= new user($db->connect());
              $user->pass=$_POST['pass'];
              $user->repass=$_POST['repass'];
              //$user->token=$_GET['token'];
              if(!preg_match($checkpass,$user->pass))
              {
                  $passerr="For a strong password<br>->password size must be greater than 8 and less than 16<br>->At least one character must be lower case<br>->At least one character must be Upper case<br>->At least one character must be number<br>->At least one character must be special symbol";

              }
              if ($user->pass!=$user->repass){  
                $repasserr="**Password do not match";
              }
              if($passerr=="" && $repasserr=="")
              {
                
                 echo $user->change_pass_individual();
              }
              // if($user->pass==$user->repass)
              // {
              //     echo $user->change_pass_individual();
              // }  
              // else
              // {
              //     echo'<script>alert("Reentered password do not match")</script>';
              //     echo "<script>location.href='change_pass_ind.php?token=$user->token'</script>";
              // }
            }
        ?>


        
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="navbar-brand"><h1><I>PlasmaBank</I></h1></div>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
          
            <!-- <div class="collapse navbar-collapse" id="navbarColor01">
              <ul class="navbar-nav mr-auto"> -->
                
                <!-- <li class="nav-item">
                  <a class="nav-link"  href="index.php">Welcome</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="login.php">Sign-in</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.php">About Us</a>
                </li> -->
                <!-- <li class="nav-item">
                  <a class="nav-link" href="diagnosis.html">Diagonsis</a>
                </li> -->
                 
        <!--     </ul> -->
              <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
              </form> -->
            </div>
          </nav>


          

        <div class="container">
            <h2 class="text-center" style="margin-bottom:-30px;margin-top: 20px;">Change Password</h2>
            <div class="col-lg-6 m-auto d-block">
                <div class="c1">
        <form method="POST" action="change_pass_ind.php" >
        
            
            <div class="form-group">
                <lable for="pass">Password: </lable> <br>
            <input type="text" class="form-control" id="pass" name="pass" placeholder="Enter password" value="<?php if(isset($_POST['pass'])){ echo $_POST['pass'];}?>" required> 
            <span id="alt5" class="text-danger font-weight-bold"><?php echo $passerr;?> </span>  
          </div>
            <div class="form-group">
                <lable for="repass">Password: </lable> <br>
            <input type="text" class="form-control" id="repass" name="repass" placeholder="Reenter password" value="<?php if(isset($_POST['repass'])){ echo $_POST['repass'];}?>" required> 
            <span id="alt5" class="text-danger font-weight-bold"><?php echo $repasserr;?> </span>  
          </div>
            
            <input type="submit" class="btn btn-primary" value="Change password">
            <br>
        </form>
</div>
</div>
</div>
<div class="jumbotron text-center" style="margin-top: 100px;">Footer</div>
        <!-- <hr> -->
        <!-- <nav class="Footer" id=individualRegistrationFooter>
            <a href="index.html"><div class="button">Home</div></a>
            <a href="about.html"><div class="button">Contact</div></a>
            <a href="diagnosis.html"><div class="button">Diagnosis</div></a>
        </nav> -->
    </body>
</html>
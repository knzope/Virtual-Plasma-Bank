<html>
    <head>
        <title>Admin Login - Virtual Plasma Bank</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
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
        p{
          font-size: x-large;
        }
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
    <body>
    <?php
       $usernameerr="";
       $passerr="";
       require 'database.php';
       if($_SERVER["REQUEST_METHOD"] == "POST")
       {
           
           require 'admin_user.php';
           $db=new database();
           $admin= new admin($db->connect());
           $checkusername= "/^[a-zA-Z0-9\.\@\$\_\-\#]{6,16}$/";
            $admin->username=$_POST['username'];
            $admin->password=$_POST['pass'];
           if (preg_match($checkusername,$admin->username) ){  
              if($admin->password==" ")
              {
                $passerr="**Password cannot be empty";
              }
              else
              {
                    echo $admin->admin_login();
              }
           }
           else{
              $usernameerr="**Invalid Username";
           } 
           
           
       }      
 ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="navbar-brand"><h1><i>PlasmaBank</i></h1></div>
            
          
            <div class="collapse navbar-collapse" id="navbarColor01">
              <ul class="navbar-nav mr-auto">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <!-- <li class="nav-item">
                  <a class="nav-link active"  href="plasma_bank_request.php">Bank Requests</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="handler_admnin.php">Logout</a>
                </li> -->
                <!-- <li class="nav-item">
                  <a class="nav-link" href="diagnosis.php">Diagonsis</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="profile_ind.php">Your Profile</a>
                </li> -->
                
              </ul>

             
            </div>
          </nav>

          <div class="container">
            <h2 class="text-center" style="margin-bottom:-30px;margin-top: 20px;">Admin Panel</h2>
            <div class="col-lg-6 m-auto d-block">
                <div class="c1">
        <form method="POST" action="login_admin.php" >
            
            
            <div class="form-group">
                <lable for="username">Username: </lable> <br>
                <input type="text" class="form-control" id="username" name="username" placeholder="User Name" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>" required>
                <span id="alt1" class="text-danger font-weight-bold"><?php echo $usernameerr;?> </span> 
            </div>
            
            
            <div class="form-group">
                <lable for="pass">Password: </lable> <br>
            <input type="text" class="form-control" id="pass" name="pass" placeholder="Enter password" value="<?php if(isset($_POST['pass'])){echo $_POST['pass'];}?>" required>
            <span id="alt2" class="text-danger font-weight-bold"> <?php echo $passerr;?></span>  
            </div>

            <div class="form-group">

            <input type="submit" id="submit-button" class="btn btn-primary" value="Login"> 
            <!-- <a class="btn btn-link"  href="forgot_password.php" style="font-size: 20px;float: right; position: relative;">Forgot Password?</a> -->
            </div>
            
        </form>
</div>
</div>
</div>
       
    </body>
</html>
<html>
    <head>
        <title>Receive Plasma - Virtual Plasma Bank</title>
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
        
        #table{
            margin-top: 10px;
            
        }
        #table th{
                
            font-size: 30px;
            align-items: center;
            justify-content: center; 
            /* padding: 40px 40px; */
            /* margin-top: -30px; */
        }
        #table td{
                
                font-size: 20px;
                align-items: center;
                justify-content: center; 
                /* padding: 40px 40px; */
                /* margin-top: -30px; */
            }
            
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
            .jumbotron{
               margin-top:20px;
            }
    </style>
    <body>
        <?php
                 $rnameerr=$ageerr=$cityerr=$bgrouperr=$fileerr="";
                 if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                      $checkrname= "/^[A-Za-z ]{2,30}$/";
                      $checkage= "/^[0-9]{1,3}$/";
                      require 'database.php';
                      require 'user_ind.php';
                      $db=new database();
                      $user= new user_ind($db->connect());
                      $user->rname=$_POST['rname'];
                      $user->age=$_POST['age'];
                      $user->gender=$_POST['gender'];
                      $user->bgroup=$_POST['bgroup'];
                      $user->city=$_POST['city'];
                      $user->file=$_FILES['file'];
              
                      $user->fileName=$_FILES['file']['name'];
                      $user->fileTmpName=$_FILES['file']['tmp_name'];
                      $user->fileSize=$_FILES['file']['size'];
                      $user->fileError=$_FILES['file']['error'];
                      $user->fileType=$_FILES['file']['type'];
                      
                      if($user->fileError===0){
                          
                          // echo $user->register_organizational_user();
                      }else
                      { 
                            $fileerr="**There was an error uploading your file!";
                          // echo'<script>alert("There was an error uploading your file!")</script>';
                          // echo "<script>location.href='registration_organization.php'</script>";
                      }
                      if (!preg_match($checkrname,$user->rname)){  
                        $rnameerr="**Enter doner name properly";
                      }
                      if($user->age==0)
                        {
                          $ageerr="**Enter age properly";
                        }
                        
                        if (!preg_match($checkage,$user->age)){
                              
                            $ageerr="**Enter age properly";
                        }
                        if ($user->city==""){  
                          $cityerr="**Select your city";
                        }
                        if ($user->bgroup==""){  
                          $bgrouperr="**Select your blood group";
                        }
                        if($rnameerr=="" && $ageerr=="" && $cityerr=="" && $bgrouperr=="" && $fileerr=="")
                        {
                          //Function need to be written in user_ind for entry in databse for user request for receive.
                           echo $user->receive_plasma();
                          // echo'<script>alert("Success.")</script>';
                          // echo "Success";
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
                  <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="profile_ind.php">Your Profile</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="logout.php">Logot</a>
                </li> -->
                
              </ul>

              
            </div>
          </nav>
          
          <div class="container">
            <h2 class="text-center" style="margin-bottom:-30px;margin-top: 20px;">Plasma Receiver Form</h2>
            <div class="col-lg-6 m-auto d-block">
                <div class="c1">
                  <form id="form_register" method="POST" action="receive_plasma.php" enctype="multipart/form-data">
                      <div class="form-group">
                        <lable for="pbname">Receiver Name : </lable> <br>
                        <input type="text" class="form-control" id="rname" name="rname" placeholder="Receiver Name" value="<?php if(isset($_POST['rname'])){echo $_POST['rname'];}?>" required>
                        <span id="alt1" class="text-danger font-weight-bold"> <?php echo $rnameerr;?></span> 
                    </div>
                    
                    <div class="form-group">
                <lable for="age">Age : </lable> <br>
                <input type="number" class="form-control" id="age" name="age" placeholder="Age" value="<?php if(isset($_POST['age'])){echo $_POST['age'];}?>" required>
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
                  <label for="bgroup">Choose Blood Group</label>
                  <select class="form-control"id="bgroup" name="bgroup" required>
                                <option value="<?php if(isset($_POST['bgroup'])){echo $_POST['bgroup'];}?>"><?php if(isset($_POST['bgroup'])){echo $_POST['bgroup'];}else{echo "Select Blood group";}?></option>
                                <option value = "A">A</option>
                                <option value = "B">B</option>
                                <option value = "AB">AB</option>
                                <option value = "O">O</option>
                  </select> 
                  <span id="alt7" class="text-danger font-weight-bold"> <?php echo $bgrouperr;?></span>     
              </div>    
              
            <div class="form-group">
            <label for="city">Choose city</label>
            <select class="form-control"id="city" name="city" required>
                            <option value="<?php if(isset($_POST['city'])){echo $_POST['city'];}?>"><?php if(isset($_POST['city'])){echo $_POST['city'];}else{echo "Select City";}?></option>
                            <option value = "Mumbai">Mumbai</option>
                            <option value = "Pune">Pune</option>
                            <option value = "Surat">Surat</option>
              </select> 
              <span id="alt7" class="text-danger font-weight-bold"> <?php echo $cityerr;?></span>     
              </div>   
              <div class="form-group">
                        <label for="file">File input</label>
                        <input type="file"  name="file" id="file" required>
                        <small id="fileHelp" class="form-text text-muted">Aadhar card/PAN card.<br>Upload jpg/jpeg/png file.</small>
                        <span id="alt9" class="text-danger font-weight-bold"> <?php echo $fileerr;?></span>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" id="submit-button" value="Submit">
              </div>
            </form>
          </div>
          </div>
          </div>
          
    </body>
</html>
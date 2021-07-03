<html>
    <head>
        <title>DIAGNOSIS - Virtual Plasma Bank</title>
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
        
           
    </style>
    <body>
    <?php
        session_start();
        $email=$_SESSION['email'];
        require 'database.php';
        $db=new database();
        $conn=$db->connect();
    ?>
        <!-- <div class="Header" id="diagnosisHeader">
            <h1>Diagnosis</h1>
        </div> -->
        <!-- <hr> -->
        
        
        <!-- <nav class="Footer" id=diagnosisFooter>
            <a href="index.html"><div class="button">Home</div></a>
            <a href="about.html"><div class="button">Contact</div></a>
            <a href="diagnosis.html"><div class="button">Diagnosis</div></a>
        </nav> -->
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
                  <a class="nav-link active" href="profile_ind.php">Your Profile</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="logout.php">Logot</a>
                </li> -->
                
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

        echo "<div class='container' id='i2'>
          <table id='table' class='table table-hover'>
            <tr>
              <th>First Name</th>
              <td id='fname'>$row[fname]</td>
            </tr>
            <tr>
              <th>Last Name</th>
              <td id='lname'>$row[lname]</td>
            </tr>
            <tr>
              <th>Email</th>
              <td id='email'>$row[email]</td>
            </tr>
            <tr>
              <th>Mobile Number</th>
              <td id='phone'>$row[phone]</td>
            </tr>
            <tr>
              <th>Age</th>
              <td id='age'>$row[age]</td>
            </tr>
            <tr>
              <th>Gender</th>
              <td id='gender'>$row[gender]</td>
            </tr>
            <tr>
              <th>Address</th>
              <td id='address'>$row[addressline1]<br>
              $row[addressline2]<br>
              $row[city]<br>
              $row[state]<br>
              $row[pincode]<br></td>
            </tr>
            <tr>
                <th>
                    <a class='btn btn-link'  href='update_ind.php' style='font-size: 20px;'>Update Details</a>
                </th>
                <td>
                </td>
            </tr>
            <tr>
                <th>
                    <a class='btn btn-link'  href='handler_ind.php?req=forgot_pass' style='font-size: 20px;'>Forgot Password?</a>
                </th>
                <td>
                </td>
            </tr>
            <tr>
                <th>
                        <form id='form_register' method='POST' action='handler_ind.php?req=logout'>
                            <input type='submit' class='btn btn-primary' value='LOGOUT'> 
                        </form>
                </th>
                <td>
                <form id='form_register' method='POST' action='handler_ind.php?req=delete_account&token=$row[initialtoken]'>
                  <input type='submit' class='btn btn-danger' value='Delete Account'> 
                </form>
                </td>
            </tr>
            
          </table></div>";
          ?>
          
          <!-- <div class="col-lg-8 m-auto d-block">
          <a class="btn btn-link"  href="login.php" style="font-size: 20px; float: left;">Sign-In</a><br><br>
          <a class="btn btn-link"  href="login.php" style="font-size: 20px; float: left;">Sign-In</a><br><br>
          <form id="form_register" method="POST" action="handler_reg_login.php?req=reg_ind_user">
         <input type="submit" class="btn btn-primary" value="LOGOUT"> 
        </form>
        </div> -->
    </body>
</html>
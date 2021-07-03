<html>
    <head>
        <title>Listings - Virtual Plasma Bank</title>
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
        #s1{
          /* float:left; */
          width: 400px;
          margin-top:10px;
        }
        #table{
            margin-top: 10px;
            
        }
        #table th{
                
            font-size: 30px;
            /* align-items: center;
            justify-content: center;  */
            
        }
        #table td{
                
                font-size: 20px;
                /* align-items: center;
                justify-content: center;   */
                
            }
    </style>
    <body>
        <!-- <div class="Header" id="listingsHeader">
            <h1>Listings</h1>
        </div>
        <hr> -->
        <?php
        require 'database.php';
         session_start();
         $email=$_SESSION['email'];
         //require 'database.php';
         $db=new database();
         $conn=$db->connect();
        
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
              
              $conn1=$db->connect();
              $city=$_POST['addressCity'];
              $sql1="SELECT * FROM organizational_user WHERE city='$city' and approval_status=1;";
              $result1=mysqli_query($conn1,$sql1);
              if($result1==false)
              {
                echo'<script>alert("Error occured. Please try again later.")</script>';
                echo "<script>location.href='home.php'</script>";
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
                  <a class="nav-link active"  href="browse_plasma_bank.php">Browse Plasma Bank</a>
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
            <div class="container" id="s1">
              <form class="form-inline my-2 my-lg-0" method="POST" action="browse_plasma_bank.php">
                <!-- <div class="form-group"> -->
               
                <select class="form-control"id="addressCity" name="addressCity" style="float: left;width:200px;"required>
                      <option value = "<?php if(isset($_POST['addressCity'])){echo $_POST['addressCity'];}else{echo $row['city'];} ?>"><?php if(isset($_POST['addressCity'])){echo $_POST['addressCity'];}else{echo $row['city'];} ?></option>
                      <option value = "Mumbai">Mumbai</option>
                      <option value = "Pune">Pune</option>
                      <option value = "Surat">Surat</option>
                </select>
                <input type="submit" class="btn btn-secondary my-2 my-sm-0" value="Search" style="float: right;margin-left:10px;">
                <!-- </div> -->
              </form>
            </div>
            <div class='container' id='i2'>
            <?php
                  if(isset($_POST['addressCity']))
                  {
                    if(mysqli_num_rows($result1)>0)
                    {
                      
                      while($row1=mysqli_fetch_assoc($result1))
                      {
                         

                          echo "<table id='table' class='table table-hover'>
                            <tr>
                              <th>Bank Name</th>
                              <td id='pbname'>$row1[pbname]</td>
                            </tr>
                            
                            <tr>
                              <th>Email</th>
                              <td id='email'>$row1[email]</td>
                            </tr>
                            <tr>
                              <th>Mobile Number</th>
                              <td id='phone'>$row1[phone]</td>
                            </tr>
                            
                            
                            <tr>
                              <th>Address</th>
                              <td id='address'>$row1[addressline1]<br>
                              $row1[addressline2]<br>
                              $row1[city]<br>
                              $row1[state]<br>
                              $row1[pincode]<br></td>
                            </tr>
                            
                            
                          </table>";
                        }
                    }
                    else{
                      echo "<p><h1 class='text-center'>No plasma bank available in this city.</h1></p>";
                      

                    }
                  }
                  else
                  {
                    $sql1="SELECT * FROM organizational_user WHERE city='$row[city]' and approval_status=1;";
                    $result1=mysqli_query($conn,$sql1);
                    if($result1==false)
                    {
                      echo'<script>alert("Error occured. Please try again later.")</script>';
                      echo "<script>location.href='home.php'</script>";
                    }
                    if(mysqli_num_rows($result1)>0)
                    {
                      
                      while($row1=mysqli_fetch_assoc($result1))
                      {
                         

                          echo "<table id='table' class='table table-hover'>
                            <tr>
                              <th>Bank Name</th>
                              <td id='pbname'>$row1[pbname]</td>
                            </tr>
                            
                            <tr>
                              <th>Email</th>
                              <td id='email'>$row1[email]</td>
                            </tr>
                            <tr>
                              <th>Mobile Number</th>
                              <td id='phone'>$row1[phone]</td>
                            </tr>
                            
                            
                            <tr>
                              <th>Address</th>
                              <td id='address'>$row1[addressline1]<br>
                              $row1[addressline2]<br>
                              $row1[city]<br>
                              $row1[state]<br>
                              $row1[pincode]<br></td>
                            </tr>
                            
                            
                          </table>";
                        }
                    }
                    else{
                      echo "<p><h1 class='text-center'>No plasma bank available in this city.</h1></p>";
                      

                    }
                  }
            ?>
            </div>
        <!-- <div class="featureButton" style="display:inline">(Enter your location)</div>
        <div class="featureButton" style="display:inline">(Detect Location)</div>
        <br>
        
        <div id="listingsMain">
            <aside>Filter Options</aside>
            <section>
                <ol>
                    <li>...</li>
                    <li>...</li>
                    <li>...</li>
                </ol>
            </section>
        </div> -->

        <br>

        <!-- <nav class="Footer" id=listingsFooter>
            <a href="index.html"><div class="button">Home</div></a>
            <a href="about.html"><div class="button">Contact</div></a>
            <a href="diagnosis.html"><div class="button">Diagnosis</div></a>
        </nav> -->
    </body>
</html>
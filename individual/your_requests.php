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
                
            font-size: 20px;
            /* align-items: center;
            justify-content: center;  */
            
        }
        #table td{
                
                font-size: 20px;
                /* align-items: center;
                justify-content: center;   */
                
            }
            #i1{
                margin-top: 10px;
            }
            #s1{
          /* float:left; */
          width: 400px;
          margin-top:10px;
          padding-left: 60px;
        }
           
    </style>
    <body>
         <?php
              require 'database.php';
              $db=new database();
              $conn=$db->connect();
              session_start();
              $email=$_SESSION['email'];
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
                  <a class="nav-link active" href="your_requests.php">Your Requests</a>
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
          <div class="container text-center" id="i1">
          <a href='donate_plasma.php'><input type='button' class='btn btn-primary' style="width: 200px;" value='Donate Plasma'></a>
          <a href='receive_plasma.php'><input type='button' class='btn btn-primary' style="width: 200px;" value='Recieve Plasma'></a>
        </div>
        <div class="container" id="s1">
              <form class="form-inline my-2 my-lg-0" method="POST" action="your_requests.php">
                <!-- <div class="form-group"> -->
               
                <select class="form-control"id="requesttype" name="requesttype" style="float: left;width:200px;"required>
                      <option value = "Select filter options">Select filter options</option>
                      <option value = "All requests">All requests</option>
                      <option value = "Donar requests">Donar requests</option>
                      <option value = "Receiver requests">Receiver requests</option>
                      
                      
                </select>
                <input type="submit" class="btn btn-secondary my-2 my-sm-0" value="Search" style="float: right;margin-left:10px;">
                <!-- </div> -->
              </form>
            </div>
            <div class='container' id='i2'>
            <?php
                  
                  if(isset($_POST['requesttype']))
                  {
                    if($_POST['requesttype']=='All requests')
                    { 
                      $sql="SELECT * FROM donar_requests where user_email='$email' and allotment_status=0;";
                      $result=mysqli_query($conn,$sql);
                      if(mysqli_num_rows($result)>0)
                      {
                        while($row=mysqli_fetch_assoc($result))
                        {
                          echo "<table id='table' class='table table-hover table-bordered'>
                          <tr>
                          <th>Donar Details</th>
                          <td id='dname'>Name: $row[donar_name]<br>
                          Age: $row[donar_age]<br>
                          Gender: $row[donar_gender]<br>
                          Blood Group: $row[donar_bgroup]<br>
                          City: $row[donar_city]<br>
                          </td>
                        </tr>
                            
                            
                            
                          </table>";
                        }
                      }
                      
                      $sql="SELECT * FROM receiver_requests where user_email='$email' and allotment_status=0;";
                      $result=mysqli_query($conn,$sql);
                      if(mysqli_num_rows($result)>0)
                      {
                        while($row=mysqli_fetch_assoc($result))
                        {
                          echo "<table id='table' class='table table-hover table-bordered'>
                          <tr>
                          <th>Receiver Details</th>
                          <td id='dname'>Name: $row[receiver_name]<br>
                          Age: $row[receiver_age]<br>
                          Gender: $row[receiver_gender]<br>
                          Blood Group: $row[receiver_bgroup]<br>
                          City: $row[receiver_city]<br>
                          </td>
                          </tr>
                            
                            
                            
                            
                          </table>";
                        }
                      }
                      else
                      {
                        
                        echo "<script>location.href='your_requests.php'</script>";
                      }
                    }
                    else if($_POST['requesttype']=='Donar requests')
                    {

                      $sql="SELECT * FROM donar_requests where user_email='$email' and allotment_status=0;";
                      $result=mysqli_query($conn,$sql);
                      if(mysqli_num_rows($result)>0)
                      {
                        while($row=mysqli_fetch_assoc($result))
                        {
                          echo "<table id='table' class='table table-hover table-bordered'>
                          <tr>
                                <th>Donar Details</th>
                                <td id='dname'>Name: $row[donar_name]<br>
                                Age: $row[donar_age]<br>
                                Gender: $row[donar_gender]<br>
                                Blood Group: $row[donar_bgroup]<br>
                                City: $row[donar_city]<br>
                                </td>
                              </tr>  
                          
                            
                            
                            
                            
                          </table>";
                        }
                      }
                      else
                      {
                        
                        echo "<div class='container' id='i2'><p><h1 class='text-center'>You have no donar requests.</h1></p></div>";
                      }
                    }
                    else if($_POST['requesttype']=='Receiver requests')
                    {
                      $sql="SELECT * FROM receiver_requests where user_email='$email' and allotment_status=0;";
                      $result=mysqli_query($conn,$sql);
                      if(mysqli_num_rows($result)>0)
                      {
                        while($row=mysqli_fetch_assoc($result))
                        {
                          echo "<table id='table' class='table table-hover table-bordered'>
                          <tr>
                          <th>Receiver Details</th>
                          <td id='dname'>Name: $row[receiver_name]<br>
                          Age: $row[receiver_age]<br>
                          Gender: $row[receiver_gender]<br>
                          Blood Group: $row[receiver_bgroup]<br>
                          City: $row[receiver_city]<br>
                          </td>
                          </tr>
                            
                            
                            
                            
                          </table>";
                        }
                      }
                      else
                      {
                        
                        echo "<div class='container' id='i2'><p><h1 class='text-center'>You have no receiver requests.</h1></p></div>";
                      }
                    }
                    
                  }
                  else
                    {
                      $sql="SELECT * FROM donar_requests where user_email='$email' and allotment_status=0;";
                      $result=mysqli_query($conn,$sql);
                      if(mysqli_num_rows($result)>0)
                      {
                        while($row=mysqli_fetch_assoc($result))
                        {
                          echo "<table id='table' class='table table-hover table-bordered'>
                          <tr>
                          <th>Donar Details</th>
                          <td id='dname'>Name: $row[donar_name]<br>
                          Age: $row[donar_age]<br>
                          Gender: $row[donar_gender]<br>
                          Blood Group: $row[donar_bgroup]<br>
                          City: $row[donar_city]<br>
                          </td>
                        </tr>
                            
                            
                            
                            
                          </table>";
                        }
                      }
                      else
                      {
                        
                        echo "<div class='container' id='i2'><p><h1 class='text-center'>You have no donar requests.</h1></p></div>";
                        
                      }
                      $sql="SELECT * FROM receiver_requests where user_email='$email' and allotment_status=0;";
                      $result=mysqli_query($conn,$sql);
                      if(mysqli_num_rows($result)>0)
                      {
                        while($row=mysqli_fetch_assoc($result))
                        {
                          echo "<table id='table' class='table table-hover table-bordered'>
                          <tr>
                          <th>Receiver Details</th>
                          <td id='dname'>Name: $row[receiver_name]<br>
                          Age: $row[receiver_age]<br>
                          Gender: $row[receiver_gender]<br>
                          Blood Group: $row[receiver_bgroup]<br>
                          City: $row[receiver_city]<br>
                          </td>
                          </tr>
                            
                            
                            
                            
                          </table>";
                        }
                      }
                      else
                      {
                        echo "<div class='container' id='i2'><p><h1 class='text-center'>You have no receiver requests.</h1></p></div>";

                        
                        
                      }
                    }
            ?>
          </div>
    </body>
</html>
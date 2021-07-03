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
            #table{
            margin-top: 10px;
            
        }
        #table th{
                
            font-size: 20px;
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
                  <a class="nav-link"  href="donar_appointment.php">Donar Requests</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"  href="receiver_appointment.php">Receiver Requests</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active"  href="upcoming_appointments.php">Upcoming Appointments</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="profile_org.php">Your Profile</a>
                </li>
                
                
                
              </ul>
              
              
            </div>
          </nav>
          <div class="container" id="s1">
              <form class="form-inline my-2 my-lg-0" method="POST" action="upcoming_appointments.php">
                <!-- <div class="form-group"> -->
               
                <select class="form-control"id="requesttype" name="requesttype" style="float: left;width:200px;"required>
                      <option value = "Select filter options">Select filter options</option>
                      <option value = "All upcoming appointments">All upcoming appointments</option>
                      <option value = "Donar upcoming appointments">Donar upcoming appointments</option>
                      <option value = "Receiver upcoming appointments">Receiver upcoimg appointments</option>
                      
                      
                </select>
                <input type="submit" class="btn btn-secondary my-2 my-sm-0" value="Search" style="float: right;margin-left:10px;">
                <!-- </div> -->
              </form>
            </div>
            <div class='container' id='i2'>
          <?php
                $date=date("Y-m-d");
                $time=date("H:i");
                if(isset($_POST['requesttype']))
                  {

                    if($_POST['requesttype']=='All upcoming appointments')
                    {
                        // $sql="SELECT * FROM donar_appointments where bank_email='$email';";
                        // $result=mysqli_query($conn,$sql);
                        // $i=0;
                        // if(mysqli_num_rows($result)>0)
                        // {
                            
                        //     while($row=mysqli_fetch_assoc($result))
                        //     {
                        //             if($row['date']>$date)
                        //             {   
                        //                 $sql1="SELECT * FROM donar_requests where donar_id='$row[donar_id]';";
                        //                 $result1=mysqli_query($conn,$sql1);
                        //                 $row1=mysqli_fetch_assoc($result1);
                        //                 $i=$i+1;
                        //                 echo "<table id='table' class='table table-hover table-bordered'>
                        //                     <tr>
                        //                     <th>Donar Details</th>
                        //                     <td id='dname'>Name: $row1[donar_name]<br>
                        //                     Age: $row1[donar_age]<br>
                        //                     Gender: $row1[donar_gender]<br>
                        //                     Blood Group: $row1[donar_bgroup]<br>
                        //                     Email: $row1[user_email]<br>
                        //                     Mobile No.: $row1[user_phone]<br>
                        //                     City: $row1[donar_city]<br>
                        //                     </td>
                        //                     </tr>
                                                
                        //                     <tr>
                        //                     <th>Appoitment timing</th>
                        //                     <td>
                        //                     Date: $row[date]<br>
                        //                     Time: $row[time]<br>
                        //                     </td>
                        //                     </tr> 
                                                
                        //                     </table>";
                        //             }
                        //     }

                        // }
                        
                        // $sql="SELECT * FROM receiver_appointments where bank_email='$email';";
                        // $result=mysqli_query($conn,$sql);
                        // $j=0;
                        // if(mysqli_num_rows($result)>0)
                        // {
                           
                        //     while($row=mysqli_fetch_assoc($result))
                        //     {
                        //             if($row['date']>$date)
                        //             {   
                        //                 $sql1="SELECT * FROM receiver_requests where receiver_id='$row[receiver_id]';";
                        //                 $result1=mysqli_query($conn,$sql1);
                        //                 $row1=mysqli_fetch_assoc($result1);
                        //                 $j=$j+1;
                        //                 echo "<table id='table' class='table table-hover table-bordered'>
                        //                     <tr>
                        //                     <th>Receiver Details</th>
                        //                     <td id='dname'>Name: $row1[receiver_name]<br>
                        //                     Age: $row1[receiver_age]<br>
                        //                     Gender: $row1[receiver_gender]<br>
                        //                     Blood Group: $row1[receiver_bgroup]<br>
                        //                     Email: $row1[user_email]<br>
                        //                     Mobile No.: $row1[user_phone]<br>
                        //                     City: $row1[receiver_city]<br>
                        //                     </td>
                        //                     </tr>
                                                
                        //                     <tr>
                        //                     <th>Appoitment timing</th>
                        //                     <td>
                        //                     Date: $row[date]<br>
                        //                     Time: $row[time]<br>
                        //                     </td>
                        //                     </tr> 
                                                
                        //                     </table>";
                        //             }
                        //     }

                        // }
                        
                        // if($i==0 && $j==0)
                        // {
                            echo "<script>location.href='upcoming_appointments.php'</script>";
                        // }
                    }
                    else if($_POST['requesttype']=='Donar upcoming appointments')
                    {
                        $sql="SELECT * FROM donar_appointments where bank_email='$email';";
                        $result=mysqli_query($conn,$sql);
                        $i=0;
                        if(mysqli_num_rows($result)>0)
                        {
                            
                            while($row=mysqli_fetch_assoc($result))
                            {
                                    if($row['date']>$date)
                                    {   
                                        $sql1="SELECT * FROM donar_requests where donar_id='$row[donar_id]';";
                                        $result1=mysqli_query($conn,$sql1);
                                        $row1=mysqli_fetch_assoc($result1);
                                        $i=$i+1;
                                        echo "<table id='table' class='table table-hover table-bordered'>
                                            <tr>
                                            <th>Donar Details</th>
                                            <td id='dname'>Name: $row1[donar_name]<br>
                                            Age: $row1[donar_age]<br>
                                            Gender: $row1[donar_gender]<br>
                                            Blood Group: $row1[donar_bgroup]<br>
                                            Email: $row1[user_email]<br>
                                            Mobile No.: $row1[user_phone]<br>
                                            City: $row1[donar_city]<br>
                                            </td>
                                            </tr>
                                                
                                            <tr>
                                            <th>Appoitment timing</th>
                                            <td>
                                            Date: $row[date]<br>
                                            Time: $row[time]<br>
                                            </td>
                                            </tr> 
                                                
                                            </table>";
                                    }
                            }

                        }
                        if($i==0)
                        {
                            
                          echo "<div class='container' id='i2'><p><h1 class='text-center'>There are no upcoming donar requests.</h1></p></div>";
                        }
                    }
                    else if($_POST['requesttype']=='Receiver upcoming appointments')
                    {
                        $sql="SELECT * FROM receiver_appointments where bank_email='$email';";
                        $result=mysqli_query($conn,$sql);
                        $i=0;
                        if(mysqli_num_rows($result)>0)
                        {
                            
                            while($row=mysqli_fetch_assoc($result))
                            {
                                    if($row['date']>$date)
                                    {   
                                        $sql1="SELECT * FROM receiver_requests where receiver_id='$row[receiver_id]';";
                                        $result1=mysqli_query($conn,$sql1);
                                        $row1=mysqli_fetch_assoc($result1);
                                        $i=$i+1;
                                        echo "<table id='table' class='table table-hover table-bordered'>
                                            <tr>
                                            <th>Receiver Details</th>
                                            <td id='dname'>Name: $row1[receiver_name]<br>
                                            Age: $row1[receiver_age]<br>
                                            Gender: $row1[receiver_gender]<br>
                                            Blood Group: $row1[receiver_bgroup]<br>
                                            Email: $row1[user_email]<br>
                                            Mobile No.: $row1[user_phone]<br>
                                            City: $row1[receiver_city]<br>
                                            </td>
                                            </tr>
                                                
                                            <tr>
                                            <th>Appoitment timing</th>
                                            <td>
                                            Date: $row[date]<br>
                                            Time: $row[time]<br>
                                            </td>
                                            </tr> 
                                                
                                            </table>";
                                    }
                            }

                        }
                        if($i==0)
                        {
                            
                          echo "<div class='container' id='i2'><p><h1 class='text-center'>There are no upcoming receiver requests.</h1></p></div>";
                        }
                    }
                  }
                  else
                  {
                      $sql="SELECT * FROM donar_appointments where bank_email='$email';";
                      $result=mysqli_query($conn,$sql);
                      $i=0;
                      if(mysqli_num_rows($result)>0)
                      {
                          
                          while($row=mysqli_fetch_assoc($result))
                          {
                                if($row['date']>$date)
                                {   
                                    $sql1="SELECT * FROM donar_requests where donar_id='$row[donar_id]';";
                                    $result1=mysqli_query($conn,$sql1);
                                    $row1=mysqli_fetch_assoc($result1);
                                    $i=$i+1;
                                    echo "<table id='table' class='table table-hover table-bordered'>
                                        <tr>
                                        <th>Donar Details</th>
                                        <td id='dname'>Name: $row1[donar_name]<br>
                                        Age: $row1[donar_age]<br>
                                        Gender: $row1[donar_gender]<br>
                                        Blood Group: $row1[donar_bgroup]<br>
                                        Email: $row1[user_email]<br>
                                            Mobile No.: $row1[user_phone]<br>
                                        City: $row1[donar_city]<br>
                                        </td>
                                        </tr>
                                            
                                           <tr>
                                           <th>Appoitment timing</th>
                                           <td>
                                           Date: $row[date]<br>
                                           Time: $row[time]<br>
                                           </td>
                                           </tr> 
                                            
                                        </table>";
                                }
                          }

                      }
                      if($i==0)
                      {
                        echo "<div class='container' id='i2'><p><h1 class='text-center'>There are no upcoming donar requests.</h1></p></div>";

                        // echo'<script>alert("There are no upcoming donar requests.")</script>';
                      }
                      $sql="SELECT * FROM receiver_appointments where bank_email='$email';";
                      $result=mysqli_query($conn,$sql);
                      $i=0;
                      if(mysqli_num_rows($result)>0)
                      {
                          
                          while($row=mysqli_fetch_assoc($result))
                          {
                                if($row['date']>$date)
                                {   
                                    $sql1="SELECT * FROM receiver_requests where receiver_id='$row[receiver_id]';";
                                    $result1=mysqli_query($conn,$sql1);
                                    $row1=mysqli_fetch_assoc($result1);
                                    $i=$i+1;
                                    echo "<table id='table' class='table table-hover table-bordered'>
                                        <tr>
                                        <th>Receiver Details</th>
                                        <td id='dname'>Name: $row1[receiver_name]<br>
                                        Age: $row1[receiver_age]<br>
                                        Gender: $row1[receiver_gender]<br>
                                        Blood Group: $row1[receiver_bgroup]<br>
                                        Email: $row1[user_email]<br>
                                            Mobile No.: $row1[user_phone]<br>
                                        City: $row1[receiver_city]<br>
                                        </td>
                                        </tr>
                                            
                                           <tr>
                                           <th>Appoitment timing</th>
                                           <td>
                                           Date: $row[date]<br>
                                           Time: $row[time]<br>
                                           </td>
                                           </tr> 
                                            
                                        </table>";
                                }
                          }

                      }
                      if($i==0)
                      {
                        echo "<div class='container' id='i2'><p><h1 class='text-center'>There are no upcoming receiver requests.</h1></p></div>";

                        // echo'<script>alert("There are no upcoming receiver appointments.")</script>';
                        
                      }
                  }

            ?>
          
          </div>
    </body>
</html>
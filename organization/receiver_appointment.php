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
                  <a class="nav-link active"  href="receiver_appointment.php">Receiver Requests</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"  href="upcoming_appointments.php">Upcoming Appointments</a>
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
          <?php
                
                $sql1="SELECT * FROM organizational_user WHERE email='$email';";
                $result1=mysqli_query($conn,$sql1);
                $row1=mysqli_fetch_assoc($result1);
                $city=$row1['city'];
                $sql="SELECT * FROM receiver_requests WHERE allotment_status=0 and receiver_city='$city';";
                $result=mysqli_query($conn,$sql);
                if($result==true)
                {
                    if(mysqli_num_rows($result)>0)
                    {
                        echo "<div class='container' id='i2'>";
                        while($row=mysqli_fetch_assoc($result))
                        {   
                            echo "<table id='table' class='table table-hover'>
                            <tr>
                                  <th>Receiver Details</th>
                                  <td id='dname'>Name: $row[receiver_name]<br>
                                  Age: $row[receiver_age]<br>
                                  Gender: $row[receiver_gender]<br>
                                  Blood Group: $row[receiver_bgroup]<br>
                                  Email: $row[user_email]<br>
                                  Mobile No.: $row[user_phone]<br>
                                  City: $row[receiver_city]<br>
                                  </td>
                                  </tr>
                            
                            <form id='form_register' method='POST' action='handler_org.php?req=allot_receiver&token=$row[token]'>
                            <tr>
                              <th>Date</th><td><input type='date'name='date' class='form-control' placeholder='choose date' required></td>
                            </tr>
                            <tr>
                              <th>Time</th><td><input type='time' name='time' class='form-control' placeholder='choose time' required></td>
                            </tr>
                            <tr>
                            <th>
                            <input type='submit' class='btn btn-primary' value='Approve'>
                            </th><td></td>
                            <tr>
                            
                                  
                            </form>

                            
                            </table>";
                        }
                        echo "</div>";
                    }
                    else
                    {
                      echo "<div class='container' id='i2'><p><h1 class='text-center'>No Receiver Requests.</h1></p></div>";
                    }
                }
                else
                {
                  echo "<div class='container' id='i2'><p><h1 class='text-center'>Error Occured Please try again later.</h1></p></div>";
                }

            ?>
          
       
    </body>
</html>
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="navbar-brand"><h1><I>PlasmaBank</I></h1></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarColor01">
              <ul class="navbar-nav mr-auto">
                
              <li class="nav-item">
                  <a class="nav-link"  href="plasma_bank_request.php">Bank Requests</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active"  href="donar_request.php">Donar Requests</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"  href="receiver_request.php">Receiver Requests</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"  href="search_users.php">Manage Users</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"  href="search_plasmabank.php">Manage Plasma Banks</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="handler_admin.php?req=logout">Logout</a>
                </li>
                
              </ul>
              
              
            </div>
          </nav>
        
          <?php
                require 'database.php';
                $db=new database();
                $conn=$db->connect();
                $sql="SELECT * FROM donar_requests WHERE request_status=0;";
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
                            <th>Donar Details</th>
                            <td>
                            Name: $row[donar_name]<br>
                                Age: $row[donar_age]<br>
                                Gender: $row[donar_gender]<br>
                                Blood Group: $row[donar_bgroup]<br>
                                Email: $row[user_email]<br>
                                Mobile No.: $row[user_phone]<br>
                                City: $row[donar_city]<br>
                            </td>
                            <tr>
                            <th>Medical history</th>
                            <td>
                            1. Do you have weight less than 50?<br>
                            Ans.: $row[donar_q1]<br>
                            2. Do you women who have ever been pregnent?<br>
                            Ans.: $row[donar_q2]<br>
                            3. Do you have diabetes?<br>
                            Ans.: $row[donar_q3]<br>
                            4. Do you have B.P. more than 140?<br>
                            Ans.: $row[donar_q4]<br>
                            5. Are you a cancer survivor?<br>
                            Ans.: $row[donar_q5]<br>
                            6. Do you have Chronic kidney/heart/lung or liver disease?<br>
                            Ans.: $row[donar_q6]<br>
                            </td>
                            </tr>
                            
                            <tr>
                                <div class='container text-center'>
                                    <img class='img-thumbnail' alt='Responsive image' src='../individual/donar_aadhar_PAN_card/$row[donar_proof]'>
                                </div>
                            </tr>
                            <tr>
                            <td><a href='handler_admin.php?req=donar_id_reject&token=$row[token]'><input type='button' class='btn btn-danger' value='Invalid ID'></a></td>
                            <td><a href='handler_admin.php?req=donar_noteligible_reject&token=$row[token]'><input type='button' class='btn btn-danger' value='Not eligible'></a></td>
                            </tr>
                            <tr>
                              <td><a href='handler_admin.php?req=donar_approve&token=$row[token]'><input type='button' class='btn btn-primary' value='Approve'></a></td>
                            </tr>
                            </table>";
                        }
                        echo "</div>";
                    }
                    else
                    {
                      echo "<div class='container' id='i2'><p><h1 class='text-center'>No Donar Requests.</h1></p></div>";
                    }
                }
                else
                {
                  echo "<div class='container' id='i2'><p><h1 class='text-center'>Error Occured Please try again later.</h1></p></div>";
                }

            ?>
          
       
    </body>
</html>
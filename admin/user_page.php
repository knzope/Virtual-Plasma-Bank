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
            
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="navbar-brand"><h1><I>PlasmaBank</I></h1></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarColor01">
              <ul class="navbar-nav mr-auto">
                
              <li class="nav-item">
                  <a class="nav-link active"  href="plasma_bank_request.php">Bank Requests</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"  href="donar_request.php">Donar Requests</a>
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
          
             <script src="jquery-3.5.1.min.js"></script>
             
            <?php
                    require 'database.php';
                    
                    $db=new database();
                    $conn=$db->connect();
                    $token=$_GET['token'];
                    $sql="SELECT * FROM individual_user where initialtoken='$token';";
                    $result=mysqli_query($conn,$sql);
                    if($result==true)
                    {
                        $row=mysqli_fetch_assoc($result);
                        echo "<div class='container' id='i2'>";

                            echo "<table id='table' class='table table-hover'>
                                <tr>
                                    <th>Name</th>
                                    <td>
                                        <a href='user_page.php?token=$row[initialtoken]'>$row[fname] $row[lname]</a>  
                                    </td>
                                </tr>
                                <tr>
                                    <th>Age</th>
                                    <td>
                                        $row[age]<br>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>
                                        $row[gender]<br>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Contact Details</th>
                                    <td>
                                        Email: $row[email]<br>
                                        Mobile No.: $row[phone]
                                    </td>
                                </tr>
                                
                                <tr>
                                <th>Address</th>
                                <td>
                                    $row[addressline1]<br>
                                    $row[addressline2]<br>
                                    $row[city]<br>
                                    $row[state]<br>
                                    $row[pincode]<br></td>
                                </td>
                            </tr>            
                            <tr>
                                <td><a href='handler_admin.php?req=delete_user&token=$row[initialtoken]'><input type='button' class='btn btn-danger' value='Delete'></a></td>
                                <td><a href='search_users.php'><input type='button' class='btn btn-primary' value='Back'></a></td>
 
                            </tr>            
                                            
                                            
                            </table>";
                                    
                        echo "</div>";
                    }
                    else
                    {
                        echo "<div class='container' id='i2'><p><h1 class='text-center'>Error Occured Please try again later.</h1></p></div>";

                    }
                    
                    

                            
            ?>
                
          
          
       
    </body>
</html>
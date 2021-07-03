<html>
    <head>
        <title>HOME - Virtual Plasma Bank</title>
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
      /* .img-thumbnail{
        height:400px;
        
        
      } */
      #container1{
        margin-top: 20px;
        margin-bottom: 20px;
        /* margin-left: 20px; */
      }
      #btn-register-individual{
        width:340px;
        font-size: 20px;
        /* margin-left: 5%;
        font-size: 20px;
        margin-top:-350px; */
        
      } 
      /* #btn-register-individual a:link {
        text-decoration: none;
        color: none;
      }

      #btn-register-individual a:visited {
        text-decoration: none;
        color: none;
      }

      #btn-register-individual a:hover {
        text-decoration: none;
        color: white;
      }

      #btn-register-individual a:active {
        text-decoration: none;
        color: none;
      } */
      #btn-register-organization{
        width:350px;
        font-size: 20px;
        /* margin-left: 87%;
        font-size: 20px;
        margin-top:-397px; */
        
      }
      #initial-para{
        width:80%;
        margin-top: 10px;
        font-size: 20px;
        
       
        font-family: 'Times New Roman', Times, serif;
      }
      .list-group{
        font-size: 20px;
      } 
    </style>
    <body>
        <!-- <div class="Header" id="homeHeader">
            <h1>HOME</h1>
        </div>
        <hr> -->

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="navbar-brand"><h1><I>PlasmaBank</I></h1></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarColor01">
              <ul class="navbar-nav mr-auto">
                
                <li class="nav-item active">
                  <a class="nav-link"  href="index.php">Welcome</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link"  href="login.php">Sign-in</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.php">About Us</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="diagnosis.html">Diagonsis</a>
                </li> -->
                
              </ul>
              
              
            </div>
          </nav>
          
          <div class="container text-center" id="container1">
           
          
          <button type="button" id="btn-register-individual" class="btn btn-outline-primary" onclick="window.location.href='registration_individual.php'">Register as User</button>
          <button type="button" id="btn-register-organization" class="btn btn-outline-primary" onclick="window.location.href='registration_organization.php'">Register as Plasma Bank</button>
        </div>

        <div class="container text-center">
          <!-- <img src="plasma-donation.jpg" class="img-thumbnail" alt="Responsive image"> -->
          <img src="donating plasama.jpg" class="img-thumbnail" alt="Responsive image">
        </div>
        
        <div class="container text-center" id="initial-para">
          <p>
            &nbsp&nbsp&nbsp&nbsp Do you know about convalescent plasma, which is taken from a person who has been cured of corona infection. In short, it may be a promising alternative in the treatment of plasma COVID-19 disease.

          </p><p>&nbsp&nbsp&nbsp&nbsp If you have ever been infected with corona and have become corona negative after infection, you have been treated for 14 days and you are feeling healthy then only you are eligible to donate Convalescent Plasma.

        </p><p>&nbsp&nbsp&nbsp&nbsp By becoming a plasma donor, with your priceless plasma, you can give a new hope of life to the corona patient!

</p><p> &nbsp&nbsp&nbsp&nbsp Thank you.
          </p>
        </div>
        <br>
        <div class="container text-center jumbotron">
          <h2>Donor ineligible for convalescent plasma donation</h2>
          <ol class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Weight less than 50 kg
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Females who have ever been pregnant              
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Diabetic on insulin              
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              B.P more than 140 and diastolic less than 60 or more than 90   
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Uncontrolled diabetes or hypertension with change in medication in last 28 days
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Cancer Survivor  
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              Chronic kidney/heart/lung or liver disease.
            </li>
          </ol>
        </div>
        
                
        
    </body>
</html>
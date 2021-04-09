<?php
  session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <title>Login</title>
    <style>

        * {
    }
    body {
		background-size: cover;
    }
/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid white;
  box-sizing: border-box;
  font-family: 'Press Start 2P', cursive;

}

/* Set a style for all buttons */
button {
  background-color: purple;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}
label{
    color: white;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 30%;
  border-radius: 50%;
}

.container {
    top: 100px;
  padding: 16px;
  width:700px;
  margin:0 auto;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 900px) {
    body{
        background-size: cover;
    }
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
        </style>
  </head>
  <body>
    <?php
      if (isset($_POST['submit']))
      {
        require 'config.inc.php';

        $gebruikersnaam = $_POST['Gebruikersnaam'];
        $wachtwoord = $_POST['Wachtwoord'];

        $username = $gebruikersnaam;
        $username = mysqli_real_escape_string($mysqli,$username);

        $password = $wachtwoord;
        $password = mysqli_real_escape_string($mysqli,$password);



            $query = "SELECT * FROM admins WHERE
                       username = '$username' AND password = '$password'";

            //check connectie met de database en voer de query uit
            $resultaat = mysqli_query($mysqli, $query);
       

        if (!$resultaat) {
            printf("Error: %s\n", mysqli_error($mysqli));
            exit();
        }

        if (mysqli_num_rows($resultaat) > 0)
        {
              //pakt de user uit de database
              $gebruiker = mysqli_fetch_array($resultaat);
              //koppelt de session aan de gebruikersnaam
              $_SESSION['level'] = $gebruiker['level'];
              $_SESSION['ID'] = $gebruiker['ID'];
              $_SESSION['username'] = $gebruiker['username'];
              header("Location: index.php");
        } else
        {
          echo "<p>Naam en/of wachtwoord zijn onjuist ingevoerd!</p>";
          echo "<p><a href='index.php'>ga terug</a></p>";
        }
      } else
      {
     ?>
     <div class="container">
<form action="" method="post">
  <div class="imgcontainer">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="Gebruikersnaam" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="Wachtwoord" required>
        
    <button type="submit" name="submit" value="login">Login</button>
        <a href="index.php"><--</a>
  </div>


</form>
</div>
    <?php
      }
     ?>
  </body>
</html>
<?php
      session_start();
      require 'config.inc.php';

      if (isset($_SESSION['token']) && $_SESSION['token'] == $_POST['csrf_token'])
      {
        if (isset($_POST['submit']))
        {

          $gebruikersnaam = $_POST['Gebruikersnaam'];
          $wachtwoord = $_POST['Wachtwoord'];

          $username = $gebruikersnaam;
          $username = mysqli_real_escape_string($mysqli,$username);

          $password = $wachtwoord;
          $password = mysqli_real_escape_string($mysqli,$password);

          if (empty($password) || empty($username))
          {
            echo "<p>Naam en/of wachtwoord zijn niet ingevoerd!</p>";
            echo "<p><a href='index.php'>ga terug</a></p>";
          }

              $query = "SELECT * FROM `account` WHERE Gebruikersnaam = '$username' AND Wachtwoord = '$password'";

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
                $_SESSION['username'] = $gebruiker['Gebruikersnaam'];
                $_SESSION['ID'] = $gebruiker['Gebruiker_ID'];
                $_SESSION['level'] = $gebruiker['Level'];
                $_SESSION['loggedin'] = true;
                header("Location: ../seizoen.php");
          } else
          {
            echo "<p>Naam en/of wachtwoord zijn onjuist ingevoerd!</p>";
            echo "<p><a href='index.php'>ga terug</a></p>";
          }
        }
      } else
      {
        echo "<p>CSRF token is onjuist ingevoerd!</p>";
        echo "<p><a href='index.php'>ga terug</a></p>";
      }
     ?>

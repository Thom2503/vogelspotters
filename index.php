<?php
  session_start();

  $token = bin2hex(openssl_random_pseudo_bytes(32));
  $_SESSION['token'] = $token;
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>De Vogelspotters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/style.css">
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <h1 class="navbar-center"><a class="navbar-brand" href="index.php">De Vogelspotters</a></h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#"></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"></a>
            </li>
          </ul>
          <span class="navbar-text">
            <a href="logout.php">Loguit</a>
          </span>
        </div>
      </div>
    </nav>
    <main>
      <div class="container">
        <h2>Welkom!</h2>
        <h2>U kunt hier inloggen:</h2>
        <form action="PHP/login_verwerk.php" method="post">
          <div class="mb-3">
            <label for="">
            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>"><br> </label>
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Gebruikersnaam:</label>
            <input type="text" name="Gebruikersnaam" class="form-control"  aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Wachtwoord:</label>
            <input type="password" name="Wachtwoord" class="form-control">
          </div>
          <input type="submit" name="submit" value="Inloggen">
        </form>
      </div>
    </main>
  </body>
</html>

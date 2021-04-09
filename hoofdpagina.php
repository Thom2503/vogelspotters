
 <?php
   session_start();

   $seizoen = $_GET['s'];
   $_SESSION['seizoen'] = $seizoen;
   if (isset($_SESSION['ID']) == false)
   	{
   		header("location: index.php");
   	}

  ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>De Vogelspotters</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="style/style.css">
     <script src="https://kit.fontawesome.com/9eb8eb270a.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
     <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
   </head>
   <body>
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
       <div class="container-fluid">
         <h1 class="navbar-center"><a class="navbar-brand" href="hoofdpagina.php?s=<?php echo $seizoen; ?>">De Vogelspotters</a></h1>
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
             <a href="post.php?s=<?php echo $seizoen; ?>">Toevoegen</a>
           </span>
           <span style="display: block; margin-left: 0.4em;" class="navbar-text">
             <a href="logout.php">Loguit</a>
           </span>
         </div>
       </div>
     </nav>
     <main>
       <div class="container_hundred">
         <?php
           require 'PHP/config.inc.php';

           $query = "SELECT * FROM `fotos` WHERE SeizoenID = '$seizoen'";

           $result = mysqli_query($mysqli, $query);

           if (!$result)
           {
             ?>
              <h2>Er is iets mis gegaan met het verbinden met de database</h2>
              <p>Sorry voor het ongemak.</p>
             <?php
           } else
           {
             ?><div class="rij"><?php
             foreach($result as $foto)
             {
               ?>
               <div class="colom">
               <div class="card-deck">
                  <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="Uploads/<?php echo $foto['Files']; ?>" alt="<?php echo $foto['Titel'] ?>">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $foto['Titel'] ?></h5>
                      <p class="card-text"><?php echo $foto['Tekst'] ?></p>
                      <?php
                        if ($_SESSION['level'] >= 1)
                        {
                          ?>
                            <a href="verwijder.php?id=<?php echo $foto['uuid'] ?>&s=<?php echo $seizoen ?>"><i class="fas fa-trash" style='color:red'></i></a>
                          <?php
                        }
                       ?>
                    </div>
                   </div>
                 </div>
               </div>
               <?php
             }
             ?></div><?php
           }

          ?>
       </div>
     </main>
   </body>
 </html>

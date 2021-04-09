<?php
  session_start();
  if (isset($_SESSION['ID']) == false)
	{
		header("location: index.php");
	}
  $seizoen = $_GET['s'];
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>De Vogelspotters || Toevoegen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
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
      <div class="container">
        <form action="PHP/post_verwerk.php" method="post" enctype="multipart/form-data">
            <input name="seizoen" type="hidden" value="<?php echo $seizoen; ?>">
          <h2>Foto toevoegen</h2>
          <div class="mb-3">
            <input placeholder="Titel" name="titel" class="titel" name="title" type="text" autofocus ><br/><br/>
          </div>
          <div class="mb-3">
            <input type='file' name="fileUpload[]"  id="chooseFile" multiple /><br><br>
          </div>
          <div class="mb-3">
            <textarea placeholder="Teksts" class="tekst" name="content" rows="10" ></textarea><br/>
          </div>
      		<input name="post" type="submit" value="Post">
      	</form>
        <script>
        $(function () {
          // Multiple images preview with JavaScript
          var multiImgPreview = function (input, imgPreviewPlaceholder) {
            if (input.files) {
              var filesAmount = input.files.length;
              for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function (event) {
                  $($.parseHTML('<img style="height: 10em">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }
                reader.readAsDataURL(input.files[i]);
              }
            }
          };
          $('#chooseFile').on('change', function () {
            multiImgPreview(this, 'div.imgGallery');
          });
        });
      </script>
      <div class="imgGallery">
        <!-- image preview -->
      </div>
      </div>
    </main>
  </body>
</html>

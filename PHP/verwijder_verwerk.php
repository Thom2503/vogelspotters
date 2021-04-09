<?php
  session_start();
  if (isset($_SESSION['ID']) == false)
	{
		header("location: index.php");
	}

  require 'config.inc.php';

  $titel = $_POST['titel'];
  $uuid = $_POST['uuid'];
  $seizoen = $_POST['seizoen'];
  $tekst = $_POST['text'];

  $file = $_POST['filename'];

  if (isset($_SESSION['token']) && $_SESSION['token'] == $_POST['csrf_token'])
  {

    if (isset($_POST['submit']))
    {
      $pattern_uuid = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';

      if (!empty($titel) &&
          !empty($uuid) &&
          !empty($seizoen) &&
          !empty($tekst))
      {
        if (preg_match($pattern_uuid, $uuid))
        {
          if (!is_int($seizoen))
          {
            //query om het uit de database te verwijderen
            $query = "DELETE FROM `fotos` WHERE uuid = ? AND Titel = ? AND SeizoenID = ?";
            $stmt = mysqli_prepare($mysqli, $query);

            mysqli_stmt_bind_param($stmt, 'ssi', $uuid, $titel, $seizoen);

            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            //path naar de uploads folder om de photo te kunnen Verwijderen
            $path = "../Uploads/";

            if (!$result)
            {
              unlink($path.$file);
              header("location: hoofdpagina.php?s=$seizoen");
              exit;
            } else {
              echo "Er is iets fout gegaan met het verbinden met de database";
            }
          } else {
            echo "seizoen is geen int";
          }
        } else {
          echo "uuid is incorrect";
        }
      } else {
        echo "velden zijn leeg";
      }
    } else
    {
      echo "Niet goed gesubmit";
    }
  }


 ?>

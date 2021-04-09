<?php
require "config.inc.php";
	session_start();
	if (isset($_SESSION['ID']) == false)
	{
		header("location: index.php");
	}

	$_SESSION['ID'];

function uuidv4()
{
	$data = openssl_random_pseudo_bytes(16);

	$data[6] = chr(ord($data[6]) & 0x0f | 0x40);
	$data[8] = chr(ord($data[8]) & 0x3f | 0x80);

	return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

if(isset($_POST['post']))
{
	$title = strip_tags($_POST['title']);
	$content = strip_tags($_POST['content']);
	$seizoen = $_POST['seizoen'];
  $target_dir = "../Uploads/"; //target directory is hier upload, upload moet dus een mapje worden.

  // Valid file extensions
  $extensions_arr = array(".jpg",".jpeg",".png",".gif");

	$title = mysqli_real_escape_string($mysqli, $title);
	$content = mysqli_real_escape_string($mysqli, $content);
	$door = $_SESSION['username'];
	$accountID = $_SESSION['ID'];

	// Count # of uploaded files in array
	$total = count($_FILES['fileUpload']['name']);

	// Loop through each file
	for( $i=0 ; $i < $total ; $i++ )
	{
		$target_file = $target_dir . basename($_FILES["fileUpload"]["name"][$i]);

	  // Select file type
	  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	  //Get the temp file path
	  $tmpFilePath = $_FILES['fileUpload']['tmp_name'][$i];
		$file_name = $_FILES['fileUpload']['name'][$i];
	  $target_file = $target_dir . basename($_FILES["fileUpload"]["name"][$i]);

		$file = $title.$file_name;

	  //Make sure we have a file path
	  if ($tmpFilePath != "")
		{
			$uuid = uuidv4();
	    //Setup our new file path
	    $newFilePath = $target_dir . $file;
			//$sql = "INSERT into posts (title, images, content, datum, createdby) VALUES ('$title', '$file_name', '$content', CURRENT_TIMESTAMP, '$door')";
			$sql = "INSERT INTO `fotos`(`uuid`, `date`, `Titel`, `Tekst`, `Files`, `SeizoenID`, `AccountID`)
			VALUES ('$uuid',CURRENT_TIMESTAMP,'$title','$content','$file',$seizoen,'$accountID')";
			if($title == "" || $content == "" || in_array($imageFileType, $extensions_arr))
			{
				echo "Maak je post af!";
				return;

			} else
			{
				move_uploaded_file($tmpFilePath, $newFilePath);
				mysqli_query($mysqli, $sql);

				header("location: hoofdpagina.php?s".$seizoen);
			}
	  }
	}

}

?>

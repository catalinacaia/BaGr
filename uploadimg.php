<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Verifica daca fisierul este imagine sau nu
if(isset($_POST["submit"])) {
include("creare.html");
    $tmp_name = $_FILES["fileToUpload"]["tmp_name"];
	$new_name = "uploads/".logo.".jpg";
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Verifica dimensiunea imaginii
if ($_FILES["fileToUpload"]["size"] > 500000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Permite incarcarea doar a anumitor formate
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = 0;
}
// Verifica daca $uploadOk este setat pe 0 de o eroare
if ($uploadOk == 0) {
// Se face incarcarea imaginii pe server
} else {
    if (move_uploaded_file($tmp_name, $new_name)) {

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
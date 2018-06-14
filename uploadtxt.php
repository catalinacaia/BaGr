<?PHP
  include("creare.php");
  if(!empty($_FILES['uploaded_file']))
  {
    //$path = "uploads/";
    $path = "uploads/"."fisier".".txt";
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      echo "The file has been uploaded";
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }
?>
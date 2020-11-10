<?php
require_once('Entity/EntityBooks.php');
require_once('Model/ModelBooks.php');

$entityBook = new EntityBooks();
$modelBook = new ModelBooks();

  $id="a";
  $titre = $_POST["titleBook"];
  $auteur = $_POST["authorBook"];
  $categorie = $_POST["categoryBook"];
  $description = $_POST["descriptBook"];
  $disponible = $_POST["availableBook"];
  $prix = $_POST["priceBook"];
  $succesAjout=false;

  if($modelBook->verifyAllAttributeBook($titre,$auteur,$categorie,$description,$prix)=true){
    $id = $modelBook->generateIdBook($titre);
    $owner =  $_COOKIE["firstName"]." ".$lastName=$_COOKIE["lastName"];
    $succesAjout=$entityBook->addBook($id,$titre,$auteur,$categorie,$description,$disponible,$prix,$owner);
  }




if ($succes=true){
    $target_dir = "ressources/bookPictures/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"][$id]);
    $uploadOk = 0;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        $modelBook->displayAlertBoxError("Le fichier sélectionné n'est pas une image");
        $uploadOk = 0;
      }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
      $modelBook->displayAlertBoxError("Désolé, ce fichier existe déjà");
      $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $modelBook->displayAlertBoxError("Désolé, ce fichier est trop volumineux");
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
      echo "Sorry, only JPG, JPEG & PNG files are allowed.";
      $modelBook->displayAlertBoxError("Les seuls type de fichier accepté sont de type JPG, JPEG et PNG");
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      $modelBook->displayAlertBoxError("Désolé, une erreur est survenu lors du téléversement du fichier");
      $entityBook->removeBook($id);
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        $modelBook->displayAlertBoxError("Désolé, une erreur est survenu lors du téléversement du fichier");
        $entityBook->removeBook($id);
      }
    }
    
}

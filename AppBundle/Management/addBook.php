<?php

try 
{   
    $connexion = new PDO("mysql:host=localhost;dbname=booksales;port=3306", "root", "" );
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $id = 1;
    $titre = $_POST["titleBook"];
    $auteur = $_POST["authorBook"];
    $categorie = $_POST["categoryBook"];
    $description = $_POST["descriptBook"];
    $disponible = $_POST["availableBook"];
    $prix = $_POST["priceBook"];
    $succes = false;



    $requete = "INSERT INTO book (id,title,author,category,description,available,price,owner) VALUES('$id', '$titre','$auteur','$categorie','$description','$disponible','$prix')"; 
    $connexion->exec($requete);
    $connexion = null;
    echo "Ajout réussi";
    $succes = true;
    header("Location: Pages/index.html");
    exit;
} 

catch(PDOException $e) {
      echo "Échec de connexion à la base de données: " . $e->getMessage();
}



if ($succes=true){
    $target_dir = "ressources/bookPictures/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"][$id]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG & PNG files are allowed.";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }

}

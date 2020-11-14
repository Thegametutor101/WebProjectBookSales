<?php
require_once('ProjectConstants.php');

class ModelBooks
{
    private $connexion;

    public function __construct()
    {
        $constants = new ProjectConstants();
        $this->connexion = $constants->getConnexion();
    }

   function addBook($id, $title, $author, $category, $description, $available, $price, $file, $fileTemp, $owner): string
   {
       try 
       {
           $extension = pathinfo(basename($file), PATHINFO_EXTENSION);
           $coverDirectory = dirname(__FILE__) . '/../../ressources/bookPictures/' . $id . '.' . $extension;
           if (!move_uploaded_file($fileTemp, $coverDirectory)) {
               return "file error";
           } else {
               $request = "INSERT INTO book VALUES('$id', '$title', '$author', '$category',
                        '$description', '$available', '$price', '$owner', '0')";
               $this->connexion->exec($request);
               return "ok";
           }
       }
       catch(PDOException $e) {
           return "no";
       }
   }

   function removeBook($id): bool
   {
       try 
       {
           $request = "DELETE FROM book WHERE id='{$id}'";
           $this->connexion->exec($request);
           return true;
       }
       catch(PDOException $e) {
           return false;
       }
   }

}
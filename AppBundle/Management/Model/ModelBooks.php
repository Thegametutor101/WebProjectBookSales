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

   function addBook($id, $title, $author, $category, $description, $available, $price, $fileTemp, $owner): string
   {
       try 
       {
           $coverDirectory = dirname(__FILE__) . '/../../ressources/bookPictures/' . $id . '.png';
           if (!move_uploaded_file($fileTemp, $coverDirectory)) {
               return "file error";
           } else {
               $request = "INSERT INTO book VALUES('$id', '$title', '$author', '$category',
                        '$description', '$available', '$price', '$owner')";
               $this->connexion->exec($request);
               return "ok";
           }
       }
       catch(PDOException $e) {
           return "no";
       }
   }

   function updateBook($id, $title, $author, $category, $description, $available, $price, $fileTemp, $owner): string
   {
       try
       {
           $coverDirectory = dirname(__FILE__) . '/../../ressources/bookPictures/' . $id . '.png';
           if (!move_uploaded_file($fileTemp, $coverDirectory)) {
               return "file error";
           } else {
               $request = "UPDATE book SET title='$title', author='$author', category='$category',
                        description='$description', available='$available', price='$price', owner='$owner' WHERE id='$id'";
               $this->connexion->exec($request);
               return "ok";
           }
       }
       catch(PDOException $e) {
           return "no";
       }
   }
    function deleteBook($id): bool
    {
       try
       {
           $request = "DELETE FROM book WHERE id='$id'";
           $this->connexion->exec($request);
           return true;
       }
       catch(PDOException $e) {
           return false;
       }
    }
    function addRental($bookID, $userID): bool
    {
        try
        {
            $request = "INSERT INTO rentals(bookID, userID) VALUES('$bookID', '$userID')";
            $this->connexion->exec($request);
            if (!$this->updateAvailableNo($bookID)) {
                return false;
            }
            return true;
        }
        catch(PDOException $e) {
            return false;
        }
    }
    function deleteRental($bookID, $userID): bool
    {
        try
        {
            $request = "DELETE FROM rentals WHERE bookID='$bookID' AND userID='$userID'";
            $this->connexion->exec($request);
            if (!$this->updateAvailableYes($bookID)) {
                return false;
            }
            return true;
        }
        catch(PDOException $e) {
            return false;
        }
    }
    function updateAvailableNo($id): bool
    {
        try {
            $request = "UPDATE book SET available='0' WHERE id='$id'";
            $this->connexion->exec($request);
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }
    function updateAvailableYes($id): bool
    {
        try {
            $request = "UPDATE book SET available='1' WHERE id='$id'";
            $this->connexion->exec($request);
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }
}
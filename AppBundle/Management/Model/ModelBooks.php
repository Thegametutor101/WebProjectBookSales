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

    function generateIdBook($titre):string{
        $randomNumber=rand(100,999);
        $subTitle=substr($titre,0,3);
        $firstNameLetters=substr($_COOKIE["firstName"],0,1);
        $lastName=$_COOKIE["lastName"];
        $id=$subTitle.$firstNameLetters.$lastName.$randomNumber;

        return $id;
    }

   function verifyTitleBook(string $title):bool{
    if(!empty($title))
    {
        if(strlen($title)<150){
            return true;
        }
        else{
            displayAlertBoxError("Le champ titre contient trop de caractères");
            return false;
        }
    }
    else{
        displayAlertBoxError("Le champ titre est vide");
        return false;
    }
   }


   function verifyAuthorBook(string $author):bool{
    if(!empty($author))
    {
        if(strlen($author)<202){
            return true;
        }
        else{
            displayAlertBoxError("Le champ auteur contient trop de caractères");
            return false;
        }
    }
    else{
        displayAlertBoxError("Le champ auteur est vide");
        return false;
    }
   }

   function verifyCategory(string $category):bool{
    if(!empty($category))
    {
        if(strlen($category)<50){
            return true;
        }
        else{
            displayAlertBoxError("Le champ catégorie contient trop de caractères");
            return false;
        }
    }
    else{
        displayAlertBoxError("Le champ catégorie est vide");
        return false;
    }
   }

   function verifyDescription(string $description):bool{
    if(!empty($category))
    {
      return true;
    }
    else{
        displayAlertBoxError("Le champ description est vide");
        return false;
    }
   }


   function verifyPrice($price)
   {
    if(!empty($price))
    {
        if($price>0){
            return true;
        }
        else{
            displayAlertBoxError("Le prix du livre doit être supérieur à zéro");
            return false;
        }
     
    }
    else{
        displayAlertBoxError("Le champ prix est vide");
        return false;
    }
   }



   function verifyAllAttributeBook($title,$author,$category,$description,$price):bool{
        if(verifyTitleBook($title) && verifyAuthorBook($author) && verifyCategory($category) && verifyDescription($description) && verifyPrice($price)){
            return true;
        }
        else{
            return false;
        }
   }



   function displayAlertBoxError(string $error){
    echo '<script language="javascript">';
    echo($error);
    echo '</script>';
   }



   
   function addBook($id,$title,$author,$category,$description,$disponible,$prix,$owner):bool
   {
       $succes=false;
       try 
       {
           $request = "INSERT INTO book (id,title,author,category,description,available,price,owner) VALUES('$id', '$titre','$auteur','$categorie','$description','$disponible','$prix')";
           $result = $this->connexion->query($request);
           $lines = $result->fetchAll();

           $succes = true;
           exit;
       } 

       catch(PDOException $e) {
               echo "Échec de connexion à la base de données: " . $e->getMessage();
               $succes =false;
       }
       return $succes;
   }

   function removeBook($id)
   {
       try 
       {
           $request = "DELETE FROM book WHERE id='{$id}'";
           $result = $this->connexion->query($request);
           echo "Suppression réussi";
           exit;
       } 

       catch(PDOException $e) {
               echo "Échec de connexion à la base de données: " . $e->getMessage();
       }
   }

}
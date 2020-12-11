<?php


class ProjectConstants
{
    public $connexion;
    public function __construct()
    {
        try {
//            $this->connexion = new PDO("mysql:host=localhost;dbname=booksales;port=3308,charset=utf8","root","");
            $this->connexion = new PDO("mysql:host=206.167.140.56;dbname=420505ri_gr06;port=3306,charset=utf8","1763237","1763237");
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    /**
     * @return PDO
     */
    public function getConnexion(): PDO
    {
        return $this->connexion;
    }
}
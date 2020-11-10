<?php


class ProjectConstants
{
    public $connexion;
    public function __construct()
    {
        $this->connexion = new PDO("mysql:host=localhost;dbname=booksales;port=3306,charset=utf8","root","");
        $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return PDO
     */
    public function getConnexion(): PDO
    {
        return $this->connexion;
    }

}
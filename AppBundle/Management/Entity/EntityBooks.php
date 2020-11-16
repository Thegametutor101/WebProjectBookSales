<?php
require_once('ProjectConstants.php');

class EntityBooks
{
    private $connexion;

    public function __construct()
    {
        $constants = new ProjectConstants();
        $this->connexion = $constants->getConnexion();
    }

    function getBooks():array
    {
        $lines = array();
        try {
            $request = "SELECT * FROM book";
            $result = $this->connexion->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }

    function getBookById($id)
    {
        $lines = array();
        try {
            $request = "SELECT * FROM book where id='$id'";
            $result = $this->connexion->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }

    function getBooksByOwner($id)
    {
        $lines = array();
        try {
            $request = "SELECT * FROM book where owner='$id'";
            $result = $this->connexion->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }

    function getBooksRented($id)
    {
        $lines = array();
        try {
            $request = "SELECT * FROM rentals where userID='$id'";
            $result = $this->connexion->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }

    function getBooksSearchByTitle($text, $sort):array
    {
        $lines = array();
        try {
            $request = "SELECT * FROM book ";
            $where = "where ";
            $words = explode(" ", $text);
            $i = 0;
            foreach ($words as $word) {
                switch (strtolower($sort)) {
                    case "titre": {
                        if (++$i === count($words)) {
                            $where .= "(title like '%{$word}%') ORDER BY title";
                        } else {
                            $where .= "(title like '%{$word}%') AND ";
                        }
                        break;
                    }
                    case "auteur": {
                        if (++$i === count($words)) {
                            $where .= "(title like '%{$word}%') ORDER BY author";
                        } else {
                            $where .= "(title like '%{$word}%') AND ";
                        }
                        break;
                    }
                    case "prix - du moins eleve": {
                        if (++$i === count($words)) {
                            $where .= "(title like '%{$word}%') ORDER BY price ASC";
                        } else {
                            $where .= "(title like '%{$word}%') AND ";
                        }
                        break;
                    }
                    case "prix - du plus eleve": {
                        if (++$i === count($words)) {
                            $where .= "(title like '%{$word}%') ORDER BY price DESC";
                        } else {
                            $where .= "(title like '%{$word}%') AND ";
                        }
                        break;
                    }
                    default: {
                        if (++$i === count($words)) {
                            $where .= "(title like '%{$word}%')";
                        } else {
                            $where .= "(title like '%{$word}%') AND ";
                        }
                        break;
                    }
                }
            }
            $request .= $where;
            $result = $this->connexion->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }
    function getBooksSearchByAuthor($text, $sort):array
    {
        $lines = array();
        try {
            $request = "SELECT * FROM book ";
            $where = "where ";
            $words = explode(" ", $text);
            $i = 0;
            foreach ($words as $word) {
                switch (strtolower($sort)) {
                    case "titre": {
                        if (++$i === count($words)) {
                            $where .= "(author like '%{$word}%') ORDER BY title";
                        } else {
                            $where .= "(author like '%{$word}%') AND ";
                        }
                        break;
                    }
                    case "auteur": {
                        if (++$i === count($words)) {
                            $where .= "(author like '%{$word}%') ORDER BY author";
                        } else {
                            $where .= "(author like '%{$word}%') AND ";
                        }
                        break;
                    }
                    case "prix - du moins eleve": {
                        if (++$i === count($words)) {
                            $where .= "(author like '%{$word}%') ORDER BY price ASC";
                        } else {
                            $where .= "(author like '%{$word}%') AND ";
                        }
                        break;
                    }
                    case "prix - du plus eleve": {
                        if (++$i === count($words)) {
                            $where .= "(author like '%{$word}%') ORDER BY price DESC";
                        } else {
                            $where .= "(author like '%{$word}%') AND ";
                        }
                        break;
                    }
                    default: {
                        if (++$i === count($words)) {
                            $where .= "(author like '%{$word}%')";
                        } else {
                            $where .= "(author like '%{$word}%') AND ";
                        }
                        break;
                    }
                }
            }
            $request .= $where;
            $result = $this->connexion->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }
    function getBooksSearchByCategory($text, $sort):array
    {
        $lines = array();
        try {
            $request = "SELECT * FROM book ";
            $where = "where ";
            $words = explode(" ", $text);
            $i = 0;
            foreach ($words as $word) {
                switch (strtolower($sort)) {
                    case "titre": {
                        if (++$i === count($words)) {
                            $where .= "(category like '%{$word}%') ORDER BY title";
                        } else {
                            $where .= "(category like '%{$word}%') AND ";
                        }
                        break;
                    }
                    case "auteur": {
                        if (++$i === count($words)) {
                            $where .= "(category like '%{$word}%') ORDER BY author";
                        } else {
                            $where .= "(category like '%{$word}%') AND ";
                        }
                        break;
                    }
                    case "prix - du moins eleve": {
                        if (++$i === count($words)) {
                            $where .= "(category like '%{$word}%') ORDER BY price ASC";
                        } else {
                            $where .= "(category like '%{$word}%') AND ";
                        }
                        break;
                    }
                    case "prix - du plus eleve": {
                        if (++$i === count($words)) {
                            $where .= "(category like '%{$word}%') ORDER BY price DESC";
                        } else {
                            $where .= "(category like '%{$word}%') AND ";
                        }
                        break;
                    }
                    default: {
                        if (++$i === count($words)) {
                            $where .= "(category like '%{$word}%')";
                        } else {
                            $where .= "(category like '%{$word}%') AND ";
                        }
                        break;
                    }
                }
            }
            $request .= $where;
            $result = $this->connexion->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }
    function getBooksSearchByText($text, $sort):array
    {
        $lines = array();
        try {
            $request = "SELECT * FROM book ";
            $where = "where ";
            $words = explode(" ", $text);
            $i = 0;
            foreach ($words as $word) {
                switch (strtolower($sort)) {
                    case "titre": {
                        if (++$i === count($words)) {
                            $where .= "(title like '%{$word}%' OR ";
                            $where .= "author like '%{$word}%' OR ";
                            $where .= "category like '%{$word}%') ORDER BY title";
                        } else {
                            $where .= "(title like '%{$word}%' OR ";
                            $where .= "author like '%{$word}%' OR ";
                            $where .= "category like '%{$word}%') AND ";
                        }
                        break;
                    }
                    case "auteur": {
                        if (++$i === count($words)) {
                            $where .= "(title like '%{$word}%' OR ";
                            $where .= "author like '%{$word}%' OR ";
                            $where .= "category like '%{$word}%') ORDER BY author";
                        } else {
                            $where .= "(title like '%{$word}%' OR ";
                            $where .= "author like '%{$word}%' OR ";
                            $where .= "category like '%{$word}%') AND ";
                        }
                        break;
                    }
                    case "prix - du moins eleve": {
                        if (++$i === count($words)) {
                            $where .= "(title like '%{$word}%' OR ";
                            $where .= "author like '%{$word}%' OR ";
                            $where .= "category like '%{$word}%') ORDER BY price ASC";
                        } else {
                            $where .= "(title like '%{$word}%' OR ";
                            $where .= "author like '%{$word}%' OR ";
                            $where .= "category like '%{$word}%') AND ";
                        }
                        break;
                    }
                    case "prix - du plus eleve": {
                        if (++$i === count($words)) {
                            $where .= "(title like '%{$word}%' OR ";
                            $where .= "author like '%{$word}%' OR ";
                            $where .= "category like '%{$word}%') ORDER BY price DESC";
                        } else {
                            $where .= "(title like '%{$word}%' OR ";
                            $where .= "author like '%{$word}%' OR ";
                            $where .= "category like '%{$word}%') AND ";
                        }
                        break;
                    }
                    default: {
                        if (++$i === count($words)) {
                            $where .= "(title like '%{$word}%' OR ";
                            $where .= "author like '%{$word}%' OR ";
                            $where .= "category like '%{$word}%')";
                        } else {
                            $where .= "(title like '%{$word}%' OR ";
                            $where .= "author like '%{$word}%' OR ";
                            $where .= "category like '%{$word}%') AND ";
                        }
                        break;
                    }
                }
            }
            $request .= $where;
            $result = $this->connexion->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }
    function getBooksSearchSort($sort):array
    {
        $lines = array();
        try {
            $request = "SELECT * FROM book ";
            $order = "";
            switch (strtolower($sort)) {
                case "titre": {
                    $order .= "ORDER BY title";
                    break;
                }
                case "auteur": {
                    $order .= "ORDER BY author";
                    break;
                }
                case "prix - du moins eleve": {
                    $order .= "ORDER BY price ASC";
                    break;
                }
                case "prix - du plus eleve": {
                    $order .= "ORDER BY price DESC";
                    break;
                }
                default: {
                    $order .= "";
                    break;
                }
            }
            $request .= $order;
            $result = $this->connexion->query($request);
            $lines = $result->fetchAll();

            return $lines;
        }
        catch(PDOException $e) {
            return $lines;
        }
    }
}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion de Stock</title>
    <link rel="stylesheet" type="text/css" href="ressources/css/styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $.get("Pages/header.html", function( data ) {
            let body=data.replace(/^.*?<body>(.*?)<\/body>.*?$/s,"$1");
            $(".header").html(body);
        });
    </script>
</head>
<body>
<div class="main">
    <div class="header"></div>
    <div class="container">
        <?php
        require_once('Entity/EntityBooks.php');
        $entityBooks = new EntityBooks();
        $lines = $entityBooks->getBooks();
        foreach($lines as $l)
        {
            if ($l[5] === '1') {
                echo "<div class='card'>
                        <div class='top'>
                            <div class='leftSide'>
                                <div class='material-icons bookPicture'>image</div>
                            </div>
                            <div class='rightSide'>
                                <div class='id' style='padding-bottom: 15px;vertical-align: top'>#$l[0]</div>
                                <div class='title' style='padding-bottom: 3px'>titre: $l[1]</div>
                                <div class='author' style='padding-bottom: 15px'>auteur: $l[2]</div>
                                <div class='category' style='padding-bottom: 3px; vertical-align: bottom'>$l[3]</div>
                            </div>
                        </div>
                        <div class='bottom'>
                            <div class='price'>$l[6]$</div>
                        </div>
                      </div>";
            }
        }
        ?>
    </div>
</div>
</body>
<style>
    .container {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        max-width: 1100px;
        width: 1100px;
        margin: 10px 50px;
    }
    .container > .card {
        border: 2px solid #c3c3c3;
        border-radius: 3px;
        margin: 10px 25px;
        width: 250px;
        padding: 5px;
        background-color: #4c74af;
        color: #f2f2f2;
        display: flex;
        flex-direction: column;
    }
    .top {
        display: flex;
        flex-direction: row;
        width: 100%;
    }
    .bottom {
        height: 30px;
        text-align: right;
        vertical-align: center;
        font-size: 25px;
        color: #ff7878;
    }
    .leftSide {
        width: 40%;
    }
    .rightSide {
        width: 60%;
        height: 150%;
        text-align: left;
        vertical-align: center;
        padding: 5px;
    }
    .bookPicture {
        size: 40px;
        border-radius: 3px;
    }
</style>
<script src="ressources/javascript/scripts.js"></script>
</html>
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
//        require_once('Entity/EntityFormation.php');
//        $entityFormation = new EntityFormation();
//        $lines = $entityFormation->getFormations();
//        foreach($lines as $l)
//        {
//            echo "<div class='card'>
//                    <div class='top'>
//                        <div class='id'>#$l[0]</div>
//                        <div class='category'>$l[7]</div>
//                    </div>
//                    <div class='middle'>
//                        <div class='text'>
//                            <div class='title'>$l[1]</div>
//                            <div class='description'>$l[2]</div>
//                        </div>
//                        <div class='price'>$l[6]$</div>
//                    </div>
//                    <div class='bottom'>
//                        <div class='date'><div class='material-icons' style='margin-right: 5px;'>event</div>$l[3]</div>
//                        <div class='duration'><div class='material-icons' style='margin-right: 5px;'>schedule</div>$l[4] heures</div>
//                        <div class='seats'><div class='material-icons' style='margin-right: 5px;'>groups</div>$l[5] places</div>
//                    </div>
//                  </div>";
//        }
        ?>
    </div>
</div>
</body>
<script src="ressources/javascript/scripts.js"></script>
</html>
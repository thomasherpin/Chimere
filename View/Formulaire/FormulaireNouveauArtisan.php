<?php
include_once '../../helper/config.php';
include_once '../../Model/MetierModel.php';
$metier = metier::getAll();
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../../css/pagecss.css" rel="stylesheet" style="">
        <title>Formulaires</title>
    </head>

    <body id="fond">
        <form action='CibleNouveauArtisan.php'
          method='post'>
            <h1>Ajouter un nouvel artisan:</h1>
        Nom: <input type='text'required name='nom'>
        Prénom: <input type='text'required name='prenom'>
        <br><br>
        Metier: <br><br>
            <?php
           
            foreach ($metier as $item)
        {
            echo "$item->Nom";
            echo "<input type= \"radio\" name= \"metier\" value= $item->IDMetier";
            echo "<br><br>";
            
            
        }

        ?>
        <br>
              <input type='reset' value='Effacer'>
           
            <input type='submit' value='Valider'>      
    </form>
    </body>
</html>


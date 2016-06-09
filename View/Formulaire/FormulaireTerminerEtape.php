<?php
include_once '../../helper/config.php';
include_once '../../helper/Connect.php';
include_once '../../Model/MatiereModel.php';
include_once '../../Model/MetierModel.php';

if(isset($_POST['devis']))
{
connect::connectidp($_POST['devis']);


}

$devis = connect::getidp();
$projet = $_POST['devis'];
$matiere = Matiere::getAllByProjet($projet);
$metier = Metier::getALL();

?>

<!doctype html>
<html>
    <head>
        <title>Formulaires</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../../css/pagecss.css" rel="stylesheet" >
    </head>
    <body id="fond">
        <form action='CibleTerminerEtape.php'
          method='post' enctype="multipart/form-data">
            <h1>Valider le travail</h1>
        Heures de travail : <input type='text' name='heuredetravail'><br>
        <br>
        <u>Composants : </u><br>
        <br>
        <?php 
		if(isset($matiere))
		{
			$i = 1;
			foreach($matiere as $item)
			{ 		
			echo"$item->Nom: ";
                        //'option' = $item->IDMatiere;
                        $name1 = "quantmatiere".$i;

                        $name2 = "idmatiere".$i;

                        
                        echo"<input  name='$name1'/><input  name='$name2' type='hidden' value='$item->IDMatiere'/>";
                        $i++;
			}
                        $i = $i - 1;
                        echo"<input  name = 'nombre' type = 'hidden' value = '$i' />";
	
		}
	   ?>
        Photo : <input type='file' name='photo'><br>
      <br>
           Commentaires : <br>
            <textarea name='commentaire' cols='50' rows='6'></textarea>
       <br>
       <br>
	   <?php 
	   if(isset($metier))
		{
			echo"Métier suivant :<select name='metier'>";
			foreach($metier as $item)
			{ 		
			echo"<option value=\"".$item->IDMetier."\">".$item->Nom."</option>";
			}
			echo "</select>";
		}
		?>
		<br>
       <br>
       <br>
            <input type='submit' value='Valider'>      
    </form>
	<br>
        <a href="/Chimere/View/OperateurView.php" id="retour"> retour </a>
    </body>
</html>


<?php

include_once '../helper/config.php';
include_once '../helper/Connect.php';
include_once '../Model/ClientModel.php';
include_once '../Model/VilleModel.php';
include_once '../Model/MatiereModel.php';
include_once '../Model/MetierModel.php';
include_once '../Model/DevisModel.php';

if(isset($_POST['devis']))
{
connect::connectidp($_POST['devis']);

}
$devis = connect::getidp();
if (isset($_POST['Valider']))
{
    Devis::setStatut($devis, 3);
    header('Location: ControleurView.php');
}
elseif (isset($_POST['Renvoye']))
{

    $metier = Metier::getALL();
    
?>
    <html>
    <head>
        <title>Renvoyer le bijou</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../css/pagecss.css" rel="stylesheet" >
    </head>
    <body id="fond">
        <form action='./Formulaire/CibleTerminerEtape.php'
          method='post' enctype="multipart/form-data">
            <h1>Renvoyer le bijou</h1>
        </br>
        Heures de travail : <input type='text' name='heuredetravail'><br>
        <br>
        <br>	
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
        <a href="/Chimere/View/ControleurView.php" id="retour"> retour </a>
    </body>
</html>
<?php
}


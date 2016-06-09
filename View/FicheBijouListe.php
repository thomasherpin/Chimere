<?php
include_once '../Model/EtapeModel.php';
include_once '../helper/config.php';
include_once '../helper/Connect.php';
include_once '../Model/DevisModel.php';
include_once '../Model/MatiereModel.php';
include_once '../Model/Devis_MatiereModel.php';
include_once '../Model/ArtisanModel.php';
if(isset($_GET['value']))
{
connect::connectidp($_GET['value']);
}
if(isset($_GET['client']))
{
connect::connectcli($_GET['client']);
}

$idDevis = split("=", $adresse=$_SERVER['REQUEST_URI'])[1];

$devis = Devis::getInfoByID($idDevis);
//$infomat=materiel::getinfomat(); //n'existe même pas dans son projet (le getinfomat)
$etapes=Etape::getetape($idDevis);
$matieres = Matiere::getAllByProjet($idDevis);


?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../css/pagecss.css" rel="stylesheet" style="">
        <title>Fiche bijou</title>
    </head>
    	<?php

			      
		echo "<body id=\"fond\">
		<div id=\"divbijoux\">
			<u>Nom:</u></br>
			".Devis::getNom($idDevis)."
			</br>
			</br>
			<u>Prix:</u></br>
			".$devis->Cout."
			</br>
			</br>
			<u>Description:</u></br>
			".$devis->DescriptionBijoux."
			</br>
			</br>";
			
			?>
			<u>Matériaux:</u></br>
			</html>
			<?php
			if(isset($matieres))
			{
				foreach ($matieres as $item)
				{        
                                    $quantite = Devis_Matiere::getQuantite($item->IDMatiere, $idDevis);
					echo"
					".$item->Nom."
					".$item->PrixParGramme."	&times;
					".$quantite."
					</br>";
				}
			}
			else
			{
			echo "Les materiaux ne sont pas renseigner</br>";	
			}
			?>
			
			<html>
			</br>
			<u>Liste des traveaux effectués:</u>
			</html>
			<?php
			if(isset($etapes))
			{

                            
				foreach ($etapes as $item)
				{  
  
                                    $employe = Artisan::getEmployeByID($item->Employee_idEmployee);
                                    echo"<br>";
                                    echo("L'intervenant est ".$employe->prenom." ".$employe->nom." et a commenté: ".$item->commentaire." avec un temps de ".$item->tempspasse. " heures<br>");
                                    echo "Photo du travail réalisé: <br>";
                                    echo "<img src='$item->UrlPhoto'  id='image'/>";
                                    echo"<br>";
                                            }
			}
			else
			{
			echo "Aucun travail n'est encore terminé";	
			}
			?>
			</br>
			</br>
		
                        <a href="ListeProjetView.php" id="retour"> retour </a>
		
	</body>
</html>
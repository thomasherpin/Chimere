<?php
include_once '../helper/config.php';
include_once '../Model/ProjetModel.php';
include_once '../helper/Connect.php';
include_once '../Model/DevisModel.php';
include_once '../Model/ArtisanModel.php';


if(isset($_GET['id']))
{
connect::connectid($_GET['id']);


}
$idEmploye = connect::getid();

$artisan = Artisan::getEmployeByID($idEmploye);

$devis = Devis::getAllEnAttenteByMetier($artisan->metier);

$devisPerso = Devis::getAllEnCoursByEmploye($idEmploye);
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/pagecss.css" rel="stylesheet" style="">
<title>Interface opérateur</title>
</head>

<body id="fond">
    <a href="index.php" id="retour"> retour </a>
</html>
<html>
    <img src="../Src/logo.png" id="logo">
    <h1 id="operateurview"><?php echo"$artisan->nom $artisan->prenom"?></h1>
<div id="cadreprojet1">
Liste des projets:</br></br>
</html>
<?php 
if(isset($devis))
{
    ?>
<form action='CibleFormulaireControleur.php'
          method='post'>
           <?php
    foreach ($devis as $item)
        {
            echo '<div id=\"projet\" ><b>';
            echo"<input type= \"radio\" required name= \"devis\" value= $item->IDDevis";
            echo "<u><a href=\"fichebijou.php?value=".$item->IDDevis."\">".Devis::getNom($item->IDDevis)."</a></u></b></br><i>".$item->NomDevis."</i></br>".$item->DescriptionBijoux."</div><br>";
            
        }
        ?>
        <input name="Valider" type='submit' value='Valider le bijou'>
        <input name="Renvoye"type='submit' value='Renvoyer le bijou'>    
</form>
<?php
}
else
{
	echo"Il n'y a aucun projet a controler";
}
?>

    
</div>

</body>
<?php

include_once "../../helper/config.php";
include_once '../../Model/DevisModel.php';
include_once 'FormulaireCreationProjet.php';
include_once '../../Model/TypeModel.php';
include_once '../../Model/EtapeModel.php';
include_once '../../Model/Devis_MatiereModel.php';

$nom=$_POST["nom"];
$type=$_POST["type"];
$prix=$_POST["prix"];
$heuredetravail=$_POST["heuredetravail"];
$photo=$_POST["photo"];
$description=$_POST["description"];
$matieres = $_POST["matiere"];
$metierSuivant = $_POST['metier'];
$client = $_POST['client'];        

Devis::enregistrerDevis($nom, $prix, $heuredetravail, $description, $metierSuivant, $type,$client);
$devis = Devis::selectDernierDevis();


foreach ($matieres as $item)
{
    Devis_Matiere::enregistrerDM($item, $devis);
}


header('Location: /Chimere/View/BijoutierView.html');
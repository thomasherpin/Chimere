<?php
include_once "../../helper/config.php";
include_once "../../Model/ArtisanModel.php";
include_once 'FormulaireNouveauArtisan.php';

$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$metier=$_POST["metier"];


Artisan::enregistrerArtisan($nom, $prenom, $metier);




//je retourne à la page de gestion des devis
header('Location: /Chimere/View/BijoutierView.html');
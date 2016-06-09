<?php

include_once '../../helper/config.php';
include_once '../../Model/MatiereModel.php';

$matiere=$_POST["matiere"];
$prix=$_POST["prixgramme"];


Matiere::enregistrerMatiere($matiere, $prix);

header('Location: FormulaireCreationProjet.php');
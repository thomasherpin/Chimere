<?php

include_once "../../helper/config.php";
include_once '../../Model/VilleModel.php';

$ville=$_POST["ville"];
$codepostal=$_POST["codepostal"];

Ville::enregistrerVille($ville, $codepostal);

header('Location: FormulaireCreationProjet.php');
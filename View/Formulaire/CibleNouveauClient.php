<?php

include_once "../../helper/config.php";
include_once '../../Model/ClientModel.php';

$name=$_POST["name"];
$surname=$_POST["surname"];
$call=$_POST["telephone"];
$idVille=$_POST["ville"];
$nomrue=$_POST["nomrue"];
$numrue=$_POST["numrue"];


Client::enregistrerClient($name, $surname, $call, $idVille, $nomrue, $numrue);

header('Location: FormulaireCreationProjet.php');

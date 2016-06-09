<?php

include_once "../helper/config.php";
include_once "../helper/Connect.php";
include_once 'OperateurView.php';
include_once '../Model/EtapeModel.php';
include_once '../Model/ArtisanModel.php';

if(isset($_GET['id']))
{
connect::connectid($_GET['id']);

}
$employe = connect::getid();
$devis = $_POST['devis'];        

//print($employe);
//print($devis);
$statut = 1;
Etape::enregistrerEtape($employe, $devis);
Devis::setStatut($devis, $statut );



header('Location: OperateurView.php');
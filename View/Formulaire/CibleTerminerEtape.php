<?php

include_once "../../helper/config.php";
include_once '../../Model/EtapeModel.php';
include_once '../../Model/DevisModel.php';
include_once '../../Model/Devis_MatiereModel.php';
include_once '../../helper/Connect.php';
$devis= connect::getidp();
$employe = connect::getid();

$metierSuivant = $_POST["metier"];
$tempsPasse = $_POST['heuredetravail'];
$commentaire = $_POST['commentaire'];
$urlPhoto = null;

if(isset($_FILES['photo']))
{ 

     $dossier = '../../Src/UploadPhotoEtape/';
     $fichier = basename($_FILES['photo']['name']);
     if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload effectué avec succès !';
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}

$urlPhoto = '/Chimere/Src/UploadPhotoEtape/'. $fichier;
Devis::setStatut($devis, 2);
Devis::setMetierSuivant($devis, $metierSuivant);
Etape::validerEtape($devis, $employe, $commentaire, $urlPhoto, $tempsPasse);

if(isset($_FILES['nombre']))
{ 
$nb = $_POST['nombre'];
     
          // je boucle tant que $i est inférieur au nombre total de champs
          for ($i = 1; $i <= $nb; $i++) {
           

          // je teste si la variable prep$i est présente 

            $quantite = $_POST['quantmatiere'.$i.''];
            $matiere = $_POST['idmatiere'.$i.''];
           
            Devis_Matiere::setQuantite($matiere, $devis, $quantite);

            
          }
}
header('Location: ../OperateurView.php');
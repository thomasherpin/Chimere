<?php
include_once '../../helper/config.php';

include_once '../../Model/ClientModel.php';
include_once '../../Model/VilleModel.php';
include_once '../../Model/MatiereModel.php';
include_once '../../Model/MetierModel.php';
$client = Client::getAll();
$ville = Ville::getAll();
$matiere = Matiere::getAll();
$metiers = Metier::getAll();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../../css/pagecss.css" rel="stylesheet" style="">
        <title>Création d'un devis</title>
    </head>

    <body id="fond">
        <a href="/Chimere/View/BijoutierView.html" id="retour"> retour </a>
        <form action='CibleNouveauProjet.php'
          method='post'>
            <h1>Ajouter un nouveau projet:</h1>
            Nom du devis : <input type='text'required name='nom'><br>
            <br>
            Travail à réaliser sur le bijou : <br>
            <br>
            Création <input type='radio' name='type' value='1'><br>
            
            Réparation <input type='radio' name='type' value='2'><br>
            <br>
            Prix estimé :  <input type='text'required name='prix'><br>
            <br>
            Heures de travail estimé :  <input type='text'required name='heuredetravail'><br>
            <br>
            Composant du bijou : <br>
            <div id='Liste des matières'>
                <p> Liste des matières: <br>
                        <?php
                        if(isset($matiere)){
                            foreach ($matiere as $item)
                            {
                                echo "$item->Nom Prix: $item->PrixParGramme";
                                echo "<input type= \"checkbox\" name= \"matiere[]\" value= $item->IDMatiere";
                                echo "<br><br>";
                                
                            }   
                        }
                        else
                            echo "Aucune matière n'est présente."
                        ?>
                    </p>
            </div>
                   
           
            <br>
            Description : <br>
            <textarea name='description' cols='50' rows='6' placeholder="Une petite description?"></textarea>

            <br>
            <br>
            <div id='ListeClientsExistants'>
                <p>Liste des clients: <br>
                        <?php
                        if(isset($client))
                        {
                            foreach ($client as $item)
                            {
                                echo "$item->Nom $item->Prenom";
                                echo "<input type= \"radio\" name= \"client\" value= $item->IDClient";
                                echo "<br><br>";
                                
                            }
                        }
                        else
                            echo "Aucun client n'est ajouté."
                        ?>
                    </p>
            </div>
            
            <div id="ListeMetier">
                <h2>Selectionner le métier de commencement </h2>
                <?php
                     foreach ($metiers as $item)
                            {
                                echo "$item->Nom";
                                echo "<input type= \"radio\" name= \"metier\" value= $item->IDMetier";
                                echo "<br><br>";
                            }
                            ?>
            </div>
 
            <input name="Effacer" type='reset' value='Effacer'>
                        <br>
            <input name="Valider" type='submit' value='Valider'>     
        </form>
        <br><br>
                <div id='CreerClient'>
                <form action='CibleNouveauClient.php'
                      method='post'>
                    Ajouter un nouveau client: <br>
                    Nom: <input type="string" name="name" required>
                    <br>
                    Prénom: <input type="string" name="surname" required>
                    <br>
                    Téléphone: <input type="string" name="telephone" required>
                    <br>
                    Nom de la rue: <input type="int" name="nomrue" required>
                    <br>
                    Numéro de la rue: <input type="int" name="numrue" required>
                    <br>
                
                    <div id="ListeVillesExistantes">
                        <p>Liste des villes: <br>

                           <?php
                           if (isset($ville))
                           {
                                foreach($ville as $item)
                                {
                                     echo "$item->Nom $item->codepostal";
                                     echo "<input type= \"radio\" name= \"ville\" value= $item->idVille";
                                     echo "<br><br>";
                                }
                           }
                           else
                               echo "Aucune ville ajoutée."
                           ?>
                        </p>
                    </div>
                
                    
                    <input name="AjouterClient" type="submit" value="Ajouter un client">
                 
                    <br>
                    <br>
                </form>
                <br>
              
                </div>
        
                    <div id='CreerVille'>
                        <form action='CibleNouvelleVille.php'
                              method='post'>
                            Ajouter une nouvelle ville: <br>
                            Ville: <input type="string" name="ville" required>
                            <br>
                            Code Postal: <input type="int" name="codepostal" required>
                            <br>
                            <input name="AjouterVille" type="submit" value="Ajouter une ville">
                        </form>
                    </div>
        
         <div id='CreerMatiere'>
                        <form action='CibleNouvelleMatiere.php'
                              method='post'>
                            Ajouter une nouvelle matiere: <br>
                            Matière: <input type="string" name="matiere" required>
                            <br>
                            Prix au gramme: <input type="int" name="prixgramme" required>
                            <br>
                            <input name="AjouterMatiere" type="submit" value="Ajouter une matière">
                        </form>
                    </div>
            <br>
</body>
</html>

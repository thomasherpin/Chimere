<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Devis_MatiereModel
 *
 * @author MicroDev
 */
class Devis_Matiere {
   public $IDMatiere;
   public $IDDevis;
   public $Quantite;
   
   public function __construct($idMatiere, $idDevis, $Quantite) {
       
       $this->IDMatiere = $idMatiere;
       $this->IDDevis = $idDevis;
       $this->Quantite = $Quantite;
   }
    public static function enregistrerDM($idMatiere, $idDevis) {
        $pdo = new PDO("mysql:host=". config::SERVERNAME.";dbname=".config::DBNAME, config::USER, config::PASSWORD);
        $Quantite= 0;
        $req=$pdo->prepare("INSERT into matieredetaildevis "
                ." (IDDevis, IDMatiere, Quantite) values "
                ." (:idDevis, :idMatiere, :Quantite);");
        
        $req->bindParam(":idDevis", $idDevis);
        $req->bindParam(":idMatiere", $idMatiere);
        $req->bindParam(":Quantite", $Quantite);
        
        $req->execute();
//      $req->execute(array($_POST['Nom'],$_POST['CodePostal']));
        
        $pdo=NULL;  
        
    }
    
    public static function setQuantite($idMatiere, $idDevis, $Quantite){
              $pdo = new PDO("mysql:host=". config::SERVERNAME.";dbname=".config::DBNAME, config::USER, config::PASSWORD);
              
              $rec = $pdo->prepare("SELECT Quantite FROM matieredetaildevis WHERE IDDevis = :devis and IDMatiere = :matiere");
              $rec->bindParam(":devis", $idDevis);
              $rec->bindParam(":matiere", $idMatiere);
              
              $rec->execute();
              $rec = $rec->fetch();
              $OldQuantite = $rec[0];

              $NewQuantite = $OldQuantite + $Quantite;
              
              $req = $pdo->prepare("UPDATE `matieredetaildevis` SET `Quantite`= :quantite WHERE IDDevis = :devis and IDMatiere = :matiere ");
              $req->bindParam(":devis", $idDevis);
              $req->bindParam(":matiere", $idMatiere);
              $req->bindParam(":quantite", $NewQuantite);
              $req->execute();
              $pdo=NULL;  
    }
    
    public static function getQuantite($idMatiere, $idDevis){
              $pdo = new PDO("mysql:host=". config::SERVERNAME.";dbname=".config::DBNAME, config::USER, config::PASSWORD);
              
              $rec = $pdo->prepare("SELECT Quantite FROM matieredetaildevis WHERE IDDevis = :devis and IDMatiere = :matiere");
              $rec->bindParam(":devis", $idDevis);
              $rec->bindParam(":matiere", $idMatiere);
              
              $rec->execute();
              $rec = $rec->fetch();
              return $rec[0];
              $pdo=NULL;  
    }
}

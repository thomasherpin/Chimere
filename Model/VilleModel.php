<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Ville {
    public $idVille;
    public $Nom;
    public $codepostal;
    
    
    public function __construct($idVille, $ville, $codepostal) {
        $this->idVille = $idVille;
        $this->Nom = $ville;
        $this->codepostal = $codepostal;
    }
  
    public static function enregistrerVille($nom, $codepostal) {
        $pdo = new PDO("mysql:host=". config::SERVERNAME.";dbname=".config::DBNAME, config::USER, config::PASSWORD);
        
        $req=$pdo->prepare("INSERT into ville "
                ." (Nom,CodePostal) values "
                ." (:ville,:codepostal);");
        
        $req->bindParam(":ville", $nom);
        $req->bindParam(":codepostal", $codepostal);
        
        $req->execute();
//      $req->execute(array($_POST['Nom'],$_POST['CodePostal']));
        
        $pdo=NULL;  
        
    }
    
    
    public static function getAll()
    {
        $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
        
        $req = $pdo->prepare("select idVille,Nom,CodePostal from ville");
		
        $req->execute();

        if ($req->rowCount() >= 1) {
            $ville = array();
            
            while ($ligne = $req->fetch()) {
                $ville[] = new Ville($ligne["idVille"],$ligne["Nom"],$ligne["CodePostal"]);
            }
            
            return $ville;
        }

        $pdo = null;

        return null;
    }
}


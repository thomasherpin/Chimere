<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Artisans
 *
 * @author MicroDev
 */
class Artisan {
   public function __construct($IDEmploye, $nom,$prenom,$metier) {
       $this->IDEmploye=$IDEmploye;
       $this->metier=$metier;
	$this->nom=$nom;
	$this->prenom=$prenom;
    }

    public $IDEmploye;
	public $metier;
	public $nom;
	public $prenom;
	
	//retourne tous les employers avec leur métiers respectifs
    public static function getAll() {
        $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
        
        $req = $pdo->prepare("select * from employe Order by IDMetier, Nom");
		
        $req->execute();
 
        if ($req->rowCount() >= 1) {
            $artisans = array();
            
            while ($ligne = $req->fetch()) {
                $artisans[] = new Artisan($ligne["IDEmploye"],$ligne["Nom"],$ligne["Prenom"],$ligne["IDMetier"]);
            }
            
            return $artisans;
        }

        $pdo = null;

        return null;
    }
    
     public static function getEmployeByID($id) {
        $artisan = null;
        $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
        
        $req = $pdo->prepare("select * from employe where IDEmploye = :id");
        $req->bindParam(":id", $id);
		
        $req->execute();
        

        $req=$req->fetch();
        $artisan = new Artisan($req["IDEmploye"],$req["Nom"],$req["Prenom"],$req["IDMetier"]);
            
            
            
        

        $pdo = null;

        return $artisan;
    }
	
	public static function enregistrerArtisan($nom, $prenom, $metier){
        $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
        
        $req=$pdo->prepare("INSERT INTO employe "
                ." (Nom,Prenom,IDMetier)values "
                ." (:nom,:prenom,:metier);");
				
        $req->bindParam(":nom", $nom);
        $req->bindParam(":prenom", $prenom);
        $req->bindParam(":metier", $metier);

        $req->execute();
        
        $pdo=NULL;
		
    }
	
}

?>
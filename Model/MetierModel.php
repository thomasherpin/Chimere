<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Metier {
    public function __construct($IDMetier, $Nom) {
        $this->IDMetier = $IDMetier;
        $this->Nom = $Nom;
    }

    public $IDMetier;
    public $Nom;
    
    public static function getAll(){
        $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
        
        $req = $pdo->prepare("select * from metier");
		
        $req->execute();
     
        if ($req->rowCount() >= 1) {
            $metier = array();
            
            while ($ligne = $req->fetch()) {
                $metier[] = new Metier($ligne["IDMetier"],$ligne["Nom"]);

            }
            
            return $metier;
        }

        $pdo = null;

        return null;
    }
    
    
}
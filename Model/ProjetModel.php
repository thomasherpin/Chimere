<?php

include_once '../helper/Connect.php';

class Projet{

    public function __construct($id,$cout,$description,$urlphoto,$nom,$datedeb) {
	$this->id=$id;
	$this->cout=$cout;
	$this->description=$description;
	$this->urlphoto=$urlphoto;
	$this->nom=$nom;
	$this->datedeb=$datedeb;
	//$this->client = $client;,$client
	}

    public $id;
	public $cout;
	public $description;
	public $urlphoto;
	public $nom;
	public $datedeb;
	//public $client;
	
	public $prenom;
	
	//retourne tous les prjet du plus urgent au moins urgent
    public static function getALL() {
        $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
        
        $req = $pdo->prepare("SELECT `idDevis`,`Cout`,`DescriptionBijoux`,`UrlPhoto`,`Nomdevis`,`Nomdevis`,`Datedebut`,`idClient` 
							FROM `Devis` d
							JOIN `client` c ON d.`Client_idClient` = c.`idClient` 
							ORDER BY `Datedebut` desc");
        $req->execute();
 
        if ($req->rowCount() >= 1) {
            $urgent = array();
            
            while ($ligne = $req->fetch()) {
                $urgent[] = new Projet($ligne["idDevis"],$ligne["Cout"],$ligne["DescriptionBijoux"],$ligne["UrlPhoto"],$ligne["Nomdevis"],$ligne["Datedebut"],$ligne["idClient"]);
            }
            
            return $urgent;
        }

        $pdo = null;

        return null;
    }
	
	public static function getbyMetier() {
        $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
        $prenomartisans = connect::getpre();
        $req = $pdo->prepare("SELECT `idDevis`,`Nomdevis`,`Cout`,`DescriptionBijoux`,`UrlPhoto`,`Datedebut` 
							  FROM `metier` 
							  JOIN `employee` ON `metier`.`idMetier` = `employee`.`Metier_idMetier` 
							  JOIN `Devis` ON `Devis`.`Metier_idMetier` = `metier`.`idMetier`
							  WHERE `employee`.`Prenom` = \"".$prenomartisans."\"");
                              //JOIN `client` ON `Devis`.`Client_idClient` = `client`.`idClient` ,`idClient`
        $req->execute();
 		
        if ($req->rowCount() >= 1) {
            $bymetier = array();
            
            while ($ligne = $req->fetch()) {
                $bymetier[] = new Projet($ligne["idDevis"],$ligne["Cout"],$ligne["DescriptionBijoux"],$ligne["UrlPhoto"],$ligne["Nomdevis"],$ligne["Datedebut"]);
            }
            
            return $bymetier;
        }

        $pdo = null;

        return null;
    }
	
	
}
?>
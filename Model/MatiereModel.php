<?php


class Matiere {
    public $Nom;
    public $PrixParGramme;
    public $IDMatiere;
            
    public function __construct($IDMatiere, $nommatiere, $Prix) {
        $this->IDMatiere = $IDMatiere;
        $this->Nom = $nommatiere;
        $this->PrixParGramme = $Prix;
    }
     
    public static function enregistrerMatiere($matiere, $prix){
        $pdo = new PDO("mysql:host=".config::SERVERNAME.";dbname=".config::DBNAME, config::USER, config::PASSWORD);
        
        $req=$pdo->prepare("INSERT into matiere "
                ." (Nom,PrixAuGramme) values "
                ." (:nommatiere,:Prix);");
        
        $req->bindParam(":nommatiere", $matiere);
        $req->bindParam(":Prix", $prix);
        $req->execute();
        
        $pdo=NULL;  
    }
    
     public static function getAll() {
        $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
        
        $req = $pdo->prepare("select * from matiere");
		
        $req->execute();

        if ($req->rowCount() >= 1) {
            $matiere = array();
            
            while ($ligne = $req->fetch()) {
                $matiere[] = new Matiere($ligne["IDMatiere"],$ligne["Nom"],$ligne["PrixAuGramme"]);
            }
            
            return $matiere;
        }

        $pdo = null;

        return null;
    }
    
    public static function getAllByProjet($idProjet) {
        $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
        $matiere = null;
        $req = $pdo->prepare("SELECT * from matiere m join matieredetaildevis md on m.IDMatiere = md.IDMatiere where md.IDDevis = :idDevis");
	$req->bindParam(":idDevis", $idProjet);	
        $req->execute();

        if ($req->rowCount() >= 1) {
            $matiere = array();
            
            while ($ligne = $req->fetch()) {
                $matiere[] = new Matiere($ligne["IDMatiere"],$ligne["Nom"],$ligne["PrixAuGramme"]);
            }
            
        }

        $pdo = null;

        return $matiere;
    }
    
}

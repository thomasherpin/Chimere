<?php


class Client {
    public $IDClient;
    public $Nom;
    public $Prenom;
    private $Telephone;
    private $IDVille;
    public $NomRue;
    public $NumRue;
   
    public function __construct($idClient,$name,$surname,$call,$ville,$nomrue,$numrue) {
        $this->IDClient = $idClient;
        $this->Nom = $name;
        $this->Prenom = $surname;
        $this->Telephone = $call;
        $this->IDVille = $ville;
        $this->NomRue = $nomrue;
        $this->NumRue = $numrue;
       // $pdo = new PDO("mysql:host=".config::SERVERNAME.";dbname=".config::DBNAME, config::USER, config::PASSWORD);
//        $req=$pdo->prepare("SELECT idVille from ville"."WHERE Nom=:ville");
        //$req=$pdo->prepare("S
//        $req->getAttribute($attribute);SELECT idVille from ville WHERE 'Nom' = \"".$this->ville."\"");
//        $idVille_idVille->bindParam(":idVille", $this->Ville_idVille);
//        $req->bindParam(':ville', $this->ville);
       // $req->execute();
       // if ($req->rowCount()==1)
//       // {
//            while($ligne=$req->fetch()){
//                $this->Ville_idVille($ligne["idville"]);
//            }
//        }
//        
//        $pdo=NULL;
    }   
    
    public static function enregistrerClient($nom, $prenom, $call, $IDVille, $NomRue, $NumRue){
        $pdo = new PDO("mysql:host=".config::SERVERNAME.";dbname=".config::DBNAME, config::USER, config::PASSWORD);
        
        $req=$pdo->prepare("INSERT into client "
                ." (Nom,Prenom,Telephone,NomRue,NumRue,IDVille) values "
                ." (:name,:surname,:call,:nomrue,:numrue,:IDVille);");
        
        $req->bindParam(":name", $nom);
        $req->bindParam(":surname", $prenom);
        $req->bindParam(":call", $call);
        $req->bindParam(":IDVille", $IDVille);
        $req->bindParam(":nomrue", $NomRue);
        $req->bindParam(":numrue", $NumRue);
        
        $req->execute();
//        $req->execute(array($_POST['Nom'],$_POST['Prenom'],$_POST['Telephone']));
        
        $pdo=NULL;
    }
    
        public static function getAll() {
        $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
        
        $req = $pdo->prepare("select * from client");
		
        $req->execute();

        if ($req->rowCount() >= 1) {
            $client = array();
            
            while ($ligne = $req->fetch()) {
                $client[] = new Client($ligne["IDClient"],$ligne["Nom"],$ligne["Prenom"],$ligne["Telephone"],$ligne["NomRue"],$ligne["NumRue"],$ligne["IDVille"]);
            }
            
            return $client;
        }

        $pdo = null;

        return null;
    }
    
    
}
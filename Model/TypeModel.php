<?php


class Type {
    private $idType;
    private $NomType;
        
    public function __construct($NomType) {
        $this->NomType = $NomType;
    }
     
    public function enregistrerType(){
        $pdo = new PDO("mysql:host=".config::SERVERNAME.";dbname=".config::DBNAME, config::USER, config::PASSWORD);
        
        $req=$pdo->prepare("INSERT into etape "
                ." (Nom) values "
                ." (:genre);");
        
        $req->bindParam(":genre", $this->NomType);
        
        $req->execute();
        
        $pdo=NULL;  
    }
    
    public static function getAll()
    {
        $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
        
        $req = $pdo->prepare("select IDType,Nom from type");
		
        $req->execute();

        if ($req->rowCount() >= 1) {
            $type = array();
            
            while ($ligne = $req->fetch()) {
                $type[] = new Type($ligne["idType"],$ligne["Nom"]);
            }
            
            return $type;
        }

        $pdo = null;

        return null;
    }
    
}
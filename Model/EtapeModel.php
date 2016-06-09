<?php



class Etape {
    
    public $tempspasse;
    public $commentaire;
    public $UrlPhoto;
    public $Devis_idDevis;
    public $Employee_idEmployee;
    public $IDEtape;
            
    public function __construct($tempspasse, $commentaire, $UrlPhoto, $Devis_idDevis, $Employee_idEmployee, $IDEtape) {
        $this->tempspasse = $tempspasse;
        $this->commentaire = $commentaire;
        $this->UrlPhoto = $UrlPhoto;
        $this->Devis_idDevis = $Devis_idDevis;
        $this->Employee_idEmployee = $Employee_idEmployee;
        $this->IDEtape = $IDEtape;
    }
     
    public static function enregistrerEtape($idEmploye, $idDevis){
        $pdo = new PDO("mysql:host=".config::SERVERNAME.";dbname=".config::DBNAME, config::USER, config::PASSWORD);
       //print("$idEmploye<br>");
       //print("$idDevis");
        $req=$pdo->prepare("INSERT INTO `etape`(`IDEmploye`, `IDDevis`) VALUES (:Employee_idEmploye,:Devis_idDevis);");
        
        $req->bindParam(":Devis_idDevis", $idDevis);
        $req->bindParam(":Employee_idEmploye", $idEmploye);
        $req->execute();

        $pdo=NULL;  
    }
    
    
    public static function validerEtape($idDevis,$idEmploye,$commentaire,$urlPhoto,$tempsPasse){
          $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
                 
            $sql = "UPDATE `etape` SET `TempsPasse`= :temps,`Commentaire`= :commentaire,`UrlPhoto`= :url WHERE etape.IDDevis = :devis and etape.IDEmploye = :employe ORDER BY IDEtape DESC LIMIT 1 ";
            $stmt = $pdo->prepare($sql);  
            $stmt->bindParam(':devis', $idDevis);  
            $stmt->bindParam(':employe', $idEmploye);   
            $stmt->bindParam(':commentaire', $commentaire);   
            $stmt->bindParam(':url', $urlPhoto);
            $stmt->bindParam(':temps', $tempsPasse);   
            $stmt->execute();
            
            $pdo = NULL;
    }
    
    public static function getetape($idDevis)
    {
         $pdo = new PDO("mysql:host=".config::SERVERNAME.";dbname=".config::DBNAME, config::USER, config::PASSWORD);

        $req=$pdo->prepare("SELECT * FROM `etape` WHERE IDDevis = :Devis_idDevis and UrlPhoto != ' '");
        
        $req->bindParam(":Devis_idDevis", $idDevis);
        $req->execute();

        
         if ($req->rowCount() >= 1) {
            $etape = array();
            
            
            while ($ligne = $req->fetch()) {
                  $etape[] = new Etape($ligne["TempsPasse"], $ligne["Commentaire"], $ligne["UrlPhoto"], $ligne["IDDevis"], $ligne["IDEmploye"], $ligne["IDEtape"]);
            }
           
        }
      
        
        
        $pdo=NULL;  
        return $etape;
    }
}

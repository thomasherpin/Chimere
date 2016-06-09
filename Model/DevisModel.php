<?php


class Devis {
    
    public $IDDevis;
    public $Cout;
    public $DescriptionBijoux;
    public $TempsPrevu;
    public $TempsTotalPasse;
    public $IDClient;
    public $IDStatut;
    public $IDType;
    public $IDMetierSuivant;
    public $NomDevis;


    public function __construct($IDDevis,$Cout,$DescriptionBijoux,$TempsPrevu,$TempsTotalPasse,$IDClient,$IDStatut,$IDType,$IDMetierSuivant,$NomDevis) {
        $this->IDDevis = $IDDevis;
        $this->Cout = $Cout;
        $this->DescriptionBijoux = $DescriptionBijoux;
        $this->TempsPrevu = $TempsPrevu;
        $this->TempsTotalPasse = $TempsTotalPasse;
        $this->IDClient = $IDClient;
        $this->IDStatut = $IDStatut;
        $this->IDType = $IDType;
        $this->IDMetierSuivant = $IDMetierSuivant;

        $this->Nomdevis = $NomDevis;
    }
    
    public static function enregistrerDevis($NomDevis,$Cout,$TempsPrevu,$DescriptionBijoux,$MetierSuivant,$IDType,$IDClient){
        $pdo = new PDO("mysql:host=".config::SERVERNAME.";dbname=".config::DBNAME, config::USER, config::PASSWORD);
        
        $req=$pdo->prepare("INSERT into devis "
                ." (NomDevis, Cout, DescriptionBijoux, TempsPrevu, TempsTotalPasse, IDMetierSuivant, IDType, IDStatut, IDClient) values "
                ." (:nom, :prix, :text, :tempsprevu, :tempstotalpasse, :metierSuivant, :idType, :idStatut, :idClient);");

        $TempsTotalPasse= 0;
        $IDStatut= 2;
        $req->bindParam(":nom", $NomDevis);
        $req->bindParam(":prix", $Cout);
        $req->bindParam(":tempsprevu", $TempsPrevu);
        $req->bindParam(":tempstotalpasse", $TempsTotalPasse);
        $req->bindParam(":text", $DescriptionBijoux);
        $req->bindParam(":metierSuivant", $MetierSuivant);
        $req->bindParam(":idType", $IDType);
        $req->bindParam(":idStatut", $IDStatut);       
        $req->bindParam(":idClient", $IDClient);
        $req->execute();
//      $req->execute(array($_POST['Coût'],$_POST['DescriptionBijoux'],$_POST['tempsprevu']));
                
        $pdo=NULL;
    }
    
     public static function selectDernierDevis(){
        $pdo = new PDO("mysql:host=".config::SERVERNAME.";dbname=".config::DBNAME, config::USER, config::PASSWORD);
        
        $req=$pdo->prepare("SELECT IDDevis FROM devis ORDER BY IDDEVIS DESC LIMIT 1");
        
        $req->execute();
        

        
        $pdo=NULL;
        
        return $req->fetch()[0];
    }
    
    
      public static function getAllEnAttenteByMetier($idMetier)
    {
          $devis = null;
        $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
        
        $req = $pdo->prepare("select * from devis where IDMetierSuivant = $idMetier AND IDStatut=2");

        $req->execute();

        if ($req->rowCount() >= 1) {
            $devis = array();
            
            
            while ($ligne = $req->fetch()) {
                $devis[] = new Devis($ligne["IDDevis"],$ligne["Cout"],$ligne["DescriptionBijoux"],$ligne["TempsPrevu"],$ligne["TempsTotalPasse"],$ligne["IDClient"],$ligne["IDStatut"],$ligne["IDType"],$ligne["IDMetierSuivant"],$ligne["NomDevis"]);
            }
           
        }

        $pdo = null;

        return $devis;
    }
      
     public static function getAllByStatut($idStatut)
    {
          $devis = null;
        $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
        
        $req = $pdo->prepare("select * from devis where IDStatut = :statut");
	$req->bindParam(":statut", $idStatut);	
        $req->execute();

        if ($req->rowCount() >= 1) {

            
            $ligne = $req->fetch();

                $devis[] = new Devis($ligne["IDDevis"],$ligne["Cout"],$ligne["DescriptionBijoux"],$ligne["TempsPrevu"],$ligne["TempsTotalPasse"],$ligne["IDClient"],$ligne["IDStatut"],$ligne["IDType"],$ligne["IDMetierSuivant"],$ligne["NomDevis"]);
            
           
        }

        $pdo = null;

        return $devis;
    }
    
    public static function getInfoByID($idDevis)
    {
          $devis = null;
        $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
        
        $req = $pdo->prepare("select * from devis where IDDevis = :idDevis");
	$req->bindParam(":idDevis", $idDevis);	
        $req->execute();

        
        $ligne = $req->fetch();
        $devis = new Devis($ligne["IDDevis"],$ligne["Cout"],$ligne["DescriptionBijoux"],$ligne["TempsPrevu"],$ligne["TempsTotalPasse"],$ligne["IDClient"],$ligne["IDStatut"],$ligne["IDType"],$ligne["IDMetierSuivant"],$ligne["NomDevis"]);
        $pdo = null;

        return $devis;
    }
    
          public static function getAllEnCoursByEmploye($idEmploye)
    {
          $devis = null;
        $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
        
        $req = $pdo->prepare("SELECT * FROM devis as d join etape e on e.IDDevis = d.IDDevis join employe as em on e.IDEmploye = em.IDEmploye where d.IDStatut = 1 and e.IDEmploye = :idEmploye and em.IDMetier = d.IDMetierSuivant group by d.IDDevis ");
	$req->bindParam(":idEmploye", $idEmploye);	
        $req->execute();

        if ($req->rowCount() >= 1) {
            $devis = array();
            
            while ($ligne = $req->fetch()) {

                $devis[] = new Devis($ligne["IDDevis"],$ligne["Cout"],$ligne["DescriptionBijoux"],$ligne["TempsPrevu"],$ligne["TempsTotalPasse"],$ligne["IDClient"],$ligne["IDStatut"],$ligne["IDType"],$ligne["IDMetierSuivant"],$ligne["NomDevis"]);
            }
           
        }

        $pdo = null;

        return $devis;
    }
    
    
    public static function setStatut($idDevis, $idStatut)
            {


                 $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
                 
            $sql = "UPDATE `devis` SET `IDStatut` = :idStatut WHERE `devis`.`IDDevis` = :idDevis; ";
            $stmt = $pdo->prepare($sql);  
            $stmt->bindParam(':idDevis', $idDevis);  
            $stmt->bindParam(':idStatut', $idStatut);   
            $stmt->execute();
             }
             
             
             
    public static function setMetierSuivant($idDevis, $idMetierSuivant)
            {


                 $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
                 
            $sql = "UPDATE `devis` SET `IDMetierSuivant` = :idMetier WHERE `devis`.`IDDevis` = :idDevis; ";
            $stmt = $pdo->prepare($sql);  
            $stmt->bindParam(':idDevis', $idDevis);  
            $stmt->bindParam(':idMetier', $idMetierSuivant);   
            $stmt->execute();
             }
             
             public static function getNom($idDevis) {
                $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
                $req = $pdo->prepare("SELECT NomDevis FROM devis WHERE IDDevis = :idDevis");
                $req->bindParam(":idDevis", $idDevis);	
                $req->execute();
                
                $nom = $req->fetch();

                return $nom[0];
             }
             
             
             public static function getDerniereUrlPhoto($idDevis)
             {
                $pdo = new PDO("mysql:host=" . config::SERVERNAME . ";dbname="
                . config::DBNAME, config::USER, config::PASSWORD);
                
                $req = $pdo->prepare("SELECT e.UrlPhoto FROM devis as d join etape as e on e.IDDevis = d.IDDevis WHERE d.IDDevis = :idDevis ORDER by e.IDEtape DESC LIMIT 1 ");
                $req->bindParam(":idDevis", $idDevis);	
                $req->execute();
                
                return $req->fetch()[0];
                
             }

}

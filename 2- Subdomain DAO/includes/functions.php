<?
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    function AddLog($Message, $mysqli){
        $query = $mysqli->prepare("INSERT INTO log (Bericht, DayTime) VALUES (?, CURRENT_TIMESTAMP)");
        $query->bind_param("s", $Message);
        $query->execute();  
    }

    function GetID($WalletID, $mysqli){
        $query = $mysqli->prepare("SELECT ID FROM users WHERE WalletID = ?");
        $query->bind_param("s", $WalletID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }    

    function GetName($ID, $mysqli){
        $query = $mysqli->prepare("SELECT Naam FROM users WHERE ID = ?");
        $query->bind_param("s", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function GetRang($ID, $mysqli){
        $query = $mysqli->prepare("SELECT Rang FROM users WHERE ID = ?");
        $query->bind_param("s", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function GetAdres($ID, $mysqli){
        $query = $mysqli->prepare("SELECT Adres FROM users WHERE ID = ?");
        $query->bind_param("s", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function GetPostcode($ID, $mysqli){
        $query = $mysqli->prepare("SELECT Postcode FROM users WHERE ID = ?");
        $query->bind_param("s", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function GetPlaats($ID, $mysqli){
        $query = $mysqli->prepare("SELECT Plaats FROM users WHERE ID = ?");
        $query->bind_param("s", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }


    function GetUserWalletID($ID, $mysqli){
        $query = $mysqli->prepare("SELECT WalletID FROM users WHERE ID = ?");
        $query->bind_param("s", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function RemoveUser($ID, $mysqli){
        $query = $mysqli->prepare("DELETE FROM users WHERE ID = ?");
        $query->bind_param("s", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function UpdateUser($ID, $Naam, $Adres, $Postcode, $Plaats, $mysqli) {
        $query = $mysqli->prepare("UPDATE users SET Naam = ?, Adres = ?, Postcode = ?, Plaats = ? WHERE ID = ?");
        $query->bind_param("sssss", $Naam, $Adres, $Postcode, $Plaats, $ID);
        $query->execute();
        return "true";    
    }

    function PromoteUser($ID, $mysqli) {
        $query = $mysqli->prepare("UPDATE users SET Rang = 'Administrator' WHERE ID = ?");
        $query->bind_param("s", $ID);
        $query->execute();
        return "true";  
    }

    function AantalGebruikers($mysqli){
        $query = $mysqli->prepare("SELECT count(*) FROM users WHERE Rang <> 'Administrator'");
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;        
    }  

    //Stelling
    function DisableStelling($DaoID, $mysqli) {
        $query = $mysqli->prepare("UPDATE stellingen SET Status = '0' WHERE ID = ?");
        $query->bind_param("i", $DaoID);
        $query->execute();
        return "true";    
    }

    function GetCountStemmenDAO($DaoID, $mysqli) {
        $query = $mysqli->prepare("SELECT count(*) FROM stemmen WHERE DaoID = ?");
        $query->bind_param("i", $DaoID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;  
    }
    
    function AddStelling($Stelling, $Beschrijving, $Functie, $ContractAdres, $StartDatum, $EindDatum, $GestartDoor, $ABI, $mysqli){
        $query = $mysqli->prepare("INSERT INTO stellingen (Stelling, Beschrijving, Functie, ContractAdres, StartDatum, EindDatum, GestartDoor, Status, Gecontroleerd, Uitgevoerd, ABI) VALUES (?,?,?,?,?,?,?,'1','0','0',?)");
        $query->bind_param("ssssssss", $Stelling, $Beschrijving, $Functie, $ContractAdres, $StartDatum, $EindDatum, $GestartDoor, $ABI);
        $query->execute(); 
    }

    function AantalOpenStellingen($mysqli){
        $query = $mysqli->prepare("SELECT count(*) FROM stellingen WHERE EindDatum >= CURDATE() AND Status = 1 AND Uitgevoerd = 0 AND Gecontroleerd = 0");
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;        
    }

    function Stemmen($UserID, $DoaID, $Stemming, $Aantal, $Tokens, $mysqli) {
        $query = $mysqli->prepare("INSERT INTO stemmen (UserID, DaoID, Stemming, Aantal, Tokens) VALUES (?,?,?,?,?)");
        $query->bind_param("iisss", $UserID, $DoaID, $Stemming, $Aantal, $Tokens);
        $query->execute(); 
    }
    
    function GetStellingName($ID, $mysqli) {
        $query = $mysqli->prepare("SELECT Stelling FROM stellingen WHERE ID = ?");
        $query->bind_param("i", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function GetStellingBeschrijving($ID, $mysqli) {
        $query = $mysqli->prepare("SELECT Beschrijving FROM stellingen WHERE ID = ?");
        $query->bind_param("i", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function GetStellingContractAdres($ID, $mysqli) {
        $query = $mysqli->prepare("SELECT ContractAdres FROM stellingen WHERE ID = ?");
        $query->bind_param("i", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function GetStellingFunction($ID, $mysqli) {
        $query = $mysqli->prepare("SELECT Functie FROM stellingen WHERE ID = ?");
        $query->bind_param("i", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function GetStellingStartDatum($ID, $mysqli) {
        $query = $mysqli->prepare("SELECT StartDatum FROM stellingen WHERE ID = ?");
        $query->bind_param("i", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function GetStellingEindDatum($ID, $mysqli) {
        $query = $mysqli->prepare("SELECT EindDatum FROM stellingen WHERE ID = ?");
        $query->bind_param("i", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function GetStellingGestartDoor($ID, $mysqli) {
        $query = $mysqli->prepare("SELECT GestartDoor FROM stellingen WHERE ID = ?");
        $query->bind_param("i", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function CheckIfUserVoted($UserID, $DoaID, $mysqli) {
        $query = $mysqli->prepare("SELECT UserID FROM stemmen WHERE UserID = ? AND DaoID = ?");
        $query->bind_param("ii", $UserID, $DoaID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function GetStellingStatus($ID, $mysqli) {
        $query = $mysqli->prepare("SELECT Status FROM stellingen WHERE ID = ?");
        $query->bind_param("i", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function GetStellingUitvoering($ID, $mysqli) {
        $query = $mysqli->prepare("SELECT Uitgevoerd FROM stellingen WHERE ID = ?");
        $query->bind_param("i", $ID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }

    function GetVoorVoting($DoaID, $mysqli) {
        $query = $mysqli->prepare("SELECT SUM(Aantal) FROM stemmen WHERE DaoID = ? AND Stemming = 'Voor'");
        $query->bind_param("i", $DoaID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch(); 
        if ($results) {
            return $results;
        } else {
            return "0";
        }     
    }

    function GetTegenVoting($DoaID, $mysqli) {
        $query = $mysqli->prepare("SELECT SUM(Aantal) FROM stemmen WHERE DaoID = ? AND Stemming = 'Tegen'");
        $query->bind_param("i", $DoaID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        if ($results) {
            return $results;
        } else {
            return "0";
        }  
    }

    function StellingUitgevoerd($DoaID, $mysqli){
        $query = $mysqli->prepare("UPDATE stellingen SET Uitgevoerd = '1' WHERE ID = ?");
        $query->bind_param("i", $DoaID);
        $query->execute();
        return "true";          
    }

    function StellingGecontroleerd($DoaID, $mysqli){
        $query = $mysqli->prepare("UPDATE stellingen SET Gecontroleerd = '1' WHERE ID = ?");
        $query->bind_param("i", $DoaID);
        $query->execute();
        return "true";          
    }     

    function WhoWon($DaoID, $mysqli) {
      $AantalVoor = GetVoorVoting($DaoID, $mysqli);
      $AantalTegen = GetTegenVoting($DaoID, $mysqli);

      $TotaalAantal = $AantalVoor + $AantalTegen;

      $ProcentVoor = @ceil((100 / $TotaalAantal * $AantalVoor));
      if ($ProcentVoor > 50) {
            return "1";
        } else {
            return "0";
        }
    }

    function TruncateDevLog($mysqli){
        $query = $mysqli->prepare("TRUNCATE log");
        $query->execute();
        return "true";         
    }

?>
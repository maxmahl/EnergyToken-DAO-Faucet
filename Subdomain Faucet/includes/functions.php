<?
    function addUser($WalletID, $Adres, $Postcode, $Plaats, $Naam, $Rang, $mysqli) {
        $query = $mysqli->prepare("INSERT INTO users (WalletID, Adres, Postcode, Plaats, Naam, Rang) VALUES (?,?,?,?,?,?)");
        $query->bind_param("ssssss", $WalletID, $Adres, $Postcode, $Plaats, $Naam, $Rang);
        $query->execute();      
    }

function isKYC($WalletID, $mysqli){
        $query = $mysqli->prepare("SELECT WalletID FROM users WHERE WalletID = ?");
        $query->bind_param("s", $WalletID);
        $query->execute();
        $query->bind_result($results);
        $query->fetch();            
        return $results;
    }
?>
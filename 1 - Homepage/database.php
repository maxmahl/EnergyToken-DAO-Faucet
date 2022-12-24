<?php 

    header("Content-Type:application/json");

    try {
            $database_name     = 'blockc_DAO';
            $database_user     = 'blockc_maxmahl';
            $database_password = 'qNHYdX6R3299';
            $database_host     = '127.0.0.1';

            $pdo = new PDO('mysql:host=' . $database_host . '; dbname=' . $database_name, $database_user, $database_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);          

            $sql = 'select
                    WalletID,
                    Adres,
                    Postcode,
                    Plaats,
                    Naam                                 
                    from users
                    ';           

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
           
            $data = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {          
                 $data[] = $row;  
            } 

           $response         = [];
           $response['data'] =  $data;

           echo json_encode($response, JSON_PRETTY_PRINT);

        } catch (PDOException $e) {
            echo 'Database error. ' . $e->getMessage();
        }        
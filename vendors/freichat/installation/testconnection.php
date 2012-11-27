<?php

error_reporting(E_ALL);
if(extension_loaded ('PDO' ) && extension_loaded('pdo_mysql')){
    
        try {
            
            $db = new PDO('mysql:host=' . $_POST["host"] . ';dbname=' . $_POST["dbname"], $_POST["muser"], $_POST["mpass"]);        
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $res=$db->query("show tables");
                      
        } catch (PDOException $e) {
         
            
            die('Failed to connect using the given credentials.');
            exit(0);
        }
    
        echo 'works';
    
}
else{
    
    echo 'pdo_mysql not installed or enabled';
}
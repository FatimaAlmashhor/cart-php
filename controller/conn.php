<?php 
     


    $host       = 'mysql:host=localhost;dbname=e-commerce'; //or localhost
    $database   = 'e-commerce';
    $port       = 8081;
    $user       = 'root';
    $password   = '';


    try{
        $con  = new PDO( $host , $user, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }
    catch(PDOException $e)
    {
        echo 'Failed To Connected' . $e->getMassage();
    }

?>
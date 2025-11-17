<?php
function connect($base){  
    try{
        $idcom=new PDO("mysql:host=localhost;dbname=$base;charset=utf8","root"," ");
        return $idcom;
        //echo "connected successfully;
    }
    catch(PDOException $except){
        echo "Echec de la connection", $except->getMessage();
        return FALSE;
        exit();
    }
}
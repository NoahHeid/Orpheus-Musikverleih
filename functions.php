<?php
    function connectDatabase(){
    $servername = "localhost";
    $user = "root";
    $password = "";
    $datenbank = "instrumente";
    return new mysqli($servername, $user, $password, $datenbank);
    }
    
    function SQL($sql){
    $datenIstLeer = true;
    $connection = connectDatabase();
    if ($erg = $connection->query($sql)) {
    while ($datensatz = $erg->fetch_object()) {
        $datenIstLeer = false;
        $daten[] = $datensatz;
    }
    }
    if($datenIstLeer){
    return null;
    }
    else{
    return $daten;
    }

    }
?>
<?php
    //Stelle Verbindung zur Datenbank her!
    function connectDatabase(){
    $servername = "localhost";
    $user = "root";
    $password = "";
    $datenbank = "instrumente";
    return new mysqli($servername, $user, $password, $datenbank);
    }

    //Liefert auf eine SQL Anfrage einen Array, mit allen Objekten, oder NULL als Return-Wert!
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

    //Wird genutzt um die Timestamps zu sortieren.
    function vergleicheTimestamp($a, $b){
        return strcmp($a->stunden_zeitpunkt, $b->stunden_zeitpunkt);
    }
?>
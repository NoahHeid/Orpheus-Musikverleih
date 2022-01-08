<?php

function validiereZeit($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

if (isset($_GET["query"])){
    $timestamp = $_GET["query"];
    if(validiereZeit($timestamp)==true){
        echo "<span class='text-success'><strong>Valider</strong> Zeitstempel! :)</span>";
    }
    else{
        echo "<span class='text-danger'>Kein <strong>valider</strong> Zeitstempel! :(</span>";
    }
};

?>
<?php

function validiereZeit($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

if (isset($_GET["timestampAjax"])){
    $timestamp = $_GET["timestampAjax"];
    if(validiereZeit($timestamp)==true){
        echo "true";
    }
    else{
        echo "<span class='text-danger'>Leider nicht im richtigen Format. Gewünscht: Jahr-Monat-Tag Stunde:Min:Sekunde</span>";
    }
};

?>
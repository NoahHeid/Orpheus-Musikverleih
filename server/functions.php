<?php
    //Stelle Verbindung zur Datenbank her!
    function connectDatabase(){
        $servername = "localhost";
        $user = "root";
        $password = "";
        $datenbank = "instrumente";
        return new mysqli($servername, $user, $password, $datenbank);
    }

    //Liefert auf eine SQL Anfrage einen Array, mit allen Objekten. Ist das Array leer, wird NULL als Return-Wert zurückgegeben!
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

    //Wird genutzt um einen Timestamp in das Format "Vor XY Tagen und 22 Stunden" zu formatieren
    function letzteAnmeldung($q){
        if($q == "")
        {
            echo "Noch nie gesehen.";
        }
        else
        {
            $d = DateTime::createFromFormat('Y-m-d H:i:s', $q);
            $date = new DateTime();
            $differenz = $date->getTimestamp() - $d->getTimestamp();
            $seen = floor($differenz/60);
            $more = false;
            if($seen > 60) 
            {
                $more = true;
                $hours = floor($seen/60);
                $minutes = $seen-($hours*60);
                if(($seen > 24) && ($more == true)) {
                    $days = floor(($seen/60)/24);
                    $hours = floor($seen/60)-($days*24);
                }
                if($minutes == 1) {
                $minute = ' Minute ';  
                } else {
                $minute = ' Minuten ';
                }
                if($hours == 1) {
                $hour = ' Stunde ';  
                } else {
                $hour = ' Stunden ';
                }
                if($days == 1) {
                $day = ' Tag ';  
                } else {
                $day = ' Tage ';
                }
                if($days > 0) {  
                $seen = 'vor '. $days . $day . $hours . $hour . $minutes . $minute;
                } else {
                $seen = 'vor '. $hours . $hour . $minutes . $minute;
                }
            } 
            else 
            {
                if($seen == 1) {
                $minute = ' minute ';  
                } else {
                $minute = ' minuten ';
                }    
                $seen = 'vor '.$seen . $minute;
            }
                return $seen;
        }
    }



?>
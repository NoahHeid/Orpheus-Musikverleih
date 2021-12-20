<?php
$q = $_REQUEST["kd_anmeldeDatum"];

// lookup all hints from array if $q is different from ""
//echo $q;
if($q == ""){
    echo "Noch nie gesehen.";
}
else{


$d = DateTime::createFromFormat('Y-m-d H:i:s', $q);
$date = new DateTime();
$differenz = $date->getTimestamp() - $d->getTimestamp();
$seen = floor($differenz/60);
$more = false;
if($seen > 60) {
    $more = true;
    $hours = floor($seen/60);
    $minutes = $seen-($hours*60);
    if(($seen > 24) && ($more == true)) {
        $days = floor(($seen/60)/24);
        $hours = floor($seen/60)-($days*24);
    }
    if($minutes == 1) {
    $minute = ' minute ';  
    } else {
    $minute = ' minutes ';
    }
    if($hours == 1) {
    $hour = ' hour ';  
    } else {
    $hour = ' hours ';
    }
    if($days == 1) {
    $day = ' day ';  
    } else {
    $day = ' days ';
    }
    if($days > 0) {  
    $seen = $days . $day . $hours . $hour . $minutes . $minute . 'ago';
    } else {
    $seen = $hours . $hour . $minutes . $minute . 'ago';
    }
} else {
    if($seen == 1) {
    $minute = ' minute ';  
    } else {
    $minute = ' minutes ';
    }    
    $seen = $seen . $minute . 'ago';
    }
    echo $seen;
}
?>
<?php
    $servername = "localhost";
    $user = "root";
    $password = "";
    $datenbank = "instrumente";

    $connection = new mysqli($servername, $user, $password, $datenbank);

    if(isset($_POST['eintragen'])){
        $kdID = $_POST['eintragenKundenID'];
        $stID = $_POST['eintragenStundenID'];
        $kd_stelle = $_POST['eintragenKundenStelle'];
        $sql = "UPDATE `musikschulstunden` SET `$kd_stelle` = $kdID WHERE `stunden_id`=$stID";
        echo $sql;
        $connection->query($sql);
        $connection->close();
        header('Location: '."terminbuchung.php");
        die();
    }
    if(isset($_POST['austragen'])){
        $kdID = $_POST['austragenKundenID'];
        $stID = $_POST['austragenStundenID'];
        $kd_stelle = $_POST['austragenKundenStelle'];
        $sql = "UPDATE `musikschulstunden` SET `$kd_stelle` = 0 WHERE `stunden_id`=$stID";
        echo $sql;
        $connection->query($sql);
        $connection->close();
        header('Location: '."terminbuchung.php");
        die();
    }
    if(isset($_POST['neueStundeHinzufügen'])){
        $datum = $_POST['datum'];
        $lehrer = $_POST['lehrer'];
        $ort = $_POST['ort'];
        $map = getMap();
        if($map[$lehrer] =="error" || $map[$ort]=="error"){

        }
        $sql = "INSERT INTO `musikschulstunden`(`kd_idLehrkraft`, `stunden_zeitpunkt`, `stunden_ort`) VALUES ('$map[$lehrer]','$datum','$map[$ort]')";
        echo $sql;
        $connection->query($sql);
        $connection->close();
        header('Location: '."admin.php");
        die();
    }

    if(isset($_POST['alteStundeLöschen'])){
        

        $sql = "DELETE FROM `musikschulstunden` WHERE `stunden_id` = $id";
    }

    function getMap(){
        //"Noah Heidrich"->1, "Moritz Hussing"->2, "Online"->"online", "Hybrid"->"hybrid", "Vor Ort"-> "vorort"
        $map = array();
        $map["Wähle..."] = "error";
        $map["Noah Heidrich"] = 1;
        $map["Moritz Hussing"] = 2;
        $map["Online"] =    "online";
        $map["Hybrid"]=     "hybrid";
        $map["Vor Ort"] =   "vorort";
        return $map;
    }

?>
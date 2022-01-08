<?php
    include "functions.php";
    $connection = connectDatabase();

    //Sich selbst in eine Stunde eintragen!
    if(isset($_POST['eintragen'])){
        $kdID = $_POST['eintragenKundenID'];
        $stID = $_POST['eintragenStundenID'];
        $kd_stelle = $_POST['eintragenKundenStelle'];
        $sql = "UPDATE `musikschulstunden` SET `$kd_stelle` = $kdID WHERE `stunden_id`=$stID";
        echo $sql;
        $connection->query($sql);
        $connection->close();
        header('Location: '."../terminbuchung.php");
        die();
    }

    //Sich selbst aus einer Stunde austragen!
    if(isset($_POST['austragen'])){
        $kdID = $_POST['austragenKundenID'];
        $stID = $_POST['austragenStundenID'];
        $kd_stelle = $_POST['austragenKundenStelle'];
        $sql = "UPDATE `musikschulstunden` SET `$kd_stelle` = 0 WHERE `stunden_id`=$stID";
        echo $sql;
        $connection->query($sql);
        $connection->close();
        header('Location: '."../terminbuchung.php");
        die();
    }

    //Adminbereich: Neue Stunde anlegen
    if(isset($_POST['neueStundeHinzufügen'])){ 
        if($_POST['datum'] == "" || !isset($_POST['lehrer']) || !isset($_POST['ort']))
        {
            echo '
            <script>
                function kehreZurückFehler()
                {
                    alert("Eine oder mehrere der Eingaben waren leer. Bitte wähle alle drei Attribute aus!");
                    location.replace("../admin.php");
                }
            </script>
            <body onload="kehreZurückFehler()">
            ';
        }
        else{
            $datum = $_POST['datum'];
            $lehrer = $_POST['lehrer'];
            $ort = $_POST['ort'];
            //Übersetzt die Attribute aus der POST Request zu den richtigen Attributen, die in der Datenbank hinterlegt sind.
            $map = getMap();
            $sql = "INSERT INTO `musikschulstunden`(`kd_idLehrkraft`, `stunden_zeitpunkt`, `stunden_ort`) VALUES ('$map[$lehrer]','$datum','$map[$ort]')";
            echo $sql;
            $connection->query($sql);
            $connection->close();
            header('Location: '."../admin.php");
            die();
        }
    }

    //Adminbereich: Stunde aus der Datenbank löschen
    if(isset($_POST['stundeLöschen'])){
        $id = $_POST['toDeleteID'];
        $sql = "DELETE FROM `musikschulstunden` WHERE `stunden_id` = $id";
        echo $sql;
        $connection->query($sql);
        $connection->close();
        header('Location: '."../admin.php#musikstundenSpalte");
        die();
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
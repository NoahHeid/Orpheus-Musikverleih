<?php
session_start();
//Hole Values aus der Form
$email = $_POST['user'];
$pass = $_POST['pass'];


//Verbinde zum Server und wähle eine Datenbank aus
$servername = "localhost";
$user = "root";
$password = "";
$datenbank = "instrumente";

$connection = new mysqli($servername, $user, $password, $datenbank);

if($connection->connect_error){
    echo "Fehler!!!";
  die("Fehlermeldung: ".$connection->connect_error);
}

//Query die Datenbank nach usern
$sql = "SELECT * FROM kunden WHERE kd_email = '$email' AND kd_kennwort = '$pass'";
$ergebnis = $connection ->query($sql);

if($ergebnis->num_rows == 1){
    $i = $ergebnis->fetch_assoc();
    echo "Hallo: ID:".$i["kd_id"]." Name: ".$i["kd_vorname"]." ".$i["kd_nachname"];
    $_SESSION['loggedin'] = true;
    $_SESSION['id'] = $i["kd_id"];
    $_SESSION['vorname'] = $i["kd_vorname"];
    $_SESSION['nachname'] = $i["kd_nachname"];
    $_SESSION['email'] = $i["kd_email"];
    $_SESSION['handy'] = $i["kd_handy"];
    //Schliesse Datenbank!
    $connection->close();
    header('Location: '."index.php");
    die();
}
else{
     session_destroy();
     $connection->close();
     echo '
     <script>
            function redirect1()
            {
                document.getElementById("myform").submit();
            }
    </script>
     <body onload="redirect1()">
     <form action="index.php" method="post" id="myform">
        <input type="text" id="anmeldeFehler" name="anmeldeFehler" value="true" hidden><br>
        <input type="submit" name="Submit1" hidden>
    </form>';

}

?>
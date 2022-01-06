<?php
session_start();
//Hole Values aus der Form
$email = $_POST['user'];
$pass = $_POST['pass'];
if(isset($checkCookie)){
    $checkCookie = $_POST['checkCookie'];
}

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
//ALLE ANMELDE DATEN MÜSSEN GEHASHT WERDEN!!!
//Query die Datenbank nach usern
$hash = md5($pass);
$sql = "SELECT * FROM kunden WHERE kd_email = '$email' AND kd_kennwort = '$hash'";
$ergebnis = $connection ->query($sql);

if($ergebnis->num_rows == 1){
    $i = $ergebnis->fetch_assoc();
    //Speicher die Daten in der Session
    setzeSessionUndCookie($i, $email, $pass);
    //Update in der Datenbank die letzte Anmeldung
    $kdID = $i["kd_id"];
    $sqlupdate = "update kunden set kd_anmeldedatum =CURRENT_TIMESTAMP where kd_id = $kdID";
    $connection -> query($sqlupdate);
    //Schliesse Datenbank!
    $connection->close();
    echo '
    <script>
    function kehreZurückErfolg()
    {
      alert("Anmelden erfolgreich. Schön dich zu sehen '.$_SESSION['vorname'].'!");
      location.replace("index.php");
    }
    </script>
    <body onload="kehreZurückErfolg()">
    ';
}
else{
     session_destroy();
     $connection->close();
     echo '
     <script>
     function kehreZurückFehler()
     {
       alert("Anmelden nicht erfolgreich. Bitte versuche es nochmal!");
       location.replace("index.php");
     }
     </script>
     <body onload="kehreZurückFehler()">
     ';

}

function setzeSessionUndCookie($i, $email, $pass){
    $_SESSION['loggedin'] = true;
    $_SESSION['id'] = $i["kd_id"];
    $_SESSION['vorname'] = $i["kd_vorname"];
    $_SESSION['nachname'] = $i["kd_nachname"];
    $_SESSION['email'] = $i["kd_email"];
    $_SESSION['handy'] = $i["kd_handy"];
    if(isset($_POST['checkCookie'])){
        setcookie("user", $email);
        setcookie("password", $pass);
    }else{
        unset($_COOKIE["user"]);
        unset($_COOKIE["password"]);
        setcookie("user", "", time()-3600);
        setcookie("password", "", time()-3600);
    }
}
?>
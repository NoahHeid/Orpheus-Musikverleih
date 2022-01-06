<?php

session_start();

//Hole Values aus der Form
$email = $_POST['email'];
$pass = $_POST['pass'];
$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];
$tel = $_POST['telefonnummer'];


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

//Query die Datenbank nach usern und schaue, ob der User so schon existiert!
$sql = "SELECT * FROM kunden WHERE kd_email = '$email'";
$ergebnis = $connection ->query($sql);

//Wenn diese Email bereits vorhanden ist, gib eine Fehlermeldung!
if($ergebnis->num_rows > 0){
    session_destroy();
    $connection->close();
    echo '
    <script>
           function kehreZurückEmailDoppelt()
           {
              alert("Email bereits vorhanden!");
              location.replace("index.php");
           }
   </script>
  <body onload="kehreZurückEmailDoppelt()">';
}
//Ansonsten, lege einen neuen Nutzer an und führe den Nutzer zurück auf die richtige Seite.
else{
    $hash = md5($pass);
    $sql = "INSERT INTO kunden (kd_vorname, kd_nachname, kd_email, kd_handy, kd_kennwort) VALUES ('$vorname', '$nachname', '$email', '$tel', '$hash')";
    if ($connection->query($sql) === TRUE) {
      echo '
      <script>
      function kehreZurückErfolg()
      {
        alert("Registration erfolgreich. Bitte logge dich nun ein '.$vorname.'!");
        location.replace("index.php");
      }
      </script>
      ';
      $connection->close();
      echo '<body onload="kehreZurückErfolg()">';
    } 
    //Wenn es einen Fehler bei der Connection gab, gib ihn aus
    else {
      echo '
      <script>
      function kehreZurückFehler()
      {
        alert("Error");
        location.replace("index.php");
      }
      </script>
      <body onload="kehreZurückFehler()">';
      $connection->close();
    }
}
?>



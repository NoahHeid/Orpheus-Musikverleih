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

//Wenn mehr als einmal diese Mail in der Database ist_
if($ergebnis->num_rows > 0){
    echo "Email gibts schon";
    while($i = $ergebnis->fetch_assoc()){
        echo "Hallo: ID:".$i["kd_id"]." Name: ".$i["kd_vorname"]." ".$i["kd_nachname"]." ID: ".$i["kd_id"];
    }
    echo '
    <script>
           
           function redirect1()
           {
               document.getElementById("myform").submit();
           }
   </script>
    <body onload="alert("Fehler")">
    <form action="index.php" method="POST" id="myform">
       <input type="text" id="emailExistiertBereits" name="emailExistiert" value="true"><br>
       <input type="submit" name="Submit1" >
   </form>';
    //Schliesse Datenbank!
    $connection->close();


}
else{

}



/*
echo '
    <script>
           
           function redirect1()
           {
               document.getElementById("myform").submit();
           }
   </script>
    <body onload="alert("Fehler")">
    <form action="index.php" method="POST" id="myform">
       <input type="text" id="emailExistiertBereits" name="emailExistiert" value="true" hidden><br>
       <input type="submit" name="Submit1" hidden>
   </form>';
*/
?>


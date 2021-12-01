<?php
$benutzer = "root";
$kennwort = "";
$db_name = "instrumente";
$mysqli = new mysqli("localhost",$benutzer, $kennwort, $db_name);

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

// Return name of current default database
if ($result = $mysqli -> query("SELECT DATABASE()")) {
  $row = $result -> fetch_row();
  echo "Default database is " . $row[0];
  echo " </br> --- </br>";
  $result -> close();
}

// Change db to "test" db
$mysqli -> select_db("instrumente");

// Return name of current default database
if ($result = $mysqli -> query("SELECT DATABASE()")) {
  $row = $result -> fetch_row();
  echo "Default database is " . $row[0];
  $result -> close();
}

$mysqli -> close();
?>
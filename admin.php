<?php
    session_start();
    if(isset($_SESSION['loggedin'])){
      $eingeloggt = true;
    }
    else{
      $eingeloggt = false;
    }
    if(!$eingeloggt || $_SESSION['id']>2){
      echo "header('Location: '.'index.php');die();";
    }
?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500&display=swap" rel="stylesheet">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"
    />
    <link
      href="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Orpheus Musikverleih</title>
  </head>
  <body>
    <div class="bgmaincolor5">

      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top bgmaincolor1">
        <div class="container">
          <a href="index.php" class="navbar-brand"><img src="img/OrpheusLogoKleinTransparentGoldeneSchrift.png" alt="Logo" style="width: 150px"></a>

          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navmenu"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
            
              <li class="nav-item mx-2">
                <?php 
                  if(!$eingeloggt){
                    echo '<button
                    class="btn btn-warning btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#anmelden"
                    
                  > Anmelden
                  </button>
                  </li>
                  <li class="nav-item">
                    <button
                      class="btn btn-warning btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#registrieren"
                    >Registrieren
                  </button>
                  </li>';
                  }
                  else{
                    echo '<form action="logout.php">
                            <button type="submit" class="btn btn-warning btn-sm" >Abmelden</button>
                          </form>
                          </li>';
                  }
                ?>
                
              
              
            </ul>
          </div>
        </div>
      </nav>

      <!-- Showcase -->
      <section class="text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor1">
        <div class="container">
          <div class="d-sm-flex align-items-center justify-content-between">
            <div>
              <h1> <?php if($eingeloggt){echo "Lieber ".$_SESSION['vorname']." b";}else{echo "B";} ?>eginne mit uns deine Reise in die <span class="text-warning"> Welt der Musik!</span></h1>
              <p class="lead my-4">

              <em>Die Musik drückt das aus, was nicht gesagt werden kann und worüber zu schweigen unmöglich ist.</em> <br>
              - Victor Hugo
              </p>

            </div>
            <img
              class="img-fluid w-25 d-none d-sm-block"
              src="img/310984.svg"
              alt=""
            />
          </div>
        </div>
      </section>
      <!-- Instrumente -->
      <section class="text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor2">
        <div class="row">
                  <div class="d-flex justify-content-center h2 ">Instrumente</div>
                  <!-- Linke Spalte-->
                  <div class="col">
                    <div class="text-center h3 text-warning">Geigen</div>
                  </div>
                  <!-- Rechte Spalte-->
                  <div class="col">
                  <div class="text-center h3 text-warning">Harfen</div>
                  <?php
                    $servername = "localhost";
                    $user = "root";
                    $password = "";
                    $datenbank = "instrumente";
                  
                    $connection = new mysqli($servername, $user, $password, $datenbank);
                    $sql = "SELECT * FROM harfen";
                    if ($erg = $connection->query($sql)) {
                      if ($erg->num_rows) {
                      // print_r($erg->num_rows);
                       $ds_gesamt = $erg->num_rows;
                       $erg->free();
                     }
                     if ($erg = $connection->query($sql)) {
                       while ($datensatz = $erg->fetch_object()) {
                         $daten[] = $datensatz;
                       }
                     }
                   }
                   ?>
                   <table class="table text-light">
                    <thead>
                   <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Harfe</th>
                    <th scope="col">Ausgeliehen an</th>
                    <th scope="col">Ausgeliehen am</th>
                   </tr>
                 </thead>
                 <tbody>
                 <?php
                 foreach ($daten as $inhalt) {
                 ?>
          
                      <tr>
                          <th scope="row"> <?php echo $inhalt->hf_id; ?></th>
                          <td>
                              <?php echo $inhalt->hf_name; ?>
                          </td>
                          <td>
                              <?php echo $inhalt->kd_id; ?>
                          </td> 
                          <td>
                              <?php echo $inhalt->hf_ausleihdatum; ?>
                          </td>               
                    </tr>
                <?php
                }
                echo '</tbody>
                </table>';
                ?>
                  </div>
         </div>
      </section>   
   </div>   
   <footer class="p-5 bg-dark text-white text-center position-relative">
      <div class="container">
        <p class="lead">Copyright &copy; 2021 Noah Heidrich, Moritz Hussing</p>

        <a href="#" class="position-absolute bottom-0 end-0 p-5">
          <i class="bi bi-arrow-up-circle h1"></i>
        </a>
      </div>
    </footer>        
  </body>
</html>

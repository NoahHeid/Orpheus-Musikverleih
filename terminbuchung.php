<?php
    session_start();
    if(isset($_SESSION['loggedin'])){
      if($_SESSION['loggedin']==TRUE){
        $eingeloggt = true;
      }else{
        $eingeloggt = false;
      }
    }
    else{
      $eingeloggt = false;
    }
    if(!$eingeloggt){
      header('Location: '.'index.php');
    }
    include "server/functions.php";
    include "statisch/header.php";
?>

<!-- Showcase -->
<section class="text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor1">
  <div class="container">
    <div class="d-sm-flex align-items-center justify-content-between">
      <div>
        <h1> <?php echo "Liebe*r ".$_SESSION['vorname']?>, viel Spaß beim Meistern deines <span class="text-warning"> Instruments!</span></h1>
        <p class="lead my-4"> 
          Herzlichen Glückwunsch, der erste Schritt ist fast getan. Wir freuen uns auf dich!
        </p>
      </div>
      <img class="img-fluid w-25 d-none d-sm-block" src="img/310984.svg" alt="" />
    </div>
  </div>
</section>

<!-- Überfällige Instrumente zurückgeben! -->
<section class = "text-center">
  <!-- Nutze hier PHP Code um zu schauen, ob ein Instrument zu lange ausgeliehen wurde -->
  <?php
    //Sieh nach, ob der Nutzer ein Instrument zu lange besitzt und es zurückgeben muss
    if($eingeloggt)
    {
        $überfälligeInstrumente = prüfeÜberfälligkeit($_SESSION['id']);      
        if(!empty($überfälligeInstrumente))
        {
            if(count($überfälligeInstrumente)>0){
            if(isset($überfälligeInstrumente[0]->hf_name))
            {
                $überfälligesBeispielInstrument = $überfälligeInstrumente[0]->hf_name;
                $fälligSeit = date("d.m.y", strtotime($überfälligeInstrumente[0]->hf_ausleihdatum)+604800);
            }
            else
            {
                $überfälligesBeispielInstrument= $überfälligeInstrumente[0]->gg_name;
                $fälligSeit = date("d.m.y", strtotime($überfälligeInstrumente[0]->gg_ausleihdatum)+604800);
            }
            echo "
                <div class='h1 text-danger'>
                Bitte gib die überfälligen Instrumente zurück! Unter anderem: ".$überfälligesBeispielInstrument." sie ist fällig seit ".$fälligSeit."
                </div>
                <script>
                alert('Du hast überfällige Instrumente:
                    ".$überfälligesBeispielInstrument."
                ');
                </script>
            ";
            }
        }    

    } 
  ?>
</section>

<!-- Online Termine -->
<section class="text-dark p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor5" id="online">
  <div class="container">
    <div class="h2 text-center">Online</div>
    <div class="row">
      <div class="col-sm">
        <table class="table text-dark mr-5">
          <thead>
            <tr>
              
              <th scope="col">Datum</th>
              <th scope="col">Lehrkraft</th>
              <th scope="col">Teilnehmer 1</th>
              <th scope="col">Teilnehmer 2</th>
              <th scope="col">Teilnehmer 3</th>
              <th scope="col">Teilnehmer 4</th>
              <th scope="col">Teilnehmer 5</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
              $musikschulDaten = SQL("SELECT * FROM musikschulstunden where stunden_zeitpunkt > CURRENT_TIMESTAMP");
              //Gib die Anzahl der Schüler an
              function gibAnzahlSchüler($inhalt){
                if($inhalt->kd_id1 == 0){
                  return 0;
                }
                if($inhalt->kd_id2 == 0){
                  return 1;
                }
                if($inhalt->kd_id3 == 0){
                  return 2;
                }
                if($inhalt->kd_id4 == 0){
                  return 3;
                }
                if($inhalt->kd_id5 == 0){
                  return 4;
                }
                if($inhalt->kd_id5 == 1){
                  return 5;
                }
              }

              usort($musikschulDaten, "vergleicheTimestamp");
              foreach ($musikschulDaten as $inhalt) {
                if($inhalt->stunden_ort=="online"){
                  gibAnzahlSchüler($inhalt);
            ?>
            <tr>

              <!-- Datum -->
              <td>
                <?php echo date("H:i", strtotime($inhalt->stunden_zeitpunkt))." Uhr am ".date("d.m.y", strtotime($inhalt->stunden_zeitpunkt)); ?>
              </td> 

              <!-- Lehrkraft -->
              <th scope="row"> 
                <?php 
                  $lehrer = $inhalt->kd_idLehrkraft; 
                  $lehrkraftdaten = SQL("SELECT * FROM kunden where $lehrer= `kd_id`");
                  if($lehrkraftdaten[0]!=null){
                    echo $lehrkraftdaten[0]->kd_vorname." ".$lehrkraftdaten[0]->kd_nachname;
                  }
                  else{
                    echo "-";
                  }                      
                ?>
              </th>
              <td>
                <?php 
                //Schüler 1
                  $schueler1daten = SQL("SELECT * FROM kunden where $inhalt->kd_id1= `kd_id`");
                  //Wenn ein Schüler bereits die Stunde besucht:
                  if($schueler1daten[0]!=null){
                    if($schueler1daten[0]->kd_id==$_SESSION['id']){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="austragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="austragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="austragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Austragen" name="austragen" id="austragen">
                        </div>
                      </form>
                      ';
                    }
                    else{
                      echo $schueler1daten[0]->kd_vorname." ".$schueler1daten[0]->kd_nachname;
                    }
                    
                  }
                  //Wenn bisher kein Schüler die Stunde besucht
                  else{
                    if(gibAnzahlSchüler($inhalt)==0){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="eintragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="eintragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="eintragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)+1).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Eintragen" name="eintragen" id="eintragen">
                        </div>
                      </form>
                      ';
                    }else{
                      echo "-";
                    }
                  }
                ?>
              </td>  
              <td>
                <?php 
                //Schüler 2
                  $schueler2daten = SQL("SELECT * FROM kunden where $inhalt->kd_id2= `kd_id`");
                  //Wenn ein Schüler bereits die Stunde besucht:
                  if($schueler2daten[0]!=null){
                    if($schueler2daten[0]->kd_id==$_SESSION['id']){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="austragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="austragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="austragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Austragen" name="austragen" id="austragen">
                        </div>
                      </form>
                      ';
                    }
                    else{
                      echo $schueler2daten[0]->kd_vorname." ".$schueler2daten[0]->kd_nachname;
                    }
                    
                  }
                  //Wenn bisher kein Schüler die Stunde besucht
                  else{
                    if(gibAnzahlSchüler($inhalt)==1){
                      //Wenn der Schüler bereits woanders eingetragen ist:
                      if($schueler1daten[0]->kd_id!=$_SESSION['id']){
                        echo '
                        <form method="post" action="server/terminbuchen.php">
                          <div class="input-group mb-3">
                            <input type="text" hidden name="eintragenKundenID" value='.$_SESSION['id'].'>
                            <input type="text" hidden name="eintragenStundenID" value='.$inhalt->stunden_id.'>
                            <input type="text" hidden name="eintragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)+1).'">
                            <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Eintragen" name="eintragen" id="eintragen">
                          </div>
                        </form>
                        ';
                      }else{
                        echo "-";
                      }
                    }else{
                      echo "-";
                    }
                  }
                  ?>  
              </td>  
              <td>
              <?php 
                //Schüler 3
                $schueler3daten = SQL("SELECT * FROM kunden where $inhalt->kd_id3= `kd_id`");
                //Wenn ein Schüler bereits die Stunde besucht:
                if($schueler3daten[0]!=null){
                  if($schueler3daten[0]->kd_id==$_SESSION['id']){
                    echo '
                    <form method="post" action="server/terminbuchen.php">
                      <div class="input-group mb-3">
                        <input type="text" hidden name="austragenKundenID" value='.$_SESSION['id'].'>
                        <input type="text" hidden name="austragenStundenID" value='.$inhalt->stunden_id.'>
                        <input type="text" hidden name="austragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)).'">
                        <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Austragen" name="austragen" id="austragen">
                      </div>
                    </form>
                    ';
                  }
                  else{
                    echo $schueler3daten[0]->kd_vorname." ".$schueler3daten[0]->kd_nachname;
                  }
                  
                }
                //Wenn bisher kein Schüler die Stunde besucht
                else{
                  if(gibAnzahlSchüler($inhalt)==2){
                    //Wenn der Schüler bereits woanders eingetragen ist:
                    if($schueler2daten[0]->kd_id!=$_SESSION['id']){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="eintragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="eintragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="eintragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)+1).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Eintragen" name="eintragen" id="eintragen">
                        </div>
                      </form>
                      ';
                    }else{
                      echo "-";
                    }
                  }else{
                    echo "-";
                  }
                }
                  ?>  
              </td>  
              <td>
              <?php 
                //Schüler 4
                  $schueler4daten = SQL("SELECT * FROM kunden where $inhalt->kd_id4= `kd_id`");
                  //Wenn ein Schüler bereits die Stunde besucht:
                  if($schueler4daten[0]!=null){
                    if($schueler4daten[0]->kd_id==$_SESSION['id']){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="austragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="austragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="austragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Austragen" name="austragen" id="austragen">
                        </div>
                      </form>
                      ';
                    }
                    else{
                      echo $schueler4daten[0]->kd_vorname." ".$schueler4daten[0]->kd_nachname;
                    }
                    
                  }
                  //Wenn bisher kein Schüler die Stunde besucht
                  else{
                    if(gibAnzahlSchüler($inhalt)==3){
                      //Wenn der Schüler bereits woanders eingetragen ist:
                      if($schueler3daten[0]->kd_id!=$_SESSION['id']){
                        echo '
                        <form method="post" action="server/terminbuchen.php">
                          <div class="input-group mb-3">
                            <input type="text" hidden name="eintragenKundenID" value='.$_SESSION['id'].'>
                            <input type="text" hidden name="eintragenStundenID" value='.$inhalt->stunden_id.'>
                            <input type="text" hidden name="eintragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)+1).'">
                            <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Eintragen" name="eintragen" id="eintragen">
                          </div>
                        </form>
                        ';
                      }else{
                        echo "-";
                      }
                    }else{
                      echo "-";
                    }
                  }
                  ?>  
              </td>  
              <td>
              <?php 
                //Schüler 5
                  $schueler5daten = SQL("SELECT * FROM kunden where $inhalt->kd_id5= `kd_id`");
                  //Wenn ein Schüler bereits die Stunde besucht:
                  if($schueler5daten[0]!=null){
                    if($schueler5daten[0]->kd_id==$_SESSION['id']){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="austragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="austragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="austragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Austragen" name="austragen" id="austragen">
                        </div>
                      </form>
                      ';
                    }
                    else{
                      echo $schueler5daten[0]->kd_vorname." ".$schueler5daten[0]->kd_nachname;
                    }
                    
                  }
                  //Wenn bisher kein Schüler die Stunde besucht
                  else{
                    if(gibAnzahlSchüler($inhalt)==4){
                      //Wenn der Schüler bereits woanders eingetragen ist:
                      if($schueler4daten[0]->kd_id!=$_SESSION['id']){
                        echo '
                        <form method="post" action="server/terminbuchen.php">
                          <div class="input-group mb-3">
                            <input type="text" hidden name="eintragenKundenID" value='.$_SESSION['id'].'>
                            <input type="text" hidden name="eintragenStundenID" value='.$inhalt->stunden_id.'>
                            <input type="text" hidden name="eintragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)+1).'">
                            <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Eintragen" name="eintragen" id="eintragen">
                          </div>
                        </form>
                        ';
                      }else{
                        echo "-";
                      }
                    }else{
                      echo "-";
                    }
                  }
                  ?>  
              </td>  
 
            </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- Hybrid Termine -->
<section class="text-dark p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor5" id="hybrid">
  <div class="container">
    <div class="h2 text-center">Hybrid</div>
    <div class="row">
      <div class="col-sm">
        <table class="table text-dark mr-5">
          <thead>
            <tr>
              <th scope="col">Datum</th>
              <th scope="col">Lehrkraft</th>
              <th scope="col">Teilnehmer 1</th>
              <th scope="col">Teilnehmer 2</th>
              <th scope="col">Teilnehmer 3</th>
              <th scope="col">Teilnehmer 4</th>
              <th scope="col">Teilnehmer 5</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $musikschulDaten = SQL("SELECT * FROM musikschulstunden where stunden_zeitpunkt > CURRENT_TIMESTAMP");
              //Gib die Anzahl der Schüler an
              usort($musikschulDaten, "vergleicheTimestamp");
              foreach ($musikschulDaten as $inhalt) {
                if($inhalt->stunden_ort=="hybrid"){
                  gibAnzahlSchüler($inhalt);
            ?>
            <tr>

              <!-- Datum -->
              <td>
                <?php echo date("H:i", strtotime($inhalt->stunden_zeitpunkt))." Uhr am ".date("d.m.y", strtotime($inhalt->stunden_zeitpunkt)); ?>
              </td> 
              
              <!-- Lehrkraft -->
              <th scope="row"> 
                <?php 
                  $lehrer = $inhalt->kd_idLehrkraft; 
                  $lehrkraftdaten = SQL("SELECT * FROM kunden where $lehrer= `kd_id`");
                  if($lehrkraftdaten[0]!=null){
                    echo $lehrkraftdaten[0]->kd_vorname." ".$lehrkraftdaten[0]->kd_nachname;
                  }
                  else{
                    echo "-";
                  }                      
                ?>
              </th>
              <td>
                <?php 
                //Schüler 1
                  $schueler1daten = SQL("SELECT * FROM kunden where $inhalt->kd_id1= `kd_id`");
                  //Wenn ein Schüler bereits die Stunde besucht:
                  if($schueler1daten[0]!=null){
                    if($schueler1daten[0]->kd_id==$_SESSION['id']){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="austragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="austragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="austragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Austragen" name="austragen" id="austragen">
                        </div>
                      </form>
                      ';
                    }
                    else{
                      echo $schueler1daten[0]->kd_vorname." ".$schueler1daten[0]->kd_nachname;
                    }
                    
                  }
                  //Wenn bisher kein Schüler die Stunde besucht
                  else{
                    if(gibAnzahlSchüler($inhalt)==0){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="eintragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="eintragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="eintragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)+1).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Eintragen" name="eintragen" id="eintragen">
                        </div>
                      </form>
                      ';
                    }else{
                      echo "-";
                    }
                  }
                ?>
              </td>  
              <td>
                <?php 
                //Schüler 2
                  $schueler2daten = SQL("SELECT * FROM kunden where $inhalt->kd_id2= `kd_id`");
                  //Wenn ein Schüler bereits die Stunde besucht:
                  if($schueler2daten[0]!=null){
                    if($schueler2daten[0]->kd_id==$_SESSION['id']){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="austragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="austragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="austragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Austragen" name="austragen" id="austragen">
                        </div>
                      </form>
                      ';
                    }
                    else{
                      echo $schueler2daten[0]->kd_vorname." ".$schueler2daten[0]->kd_nachname;
                    }
                    
                  }
                  //Wenn bisher kein Schüler die Stunde besucht
                  else{
                    if(gibAnzahlSchüler($inhalt)==1){
                      //Wenn der Schüler bereits woanders eingetragen ist:
                      if($schueler1daten[0]->kd_id!=$_SESSION['id']){
                        echo '
                        <form method="post" action="server/terminbuchen.php">
                          <div class="input-group mb-3">
                            <input type="text" hidden name="eintragenKundenID" value='.$_SESSION['id'].'>
                            <input type="text" hidden name="eintragenStundenID" value='.$inhalt->stunden_id.'>
                            <input type="text" hidden name="eintragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)+1).'">
                            <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Eintragen" name="eintragen" id="eintragen">
                          </div>
                        </form>
                        ';
                      }else{
                        echo "-";
                      }
                    }else{
                      echo "-";
                    }
                  }
                  ?>  
              </td>  
              <td>
              <?php 
                //Schüler 3
                $schueler3daten = SQL("SELECT * FROM kunden where $inhalt->kd_id3= `kd_id`");
                //Wenn ein Schüler bereits die Stunde besucht:
                if($schueler3daten[0]!=null){
                  if($schueler3daten[0]->kd_id==$_SESSION['id']){
                    echo '
                    <form method="post" action="server/terminbuchen.php">
                      <div class="input-group mb-3">
                        <input type="text" hidden name="austragenKundenID" value='.$_SESSION['id'].'>
                        <input type="text" hidden name="austragenStundenID" value='.$inhalt->stunden_id.'>
                        <input type="text" hidden name="austragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)).'">
                        <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Austragen" name="austragen" id="austragen">
                      </div>
                    </form>
                    ';
                  }
                  else{
                    echo $schueler3daten[0]->kd_vorname." ".$schueler3daten[0]->kd_nachname;
                  }
                  
                }
                //Wenn bisher kein Schüler die Stunde besucht
                else{
                  if(gibAnzahlSchüler($inhalt)==2){
                    //Wenn der Schüler bereits woanders eingetragen ist:
                    if($schueler2daten[0]->kd_id!=$_SESSION['id']){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="eintragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="eintragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="eintragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)+1).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Eintragen" name="eintragen" id="eintragen">
                        </div>
                      </form>
                      ';
                    }else{
                      echo "-";
                    }
                  }else{
                    echo "-";
                  }
                }
                  ?>  
              </td>  
              <td>
              <?php 
                //Schüler 4
                  $schueler4daten = SQL("SELECT * FROM kunden where $inhalt->kd_id4= `kd_id`");
                  //Wenn ein Schüler bereits die Stunde besucht:
                  if($schueler4daten[0]!=null){
                    if($schueler4daten[0]->kd_id==$_SESSION['id']){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="austragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="austragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="austragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Austragen" name="austragen" id="austragen">
                        </div>
                      </form>
                      ';
                    }
                    else{
                      echo $schueler4daten[0]->kd_vorname." ".$schueler4daten[0]->kd_nachname;
                    }
                    
                  }
                  //Wenn bisher kein Schüler die Stunde besucht
                  else{
                    if(gibAnzahlSchüler($inhalt)==3){
                      //Wenn der Schüler bereits woanders eingetragen ist:
                      if($schueler3daten[0]->kd_id!=$_SESSION['id']){
                        echo '
                        <form method="post" action="server/terminbuchen.php">
                          <div class="input-group mb-3">
                            <input type="text" hidden name="eintragenKundenID" value='.$_SESSION['id'].'>
                            <input type="text" hidden name="eintragenStundenID" value='.$inhalt->stunden_id.'>
                            <input type="text" hidden name="eintragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)+1).'">
                            <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Eintragen" name="eintragen" id="eintragen">
                          </div>
                        </form>
                        ';
                      }else{
                        echo "-";
                      }
                    }else{
                      echo "-";
                    }
                  }
                  ?>  
              </td>  
              <td>
              <?php 
                //Schüler 5
                  $schueler5daten = SQL("SELECT * FROM kunden where $inhalt->kd_id5= `kd_id`");
                  //Wenn ein Schüler bereits die Stunde besucht:
                  if($schueler5daten[0]!=null){
                    if($schueler5daten[0]->kd_id==$_SESSION['id']){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="austragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="austragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="austragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Austragen" name="austragen" id="austragen">
                        </div>
                      </form>
                      ';
                    }
                    else{
                      echo $schueler5daten[0]->kd_vorname." ".$schueler5daten[0]->kd_nachname;
                    }
                    
                  }
                  //Wenn bisher kein Schüler die Stunde besucht
                  else{
                    if(gibAnzahlSchüler($inhalt)==4){
                      //Wenn der Schüler bereits woanders eingetragen ist:
                      if($schueler4daten[0]->kd_id!=$_SESSION['id']){
                        echo '
                        <form method="post" action="server/terminbuchen.php">
                          <div class="input-group mb-3">
                            <input type="text" hidden name="eintragenKundenID" value='.$_SESSION['id'].'>
                            <input type="text" hidden name="eintragenStundenID" value='.$inhalt->stunden_id.'>
                            <input type="text" hidden name="eintragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)+1).'">
                            <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Eintragen" name="eintragen" id="eintragen">
                          </div>
                        </form>
                        ';
                      }else{
                        echo "-";
                      }
                    }else{
                      echo "-";
                    }
                  }
                  ?>  
              </td>  

            </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- Präsenz -->
<section class="text-dark p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor5" id="vorort">
  <div class="container">
    <div class="h2 text-center">Vor Ort</div>
    <div class="row">
      <div class="col-sm">
        <table class="table text-dark mr-5">
          <thead>
            <tr>
              <th scope="col">Datum</th>
              <th scope="col">Lehrkraft</th>
              <th scope="col">Teilnehmer 1</th>
              <th scope="col">Teilnehmer 2</th>
              <th scope="col">Teilnehmer 3</th>
              <th scope="col">Teilnehmer 4</th>
              <th scope="col">Teilnehmer 5</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
              $musikschulDaten = SQL("SELECT * FROM musikschulstunden where stunden_zeitpunkt > CURRENT_TIMESTAMP");
              //Gib die Anzahl der Schüler an
              usort($musikschulDaten, "vergleicheTimestamp");
              foreach ($musikschulDaten as $inhalt) {
                if($inhalt->stunden_ort=="vorort"){
                  gibAnzahlSchüler($inhalt);
            ?>
            <tr>
              
              <!-- Datum -->
              <td>
                <?php echo date("H:i", strtotime($inhalt->stunden_zeitpunkt))." Uhr am ".date("d.m.y", strtotime($inhalt->stunden_zeitpunkt)); ?>
              </td> 
              
              <!-- Lehrkraft -->
              <th scope="row"> 
                <?php 
                  $lehrer = $inhalt->kd_idLehrkraft; 
                  $lehrkraftdaten = SQL("SELECT * FROM kunden where $lehrer= `kd_id`");
                  if($lehrkraftdaten[0]!=null){
                    echo $lehrkraftdaten[0]->kd_vorname." ".$lehrkraftdaten[0]->kd_nachname;
                  }
                  else{
                    echo "-";
                  }                      
                ?>
              </th>
              <td>
                <?php 
                //Schüler 1
                  $schueler1daten = SQL("SELECT * FROM kunden where $inhalt->kd_id1= `kd_id`");
                  //Wenn ein Schüler bereits die Stunde besucht:
                  if($schueler1daten[0]!=null){
                    if($schueler1daten[0]->kd_id==$_SESSION['id']){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="austragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="austragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="austragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Austragen" name="austragen" id="austragen">
                        </div>
                      </form>
                      ';
                    }
                    else{
                      echo $schueler1daten[0]->kd_vorname." ".$schueler1daten[0]->kd_nachname;
                    }
                    
                  }
                  //Wenn bisher kein Schüler die Stunde besucht
                  else{
                    if(gibAnzahlSchüler($inhalt)==0){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="eintragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="eintragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="eintragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)+1).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Eintragen" name="eintragen" id="eintragen">
                        </div>
                      </form>
                      ';
                    }else{
                      echo "-";
                    }
                  }
                ?>
              </td>  
              <td>
                <?php 
                //Schüler 2
                  $schueler2daten = SQL("SELECT * FROM kunden where $inhalt->kd_id2= `kd_id`");
                  //Wenn ein Schüler bereits die Stunde besucht:
                  if($schueler2daten[0]!=null){
                    if($schueler2daten[0]->kd_id==$_SESSION['id']){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="austragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="austragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="austragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Austragen" name="austragen" id="austragen">
                        </div>
                      </form>
                      ';
                    }
                    else{
                      echo $schueler2daten[0]->kd_vorname." ".$schueler2daten[0]->kd_nachname;
                    }
                    
                  }
                  //Wenn bisher kein Schüler die Stunde besucht
                  else{
                    if(gibAnzahlSchüler($inhalt)==1){
                      //Wenn der Schüler bereits woanders eingetragen ist:
                      if($schueler1daten[0]->kd_id!=$_SESSION['id']){
                        echo '
                        <form method="post" action="server/terminbuchen.php">
                          <div class="input-group mb-3">
                            <input type="text" hidden name="eintragenKundenID" value='.$_SESSION['id'].'>
                            <input type="text" hidden name="eintragenStundenID" value='.$inhalt->stunden_id.'>
                            <input type="text" hidden name="eintragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)+1).'">
                            <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Eintragen" name="eintragen" id="eintragen">
                          </div>
                        </form>
                        ';
                      }else{
                        echo "-";
                      }
                    }else{
                      echo "-";
                    }
                  }
                  ?>  
              </td>  
              <td>
              <?php 
                //Schüler 3
                $schueler3daten = SQL("SELECT * FROM kunden where $inhalt->kd_id3= `kd_id`");
                //Wenn ein Schüler bereits die Stunde besucht:
                if($schueler3daten[0]!=null){
                  if($schueler3daten[0]->kd_id==$_SESSION['id']){
                    echo '
                    <form method="post" action="server/terminbuchen.php">
                      <div class="input-group mb-3">
                        <input type="text" hidden name="austragenKundenID" value='.$_SESSION['id'].'>
                        <input type="text" hidden name="austragenStundenID" value='.$inhalt->stunden_id.'>
                        <input type="text" hidden name="austragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)).'">
                        <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Austragen" name="austragen" id="austragen">
                      </div>
                    </form>
                    ';
                  }
                  else{
                    echo $schueler3daten[0]->kd_vorname." ".$schueler3daten[0]->kd_nachname;
                  }
                  
                }
                //Wenn bisher kein Schüler die Stunde besucht
                else{
                  if(gibAnzahlSchüler($inhalt)==2){
                    //Wenn der Schüler bereits woanders eingetragen ist:
                    if($schueler2daten[0]->kd_id!=$_SESSION['id']){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="eintragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="eintragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="eintragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)+1).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Eintragen" name="eintragen" id="eintragen">
                        </div>
                      </form>
                      ';
                    }else{
                      echo "-";
                    }
                  }else{
                    echo "-";
                  }
                }
                  ?>  
              </td>  
              <td>
              <?php 
                //Schüler 4
                  $schueler4daten = SQL("SELECT * FROM kunden where $inhalt->kd_id4= `kd_id`");
                  //Wenn ein Schüler bereits die Stunde besucht:
                  if($schueler4daten[0]!=null){
                    if($schueler4daten[0]->kd_id==$_SESSION['id']){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="austragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="austragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="austragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Austragen" name="austragen" id="austragen">
                        </div>
                      </form>
                      ';
                    }
                    else{
                      echo $schueler4daten[0]->kd_vorname." ".$schueler4daten[0]->kd_nachname;
                    }
                    
                  }
                  //Wenn bisher kein Schüler die Stunde besucht
                  else{
                    if(gibAnzahlSchüler($inhalt)==3){
                      //Wenn der Schüler bereits woanders eingetragen ist:
                      if($schueler3daten[0]->kd_id!=$_SESSION['id']){
                        echo '
                        <form method="post" action="server/terminbuchen.php">
                          <div class="input-group mb-3">
                            <input type="text" hidden name="eintragenKundenID" value='.$_SESSION['id'].'>
                            <input type="text" hidden name="eintragenStundenID" value='.$inhalt->stunden_id.'>
                            <input type="text" hidden name="eintragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)+1).'">
                            <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Eintragen" name="eintragen" id="eintragen">
                          </div>
                        </form>
                        ';
                      }else{
                        echo "-";
                      }
                    }else{
                      echo "-";
                    }
                  }
                  ?>  
              </td>  
              <td>
              <?php 
                //Schüler 5
                  $schueler5daten = SQL("SELECT * FROM kunden where $inhalt->kd_id5= `kd_id`");
                  //Wenn ein Schüler bereits die Stunde besucht:
                  if($schueler5daten[0]!=null){
                    if($schueler5daten[0]->kd_id==$_SESSION['id']){
                      echo '
                      <form method="post" action="server/terminbuchen.php">
                        <div class="input-group mb-3">
                          <input type="text" hidden name="austragenKundenID" value='.$_SESSION['id'].'>
                          <input type="text" hidden name="austragenStundenID" value='.$inhalt->stunden_id.'>
                          <input type="text" hidden name="austragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)).'">
                          <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Austragen" name="austragen" id="austragen">
                        </div>
                      </form>
                      ';
                    }
                    else{
                      echo $schueler5daten[0]->kd_vorname." ".$schueler5daten[0]->kd_nachname;
                    }
                    
                  }
                  //Wenn bisher kein Schüler die Stunde besucht
                  else{
                    if(gibAnzahlSchüler($inhalt)==4){
                      //Wenn der Schüler bereits woanders eingetragen ist:
                      if($schueler4daten[0]->kd_id!=$_SESSION['id']){
                        echo '
                        <form method="post" action="server/terminbuchen.php">
                          <div class="input-group mb-3">
                            <input type="text" hidden name="eintragenKundenID" value='.$_SESSION['id'].'>
                            <input type="text" hidden name="eintragenStundenID" value='.$inhalt->stunden_id.'>
                            <input type="text" hidden name="eintragenKundenStelle" value="kd_id'.(gibAnzahlSchüler($inhalt)+1).'">
                            <input type="submit" class="btn-sm bg-transparent btn-outline-primary"  value="Eintragen" name="eintragen" id="eintragen">
                          </div>
                        </form>
                        ';
                      }else{
                        echo "-";
                      }
                    }else{
                      echo "-";
                    }
                  }
                  ?>  
              </td>   
            </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<?php
  include "statisch/footer.php";
?>
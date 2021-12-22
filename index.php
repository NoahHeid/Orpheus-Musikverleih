<?php
    session_start();
    if(isset($_SESSION['loggedin'])){
      $eingeloggt = true;
    }
    else{
      $eingeloggt = false;
    }

?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
            <li class="nav-item">
              <a href="#orpheus" class="nav-link text-warning">Orpheus</a>
            </li>
            <li class="nav-item">
              <a href="#faq" class="nav-link text-warning">FAQ</a>
            </li>
            <li class="nav-item">
              <a href="#werwirsind" class="nav-link text-warning">Wer wir sind</a>
            </li>
            <li class="nav-item">
              <a href="#kontakt" class="nav-link text-warning">Kontakt</a>
            </li>
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
    <section
      class="text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start bgmaincolor1"
    >
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

    <!-- Newsletter -->
    <?php if(!isset($_SESSION['loggedin'])){echo '      
    <section class="text-light p-5 bgmaincolor4">
      <div class="container">
        <div class="d-md-flex justify-content-between align-items-center">
          <p class="mb-3 mb-md-0 text-dark text-underlined"><u>Registriere dich hier, um nichts mehr zu verpassen!</u></p>

          <div class="input-group news-input">
            <input type="text" class="form-control" placeholder="Email Addresse" />
            <button class="btn bgmaincolor1 text-light btn-lg" type="button">Senden</button>
          </div>
        </div>
      </div>
    </section>
    ';}
    ?>

    <!-- Terminplanung Musikschule -->
    <section class="p-5">
      <div class="container">
        <div class="row text-center g-4">
          <div class="h2">Unsere Unterrichtskonzepte passen sich flexibel an deine Bedürfnisse an!</div>
          <div class="col-md">
            <div class="card bgmaincolor3 text-light">
              <div class="card-body text-center">
                
                <div class="h1 mb-3">
                  <i class="bi bi-laptop"></i>
                </div>
                <h3 class="card-title mb-3">Virtuell</h3>
                <p class="card-text">
                  Die Pandemie fordert uns alle heraus. Daher bieten wir Montags und Freitags Musikunterricht über Zoom an!
                </p>
                <script>
                function alertNachricht(){
                  alert("Bitte zur Terminplanung erst einloggen!");
                }
                </script>
                <?php if(!isset($_SESSION['loggedin'])){echo '<input type="button" onclick="alertNachricht");" value="Jetzt Termin vereinbaren" />';}
                else{echo '<a href="terminplanung.php#virtuell" class="btn btn-dark">Jetzt Termin vereinbaren</a>';}
                ?>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card bgmaincolor4 text-light">
              <div class="card-body text-center">
                <div class="h1 mb-3">
                  <i class="bi bi-person-square"></i>
                </div>
                <h3 class="card-title mb-3">Hybrid</h3>
                <p class="card-text">
                  Mittwochs finden unsere Stunden als Hybridmodell statt. Hier kannst du entscheiden, von wo aus du teilnehmen möchtest!
                </p>
                <a href="terminplanung.php#hybrid" class="btn btn-dark">Jetzt Termin vereinbaren</a>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card bgmaincolor3 text-light">
              <div class="card-body text-center">
                <div class="h1 mb-3">
                  <i class="bi bi-people"></i>
                </div>
                <h3 class="card-title mb-3">Vor Ort</h3>
                <p class="card-text">
                  Vor Ort ist maßgeschneiderte Förderung am Besten möglich. Deswegen findet jeden Dienstag, Donnerstag und Samstag Unterricht in Präsenz statt!
                </p>
                <a href="terminplanung.php#vorort" class="btn btn-dark">Jetzt Termin vereinbaren</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Wer ist Orpheus? -->
    <section class="p-5" id="orpheus">
      <div class="container">
        <div class="row align-items-center justify-content-between">
          <div class="col-md">
            <img src="img/orpheus-saga.jpg" class="img-fluid" alt="" />
          </div>
          <div class="col-md p-5">
            <h2>Wer war Opheus?</h2>
            <p class="lead">
              Orpheus war ein begnadeter Musiker aus der Antike. Seine Gabe war so groß, dass er sogar in der Gunst des Gottes Apollon stand.
            </p>
            <p>

            </p>
            <button
              class="btn btn-warning btn-lg"
              data-bs-toggle="modal"
              data-bs-target="#orpheusMehr"
            >
              <i class="bi bi-chevron-right"></i> Erfahre mehr
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Unser Instrumentverleih -->
    <section class="p-5 bgmaincolor1 text-light">
      <div class="container">
        <div class="row align-items-center justify-content-between">
          <div class="col-md p-5">
            <h2>Unser Instrumentverleih</h2>
            <p class="lead">
             Das richtige Instrument ist Voraussetzung für das Realisieren der eigenen musikalischen Ziele und Träume.
            </p>
            <p>
              Wir bieten ihnen Instrumente, Beratung und Service von höchster Qualität. Bei Fragen aller Art stehen wir gerne zur Verfügung!
            </p>
            <a href="#" class="btn btn-light mt-3">
              <i class="bi bi-chevron-right"></i> Nimm Kontakt zu uns auf
            </a>
          </div>
          <div class="col-md">
            <img src="img/saxophon.jpeg" class="img-fluid" alt="" />
          </div>
        </div>

        <!-- Unsere Musikschule -->
        <div class="row align-items-center justify-content-between">
          <div class="col-md">
            <img src="img/saxophon.jpeg" class="img-fluid" alt="" />
          </div>
          <div class="col-md p-5">
            <h2>Unsere Musikschule</h2>
            <p class="lead">
            <em>Musik allein ist die Weltsprache und braucht nicht übersetzt zu werden.</em><br>
            - Berthold Auerbach
            </p>
            <p>
            Entdecke mit uns deine Talente und entfalte dein Potential. Wir bieten hervorragenden Unterricht in Violine, Klavier und Gesang!
            </p>
            <a href="#" class="btn btn-light mt-3">
              <i class="bi bi-chevron-right"></i> Nimm Kontakt zu uns auf
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="p-5">
      <div class="container">
        <h2 class="text-center mb-4">Frequently Asked Questions</h2>
        <div class="accordion accordion-flush" id="questions">
          <!-- Item 1 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#question-one"
              >
               Kann trotz Corona Musikuntericht stattfinden?
              </button>
            </h2>
            <div
              id="question-one"
              class="accordion-collapse collapse"
              data-bs-parent="#questions"
            >
              <div class="accordion-body">
                Ja! Unter Einhaltung der aktuell gültigen Hygiene- und Sicherheitsmaßnahmen kann wie gewohnt Unterricht in Präsenz stattfinden.
                Ergänzend dazu bieten wir auch ein Hybridmodell an, bei dem einige Lernende vor Ort teilnehmen und andere über Zoom zugeschaltet werden.
                Außerdem ist auch das Modell Stunden vollständig Online abzuhalten in unserem Angebot enthalten.
              </div>
            </div>
          </div>
          <!-- Item 2 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#question-two"
              >
                Wie viel kosten die Stunden?
              </button>
            </h2>
            <div
              id="question-two"
              class="accordion-collapse collapse"
              data-bs-parent="#questions"
            >
              <div class="accordion-body">
                Die Preise für die einzelnen Stunden sind abhänig vom gewählten Instrument und dem Level der Lernenden:<br>
                Violine: 40 € für Anfänger, 50 € für Fortgeschrittene<br>
                Klavier: 35 € für Anfänger, 45 € für Fortgeschrittene<br>
                Gesang: 40 € für jedes Level
                
              </div>
            </div>
          </div>
          <!-- Item 3 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#question-three"
              >
               Was benötige ich?
              </button>
            </h2>
            <div
              id="question-three"
              class="accordion-collapse collapse"
              data-bs-parent="#questions"
            >
              <div class="accordion-body">
                Natürlich am Wichtigsten: Das gewünschte Instrument! Hierbei kannst du entweder dein eigenes mitbringen,
                oder unseren Verleihservice in Anspruch nehmen. 
                Weiteres eventuell benötigtes Material (z.B. Noten) wird von uns zur Verfügung gestellt.<br>
                Im Falle der in Anspruchnahme der Online-Angebote wird außerdem ein Tablet, Laptop oder Computer mit funktionierender Kamera und funktionierendem Mikrophon benötigt!
              </div>
            </div>
          </div>
          <!-- Item 4 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#question-four"
              >
                Wie melde ich mich an?
              </button>
            </h2>
            <div
              id="question-four"
              class="accordion-collapse collapse"
              data-bs-parent="#questions"
            >
              <div class="accordion-body">
                Nachdem du dich oben auf dieser Website angemeldet hast steht dir die Option <em>Jetzt Termin vereinbaren</em> zur Verfügung.
                Hier wählst du nun einfach das von dir gewünschte Unterrichtsmodell aus und vereinbarst mit unseren fachkompetenten Lehrenden den für dich optimalen Termin.
              </div>
            </div>
          </div>
          <!-- Item 5 -->
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#question-five"
              >
                Wie kann ich euch erreichen?
              </button>
            </h2>
            <div
              id="question-five"
              class="accordion-collapse collapse"
              data-bs-parent="#questions"
            >
              <div class="accordion-body">
                Ganz unten auf dieser Website findest du alle Informationen bezüglich der Anfahrt und Kontaktaufnahme.
                Bei Fragen aller Art melde dich gerne bei uns!
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <!-- Wer wir sind -->
    <section id="werwirsind" class="p-5 bgmaincolor1">
      <div class="container">
        <h2 class="text-center text-white">Wer sind wir?</h2>
        <p class="lead text-center text-white mb-5">
          Unser Team überzeugt mit jahrelanger musikalischer Erfahrung und Referenzen der bekanntesten Opernhäuser dieser Welt.
        </p>
        <div class="row g-4">
          <div class="col-md-6 col-lg-6">
            <div class="card bg-light">
              <div class="card-body text-center">
                <img
                  src="img/noah.jpeg"
                  class="rounded-circle mb-3"
                  style="width: 150px; height: 150px;"
                  alt=""
                />
                <h3 class="card-title mb-3">Noah Heidrich</h3>
                <p class="card-text">
                  Noah Heidrich ist der Fachwelt als profilierter Violinist bekannt. 
                  Sein Repertoire reicht von klassischen Stücken bis zu moderner Pop-Musik. 
                  Stilistisch beeindruckt Heidrich durch die feine Eleganz seines Spiels und glänzt außerdem mit innovativen Interpretationen klassischer Werke.
                  Als zweites Standbein baute er sich außerdem eine Karriere als bekannter Jazzsaxophonist 
                </p>
                <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-6">
            <div class="card bg-light">
              <div class="card-body text-center">
                <img
                  src="https://randomuser.me/api/portraits/men/11.jpg"
                  class="rounded-circle mb-3"
                  style="width: 150px; height: 150px;"
                  alt=""
                />
                <h3 class="card-title mb-3">Moritz Hussing</h3>
                <p class="card-text">
                  Moritz Hussing 
                </p>
                <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<!--
    <!DOCTYPE html>
<html>
  <head>
	  <title>Roomtour Test</title>
	  <meta charset="UTF-8" />
    <style>
      #roomtour {
        border: 1px solid black;
      }
      </style>
              
  </head>
  <body>
    <canvas id="canvas"></canvas>
    <script src="panorama.js"></script>
  </body>
</html>
-->

    <!-- Contact & Map -->
    <section class="p-5" id="kontakt">
      <div class="container">
        <div class="row g-4">
          <div class="col-md">
            <h2 class="text-center mb-4">Kontakt Info und Anfahrt</h2>
            <ul class="list-group list-group-flush lead">
              <li class="list-group-item">
                <span class="fw-bold">Sie finden uns hier:</span> Mozartstraße 41, 55283 Nierstein
              </li>
              <li class="list-group-item">
                <span class="fw-bold">Musikschule:</span> 06133 5757801
              </li>
              <li class="list-group-item">
                <span class="fw-bold">Instrumentverleih:</span> 06133 5757802
              </li>
              <li class="list-group-item">
                <span class="fw-bold">Email:</span> musikservice@orpheus.de
              </li>
            </ul>
          </div>
          <div class="col-md">
            <div id="map"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- Grosses Bild -->
    <section class="p-5" id="bild">
      <div class="container">
        
        <img src="img/man_gitarre.jpg" class="img-fluid" alt="Gitarre">
      </div>
    </section> 

    <!-- Footer -->
    <footer class="p-5 bg-dark text-white text-center position-relative">
      <div class="container">
        <p class="lead">Copyright &copy; 2021 Noah Heidrich, Moritz Hussing</p>

        <a href="#" class="position-absolute bottom-0 end-0 p-5">
          <i class="bi bi-arrow-up-circle h1"></i>
        </a>
      </div>
    </footer>

    <!-- Modal Hier Anmelden -->
    <div
      class="modal fade"
      id="anmelden"
      tabindex="-1"
      aria-labelledby="enrollLabel"
      aria-hidden="true"
    >

      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="enrollLabel">Anmelden</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">

            <form action="login.php" method="POST" >
              <div class="mb-3">
                <label for="user" class="col-form-label">Email</label>
                <input type="text" class="form-control" id="user" name="user" required/>
              </div>
              <div class="mb-3">
                <label for="pass" class="col-form-label">Passwort:</label>
                <input type="password" class="form-control" id="pass" name="pass" required/>
              </div>
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <input type="submit" value="Login" class="btn btn-warning" />
            </form>
        </div>
          
        </div>
      </div>
    </div>

    <!-- Modal Hier Registrieren -->
    <div
      class="modal fade"
      id="registrieren"
      tabindex="-1"
      aria-labelledby="enrollLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="enrollLabel">Registrieren</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
            </div>
            <div class="modal-body">

              <form action="registrieren.php" method="POST">
                <div class="mb-3">
                  <label for="vorname" class="col-form-label">Vorname:</label>
                  <input type="text" class="form-control" id="vorname" name="vorname" required/>
                </div>
                <div class="mb-3">
                  <label for="nachname" class="col-form-label">Nachname:</label>
                  <input type="text" class="form-control" id="nachname" name="nachname" required/>
                </div>
                <div class="mb-3">
                  <label for="email" class="col-form-label"> Email </label>
                  <input type="email" class="form-control" id="email" name="email" required/>
                </div>
                <div class="mb-3">
                  <label for="pass" class="col-form-label">Passwort:</label>
                  <input type="password" class="form-control" id="pass" name="pass" required/>
                </div>
                <div class="mb-3">
                  <label for="telefonnummer" class="col-form-label">Telefonnummer:</label>
                  <input type="tel" class="form-control" id="telefonnummer" name="telefonnummer" required/>
                </div>
                <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
                >
                Close
                </button>
                <input type="submit" value="Registrieren" class="btn btn-warning" />
              </form>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal Mehr erfahren über Orpheus -->
    <div
      class="modal fade"
      id="orpheusMehr"
      tabindex="-1"
      aria-labelledby="orpheusMehr"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="orpheusMehr">Mehr über Orpheus</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <p class="lead">Wer war dieser begnadete Musiker?</p>
            <p>Orpheus war...</p>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Schließen
            </button>
            
          </div>
        </div>
      </div>
    </div>


    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
      crossorigin="anonymous"
    ></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js"></script>

    <script>
      mapboxgl.accessToken =
        'pk.eyJ1IjoiYnRyYXZlcnN5IiwiYSI6ImNrbmh0dXF1NzBtbnMyb3MzcTBpaG10eXcifQ.h5ZyYCglnMdOLAGGiL1Auw'
      var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [8.336097717285156, 49.86569595336914],
        zoom: 14,
      })
    </script>
  
  </div>
  <?php
    if(isset($_POST['anmeldeFehler'])){
      echo '
      <script>
        alert("Falsche Einlogdaten!");
      </script>
      ';
    }
    if(isset($_POST['emailExistiert'])){
      echo '
      <script>
        alert("Diese Email wird bereits verwendet, bitte nutze eine andere Email Adresse!");
      </script>
      ';
    }
  ?>
  </body>
</html>

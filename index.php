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

            <em>Die Musik drückt das aus, was nicht gesagt werden kann und worüber zu schweigen unmöglich ist.</em> 
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
              Orpheus war ein begnadeter Musiker aus der Antike. Seine Gabe war so groß, dass er sogar in der Gunst des großen Apollon stand.
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
             Ein großer Künstler braucht das richtige Werkzeug. Unsere Kunden können sich bei uns auf die beste Qualität verlassen.
             Dieser Text soll hier stehen.
            </p>
            <p>
              Hier bitte Werbetext für den Verleih einfügen @Moritz
            </p>
            <a href="#" class="btn btn-light mt-3">
              <i class="bi bi-chevron-right"></i> Read More
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
              Ein Instrument in der Hand bringt einem nichts, wenn man keine gerade Töne rausbekommen kann. Dafür wollen wir abhilfe schaffen!
            </p>
            <p>
            Hier bitte Werbetext für den Verleih einfügen @Moritz
            </p>
            <a href="#" class="btn btn-light mt-3">
              <i class="bi bi-chevron-right"></i> Read More
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
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam
                beatae fuga animi distinctio perspiciatis adipisci velit maiores
                totam tempora accusamus modi explicabo accusantium consequatur,
                praesentium rem quisquam molestias at quos vero. Officiis ad
                velit doloremque at. Dignissimos praesentium necessitatibus
                natus corrupti cum consequatur aliquam! Minima molestias iure
                quam distinctio velit.
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
               Was muss ich mitbringen?
              </button>
            </h2>
            <div
              id="question-three"
              class="accordion-collapse collapse"
              data-bs-parent="#questions"
            >
              <div class="accordion-body">
                eigenes instru, oder man leiht aus
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
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam
                beatae fuga animi distinctio perspiciatis adipisci velit maiores
                totam tempora accusamus modi explicabo accusantium consequatur,
                praesentium rem quisquam molestias at quos vero. Officiis ad
                velit doloremque at. Dignissimos praesentium necessitatibus
                natus corrupti cum consequatur aliquam! Minima molestias iure
                quam distinctio velit.
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
                Wie kann ich Sie erreichen?
              </button>
            </h2>
            <div
              id="question-five"
              class="accordion-collapse collapse"
              data-bs-parent="#questions"
            >
              <div class="accordion-body">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam
                beatae fuga animi distinctio perspiciatis adipisci velit maiores
                totam tempora accusamus modi explicabo accusantium consequatur,
                praesentium rem quisquam molestias at quos vero. Officiis ad
                velit doloremque at. Dignissimos praesentium necessitatibus
                natus corrupti cum consequatur aliquam! Minima molestias iure
                quam distinctio velit.
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <!-- Wer wir sind -->
    <section id="werwirsind" class="p-5 bgmaincolor1">
      <div class="container">
        <h2 class="text-center text-white">Our Instructors</h2>
        <p class="lead text-center text-white mb-5">
          Hier erklären warum unser Team so geil ist @Moritz
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
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Assumenda accusamus nobis sed cupiditate iusto? Quibusdam.
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
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Assumenda accusamus nobis sed cupiditate iusto? Quibusdam.
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
                <input type="text" class="form-control" id="user" name="user" />
              </div>
              <div class="mb-3">
                <label for="pass" class="col-form-label">Passwort:</label>
                <input type="password" class="form-control" id="pass" name="pass" />
              </div>
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <input type="submit" value="Login" class="btn btn-primary" />
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
            <form>
              <div class="mb-3">
                <label for="email" class="col-form-label">
                  Email
                </label>
                <input type="text" class="form-control" id="email" />
              </div>
              <div class="mb-3">
                <label for="password" class="col-form-label">Passwort:</label>
                <input type="text" class="form-control" id="password" />
              </div>
              <div class="mb-3">
                <label for="vorname" class="col-form-label">Vorname:</label>
                <input type="text" class="form-control" id="vorname" />
              </div>
              <div class="mb-3">
                <label for="telefonnummer" class="col-form-label">Telefonnummer:</label>
                <input type="text" class="form-control" id="telefonnummer" />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary" value="submit">Submit</button>
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
  ?>
  </body>
</html>

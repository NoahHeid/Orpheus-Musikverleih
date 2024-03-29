<!-- Modal Hier Anmelden -->
<div class="modal fade" id="anmelden" tabindex="-1" aria-labelledby="enrollLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
        
        <div class="modal-header">
            <h5 class="modal-title" id="enrollLabel">Anmelden</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
            <form action="server/kunden.php" method="POST" >
            <div class="mb-3">
                <input type="text" hidden name="login">
                <label for="user" class="col-form-label">Email</label>
                <input type="text" class="form-control" id="user" name="user" value="<?php 
               
                if(isset($_COOKIE['email']))
                {
                    echo $_COOKIE['email'];
                }
                ?>" required/>
            </div>
            <div class="mb-3">
                <label for="pass" class="col-form-label">Passwort:</label>
                <input type="password" class="form-control" id="pass" required name="pass" value="<?php 
                if(isset($_COOKIE['password']))
                {
                    echo $_COOKIE['password'];
                }
                ?>" />
            </div>
            <div class="form-check mt-2">
                <input class="form-check-input" <?php if(isset($_COOKIE['checkBoxCookie'])){echo "checked";} ?> type="checkbox" value="true" name="checkCookie" id="checkCookie">
                <label class="form-check-label" for="checkCookie">Daten speichern (verwendet Cookies)</label>
            </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >
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
            <script>
                function emailIsTaken(email){
                // check is email is already saved in database
                if (window.XMLHttpRequest)
                {
                /// AJAX with mit IE7+, Chrome, Firefox, Safari, Opera
                xmlhttp=new XMLHttpRequest();
                }
                else
                {
                /// AJAX with IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        document.getElementById("emailIsTaken").innerHTML=xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","scripts/isEmailTaken.php?query="+email,true);
                xmlhttp.send();
            }
            </script>
            <form action="server/kunden.php" method="POST">
            <input type="text" hidden id="registrieren" name="registrieren"/>
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
                <label for="passReg" class="col-form-label">Passwort:</label>
                <input type="password" class="form-control" id="passReg" name="pass" required/>
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
<div class="modal fade" id="orpheusMehr" tabindex="-1" aria-labelledby="orpheusMehr" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="orpheusMehr">Mehr über Orpheus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <p class="lead">Orpheus und die Musik</p>
        <p>Orpheus war ein begnadeter Musiker und Sänger der antiken griechischen Sagenwelt. Sein Gesang war so schön,
            dass sogar Tiere, Pflanzen und Steine davon berührt wurden. Auch stand Orpheus in der Gunst des Gottes Apollon,
            von dem er einst eine göttliche Lyra geschenkt bekam, die dieser widerum von seinem Halbbruder Hermes erhalten hatte.
            Als Eurydike, Orpheus Frau, eines Tages tragisch und viel zu früh verstarb machte sich Orpheus auf den Weg die Götter um Hilfe zu bitten.
            Lange sang und flehte er, bis sich die Götter schließlich erweichen ließen.
            Ihm wurde gestattet Eurydike aus der Unterwelt zurückzuholen, nur dürfe er sich den Weg zurück an die Oberfläche über
            niemals umdrehen.
            Auf dem langen Weg durch die Stille hinter ihm verunsichert hielt Orpheus es kurz vor Erreichen des Ziels jedoch nicht mehr aus.
            Er drehte sich um und sah nur noch, wie Eurydike von der Dunkelheit hinter ihnen verschlungen wurde und verschwand.
            Abermals versuchte er die Götter durch Singen und Flehen zu erweichen, dieses Mal jedoch ohne Erfolg...
        </p>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >
          Schließen
        </button>
      </div>

    </div>
  </div>
</div>
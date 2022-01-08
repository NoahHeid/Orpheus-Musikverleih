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
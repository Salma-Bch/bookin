<div class="row">
    <div class="form-group col-md-6">
        <input type='text' name="lastName" class='form-control change' placeholder='Nom' onblur="validInput(this)"/>
        <div class="invalid-feedback" style="display: none">
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg>
                Entrez un nom valide.
            </p>
        </div>
    </div>
    <div class="form-group col-md-6">
        <input type='text' name="firstName" class='form-control change' placeholder='Prénom' onblur="validInput(this)"/>
        <div class="invalid-feedback" style="display: none">
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg>
                Entrez un prénom valide.
            </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-12">
        <input type='text' name="mail" id="mailInput" class='form-control' placeholder='Adresse mail' onblur="validEmailInput(this)"/>
        <div class="invalid-feedback" style="display: none">
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg>
                Entrez une adresse de messagerie valide.
            </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <input type='password' name="psd" id="passwordInput" class='form-control' placeholder='Mot de passe' onblur="validPassword(this)" />
        <div class="invalid-feedback" style="display: none">
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg>
                Entrez un mot de passe valide, utilisez 8 caractères ou plus aves des lettres et des chiffres.
            </p>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="checkBoxPass" id="psdShow" onclick="showHidePassword('passwordInput', 'passwordInput2')" />
            <label class="form-check-label" for="psdShow">Afficher le mot de passe</label>
        </div>
    </div>
    <div class="form-group col-md-6">
        <input type='password' name="psdConfirmation" id="passwordInput2" class='form-control' placeholder='Confirmer'
               onblur="matchPasswords(document.getElementById('passwordInput'),this)"/>
        <div class="invalid-feedback" style="display: none">
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg>
                Les mots de passe ne correspondent pas. Veuillez réessayer.
            </p>
        </div>
    </div>
</div>
<div class="form-group col-md-6">
    <button class='btn btn-lg btn-danger btn-block btn-signin' name="submit"  onclick="nextForm('firstPart','secondPart')">Suivant</button>
</div>
<div class="form-group col-md-12">
    <p>Vous possédez déjà un compte ? <a href='clientLoginSpace.php'>Identifiez-vous</a></p>
</div>
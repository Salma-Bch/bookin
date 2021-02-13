
console.log("script.js file uploaded");

function displayEchecCreat(){
    document.getElementById("infosMaj").textContent = "Votre compte n'a pas pu être crée.";
    document.getElementById("modifFailed").setAttribute("fill", "red");
    document.getElementById("modifChecked").setAttribute("display", "none");
    document.getElementById("modifFailed").setAttribute("display", "inline-block");
    $('#dialogModal').modal({
        show: 'true'
    });
}

function displaySuccessCreat(){
    document.getElementById("infosMaj").textContent = "Votre compte a été créé avec succès.";
    document.getElementById("modifChecked").setAttribute("fill", "green") ;
    document.getElementById("modifFailed").setAttribute("display", "none");
    document.getElementById("modifChecked").setAttribute("display", "inline-block");

    $('#dialogModal').modal({
        show: 'true'
    });
}



function validdInput(){
   /* var noError = true;
    var form = document.getElementById("infosCompte");
    var nom = document.getElementById("inputNom").value;
    var prenom = document.getElementById("inputPrenom").value;
    var email = document.getElementById("inputEmail").value;
    var number =document.getElementById("numeroPermis").value;
    var mdp = document.getElementById("mdp").value;
    var mdpConfirm = document.getElementById("mdpConfirm").value;
    var cdp = document.getElementById("cdp").value;

    if(cdp.length < 5 || cdp.length > 5){
        document.getElementById("codePostale").setAttribute("class","form-group has-error");
        noError = false;
    }
    if(number.length < 12 || number.length > 15){
        document.getElementById("permis").setAttribute("class","form-group has-error");
        noError = false;
    }
    if (!valide(email)) {
        document.getElementById("mail").setAttribute("class","form-group has-error");
        noError = false;
    }

    if(mdp ==""){
        document.getElementById("mdp").setAttribute("class","form-group has-error");
        noError = false;
    }
    if(mdpConfirm ==""){
        document.getElementById("mdpConf").setAttribute("class","form-group has-error");
        noError = false;
    }
    if(mdp != mdpConfirm){
        document.getElementById("password").setAttribute("class","form-group has-error");
        document.getElementById("mdpConf").setAttribute("class","form-group has-error");
        noError = false;
    }
    return noError;*/
    return true;
}

function valide(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
function onlyNumberKey(evt) {
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}



function validInput(input){
    var div = input.parentNode.getElementsByClassName("invalid-feedback");
    if(input.value === ""){
        displayInvalidInput(input);
        return false;
    }
    else {
        displayValidInput(input);
        return true;
    }
}

function displayInvalidInput(input){
    var div = input.parentNode.getElementsByClassName("invalid-feedback");
    input.classList.add("is-invalid");
    input.classList.remove("is-valid");
    if(div.length > 0)
        div[0].setAttribute("style", "display : block");
}
function displayValidInput(input){
    var div = input.parentNode.getElementsByClassName("invalid-feedback");
    input.classList.add("is-valid");
    input.classList.remove("is-invalid");
    if(div.length > 0)
        div[0].setAttribute("style", "display : none");
}

function validEmailInput(input){
    const emailFormat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(input.value === "" || !emailFormat.test(input.value)){
        displayInvalidInput(input)
        return false;
    }
    else {
        displayValidInput(input)
        return true;
    }
}

function validPassword(input){
    var psd = input.value;
    removeInvalidDisplay(document.getElementById("passwordInput2"));
    if (psd.match( /[0-9]/g) && psd.match( /[A-Z]/g) && psd.match(/[a-z]/g) &&
        psd.match( /[^a-zA-Z\d]/g) && psd.length >= 8){
        displayValidInput(input);
        return true;
    }
    else{
        displayInvalidInput(input);
        return false;
    }
}

function matchPasswords(psd1, psd2){
    if(psd1.value !== psd2.value && validPassword(psd1)){
        displayInvalidInput(psd2);
        return false;
    }
    else {
        removeInvalidDisplay(psd2);
        return true
    }
}

function removeInvalidDisplay(input){
    var div = input.parentNode.getElementsByClassName("invalid-feedback");
    input.classList.remove("is-invalid");
    if(div.length > 0)
        div[0].setAttribute("style", "display : none");
}

function nextForm(firstPartId, secondPartId){
    var isValid = true;
    var passwordInput = document.getElementById("passwordInput");
    var passwordInput2 = document.getElementById("passwordInput2");
    var firstPartDiv = document.getElementById(firstPartId);
    var inputs = firstPartDiv.getElementsByClassName("change");
    for (var i = 0; i < inputs.length; i++){
        if( !validInput(inputs[i]) )
            isValid = false;
    }
    var validMail = validEmailInput(document.getElementById("mailInput"));
    var validPsd = matchPasswords(passwordInput, passwordInput2);
    if( !validMail || !validPsd){
        isValid = false;
    }


    if(isValid) {
        firstPartDiv.setAttribute("style", "display : none");
        document.getElementById(secondPartId).setAttribute("style", "display : block");
    }
}

function previousForm(firstPartId, secondPartId){
    document.getElementById(firstPartId).setAttribute("style", "display : block");
    document.getElementById(secondPartId).setAttribute("style","display : none");
}

function showHidePassword(inputId1, inputId2){
    var input1 = document.getElementById(inputId1);
    var input2 = document.getElementById(inputId2);
    if(input1.getAttribute("type") === "password") {
        input1.setAttribute("type", "text");
        input2.setAttribute("type", "text");
    }
    else{
        input1.setAttribute("type", "password");
        input2.setAttribute("type", "password");
    }
}

function createCompte(idForm) {
    if (validInput()) {
        var formCompte = $("#"+idForm).serialize();
        $.ajax({
            type: 'post',
            url: './ressources/include/compteCreation.php',
            data: formCompte,
            success: function (response) {
                if (response.includes("failed")) {
                    displayEchecCreat();
                } else {
                    displaySuccessCreat();
                }
            },
            error: function () {
                displayEchecCreat();
            }
        });
    }
}

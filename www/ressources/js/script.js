
console.log("./js/script.js file uploaded");

function displayEchecCreat(){
    document.getElementById("modalTitle").textContent = "Création de compte";
    document.getElementById("textModal").textContent = "Votre compte n'a pas pu être crée.";
    document.getElementById("modifFailedIcon").setAttribute("fill", "red");
    document.getElementById("modifCheckedIcon").setAttribute("display", "none");
    document.getElementById("modifFailedIcon").setAttribute("display", "inline-block");
    var myModal = new bootstrap.Modal(document.getElementById('dialogModal'));
    myModal.show();
}

function displaySuccessCreat(){
    document.getElementById("modalTitle").textContent = "Création de compte";
    document.getElementById("textModal").textContent = "Votre compte a été créé avec succès.";
    document.getElementById("modifFailedIcon").setAttribute("display", "none");
    document.getElementById("modifCheckedIcon").setAttribute("fill", "green") ;
    document.getElementById("modifCheckedIcon").setAttribute("display", "inline-block");
    var myModal = new bootstrap.Modal(document.getElementById('dialogModal'));
    myModal.show();
}

function displaySuccessPurchase(){
    document.getElementById("modalTitle").textContent = "Effectuer un achat";
    document.getElementById("textModal").textContent = "Votre achat a été effectué avec succès, il vous sera livré très bientôt.";
    document.getElementById("modifFailedIcon").setAttribute("display", "none");
    document.getElementById("modifCheckedIcon").setAttribute("fill", "green") ;
    document.getElementById("modifCheckedIcon").setAttribute("display", "inline-block");
    var myModal = new bootstrap.Modal(document.getElementById('dialogModal'));
    myModal.show();
}

function displayEchecPurchase(){
    document.getElementById("modalTitle").textContent = "Effectuer un achat";
    document.getElementById("textModal").textContent = "Votre achat n'a malheuresement pas pu être effectué, " +
        "merci de contacter le service client si le problème persiste.";
    document.getElementById("modifFailedIcon").setAttribute("fill", "red");
    document.getElementById("modifCheckedIcon").setAttribute("display", "none");
    document.getElementById("modifFailedIcon").setAttribute("display", "inline-block");
    var myModal = new bootstrap.Modal(document.getElementById('dialogModal'));
    myModal.show();
}

function addCategory() {
    var myModal = new bootstrap.Modal(document.getElementById('dialogCategoryModal'));
    myModal.show();
}

function addTag() {
    var myModal = new bootstrap.Modal(document.getElementById('dialogTagModal'));
    myModal.show();
}

function addCategoryToBd() {
    var formChildren = document.getElementById("categoryForm").children;
    alert(formChildren) ;
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

function isempty(input){
    return input.value === ""
}

function validInput(input){
    var div = input.parentNode.getElementsByClassName("invalid-feedback");
    if(isempty(input)){
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
    if(isempty(input) || !emailFormat.test(input.value)){
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

function validPassword2(input){
    var psd = input.value;
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

function isDateValide(dayInput, monthInput, yearInput){
    var dateTab = [dayInput.value, monthInput.value, yearInput.value];

    if(dateTab.length !== 3 || isNaN(parseInt(dateTab[0])) ||
        isNaN(parseInt(dateTab[1])) || isNaN(parseInt(dateTab[2])))
        return false;

    var dateVerif = new Date(eval(dateTab[2]), eval(dateTab[1])-1, eval(dateTab[0]))

    var year = dateVerif.getFullYear();
    if((Math.abs(year)+"").length < 4)
        year = year + 1900;

    return ( (dateVerif.getDate() === eval(dateTab[0])) && (dateVerif.getMonth() === eval(dateTab[1])-1)
        && (year === eval(dateTab[2])) );
}

function createCompte(idForm) {
    var div = document.getElementById("secondPart");
    var inputs = div.getElementsByClassName("change");
    var send = true;
    for(var i=0; i<inputs.length; i++){
        if(!validInput(inputs[i])){
            send = false;
        }
    }
    if (send) {
        var formCompte = $("#"+idForm).serialize();
        $.ajax({
            type: 'post',
            url: './include/compteCreation.php',
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

function createAdministratorCompte(idForm) {
    var div = document.getElementById("adm");
    var inputs = div.getElementsByClassName("change");
    var send = true;
    for(var i=0; i<inputs.length; i++){
        if(!validInput(inputs[i])){
            send = false;
        }
    }
    if (send) {
        var formCompte = $("#"+idForm).serialize();
        $.ajax({
            type: 'post',
            url: './include/compteAdministratorCreation.php',
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

function changeInfoClient(id, previousInformation, newInformation){
    var balise = document.getElementById(id);
    balise.textContent = balise.textContent.replace(previousInformation, newInformation);
}

function updateInfosClient(oldClient, newClient){
    changeInfoClient("titleName",oldClient["first_name"]+" "+oldClient['last_name'],newClient["first_name"]+" "+newClient['last_name']);
    changeInfoClient("tab_id",oldClient["client_id"],newClient["client_id"]);
    changeInfoClient("tab_laste_name",oldClient["last_name"],newClient["last_name"]);
    changeInfoClient("tab_first_name",oldClient["first_name"],newClient["first_name"]);
    changeInfoClient("tab_mail",oldClient["mail"],newClient["mail"]);
    changeInfoClient("psd",oldClient["psd"],newClient["psd"]);
    changeInfoClient("tab_profession",oldClient["profession"],newClient["profession"]);
    changeInfoClient("tab_sex",oldClient["sex"],newClient["sex"]);
    updateInfosClientForm(newClient);
}

function updateInfosClientForm(newClient){
    var newBirthDate = newClient['birthDate'].split('-');
    document.getElementById("client_id").value = newClient["client_id"];
    document.getElementById("last_name").value = newClient["last_name"];
    document.getElementById("first_name").value = newClient["first_name"];
    document.getElementById("mail").value = newClient["mail"];
    document.getElementById("psd").value = newClient["psd"];
    document.getElementById("birthDay").value = parseInt(newBirthDate[2]);
    document.getElementById("birthMonth").value = parseInt(newBirthDate[1]);
    document.getElementById("birthYear").value = newBirthDate[0];
    document.getElementById("profession").value = newClient["profession"];
    document.getElementById("sex").value = newClient["sex"];
}

function showModifInfosForm() {
    document.getElementById("infosModifDiv").style.display = "block";
    infoDesabled();
}

function hideModifInfosForm(){
    document.getElementById("infosModifDiv").style.display = "none";
    infoEnabled();
}

function infoEnabled(){
    var element = document.getElementById('tableauInfo') ;
    element.style.background ='white';
    element.style.opacity='1';
}

function infoDesabled() {
    var element = document.getElementById('tableauInfo') ;
    element.style.background ='silver';
    element.style.opacity='0.7';
}

function displaySuccessMdif(){
    document.getElementById("modalTitle").textContent = "Modification de vos informations personnelles";
    document.getElementById("textModal").textContent = "Vos informations personnelles ont été mises à jour.";
    document.getElementById("modifFailedIcon").setAttribute("display", "none");
    document.getElementById("modifCheckedIcon").setAttribute("fill", "green") ;
    document.getElementById("modifCheckedIcon").setAttribute("display", "inline-block");
    var myModal = new bootstrap.Modal(document.getElementById('dialogModal'));
    myModal.show();
}

function displayEchecModif(){
    document.getElementById("modalTitle").textContent = "Modification de vos informations personnelles";
    document.getElementById("textModal").textContent = "Vos informations personnelles n'ont pas été mises à jour.";
    document.getElementById("modifFailedIcon").setAttribute("fill", "red");
    document.getElementById("modifCheckedIcon").setAttribute("display", "none");
    document.getElementById("modifFailedIcon").setAttribute("display", "inline-block");
    var myModal = new bootstrap.Modal(document.getElementById('dialogModal'));
    myModal.show();
}

function valide3(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validInput2(){
    var noError = true;
    var form = document.getElementById("infosModifForm");

    for (var i = 0; i < form.getElementsByTagName("input").length; i++) {
        if(form.elements[i].value.length === 0){
            noError = false;
            break;
        }
    }
    return noError;
}
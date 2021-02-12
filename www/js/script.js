
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

function validInput(){
    var noError = true;
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
    return noError;
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

function createCompte(idForm) {
    if (validInput()) {
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

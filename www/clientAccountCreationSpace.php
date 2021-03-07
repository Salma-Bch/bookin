<!DOCTYPE html>
<html lang="fr">
    <?php
        /**
         * \file      creationCompte.php
         * \author    Salma BENCHELKHA - Mouncif LEKMITI - Enzo CERINI
         * \version   1.0
         * \date      8 janvier 2020
         * \brief     Affiche la page de création de compte.
         * \details   Formulaire à remplir par l'utilisateur afin d'obtenir un espace personnel.
         */
    ?>
    <head>
        <?php
            include_once("include/head.php");
        ?>
        <title>Création de compte</title>
    </head>
    <body>
        <?php
            include("include/header.php");
        ?>

        <div class ='container-connexion'>
            <div class='card card-container-mdp'>
                <h2 class="mb-5 mt-5" style="margin-left: 0;">Créer un compte Book'In</h2>
                <form id ="compteInfo" class="form-group" method="post" onsubmit="return false">
                    <div id="firstPart">
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
                                <input type='password' name="psd" id="passwordInput" class='form-control' id="passwordInput" placeholder='Mot de passe' onblur="validPassword(this)" />
                                <div class="invalid-feedback" style="display: none">
                                    <p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                        </svg>
                                        Entrez Un mot de passe valide, utilisez 8 carractère ou plus aves des lettres et des chiffres.
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
                        <script type="text/javascript" src="./js/script.js" ></script>
                        <div class="form-group col-md-6">
                            <button class='btn btn-lg btn-danger btn-block btn-signin' name="submit"  onclick="nextForm('firstPart','secondPart')">Suivant</button>
                        </div>
                        <div class="form-group col-md-12">
                            <p>Vous possédez déjà un compte ? <a href='clientLoginSpace.php'>Identifiez-vous</a></p>
                        </div>
                    </div>

                    <div id="secondPart" style="display: none">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <?php include("./include/dayInput.php"); ?>
                            </div>
                            <div class="form-group col-md-4">
                                <?php include("./include/monthInput.php"); ?>
                            </div>
                            <div class="form-group col-md-4">
                                <?php include("./include/yearInput.php"); ?>
                            </div>
                            <div class="form-group col-md-6 mb-8">
                                <select class="form-select form-select-lg mb-3 change" name="sex" aria-label="Default select example">
                                    <option selected="" value="" disabled="" hidden="">Sexe</option>
                                    <option value="M">Homme</option>
                                    <option value="F">Femme</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <?php include("./include/professionInput.php"); ?>
                            </div>
                            <div class="form-group col-md-6">
                                <button class='btn btn-lg btn-danger btn-block btn-signin' name="submit"  onclick="previousForm('firstPart','secondPart')">Retour</button>
                            </div>
                            <div class="form-group col-md-6">
                                <button class='btn btn-lg btn-danger btn-block btn-signin' name="submit"  onclick="nextForm('secondPart','thirdPart')">Suivant</button>
                            </div>
                        </div>
                    </div>

                    <div id="thirdPart" style="display: none">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Quelles catégories aimez-vous ?</h3>
                                <div class="btn-group choix_categorie" role="group" aria-label="Basic checkbox toggle button group">
                                    <input type="checkbox" class="btn-check" id="categorie_1" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_1">Actualité</label>

                                    <input type="checkbox" class="btn-check" id="categorie_2" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_2">Amour</label>

                                    <input type="checkbox" class="btn-check" id="categorie_3" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_3">Art</label>

                                    <input type="checkbox" class="btn-check" id="categorie_4" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_4">Bande dessinée</label>

                                    <input type="checkbox" class="btn-check" id="categorie_5" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_5">Bien-être</label>

                                    <input type="checkbox" class="btn-check" id="categorie_6" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_6">Cuisine</label>

                                    <input type="checkbox" class="btn-check" id="categorie_7" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_7">Culture</label>

                                    <input type="checkbox" class="btn-check" id="categorie_8" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_8">Education</label>

                                    <input type="checkbox" class="btn-check" id="categorie_9" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_9">Histoire</label>

                                    <input type="checkbox" class="btn-check" id="categorie_10" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_10">Loisir</label>

                                    <input type="checkbox" class="btn-check" id="categorie_11" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_11">Policier</label>

                                    <input type="checkbox" class="btn-check" id="categorie_12" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_12">Psychologie</label>

                                    <input type="checkbox" class="btn-check" id="categorie_13" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_13">Santé</label>

                                    <input type="checkbox" class="btn-check" id="categorie_14" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_14">Science</label>

                                    <input type="checkbox" class="btn-check" id="categorie_15" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_15">Science-fiction</label>

                                    <input type="checkbox" class="btn-check" id="categorie_16" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="categorie_16">Vie pratique</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6 partButton">
                                <button class='btn btn-lg btn-danger btn-block btn-signin' name="submit"  onclick="previousForm('secondPart','thirdPart')">Retour</button>
                            </div>
                            <div class="form-group col-md-6 partButton">
                                <button class='btn btn-lg btn-danger btn-block btn-signin' name="submit"  onclick="nextForm('thirdPart','fourthPart')">Suivant</button>
                            </div>
                        </div>
                    </div>

                    <div id="fourthPart" style="display: none">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Apprenons à vous connaître !</h3>
                                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                    <input type="checkbox" class="btn-check" id="tag_1" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_1">Actualité</label>

                                    <input type="checkbox" class="btn-check" id="tag_2" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_2">Information</label>

                                    <input type="checkbox" class="btn-check" id="tag_3" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_3">Concours</label>

                                    <input type="checkbox" class="btn-check" id="tag_4" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_4">Guerre</label>

                                    <input type="checkbox" class="btn-check" id="tag_5" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_5">Covid</label>

                                    <input type="checkbox" class="btn-check" id="tag_6" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_6">Pandémie</label>

                                    <input type="checkbox" class="btn-check" id="tag_7" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_7">Economie</label>

                                    <input type="checkbox" class="btn-check" id="tag_8" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_8">Amour</label>

                                    <input type="checkbox" class="btn-check" id="tag_9" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_9">Mot</label>

                                    <input type="checkbox" class="btn-check" id="tag_10" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_10">Politique</label>

                                    <input type="checkbox" class="btn-check" id="tag_11" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_11">France</label>

                                    <input type="checkbox" class="btn-check" id="tag_12" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_12">Relation</label>

                                    <input type="checkbox" class="btn-check" id="tag_13" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_13">Sentiment</label>

                                    <input type="checkbox" class="btn-check" id="tag_14" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_14">Roi</label>

                                    <input type="checkbox" class="btn-check" id="tag_15" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_15">Reine</label>

                                    <input type="checkbox" class="btn-check" id="tag_16" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_16">Royal</label>

                                    <input type="checkbox" class="btn-check" id="tag_17" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_17">Trahison</label>

                                    <input type="checkbox" class="btn-check" id="tag_18" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_18">K-Pop</label>

                                    <input type="checkbox" class="btn-check" id="tag_19" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_19">Art</label>

                                    <input type="checkbox" class="btn-check" id="tag_20" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_20">Peinture</label>

                                    <input type="checkbox" class="btn-check" id="tag_21" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_21">Oeuvre</label>

                                    <input type="checkbox" class="btn-check" id="tag_22" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_22">Dessin</label>

                                    <input type="checkbox" class="btn-check" id="tag_23" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_23">Disney</label>

                                    <input type="checkbox" class="btn-check" id="tag_24" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_24">Princesse</label>

                                    <input type="checkbox" class="btn-check" id="tag_25" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_25">Sculpture</label>

                                    <input type="checkbox" class="btn-check" id="tag_26" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_26">Mode</label>

                                    <input type="checkbox" class="btn-check" id="tag_27" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_27">Défilé</label>

                                    <input type="checkbox" class="btn-check" id="tag_28" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_28">Décoration</label>

                                    <input type="checkbox" class="btn-check" id="tag_29" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_29">Astérix</label>

                                    <input type="checkbox" class="btn-check" id="tag_30" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_30">Bande dessinée</label>

                                    <input type="checkbox" class="btn-check" id="tag_31" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_31">Jeunesse</label>

                                    <input type="checkbox" class="btn-check" id="tag_32" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_32">Spider-Man</label>

                                    <input type="checkbox" class="btn-check" id="tag_33" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_33">Spirou</label>

                                    <input type="checkbox" class="btn-check" id="tag_34" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_34">Clifton</label>

                                    <input type="checkbox" class="btn-check" id="tag_35" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_35">Marsupilami</label>

                                    <input type="checkbox" class="btn-check" id="tag_36" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_36">Gaston</label>

                                    <input type="checkbox" class="btn-check" id="tag_37" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_37">Bien</label>

                                    <input type="checkbox" class="btn-check" id="tag_38" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_38">Santé</label>

                                    <input type="checkbox" class="btn-check" id="tag_39" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_39">Mental</label>

                                    <input type="checkbox" class="btn-check" id="tag_40" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_40">Cuisine</label>

                                    <input type="checkbox" class="btn-check" id="tag_41" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_41">Italie</label>

                                    <input type="checkbox" class="btn-check" id="tag_42" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_42">Dégustation</label>

                                    <input type="checkbox" class="btn-check" id="tag_43" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_43">Recette</label>

                                    <input type="checkbox" class="btn-check" id="tag_44" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_44">Chef</label>

                                    <input type="checkbox" class="btn-check" id="tag_45" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_45">Rapide</label>

                                    <input type="checkbox" class="btn-check" id="tag_46" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_46">Emission</label>

                                    <input type="checkbox" class="btn-check" id="tag_47" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_47">Culture</label>

                                    <input type="checkbox" class="btn-check" id="tag_48" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_48">Général</label>

                                    <input type="checkbox" class="btn-check" id="tag_49" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_49">Nature</label>

                                    <input type="checkbox" class="btn-check" id="tag_50" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_50">Rap</label>

                                    <input type="checkbox" class="btn-check" id="tag_51" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_51">Quebec</label>

                                    <input type="checkbox" class="btn-check" id="tag_52" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_52">Crise</label>

                                    <input type="checkbox" class="btn-check" id="tag_53" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_53">Pays</label>

                                    <input type="checkbox" class="btn-check" id="tag_54" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_54">Japon</label>

                                    <input type="checkbox" class="btn-check" id="tag_55" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_55">Education</label>

                                    <input type="checkbox" class="btn-check" id="tag_56" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_56">Scolaire</label>

                                    <input type="checkbox" class="btn-check" id="tag_57" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_57">Histoire</label>

                                    <input type="checkbox" class="btn-check" id="tag_58" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_58">Loisir</label>

                                    <input type="checkbox" class="btn-check" id="tag_59" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_59">Sudoku</label>

                                    <input type="checkbox" class="btn-check" id="tag_60" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_60">Enfant</label>

                                    <input type="checkbox" class="btn-check" id="tag_61" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_61">Echec</label>

                                    <input type="checkbox" class="btn-check" id="tag_62" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_62">Dessin</label>

                                    <input type="checkbox" class="btn-check" id="tag_63" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_63">Mandala</label>

                                    <input type="checkbox" class="btn-check" id="tag_64" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_64">Roman</label>

                                    <input type="checkbox" class="btn-check" id="tag_65" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_65">Policier</label>

                                    <input type="checkbox" class="btn-check" id="tag_66" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_66">Sombre</label>

                                    <input type="checkbox" class="btn-check" id="tag_67" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_67">Nuit</label>

                                    <input type="checkbox" class="btn-check" id="tag_68" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_68">Crime</label>

                                    <input type="checkbox" class="btn-check" id="tag_69" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_69">Psychologie</label>

                                    <input type="checkbox" class="btn-check" id="tag_70" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_70">Mental</label>

                                    <input type="checkbox" class="btn-check" id="tag_71" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_71">Santé</label>

                                    <input type="checkbox" class="btn-check" id="tag_72" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_72">Urgence</label>

                                    <input type="checkbox" class="btn-check" id="tag_73" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_73">Huile</label>

                                    <input type="checkbox" class="btn-check" id="tag_74" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_74">Accouchement</label>

                                    <input type="checkbox" class="btn-check" id="tag_75" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_75">Eglise</label>

                                    <input type="checkbox" class="btn-check" id="tag_76" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_76">Cerveau</label>

                                    <input type="checkbox" class="btn-check" id="tag_77" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_77">Religion</label>

                                    <input type="checkbox" class="btn-check" id="tag_78" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_78">Brevet</label>

                                    <input type="checkbox" class="btn-check" id="tag_79" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_79">Fiche</label>

                                    <input type="checkbox" class="btn-check" id="tag_80" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_80">Révision</label>

                                    <input type="checkbox" class="btn-check" id="tag_81" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_81">Fiction</label>

                                    <input type="checkbox" class="btn-check" id="tag_82" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="tag_82">Social</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6 partButton">
                                <button class='btn btn-lg btn-danger btn-block btn-signin' name="submit"  onclick="previousForm('thirdPart','fourthPart')">Retour</button>
                            </div>
                            <div class="form-group col-md-6 partButton">
                                <button class='btn btn-lg btn-danger btn-block btn-signin' name="submit"  onclick="createCompte('compteInfo')">Creer mon compte</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php
            include("include/footer.php");
            include("include/dialogModal.php");
        ?>
    <script>
        //displaySuccessCreat();
    </script>
    </body>
</html>
<div class="row">
    <div class="form-group col-md-4">
    <select class="form-select form-select-lg mb-3 change" name="birthDay" aria-label="Default select example">
    <option selected="" disabled="" value="" hidden="">Jour</option>
    <?php
        for ($i = 1; $i <= 31; $i++){
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
    ?>
</select>
</div>
<div class="form-group col-md-4">
    <select class="form-select form-select-lg mb-3 change" name="birthMonth" aria-label="Default select example">
        <option selected="" disabled="" value="" hidden="">Mois</option>
        <option value="01">Janvier</option>
        <option value="02">Fevrier</option>
        <option value="03">Mars</option>
        <option value="04">Avril</option>
        <option value="05">Mai</option>
        <option value="06">Juin</option>
        <option value="07">Juillet</option>
        <option value="08">Aout</option>
        <option value="09">Septembre</option>
        <option value="10">Octobre</option>
        <option value="11">Novembre</option>
        <option value="12">Decembre</option>
    </select>
</div>

<div class="form-group col-md-4">
    <select class="form-select form-select-lg mb-3 change" name="birthYear" aria-label="Default select example">
        <option selected="" disabled="" value="" hidden="">Année</option>

        <?php
        $date = date('Y');
        for($date-1; $date >= 1900; $date--){
            echo '<option value="'.$date.'">'.$date.'</option>';
        }
        ?>
    </select>
</div>

<div class="form-group col-md-6 mb-8">
    <select class="form-select form-select-lg mb-3 change" name="sex" aria-label="Default select example">
        <option selected="" value="" disabled="" hidden="">Sexe</option>
        <option value="M">Homme</option>
        <option value="F">Femme</option>
    </select>
</div>
<div class="form-group col-md-6">
    <select class="form-select form-select-lg mb-3 change" name="profession" aria-label="Default select example">
        <option selected="" disabled="" value="" hidden="">Profession</option>
        <option value="Archéologue">Archéologue</option>
        <option value="Chirurgien">Chirurgien</option>
        <option value="Cuisinier">Cuisinier</option>
        <option value="Dessinateur">Dessinateur</option>
        <option value="Etudiant">Etudiant</option>
        <option value="Ingénieur ">Ingénieur</option>
        <option value="Journaliste">Journaliste</option>
        <option value="Médecin">Médecin</option>
        <option value="Peintre">Peintre</option>
        <option value="Policier">Policier</option>
        <option value="Professeur">Professeur</option>
        <option value="Psychologue ">Psychologue</option>
        <option value="Rechercheur">Rechercheur</option>
        <option value="Rédacteur">Rédacteur</option>
        <option value="Scientifique ">Scientifique</option>
        <option value="Sculpteur">Sculpteur</option>
        <option value="Sculpteur">Autres</option>
    </select>
</div>
<div class="form-group col-md-6">
    <button class='btn btn-lg btn-danger btn-block btn-signin' name="submit"  onclick="previousForm('firstPart','secondPart')">Retour</button>
</div>
<div class="form-group col-md-6">
    <button class='btn btn-lg btn-danger btn-block btn-signin' name="submit"  onclick="nextForm('secondPart','thirdPart')">Suivant</button>
</div>
</div>

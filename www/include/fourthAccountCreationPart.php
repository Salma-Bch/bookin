<div class="row">
    <div>
        <h3>Apprenons à vous connaître !</h3>
        <p>Choisissez les mots-clefs qui vous intéressent.</p>
        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            <?php
            $csvFile = fopen("./ressources/bd/db_tag.csv","r");
            $i=0;
            while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {
                echo "<input type='checkbox' class='btn-check tags_input' value ='".utf8_encode($lineCsv[0])."' name='tags[".$i."]' 
            id='tag-".strtolower(utf8_encode($lineCsv[0]))."' />";
                echo "<label class='btn btn-outline-secondary col-xs-6 col-sm-3' for='tag-".strtolower(utf8_encode($lineCsv[0]))."'>".utf8_encode($lineCsv[0])."</label>";
                $i++;
            }
            ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6 col-xs-6 partButton">
        <button class='btn btn-lg btn-danger btn-block btn-signin' name="submit"  onclick="previousForm('thirdPart','fourthPart')">Retour</button>
    </div>
    <div class="form-group col-sm-6 col-xs-6 partButton">
        <button class='btn btn-lg btn-danger btn-block btn-signin' name="submit"  onclick="createCompte('compteInfo')">Creer mon compte</button>
    </div>
</div>
<div class="btn-group choix_categorie" role="group" aria-label="Basic checkbox toggle button group">
    <?php
    $csvFile = fopen("./ressources/bd/db_category.csv","r");
    $lineCsv = fgetcsv($csvFile,1024, ";");
    $i = 0;
    while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {
        $bookId = str_pad(((int)$lineCsv[0]),8,0, STR_PAD_LEFT);
        echo "<input type='checkbox' class='btn-check category_input' value ='".utf8_encode($lineCsv[0])."' name='category[".$i."]' id='".strtolower(utf8_encode($lineCsv[0]))."' autocomplete='off'>";
        echo "<label class='btn btn-outline-secondary' for='".strtolower(utf8_encode($lineCsv[0]))."'>".utf8_encode($lineCsv[0])."</label>";
        $i++;
    }
    ?>
</div>


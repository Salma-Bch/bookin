<div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
    <?php
        $csvFile = fopen("./ressources/bd/db_tag.csv","r");
        $lineCsv = fgetcsv($csvFile,1024, ";");
        while ( ($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {
            $bookId = str_pad(((int)$lineCsv[0]),8,0, STR_PAD_LEFT);
            echo "<input type='checkbox' class='btn-check tags_input' value ='".strtolower(utf8_encode($lineCsv[0]))."' id='".strtolower(utf8_encode($lineCsv[0]))."' autocomplete='off'>";
            echo "<label class='btn btn-outline-secondary' for='".strtolower(utf8_encode($lineCsv[0]))."'>".utf8_encode($lineCsv[0])."</label>";
        }
    ?>
</div>

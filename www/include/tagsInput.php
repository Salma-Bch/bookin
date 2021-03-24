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

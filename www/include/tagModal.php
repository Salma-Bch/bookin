<div class="modal" id="dialogTagModal" tabindex = "-1">
    <div class = "modal-dialog modal-xl">
        <div class = "modal-content">
            <div class = "modal-header">
                <h3 class="modal-title">Ajouter des tags.</h3>
            </div>
            <div class ="modal-body">
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    <?php
                        include_once('./class/model/Client.php');
                        include_once("./include/includeFiles.php");
                        $client = $_SESSION['bookinClient'];
                        $tags = $client->getTags();

                        $csvFile = fopen("./ressources/bd/db_tag.csv","r");
                        $i = 0;

                        while (($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {
                            if(in_array(utf8_encode($lineCsv[0]), $tags)) {
                                echo "<input type='checkbox' class='btn-check tags_input' value ='".utf8_encode($lineCsv[0])."' name='tags[".$i."]' id='tag-".strtolower(utf8_encode($lineCsv[0]))."' checked />";
                                echo "<label class='btn btn-outline-secondary col-md-2' for='tag-".strtolower(utf8_encode($lineCsv[0]))."'>".utf8_encode($lineCsv[0])."</label>";
                                $i++;
                            }
                            else {
                                echo "<input type='checkbox' class='btn-check tags_input' value ='".utf8_encode($lineCsv[0])."' name='tags[".$i."]' id='tag-".strtolower(utf8_encode($lineCsv[0]))."' />";
                                echo "<label class='btn btn-outline-secondary col-md-2' for='tag-".strtolower(utf8_encode($lineCsv[0]))."'>".utf8_encode($lineCsv[0])."</label>";
                                $i++;
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Valider</button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
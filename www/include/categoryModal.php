<div class="modal" id="dialogModal" tabindex = "-1">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h3 class="modal-title">Ajouter des catégories.</h3>
            </div>
            <div class ="modal-body">
                <div class="btn-group choix_categorie" role="group" aria-label="Basic checkbox toggle button group">
                    <?php
                        use dao\DAOFactory;
                        use utility\Format;
                        include_once('./class/model/Client.php');
                        include_once("./include/includeFiles.php");
                        $client = $_SESSION['bookinClient'];
                        $daoFactory = DAOFactory::getInstance();
                        $likesDao = $daoFactory->getLikesDao();
                        $likes = $likesDao->find( Format::getFormatId(8,$client->getClientId()), null);
                        $likedCategoriesName = array();
                        foreach ($likes as $like){
                            array_push($likedCategoriesName,$like->getCategoryName());
                        }
                        $csvFile = fopen("./ressources/bd/db_category.csv","r");
                        $i = 0;

                        while (($lineCsv = fgetcsv($csvFile,1024, ";")) !== FALSE ) {

                                if(in_array(utf8_encode($lineCsv[0]), $likedCategoriesName)) {
                                    echo "<input type='checkbox' class='btn-check category_input' value ='" . utf8_encode($lineCsv[0]) . "' name='category[" . $i . "]' id='" . str_replace(' ', '-', strtolower(utf8_encode($lineCsv[0]))) . "' checked />";
                                    echo "<label class='btn btn-outline-secondary' for='" . str_replace(' ', '-', strtolower(utf8_encode($lineCsv[0]))) . "'>" . utf8_encode($lineCsv[0]) . "</label>";
                                    $i++;
                                }
                                else {
                                    echo "<input type='checkbox' class='btn-check category_input' value ='" . utf8_encode($lineCsv[0]) . "' name='category[" . $i . "]' id='" . str_replace(' ', '-', strtolower(utf8_encode($lineCsv[0]))) . "' />";
                                    echo "<label class='btn btn-outline-secondary' for='" . str_replace(' ', '-', strtolower(utf8_encode($lineCsv[0]))) . "'>" . utf8_encode($lineCsv[0]) . "</label>";
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
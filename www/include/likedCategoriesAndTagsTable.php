<table class="table">
    <tbody>
        <tr>
            <th><b>Catégories aimés :</b></th>
            <th><b>Tags aimés :</b></th>
        </tr>
        <tr>
            <td class="col-md-6" style="border-right:solid">
                <?php
                $i=0;
                while($i < count($likes)) {
                    echo '<div class="col-md-4 categoryAndTag">'.$likes[$i]->getCategoryName().' '.'</div>';
                    $i++;
                }
                ?>
                <button class="col-md-12 categoryAndTagButton" onclick="addCategory()"><b>+</b></button>
            </td>
            <td class="col-md-6" style="border-left:solid">
                <?php
                    $tags = $client->getTags();
                    $i=0;
                    while($i < count($tags)) {
                        echo '<div class="col-md-4 categoryAndTag">'.$tags[$i].' '.'</div>';
                        $i++;
                    }
                ?>
                <button class="col-md-12 categoryAndTagButton" onclick="addTag()"><b>+</b></button>
            </td>
        </tr>
    </tbody>
</table>

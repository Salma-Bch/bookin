<table class="table table-dark">
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
                echo '<button class="categoryAndTagButton">'.$likes[$i]->getCategoryName().' '.'</button>';
                $i++;
            }
            ?>
            <button class="categoryAndTagButton"><b>+</b></button>
        </td>

        <td class="col-md-6" style="border-left:solid">
            <?php
            $tags = $client->getTags();
            $i=0;
            while($i < count($tags)) {
                echo '<button class="categoryAndTagButton">'.$tags[$i].' '.'</button>';
                $i++;
            }
            ?>
            <button class="categoryAndTagButton"><b>+</b></button>
        </td>
    </tr>
    </tbody>
</table>
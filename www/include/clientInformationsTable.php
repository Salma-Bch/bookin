<?php
    use utility\Format;
?>
<table class="table" id="tableauInfo">
    <tbody>
    <tr>
        <td id="tab_laste_name"><b>Nom :</b> <?php echo $client->getLastName() ?></td>
        <td id="tab_first_name"><b>Prénom :</b> <?php echo $client->getFirstName() ?></td>
    </tr>
    <tr>
        <td id="tab_mail"><b>Adresse mail :</b> <?php echo $client->getMail();?></td>
        <td id="tab_id"><b>Id :</b> <?php echo Format::getFormatId(8,$client->getClientId())?></td>
    </tr>
    <tr>
        <td id="tab_profession"><b>Profession : </b><?php echo $client->getProfession();?></td>
        <td id="tab_sex"><b>Sexe :</b> <?php echo $client->getSex();?></td>
    </tr>
    </tbody>
</table>
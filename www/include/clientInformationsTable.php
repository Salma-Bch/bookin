<?php
    use utility\Format;
?>
<table class="table table-dark">
    <tbody>
    <tr>
        <td><b>Nom :</b> <?php echo $client->getLastName() ?></td>
        <td><b>Prénom :</b> <?php echo $client->getFirstName() ?></td>
    </tr>
    <tr>
        <td><b>Adresse mail :</b> <?php echo $client->getMail();?></td>
        <td><b>Id :</b> <?php echo Format::getFormatId(8,$client->getClientId())?></td>
    </tr>
    <tr>
        <td><b>Profession : </b><?php echo $client->getProfession();?></td>
        <td><b>Sexe :</b> <?php echo $client->getSex();?></td>
    </tr>
    </tbody>
</table>
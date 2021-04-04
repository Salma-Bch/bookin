<?php
    use utility\Format;
?>
<table class="table">
    <tbody>
        <tr>
            <td><b>Nom :</b> <?php echo $administrator->getLastName() ?></td>
            <td><b>Prénom :</b> <?php echo $administrator->getFirstName() ?></td>
        </tr>
        <tr>
            <td><b>Adresse mail :</b> <?php echo $administrator->getMail();?></td>
            <td><b>Id :</b> <?php echo Format::getFormatId(8,$administrator->getAdminId())?></td>
        </tr>
    </tbody>
</table>
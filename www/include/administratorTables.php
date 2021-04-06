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

<?php
$likesDao = \dao\DAOFactory::getInstance()->getLikesDao();
$evaluatesDao = \dao\DAOFactory::getInstance()->getEvaluatesDao();
$bookDao = \dao\DAOFactory::getInstance()->getBookDao();
$likes = $likesDao->getMostLikedCategory(5);
$likedBooksCount = $evaluatesDao->getBestRatedCount(5);
$likedBooks = $bookDao->findIn(array_keys($likedBooksCount));
$likedBooksGraph = array();
foreach ($likedBooks as $likedBook){
    $likedBooksGraph[$likedBook->getTitle()] = $likedBooksCount[Format::getFormatId(8,$likedBook->getBookId())];
}

var_dump($likedBooksGraph);
?>

<table class="table">
    <tbody>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <tr>
        <th><b>Statistiques des livres les plus achetés :</b></th>
        <th><b>Statistiques des livres les plus aimés :</b></th>
    </tr>
    <tr>
        <td class="col-md-6" style="border-right:solid">
            <canvas id="categoryGraph" width="400" height="400"></canvas>
        </td>
        <td class="col-md-6" style="border-right:solid">
            <canvas id="likedBookGraph" width="400" height="400"></canvas>
        </td>
    </tr>
    </tbody>
</table>
<script>
    var likedCategories = <?php echo json_encode($likes,JSON_INVALID_UTF8_SUBSTITUTE); ?>;
    var likedbooks = <?php echo json_encode($likedBooks,JSON_INVALID_UTF8_SUBSTITUTE); ?>;
    var ctx = document.getElementById('categoryGraph').getContext('2d');
    var ctx2 = document.getElementById('likedBookGraph').getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(likedCategories),
            datasets: [{
                label: '# Les catégories les plus aimées',
                data: Object.values(likedCategories),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',

                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var myChart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: Object.keys(likedbooks),
            datasets: [{
                label: '# Les livres les plus aimées',
                data: Object.values(likedbooks),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',

                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
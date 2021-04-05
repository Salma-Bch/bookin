<?php
    $likesDao = \dao\DAOFactory::getInstance()->getLikesDao();
    $likes = $likesDao->getMostLikedCategory(5);
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
                <canvas id="myChart" width="400" height="400"></canvas>
                <script>
                    var likedCategories = <?php echo json_encode($likes,JSON_INVALID_UTF8_SUBSTITUTE); ?>;
                    var ctx = document.getElementById('myChart').getContext('2d');
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

                </script>
               <!-- <img src="./ressources/images/graph.png" alt="Logo" style="height: 180px"/>-->
            </td>
            <td class="col-md-6" style="border-left:solid">
               <!-- <img src="./ressources/images/graph.png" alt="Logo" style="height: 180px"/>-->
            </td>
        </tr>
    </tbody>
</table>

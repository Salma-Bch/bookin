<!DOCTYPE html>
<html lang="fr">
    <?php
        /**
        * \file      termsOfUse.php
        * \author    Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
        * \version   1.0
        * \date      1 janvier 2021
        * \brief     Affiche la page 'Conditions d'utilisation' de l'application web Book'In.
        * \details   Page présentant les conditions d'utilisation de l'application web Book'In.
        */
    ?>
    <head>
        <?php
            include_once("include/head.php");
        ?>
        <title>Conditions d'utilisation</title>
    </head>
	<body>
		<?php
	        include("include/header.php");
	    ?>
        <div class="head_location"></div>
		<div class="container bodyContainer" id="termsOfUse">
            <h2>Conditions générales d'utilisation</h2>
			<div class="row termes">
				<div class="col-sm-12">
                    <p>Les présentes conditions générales d'utilisation s'appliquent à l'application web Book'In.</p>
                    <p><b>EN UTILISANT LE SITE, VOUS ACCEPTEZ LES PRÉSENTES CONDITIONS D'UTILISATION.</b></p>
					<p>
                        Sauf mention expresse figurant dans les présentes conditions d'utilisation,
                        aucune section du site ni aucun contenu ne peuvent être copiés, reproduits,
                        republiés, téléchargés, exposés en public, encodés, traduits, transmis ou
                        diffusés de quelque façon que ce soit sur un autre ordinateur, serveur,
                        application web ou support de publication ou de diffusion, ou pour quelque
                        entreprise commerciale que ce soit, sans un accord écrit préalable.
					</p>
                    <p>
                        Nous nous réservons le droit d’apporter des modifications à l'application web,
                        ce qui peut comprendre l’élimination, la modification ou la suspension
                        de tout aspect de l'application web à tout moment, sans préavis.
                    </p>
                    <p>
                        Il est possible que nous imposions de nouvelles règles ou de nouvelles
                        restrictions liées à l’utilisation de notre application web. Vous convenez de
                        relire périodiquement les modalités, et si vous continuez à accéder à
                        notre application web et à l’utiliser, cela signifiera que vous acceptez
                        toutes les modifications qui y ont été apportées.
                    </p>
                    <p>
                        Les prix sont indiqués en euros. Le paiement de la totalité du prix
                        doit être réalisé lors de l'achat des livres.
                    </p>
				</div>
			</div>
		</div>
		<?php
			include("include/footer.php");
		?>
	</body>
</html>

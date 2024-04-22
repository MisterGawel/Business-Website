<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-grey.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <style>
        body {
            background-image:url("images/test.png");
        }
        #titre {
            font-family: "Sofia", sans-serif;
            font-size: 1.7em;
        }
        .w3-card, .w3-bar-block{
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
        }
    </style>
</head>
<body>
    <main>

        <div class="w3-row">
            <div class="w3-col w3-mobile w3-card w3-theme-l5 w3-margin-right w3-border-0" style="width:60%">
                <div class="w3-card w3-light-gray w3-border-0">
                    <h4 id="titre" class="w3-center w3-margin-0 w3-padding">L'histoire de ma boulangerie</h4>
                </div>
                <div class="w3-theme-l5  w3-border-0 " style="margin:30px">
                    <p>
                        Bienvenue à "La Boulangerie Gourmande" - votre destination ultime pour les amoureux du bon pain et des pâtisseries délicieuses !
                        Située au cœur de la ville, notre boutique est un véritable paradis pour les amateurs de boulangerie. Avec notre vaste sélection de pains fraîchement sortis du four, 
                        de viennoiseries moelleuses et de pâtisseries alléchantes, nous sommes fiers de vous offrir une expérience culinaire exceptionnelle.
                    </p>
                    <p>
                        Notre équipe de boulangers passionnés travaille avec soin et savoir-faire pour vous proposer une variété de pains artisanaux, 
                        du classique baguette française à la rustique pain de campagne. Nos viennoiseries sont préparées avec amour, avec des croissants croustillants, 
                        des pains au chocolat fondants et des brioches dorées qui raviront vos papilles.
                    </p>
                    <p>
                        Et ce n'est pas tout ! Notre assortiment de pâtisseries saura satisfaire vos envies sucrées, avec des éclairs au chocolat riches en saveurs, 
                        des tartes aux fruits fraîchement préparées et des religieuses à la crème décadentes. Nous sommes fiers d'utiliser des ingrédients de qualité 
                        et de suivre des méthodes de fabrication traditionnelles pour vous offrir des produits authentiques et savoureux.
                    </p>
                    <p>
                        Que vous soyez à la recherche du pain parfait pour accompagner votre dîner, d'une viennoiserie pour votre pause café ou d'une pâtisserie pour célébrer une occasion spéciale, "La Boulangerie Gourmande" est 
                        l'endroit idéal pour satisfaire vos papilles. Venez nous rendre visite et laissez-vous séduire par l'odeur alléchante du pain fraîchement sorti du four et la douceur de nos délicieuses pâtisseries. 
                        Nous sommes impatients de vous accueillir dans notre boutique chaleureuse et conviviale pour une expérience inoubliable de boulangerie artisanale.
                    </p>    
                </div>
            </div>
            
            <div class="w3-rest w3-mobile w3-card w3-theme-l5">
                <div class="w3-card w3-light-gray w3-border-0">
                    <h4 id="titre" class="w3-center w3-margin-0 w3-padding">Instructions d'utilisation du site</h4>
                </div>
                <div class="w3-theme-l5 w3-border-0" style="margin:30px">
                    <?php
                        $instructions = fopen("README.txt","r");
                        while(!feof($instructions)){
                            $ligne = fgets($instructions); // LECTURE DU FICHIER README.TXT
                            echo $ligne;
                        }
                        fclose($instructions);
                    ?>
                </div>
            </div>
        </div>

    </main>
</body>
</html>
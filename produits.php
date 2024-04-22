<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-grey.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <style>
        a {
            font-family: "Sofia", sans-serif;
            font-size: 1.3em;
        }
        .w3-card, .w3-bar-block{
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
        }
        body {
            background-image:url("images/test.png");
        }
    </style>
</head>
<body>
    <div class="w3-bar-block w3-mobile w3-light-gray w3-quarter w3-animate-left" style="width:200px; margin:10px auto; text-align:left;">
        <a href="#" class="w3-bar-item w3-center w3-button w3-border-bottom" data-categorie="Tous" onclick="tri()"><i class="fa fa-align-justify" style="position: relative; right:10px;"></i>Tout afficher</a>    
        <a href="#" class="w3-bar-item w3-center w3-button" data-categorie="Pains" onclick="tri()">Pains</a>
        <a href="#" class="w3-bar-item w3-center w3-button" data-categorie="Viennoiseries" onclick="tri()">Viennoiseries</a>
        <a href="#" class="w3-bar-item w3-center w3-button" data-categorie="Pâtisseries" onclick="tri()">Pâtisseries</a>
    </div>
    <div>
        <div class="w3-rest w3-animate-left">
            <?php 
               function trierFichier($nomFichier) {
                $lignes = file($nomFichier, FILE_IGNORE_NEW_LINES);
            
                usort($lignes, function($a, $b) {
                    $categorieA = explode('|', $a)[2];
                    $categorieB = explode('|', $b)[2];
                    return strcmp($categorieA, $categorieB);
                });
            
                $fichier = fopen($nomFichier, "w");
                $derniereLigne = end($lignes); 
                foreach ($lignes as $ligne) {
                    if ($ligne === $derniereLigne) {
                        fwrite($fichier, $ligne);
                    } else {
                        fwrite($fichier, $ligne . "\n");
                    }
                }
                fclose($fichier);
            }
            trierFichier("produits.txt");
            ?>

            <?php 
            if(isset($_POST['identifiant']) && $_POST['choix'] == 'supprimer') {    
                supprimerProduit($_POST['identifiant']);        
                trierFichier("produits.txt");
            }
            function supprimerProduit($identifiant) {
                $newfile = fopen("produits.txt","r");
                $newproducts = "";
                while(!feof($newfile)){
                    $ligne = fgets($newfile);
                    list($ligne_identifiant, $nom, $categorie, $prix, $image) = explode("|", $ligne);
                    if($ligne_identifiant !== $identifiant){
                        $newproducts .= $ligne;
                    }
                }       
                fclose($newfile);
                $newfile = fopen("produits.txt","w");
                fwrite($newfile, rtrim($newproducts));
                fclose($newfile);
                echo "<script>alert('Vous venez de supprimer le produit " . $identifiant . "')</script>";
            }
            ?>
            
            <?php
            if(filesize("produits.txt") > 0){
                $file = fopen("produits.txt","r");
                while(!feof($file))
                {
                    $donnees = fgets($file);
                    list($identifiant, $nom, $categorie, $prix, $image) = explode("|", $donnees);
                    echo '<div id="'.$identifiant.'" class="w3-third produit " style="margin-bottom: 35px; height:370px">
                            <div class="w3-card w3-theme-l5" style="height:100%; position: relative; width:75%; margin:10px auto;">
                                <div style="position: relative; padding-top: 75%; overflow: hidden;">
                                    <img src="'.$image.'" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" />
                                </div>
                                    <span class="w3-btn w3-blue w3-hover-red" style="position: absolute; top: 0; right: 0;" onclick="supprimerProduit(\''.$identifiant.'\')"><i class="fa fa-remove"></i></span>
                                    <span class="w3-btn w3-blue w3-hover-red" style="position: absolute; top: 0; right: 50px;" onclick="modifierProduit(\''.$identifiant.'\',\''.$nom.'\',\''.$categorie.'\',\''.$prix.'\',\''.$image.'\')"><i class="fa fa-edit"></i></span>
                                <div class="w3-theme-l5">
                                    <h4 id="categorie" class="w3-center w3-margin-0 w3-padding w3-light-gray" style="font-family: Sofia, sans-serif;"><strong>'.$categorie.'</strong></h4>
                                    <h4 class="w3-padding-left w3-padding-0" style="font-family: Sofia, sans-serif;">'.$nom.' <i>#'.$identifiant.'</i></h4>
                                    <h5 class="w3-padding-left w3-padding">'.$prix.'&euro;</h5>
                                </div>
                            </div>
                        </div>';
                }
                fclose($file);
            }
            ?>
        </div>
    </div> 
    <script>
        // CREATION D'UN FORMULAIRE POUR CHAQUE CHOIX : SUPPRIMER OU MODIFIER
        
        // FONCTION SUPPRIMER 
        function supprimerProduit(identifiant) {
            const produitASupprimer = document.getElementById(identifiant);
            produitASupprimer.remove();
            const form = document.createElement('form');
            form.method = 'post';
            form.action = '';

            const inputNames = ['identifiant', 'choix'];
            const inputValues = [identifiant, 'supprimer'];

            for (let i = 0; i < inputNames.length; i++) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = inputNames[i];
                input.value = inputValues[i];
                form.appendChild(input);
            }

            document.body.appendChild(form);
            form.submit();
        }

        // FONCTION MODIFIER
        function modifierProduit(identifiant, nom, categorie, prix, image) {
            const form = document.createElement('form');
            form.method = 'post';
            form.action = 'index.php?page=modifprod.php';

            const inputNames = ['identifiant', 'choix','nom', 'categorie', 'prix', 'image'];
            const inputValues = [identifiant, 'modifier',nom, categorie, prix, image];

            for (let i = 0; i < inputNames.length; i++) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = inputNames[i];
                input.value = inputValues[i];
                form.appendChild(input);
            }

            document.body.appendChild(form);
            form.submit();
        }

        // FONCTION TRI PAR CATEGORIE
        function tri() {
            const categorie = event.target.getAttribute('data-categorie');
            const produits = document.querySelectorAll('.produit');
            produits.forEach(produit => {
                if (categorie === 'Tous' || produit.querySelector('#categorie').textContent === categorie) {
                produit.style.display = 'block';
                } else {
                produit.style.display = 'none'; 
                }
        });
        }

    </script>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-grey.css">
    <style>
        body {
            background-image:url("images/test.png");
        }
        div, header{
	        font-family: "Sofia", sans-serif;
            font-size: 1.0em;
        }
        form {
            font-size: 1.4em;
        }
        #title1 {
            font-family: 'Brush Script MT', cursive;
            font-size: 1.9em;     
        }
        input[type='text'], input[type='password'], select {
            border: none; 
            border-bottom: 1px solid rgb(151, 151, 151);
            width:100%;
            padding: 4px 2px;
            margin: 5px 0px;
            box-sizing: border-box;
            outline: none;
            border-radius: 5px;
        }
        .w3-card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
        }
    </style>
</head>
<body>
    <header class="w3-container w3-light-gray w3-center w3-padding">
        <h1 id="title1">Formulaire d'édition de produit</h1>
    </header>
    <main>
        <?php
            // VERIFICATION DES VARIABLES SI FORMULAIRE EST EN MODE MODIFICATION
            // PERMET D'EVITER LA CREATION DE VARIABLES NON-DEFINIES
            $identifiant = $nom = $categorie = $prix = $image = "";
            if(isset($_POST['identifiant'])){
                $identifiant = $_POST['identifiant'];}
            if(isset($_POST['nom'])){
                $nom = $_POST['nom'];}
            if(isset($_POST['categorie'])){
                $categorie = $_POST['categorie'];}
            if(isset($_POST['prix'])){
                $prix = $_POST['prix'];}
            if(isset($_POST['image'])){
                $image = $_POST['image'];}

            // ON RECUPERE LE CHOIX DE SOUMISSION : MODIFIER OU AJOUTER
            if(isset($_POST['choix']) && $_POST['choix'] === "modifier"){
                $type = "de modification";
                $soumission = "Modifier";
            }       
            else {
                $type = "d'ajout";
                $soumission = "Ajouter";
                $reset = "<button class='w3-button w3-gray' type='reset'>Réinitialiser</button>";
            }


            // GENERATEUR D'IDENTIFIANTS 
            $newfile2 = fopen("produits.txt","r");
            $id = 1;
            while(!feof($newfile2)){
                $ligne2 = fgets($newfile2);
                list($un, $de, $tr, $q, $c) = explode("|", $ligne2);
                if($un !== $id){
                    $id++;
                }
            }  
            fclose($newfile2);   

            // RECUPERE LES CATEGORIES DU FICHIER SANS LES PRENDRE EN DOUBLE
            // PERMET DE FAIRE LA SELECTION DANS LE FORMULAIRE
            $newfile3 = fopen("produits.txt","r");
            $typecategorie = array();
            $i = 0;
            while(!feof($newfile3)){
                $ligne3 = fgets($newfile3);
                list($un, $de, $tr, $q, $c) = explode("|", $ligne3);
                if(!in_array($tr, $typecategorie)){
                    $typecategorie[$i] = $tr; 
                    $i++;
                }
            }  
            fclose($newfile3);
        ?>

        <div class="w3-content w3-theme-l5 w3-card w3-margin-top w3-margin-bottom w3-mobile w3-animate-left" style="width:35%" id="id01">
            <h2 class="w3-light-gray w3-margin-0 w3-center w3-padding">Formulaire <?php echo $type ?></h2>

            <form class="w3-row w3-padding w3-margin" method="POST" id="form" action="index.php?page=modifprod.php">
                <div class="w3-block w3-row w3-padding-right" >
                    <label for="identifiant">Identifiant :</label>
                    <input type="text" id="identifiant" name="identifiant" value="<?php if(isset($_POST['identifiant'])) echo $identifiant; else echo $id; ?>" readonly>

                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="<?php echo $nom ?>">
                
                    <label for="categorie">Catégorie :</label><br>
                    <select id="categorie" class="w3-border-0 w3-border-bottom" name="categorie">
                        <?php
                            foreach($typecategorie as $cat){
                                echo '<option value="' . $cat . '"';
                                if(isset($_POST['categorie']) && $_POST['categorie'] == $cat){
                                    echo ' selected'; 
                                }
                                echo '>' . $cat . '</option>';
                            }
                        ?>
                    </select><br>

                    <label for="prix">Prix :</label>
                    <input type="text" id="prix" name="prix" value="<?php echo $prix ?>">

                    <label for="image">Image : </label>
                    <input type="text" id="image" name="image" value="<?php echo $image ?>" placeholder="URL de l'image">
                    <img src="<?php echo $image ?>" style="width:100%">
                </div>
                <div class="w3-block w3-row w3-padding-top">
                    <button class="w3-button w3-gray" id="bouton" type="button" onclick="submitform()" value="<?php echo $soumission ?>"><?php echo $soumission ?></button>
                    <?php if(isset($reset)) echo $reset ?>
                </div>
            </form>

        </div>

        <?php
            // SI FORMULAIRE SOUMIS ET EN MODE MODIFIER
            // AFFICHE UN RECAPITULATIF DES MODIFICATIONS
            if(isset($_POST['AfterAdd']) && $_POST['AfterAdd'] == "Modify"){
            echo '
                <div class="w3-content w3-theme-l5 w3-card w3-margin-top w3-margin-bottom w3-mobile" style="width:70%;font-size:1.4em;">
                    <h2 class="w3-light-gray w3-margin-0 w3-center w3-padding">Modification effectué</h2>
                    <h4 class="w3-light-gray w3-margin-0 w3-center w3-padding"><strong>Récapitulatif</strong></h4>
                
                    <div class="w3-row w3-padding w3-margin">

                        <div class="w3-col w3-padding-right" style="width:40%">
                            <label for="identifiant">Identifiant :</label>
                            <input type="text" id="identifiant" name="identifiant" value="'.$identifiant.'" readonly>

                            <label for="nom">Nom :</label>
                            <input type="text" id="nom" name="nom" value="'.$_POST['avantnom'].'" readonly>
                        

                            <label for="categorie">Catégorie :</label>
                            <input type="text" id="categorie" name="categorie" value="'.$_POST['avantcategorie'].'" readonly>
                            
                            <label for="prix">Prix :</label>
                            <input type="text" id="prix" name="prix" value="'.$_POST['avantprix'].'" readonly>
                            
                            <label for="image">URL : </label>
                            <input type="text" id="image" name="image" value="'.$_POST['avantimage'].'" readonly>
                            <img src="'.$_POST['avantimage'].'" style="width:100%">
                        </div>
                        <div class="w3-col" style="width:20%">
                            <img src="images/fleche.jpg" style="position: relative; left: 65px; top: 230px; width:20%;">
                        </div>
                        <div class="w3-col" style="width:40%">
                            <label for="identifiant">Identifiant :</label>
                            <input type="text" id="identifiant" name="identifiant" value="'.$identifiant.'" readonly>

                            <label for="nom">Nom :</label>
                            <input type="text" id="nom" name="nom" value="'.$nom.'" readonly>
                        

                            <label for="categorie">Catégorie :</label>
                            <input type="text" id="categorie" name="categorie" value="'.$categorie.'" readonly>
                            
                            <label for="prix">Prix :</label>
                            <input type="text" id="prix" name="prix" value="'.$prix.'" readonly>
                            
                            <label for="image">URL : </label>
                            <input type="text" id="image" name="image" value="'.$image.'" readonly>
                            <img src="'.$image.'" style="width:100%">
                        </div>


                        <div class="w3-block w3-row w3-padding-top w3-col" style="width:40%">
                            <h5 class="w3-center"><strong>Produit avant-modification</strong></h5>
                        </div>
                        <div class="w3-block w3-row w3-padding-top w3-col" style="width:20%">
                        </div>
                        <div class="w3-block w3-row w3-padding-top w3-col" style="width:40%"> 
                            <h5 class="w3-center"><strong>Produit après-modification</strong></h5>
                        </div>
                        <div class="w3-block w3-row w3-padding-top w3-col" style="width:40%">
                        </div>
                        <div class="w3-block w3-row w3-padding-top w3-col" style="width:20%">
                            <a href="index.php?page=produits.php" class="w3-button w3-center" style="position: relative; right: 50px;">Retour à la liste des produits</a>
                        </div>
                        <div class="w3-block w3-row w3-padding-top w3-col" style="width:40%"> 
                        </div>
                    </div>
                </div>';
            echo '<script>document.getElementById("id01").style.display="none";</script>';
            }
        ?>
        <?php
            // SI FORMULAIRE SOUMIS ET EN MODE AJOUT
            // AFFICHE UN RECAPITULATIF DE L'AJOUT
            if(isset($_POST['AfterAdd'])  && $_POST['AfterAdd'] == "Add"){
            echo '        
                <div class="w3-content w3-theme-l5 w3-card w3-margin-top w3-margin-bottom w3-mobile" style="width:35%;font-size:1.4em;">
                    <h2 class="w3-light-gray w3-margin-0 w3-center w3-padding">Ajout effectué</h2>
                    <h4 class="w3-light-gray w3-margin-0 w3-center w3-padding"><strong>Récapitulatif</strong></h4>

                    <div class="w3-row w3-padding w3-margin">
                         <div class="w3-block w3-row w3-padding-right">
                            <label for="identifiant">Identifiant :</label>
                            <input type="text" id="identifiant" name="identifiant" value="'.$identifiant.'" readonly>

                            <label for="nom">Nom :</label>
                            <input type="text" id="nom" name="nom" value="'.$nom.'">

                            <label for="categorie">Catégorie :</label>
                            <input type="text" id="categorie" name="categorie" value="'.$categorie.'">
                            
                            <label for="prix">Prix :</label>
                            <input type="text" id="prix" name="prix" value="'.$prix.'">

                            <label for="image">URL : </label>
                            <input type="text" id="image" name="image" value="'.$image.'">
                            <img src="'.$image.'" class="w3-padding-bottom" style="width:100%">
                        </div>
                        <div class="w3-block w3-row w3-padding-top w3-center">
                            <a href="index.php?page=produits.php" class="w3-button">Retour à la liste des produits</a>
                        </div>
                    </div>

                </div>';
            echo '<script>document.getElementById("id01").style.display="none";</script>';
            }
        ?>
    </main>

    <?php
        // ECRITURE DANS LE FICHIER PRODUITS.TXT
        if(isset($_POST['typeSubmit']) && $_POST['typeSubmit'] === "Ajouter"){
            if (!empty($_POST["nom"]) and !empty($_POST["categorie"]) and !empty($_POST["prix"]) and !empty($_POST["image"]))
            {
                $identifiant = $_POST["identifiant"];
                $nom =  $_POST['nom'];
                $categorie = $_POST['categorie'];
                $prix = $_POST['prix'];
                $image = $_POST['image'];
                $fp = fopen("produits.txt", "a");
                $savestring = "\n".$identifiant."|" .$nom."|".$categorie ."|" .$prix."|".$image;
                fwrite($fp, $savestring);
                fclose($fp);
                echo '<script>alert("Vous venez d\'ajouter un nouveau produit")</script>';
            }
            else echo '<script>alert("Un champ est manquant");</script>';
        }

        // MODIFICATION DANS LE FICHIER PRODUITS.TXT
        if(isset($_POST['typeSubmit']) && $_POST['typeSubmit'] == "Modifier"){
            if (!empty($_POST["identifiant"]) && !empty($_POST["nom"]) && !empty($_POST["categorie"]) && !empty($_POST["prix"]) && !empty($_POST["image"])) {
                $identifiant = $_POST["identifiant"];
                $nom = $_POST['nom'];
                $categorie = $_POST['categorie'];
                $prix = $_POST['prix'];
                $image = $_POST['image'];

                $newfile = fopen("produits.txt","r");
                $newproducts = $identifiant.'|'.$nom.'|'.$categorie.'|'.$prix.'|'.$image.'|'."\n";
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

                echo "<script>alert('Vous venez de modifier le produit " . $identifiant . "')</script>";
            } else {
                echo '<script>alert("Un champ est manquant");</script>';
            }
        }  
    ?>
    <script>
        var identifiant = document.getElementById("identifiant");
        var nom = document.getElementById("nom");
        var categorie = document.getElementById("categorie");
        var prix = document.getElementById("prix");
        var image = document.getElementById("image");

        var formulaire = document.getElementById("form");
        var soumission = document.getElementById("bouton");

        function submitform() {
            if(soumission.value === "Ajouter"){
                ajouterProduit();
            }
            if(soumission.value === "Modifier"){
                modifierProduit();
            }
        }

        // CREATION D'UN FORMULAIRE ET VERIFICATIONS DES CHAMPS VIDES
        function ajouterProduit() {
            if (nom.value !== "" && categorie.value !== "" && prix.value !== "" && image.value !== "") {
                const inputNames = ['typeSubmit', 'AfterAdd'];
                const inputValues = ['Ajouter', 'Add'];

                for (let i = 0; i < inputNames.length; i++) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = inputNames[i];
                    input.value = inputValues[i];
                    form.appendChild(input);
                }

                document.body.appendChild(form);
                formulaire.submit();   
            } else {
                alert("Un champ est manquant");
            }
        }

         // CREATION D'UN FORMULAIRE ET VERIFICATIONS DES CHAMPS VIDES
        function modifierProduit(){
            if (nom.value !== "" && categorie.value !== "" && prix.value !== "" && image.value !== "") {
                const inputNames = ['typeSubmit', 'AfterAdd','avantnom', 'avantcategorie', 'avantprix', 'avantimage'];
                const inputValues = ['Modifier', 'Modify','<?php echo "$nom" ?>', '<?php echo "$categorie" ?>', '<?php echo "$prix" ?>', '<?php echo "$image" ?>'];

                for (let i = 0; i < inputNames.length; i++) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = inputNames[i];
                    input.value = inputValues[i];
                    form.appendChild(input);
                }

                document.body.appendChild(form);
                formulaire.submit(); 
            } else {
                alert("Un champ est manquant");
            }    
        }
        
    </script>
</body>
</html>
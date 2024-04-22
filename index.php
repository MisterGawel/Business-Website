<!DOCTYPE html>
<html lang="en">
<head>
    <title>INDEX</title>
</head>
<body>
    <?php include('entete.php'); ?>
    <?php 
        $TABPAGES = array(
            '<i class="fa fa-home" style="font-size:23px"></i>'=>"init.php",
            "Produits"=>"produits.php",
            "Formulaire"=>"modifprod.php",
        );

        include('menu.php');
    ?>
    <div class="w3-container w3-padding">
        <?php 
            if (isset($_GET['page'])){
                include($_GET['page']); 
            } else {    
                include('init.php'); 
            }
        ?>
    </div>
    <?php 
        include('pied.php'); 
    ?>
</body>
</html>
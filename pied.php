<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css"> 
    <style>
        footer {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
            font-family: "Sofia", sans-serif;
            font-size: 1.3em;
        }
    </style>
</head>
<body>
    <footer class="w3-container w3-light-gray w3-panel w3-center">
        <p class="w3-container w3-center w3-margin">
            <?php
                echo "Cette page a été modifié le : ".date("F d Y H:i:s.", filemtime("pied.php"));
            ?>  
            <br>Réalisé par A. GAEL
        </p>
    </footer>
</body>
</html>
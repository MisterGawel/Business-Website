<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <style>
        .w3-bar {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
        }
    </style>
</head>
<body>
    <div class="w3-bar w3-light-gray">
        <?php foreach ($TABPAGES as $nom_page => $url_page): ?>
            <a href="index.php?page=<?php echo $url_page; ?>" class="w3-bar-item w3-button" style="font-family: Sofia, sans-serif; font-size: 1.3em;"><?php echo $nom_page; ?></a>
        <?php endforeach; ?>
    </div>
</body>
</html>
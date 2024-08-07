<?php include_once('classes/dog.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>OOP Day 1</title>
    </head>
    <body>
        <?php 
            $spirit = new Dog(4, 'male', 25, 'white', 'Spirit');
            
            $aoi = new Dog(6, 'female', 25, 'marble', 'Aoi');
        ?>
    </body>
</html>
<?php
    $albums = array(["Rancid","Let's Go!", "https://www.youtube.com/rancid"], ["Less Than Jake", "Losing Streak", "https://www.youtube.com/channel/UCierbPdWUu5-WN2p7r1j1-w"], ["PennyWise", "Land of the Free", "https://www.youtube.com/channel/UCaqhFGLjN--Qq9W60qCcRHg"], ["Stevie Ray Vaughn", "Texas Flood", "https://www.youtube.com/channel/UCxPlXqVP-0GvvGG-WrE_6Iw"], ["Pennywise", "About Time", "https://www.youtube.com/channel/UCaqhFGLjN--Qq9W60qCcRHg"], ["Pennywise", "Pennywise", "https://www.youtube.com/channel/UCaqhFGLjN--Qq9W60qCcRHg"], ["Pennywise", "Straight Ahead", "https://www.youtube.com/channel/UCaqhFGLjN--Qq9W60qCcRHg"], ["The Offspring", "Offspring", "https://www.youtube.com/channel/UCP3EX5VKeaG4Oa2qTKPuEFA"], ["Rancid", "2000", "https://www.youtube.com/rancid"], ["Offspring", "Americana", "https://www.youtube.com/channel/UCP3EX5VKeaG4Oa2qTKPuEFA"]);
    shuffle($albums);
    $display = "";

    for($i = 0; $i < sizeof($albums); $i++){
        $album = $albums[$i];
        $band = $album[0];
        $albumName = $album[1];
        $url = $album[2];
        $display .= '<tr class="border"><td class="text-center">'.$band.'</td><td class="text-center"><a href='.$url.' target="_blank">'.$albumName.'</a></td></tr>';
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Music</title>
        <link rel="stylesheet" href="./css/styles.css" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <?php include '../partials/navbar.php'; ?>
    <body>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-5">
                    <table class="border m-auto wider">
                        <tr class="border">
                            <th class="fs-30 yellow text-center">Band</th>
                            <th class="fs-30 yellow text-center">Album Name</th>
                        </tr>
                        <?php
                            echo $display;                
                        ?>
                    </table>
                    </div>
                </div>
            </div>    
        </main>
    </body>
</html>
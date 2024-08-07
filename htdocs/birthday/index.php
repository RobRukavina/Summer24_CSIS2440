<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Birthday</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <?php include '../partials/navbar.php'; ?>
    

    <body>
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <?php
                        echo("<h1>Happy Birthday!</h1>")
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="img-container d-flex m-auto">
                    <?php    
                    echo'<img class="d-flex m-auto" src="img/stern-flag.jpg" alt="stern flag">';
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
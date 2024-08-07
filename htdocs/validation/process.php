<?php 
    if($_POST['phoneNumber'] === "" || !empty($_POST['phoneNumber'])){
        $phoneNumber = $_POST['phoneNumber'];
        if(!preg_match("/\(\d{3}\)\d{3}-\d{4}\$/", $phoneNumber)){
            $ec = 1;
            header("location: .?ec=".$ec."&phoneNumber=".$phoneNumber."");
        };
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Confirmation</title>
        <link rel="stylesheet" href="./css/styles.css" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <?php include "../partials/navbar.php"?>
        <main class="bkg-img">
            <div class="container">
                <div class="row">
                    <div class="col-12 m-auto">
                        <div class="card border-rounded p-4 mt-5 bkg shadow-lg text-center">
                            <div class='card-title'>
                                <h1 class='bold white'>Thank You!</h1>
                                <h3 class='sec-font-color'>Your phone number has been validated and you have been <br>signed up to receive a text with info about Beartooth Lake.</h3>
                            </div>
                            <div class="card-body">
                                <h2 class="white">We will text the info to:</h2>
                                <h3 class="yellow bold"><?php echo $phoneNumber ?></h3>
                                <div class="img-container">
                                    <img class="img-fluid rounded" src="./img/BeartoothLake.jpg" alt="Beartooth Lake">
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>    
        </main>
    </body>
</html>
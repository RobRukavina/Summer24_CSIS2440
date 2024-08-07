<?php
    $msg = $phoneNumber = "";
    
    if(!empty($_GET['phoneNumber'])){
        $phoneNumber = $_GET['phoneNumber'];
    }

    if(!empty($_GET['ec'])){
        $msg = "<p class='warning col-4 m-auto'>Please enter a valid phone number.</p><br><p class='warning col-4 m-auto fs-14'>*Accepted Format: (XXX)XXX-XXXX</p>";
    }

    function displayForm($phoneNumber){
        $result =
            "<div class='card-title'>
                <h1 class='bold white'>For Info On Beartooth Lake</h1>
                <h2 class='sec-font-color'>Enter Your Phone Number!</h2>
            </div>
            <div class='card-body'>
                <form class='col-6 m-auto' action='process.php' method='post'>
                    <div class='form-group'>
                        <label class='white' for='phoneNumber'>Phone Number</label>
                        <input type='text' class='form-control ' name='phoneNumber' value='".$phoneNumber."' id='phoneNumber' placeholder='Enter Your Phone Number'>
                    </div>
                    <div class='btn-toolbar justify-content-center'>
                        <button type='reset' class='text-center btn btn-danger btn-md mr-1'>Reset</button>
                        <button type='submit' class='text-center btn btn-primary btn-md ml-1'>Submit</button>
                    </div>
                </form>
            </div>";
        return $result;
    }    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Beartooth Lake Info</title>
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
                            <?php echo displayForm($phoneNumber) ?>
                            <div class="text-center">
                                <?php echo ($msg != "" ? $msg : "") ?>
                            </div>
                            <div class='img-container mt-5'>
                                <img class='img-fluid rounded' src='./img/BeartoothLake.jpg' alt='Beartooth Lake'>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>    
        </main>
    </body>
</html>





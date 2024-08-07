<?php 
    $email = $firstName = $lastName = $msg = $phoneNumber = "";
    $errorCode = 0;
    $prevErr = 0;

    if(!empty($_GET['ec'])){
        $errorCode = $_GET['ec'];
        $prevErr = $_GET['ec'];
        if(!empty($_GET['firstName'])){
            $firstName = $_GET['firstName'];
        }
        if(!empty($_GET['lastName'])){
            $lastName = $_GET['lastName'];
        }
        if(!empty($_GET['email'])){
            $email = $_GET['email'];
        }
        if(!empty($_GET['phoneNumber'])){
            $phoneNumber = $_GET['phoneNumber'];
        }
    }

    if(isset($_POST['sub-btn'])){
        $errorCode = 0;
        if(!empty($_POST['firstName']) && empty($_GET['firstName'])){
            $firstName = $_POST['firstName'];
        } 
        if(!empty($_POST['lastName']) && empty($_GET['lastName'])){
            $lastName = $_POST['lastName'];
        }
        if(!empty($_POST['email']) && empty($_GET['email'])){
            $email = $_POST['email'];
        }
        if(!empty($_POST['phoneNumber']) && empty($_GET['phoneNumber'])){
            $phoneNumber = $_POST['phoneNumber'];
        }
        
        if((!empty($firstName) && !empty($lastName) && !empty($email) && !empty($_phoneNumber) || (empty($firstName) || empty($lastName) || empty($email) || empty($phoneNumber)))){
            if(!preg_match("/\w+/", $firstName)) {
                $errorCode += 1;
            }
            if(!preg_match("/\w+/", $lastName)){
                $errorCode += 2;
            } 
            if(!preg_match("/\w+[@]\w+[.]\w{2,5}/", $email)){
                $errorCode += 4;
            } 
            if(!preg_match("/\d{3}[-.*_]?\d{3}[-.*_]?\d{4}/", $phoneNumber)){
                $errorCode += 6;
            }
        }
    }

    if($errorCode > 0){
        $eMsg[] = "";
        $eMsg[] = "<p><span class='warning'>*Enter a valid First Name</span></p>";
        $eMsg[] = "<p><span class='warning'>*Enter a valid Last Name</span></p>";
        $eMsg[4] = "<p><span class='warning'>*Enter a valid Email</span></p>";
        $eMsg[6] = "<p><span class='warning'>*Enter a valid Phone Number</span></p>";
        switch($errorCode){
            case 13: $msg = $eMsg[1].$eMsg[2].$eMsg[4].$eMsg[6]; break;
            case 12: $msg = $eMsg[2].$eMsg[4].$eMsg[6]; break;
            case 11: $msg = $eMsg[1].$eMsg[4].$eMsg[6]; break;
            case 10: $msg = $eMsg[4].$eMsg[6]; break;
            case 9: $msg = $eMsg[1].$eMsg[2].$eMsg[6]; break;
            case 8: $msg = $eMsg[2].$eMsg[6]; break;
            case 7: $msg = $eMsg[1].$eMsg[6]; break;
            case 6: $msg = $eMsg[6]; break;
            case 5: $msg = $eMsg[1].$eMsg[4]; break;
            case 4: $msg = $eMsg[4]; break;
            case 3: $msg = $eMsg[1].$eMsg[2]; break;
            case 2: $msg = $eMsg[2]; break;
            case 1: $msg = $eMsg[1]; break;
        }
        if(!isset($_GET['ec']) || isset($_GET['ec']) && $prevErr != $errorCode){
            header('location: .?ec='.$errorCode.'&firstName='.$firstName.'&lastName='.$lastName.'&email='.$email.'&phoneNumber='.$phoneNumber);
        }
    }


    function display($errorCode, $firstName, $lastName, $email, $phoneNumber){
        if(!isset($_POST['sub-btn']) || $errorCode > 0){
            return "<div class='card-title'>
                        <h1 class='bold'>Give Me Your Data!</h1>
                        <h5 class='text-muted'>I promise I won't sell it :)</h5>
                    </d>
                    <form class='m-auto' action='' method='post'>
                        <div class='form-group'>
                            <label for='firstName'>First Name</label>
                            <input type='text' class='form-control' name='firstName' value='$firstName' id='firstName' placeholder='Enter Your First Name'>
                        </div>
                        <div class='form-group'>
                            <label for='lastName'>Last Name</label>
                            <input type='text' class='form-control' name='lastName' value='$lastName' id='lastName' placeholder='Enter Your Last Name'>
                        </div>
                        <div class='form-group'>
                            <label for='email'>Email address</label>
                            <input type='text' class='form-control' name='email' value='$email' id='email' aria-describedby='emailHelp' placeholder='Enter email'>
                            <small id='emailHelp' class='form-text text-muted'>We'll never share your email with anyone else. (...unless they give us money)</small>
                        </div>
                        <div class='form-group'>
                            <label for='phoneNumber'>Phone Number</label>
                            <input type='text' class='form-control' name='phoneNumber' value='$phoneNumber' id='phoneNumber' placeholder='Enter Your Phone Number'>
                        </div>
                        <div class='btn-group d-flex m-auto'>
                            <button type='submit' name='sub-btn' class='text-center btn btn-primary'>Submit</button>
                        </div>
                    </form>";
        } else {
            return '<div class="card-header">
                        <div class="card-title">
                            <h2 class="m-auto bold"> Thank You '. $firstName .' '. $lastName.'!</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="m-auto">Email: '. $email .'</p>
                        <p class="m-auto">Phone Number: '. $phoneNumber .'</p>
                    </div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sign Up</title>
        <link rel="stylesheet" href="/input/css/styles.css" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <?php include "../partials/navbar.php"?>
    <body>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-8 m-auto">
                        <div class="card border-rounded p-4 mt-5 bkg shadow-lg text-center">
                            <?php echo display($errorCode, $firstName, $lastName, $email, $phoneNumber) ?>
                            <div class="text-center">
                                <?php echo "<p class='warning'>".$msg."</p>" ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </main>
    </body>
</html>
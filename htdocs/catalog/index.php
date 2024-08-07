<?php 
include_once("./includes/db.php");
    if(!isset($_SESSION)){
        session_start();
    }

    $userName = "";
    $pass = "";
    $msg = "";
    $userImg = "";
    $logged = false;
    $ec = array();


    if(isset($_SESSION['userName'])){
        $userName = $_SESSION['userName'];
    }
    if(isset($_SESSION['pass'])){
        $pass = $_SESSION['pass'];
    }
    if(isset($_SESSION['log'])){
        $logged = $_SESSION['log'];
    }

    function comparePass($user, $password, $dbRes){
        $response = false;
        $salt = "3e4iovcn-qnooen";
        $salt2 = "onvwhnlahjfijop";
        $password = $salt.$password.$salt2;
        $password = hash("sha512", $password);
        while($row = mysqli_fetch_array($dbRes, MYSQLI_ASSOC)){
            if($row['username'] == $user && $row['pass'] == $password){
                return true;
            }
        }
           
        return $response;
    }

    if(isset($_POST['sbt'])){
        $_SESSION['sbt'] = true;

        if(!empty($_POST['userName'])) {
            $userName = $_POST["userName"];
            $_SESSION["userName"] = $userName;
        }
        
        if(!empty($_POST['password'])) {
            $pass = $_POST["password"];
            $_SESSION["password"] = $pass;
        }

        $con = connectToDB();
        $query = "SELECT * FROM secureusers;";
        $res = mysqli_query($con, $query);
        
        mysqli_close($con);
        
        if(
            ($userName == "" && $pass == "")
            || ($userName != "" && $pass == "" || $pass != "" && $userName =="")  
        ){
            array_push($ec, 1);
        } else if(!comparePass($userName, $pass, $res)){ 
            array_push($ec, 2);
        } else if(sizeof($ec) == 0){  
            $_SESSION['log'] = true;
            $msg = "";
        }
        $_SESSION['ec'] = $ec;

        header("location: .");
    }

    if(isset($_SESSION['ec']) && sizeof($_SESSION['ec']) > 0){
        unset($ec);
        $ec = $_SESSION['ec'];
        for($i = 0; $i < sizeof($ec); $i++){
            if($ec[$i] == 1){
                $msg .= "<p class='warning'>please enter both a username and password.</p>";
            }
            if($ec[$i] == 2){
                $msg .= "<p class='warning'>You have entered an invalid username or password. Please try again</p>";
            }
        }
    }


    function getDisplay($userName, $pass, $msg, $logged){
        $res = "";

        if($logged){
            $res.='
            <div class="card bdr-25 bkg-grey">
                <div class="card-title">
                    <h1 class="text-center mt-3">Woohoo '.ucfirst($userName).'</h1>
                    <h4 class="text-center pr-5 pl-5">Check out the amazing deals we have today by clicking the link below.</h4>
                </div>
                <div class="card-body">
                    <div class="img-container mr-3 ml-3">
                        <img class="img-fluid d-flex m-auto bdr-25" src="./img/HomerSimpson.png" alt="'.$userName.'" profile img">
                    </div>
                    <p class="text-center mt-4">
                        <a href="./catalog.php">Click here</a> 
                        to get the scoop on all our killer deals!
                    </p> 
                </div>
            </div>';
        } else {
            $res.= ($msg != "" ? "<div class='card bdr-25 bkg-grey'><div class='card-title m-4 text-center'>". $msg .="
                    </div>
                        <div class='card-body'>
                            <form class='col-6 m-auto' action='' method='post'>
                                <div class='form-group'>
                                    <label class='white' for='userName'>Username</label>
                                    <input type='text' class='form-control ' name='userName' value='".$userName."' id='userName' placeholder='Enter your username'>
                                </div>
                                <div class='form-group'>
                                    <label class='white' for='pass'>Password</label>
                                    <input type='password' class='form-control ' name='password' value='".$pass."' id='pass' placeholder='Enter your password'>
                                </div>
                                <div class='btn-toolbar justify-content-center'>
                                    <button type='reset' class='text-center btn btn-danger btn-md mr-1'>Reset</button>
                                    <button type='submit' name='sbt' class='text-center btn btn-primary btn-md ml-1'>Submit</button>
                                </div>
                                <div class='col-12 text-center mt-3'>
                                    <a href='./create-account.php'>No account? Sign up here.</a>
                                </div>
                            </form>
                        </div>
                    </div>" 
                    : 
                    "<div class='card bdr-25 bkg-grey'>
                        <div class='card-title text-center mt-3'>
                            <h1 class='bold mt-3'>Welcome to Rob's Catalog </h1>
                            <h2> Of Crazy & Amazing Deals</h2>
                        </div>
                        <div class='card-body'>
                            <p class='sec-font-color mt-3 text-center'>Please enter your username and password.</p>
                            <form class='col-6 m-auto' action='' method='post'>
                                <div class='form-group'>
                                    <label class='white' for='userName'>Username</label>
                                    <input type='text' class='form-control ' name='userName' value='".$userName."' id='userName' placeholder='Enter your username'>
                                </div>
                                <div class='form-group'>
                                    <label class='white' for='pass'>Password</label>
                                    <input type='password' class='form-control ' name='password' value='".$pass."' id='pass' placeholder='Enter your password'>
                                </div>
                                <div class='btn-toolbar justify-content-center'>
                                    <button type='reset' class='text-center btn btn-danger btn-md mr-1'>Reset</button>
                                    <button type='submit' name='sbt' class='text-center btn btn-primary btn-md ml-1'>Submit</button>
                                </div>
                                <div class='col-12 text-center mt-3'>
                                    <a href='./create-account.php'>No account? Sign up here.</a>
                                </div>
                            </form>
                        </div>
                    </div>");
        }

        return $res;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <title><?php echo((!$logged ? "Login": "Home"))?></title>
        <link rel="stylesheet" href="./css/styles.css" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body class="salmon-bkg">
        <?php include("./includes/navbar.php") ?>
        <main>
            <div class="container">
                <div class="row justify-content-center pt-3">
                    <div class="col-8 mt-3 pt-3">
                        <?php
                        echo getDisplay($userName, $pass, $msg, $logged, $userImg); ?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
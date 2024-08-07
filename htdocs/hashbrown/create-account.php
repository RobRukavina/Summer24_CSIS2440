<?php
    include_once("../hashbrown/includes/db.php");
    $userName = "";
    $pass = "";
    $passV = "";
    $ec = array();
    $msg = "";
    $sub = false;
    $valid = false;

    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_POST['sub'])){
        $_SESSION['sub'] = true;
        $_SESSION['LAST_ACTIVITY'] = time();

        if(!empty($_POST['userName'])) {
            $userName = $_POST["userName"];
            $_SESSION["userName"] = $userName;
        }
        
        if(!empty($_POST['password'])) {
            $pass = $_POST["password"];
            $_SESSION["password"] = $pass;
        }

        if(!empty($_POST['passwordV'])) {
            $passV = $_POST["passwordV"];
            $_SESSION["passwordV"] = $passV;
        }
        
        validate($userName, $pass, $passV);
        
        $_SESSION['LAST_ACTIVITY'] = time();

        if(sizeof($ec) == 0){  
            echo "Success!";
            signUp($userName,$pass);
            unset($_SESSION['userName']);
            unset($_SESSION['password']);
            unset($_SESSION['passwordV']);
        } else {
            // header("location: ".$_SERVER["PHP_SELF"]);
        }
    }

    function signUp($u, $p){
        global $msg;
        $conn = connectToDB();
            $salt = "3e4iovcn-qnooen";
            $salt2 = "onvwhnlahjfijop";
            $p = $salt.$p.$salt2;
            $p = hash("sha512", $p);
        
            $ins = 'INSERT INTO secureusers (username, pass, counter) VALUES ("'.$u.'", "'.$p.'", 0)';
        
            mysqli_query($conn, $ins);
            mysqli_close($conn);
            $msg = '<div class="col-12 text-center pt-2 pb-2 green bdr-25"><h2>You have successfully created an account</h2><a class="mb-3" href="/hashbrown">Sign in here</a></div>';
            
    }

    function handleError(){
        $e = $_SESSION['ec'];
        $m = "";
        if(in_array(0, $e)) {
            $m.= "<li class='denied p-1'>Username already exists</li>";
            session_unset();
            session_destroy();
        }
        if(in_array(1, $e)) {
            $m.= "<li class='denied p-1'>Enter a username</li>";
        }
        if(in_array(2, $e)) {
            $m.= "<li class='denied p-1'>Enter a password</li>";
        }
        if(in_array(3, $e)){
            $m.= "<li class='denied p-1'>Verify your password</li>";
        } 
        if(in_array(4, $e)){
            $m.= "<li class='denied p-1'>Enter a username, password, and verify your password</li>";
        } 
        if(in_array(5, $e)){
            $m.= "<li class='denied p-1'>Passwords do not match</li>";
        }
        return $m;
    }

    if(!empty($_SESSION)){
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 15) || str_ends_with($_SERVER['HTTP_REFERER'], "/hashbrown/")) {
            session_unset(); 
            session_destroy();
        }

        if(!empty($_SESSION['sub'])){
            $sub = $_SESSION['sub'];
        }
        

        if(!empty($_SESSION['ec']) && sizeof($_SESSION['ec']) > 0) {
            $ec[] = $_SESSION['ec'];
            $msg = handleError();
            if($msg != ""){
                $_SESSION['msg'] = $msg;
            }
        }
        if(isset($_SESSION['msg'])) $msg = $_SESSION['msg'];
        if(!empty($_SESSION['userName'])) $userName = $_SESSION['userName'];
        if(!empty($_SESSION['password'])) $pass = $_SESSION['password'];
        if(!empty($_SESSION['passwordV'])) $passV = $_SESSION['passwordV'];

        if(isset($_SESSION["LAST_ACTIVITY"]) && !isset($_SESSION['signedUp'])){
            session_unset();
            session_destroy();
        }
        $_SESSION['LAST_ACTIVITY'] = time(); 
    }

    function comparePass($user, $dbRes){
        $response = false;
        while($row = mysqli_fetch_array($dbRes, MYSQLI_ASSOC)){
            if($row['username'] == $user){
                return true;
            }
        }
        return $response;
    }

    function validate($userName, $pass, $passV)
    {
        global $ec;
        if ($userName == "") {
            array_push($ec, 1);
        } else {
            $con = connectToDB();
            $query = "SELECT * FROM secureusers;";
            $res = mysqli_query($con, $query);
            mysqli_close($con);
            if(comparePass($userName, $res)){
                array_push($ec, 0);
                unset($_SESSION['userName']);
            }
        }
        if ($pass == "") {
            array_push($ec, 2);
        }
        if ($passV == "") {
            array_push($ec, 3);
        }
        if ($userName == "" && $pass == "" && $passV == "") {
            array_push($ec, 4);
        }
        if ($pass != $passV) {
            array_push($ec, 5);
        }

        if (isset($ec) && sizeof($ec) > 0) {
            unset($_SESSION['ec']);
            $_SESSION['ec'] = $ec;
        } else {
            $_SESSION['signedUp'] = true;
        }
    }

    

    function getDisplay($sub, $userName, $pass, $passV, $msg){
        $result = "";
        if(!$sub || $msg == ""){
            $result .='
                <div class="card text-black my-5 bdr-25">
                    <div class="card-body ">
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-8 col-xl-6 order-2 order-lg-1">
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                                <form action="" method="post">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="userName" value="'.$userName.'" name="userName" class="form-control" />
                                            <label class="form-label" for="userName">Username</label>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="password" autocomplete="off" value="'.$pass.'" name="password" class="form-control" />
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div  class="form-outline flex-fill mb-0">
                                            <input type="password" id="passwordV" autocomplete="off" value="'.$passV.'" name="passwordV" class="form-control" />
                                            <label class="form-label" for="passwordV">Verify password</label>
                                        </div>
                                    </div>
                                    <div class="btn-toolbar justify-content-center">
                                        <button type="reset" class="text-center btn-danger btn-lg mr-1">Reset</button>
                                        <button type="submit" name="sub" class="text-center btn-primary btn-lg ml-1">Create Account</button>
                                    </div>
                                    <div class="row pt-3">
                                        <div class="col-12 text-center mt-2">
                                            <a class="" href="/hashbrown">Already a member? Sign in here.</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
        } else {
            $result .='
                <div class="card text-black my-5 bdr-25">
                    <div class="card-body ">
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-8 col-xl-6 order-2 order-lg-1">
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                                <ul class="list-unstyled">'.$msg.'</ul>
                                <form action="" method="post">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="userName" value="'.$userName.'"  name="userName" class="form-control" />
                                            <label class="form-label" for="userName">Username</label>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="password" autocomplete="off" value="'.$pass.'" name="password" class="form-control" />
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div  class="form-outline flex-fill mb-0">
                                            <input type="password" id="passwordV" autocomplete="off" value="'.$passV.'"  name="passwordV" class="form-control" />
                                            <label class="form-label" for="passwordV">Verify password</label>
                                        </div>
                                    </div>
                                    <div class="btn-toolbar justify-content-center">
                                        <button type="reset" class="text-center btn-danger btn-lg mr-1">Reset</button>
                                        <button type="submit" name="sub" class="text-center btn-primary btn-lg ml-1">Create Account</button>
                                    </div>
                                    <div class="row pt-3">
                                        <div class="col-12 text-center mt-2">
                                            <a class="" href="/hashbrown">Already a member? Sign in here.</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        return $result;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Account</title>
    <link rel="stylesheet" href="./css/styles.css" type="text/css">
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/script.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php include("../partials/navbar.php") ?>
    <main class="bkg-blue">
        <div class="container">
            <div class="row">
                <div class="col-8 m-auto">
                    <?php echo getDisplay($sub, $userName, $pass, $passV, $msg); ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
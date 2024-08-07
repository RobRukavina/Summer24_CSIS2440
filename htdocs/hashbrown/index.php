<?php 
    include_once("./includes/db.php");
    $userName = "";
    $pass = "";
    $errC = 0;
    $msg = "";
    $sbt = "";
    $valid = "";
    $sic = 0;
    $locked = false;
    $currLi = 0;
    

    if(!isset($_SESSION)){
        session_start();
    }
    
    if(!empty($_SESSION)){
        if(!empty($_SESSION['sbt'])){
            $sbt = $_SESSION['sbt'];
        }
        if(!empty($_SESSION['logins'])){
            $currLi = $_SESSION['logins'];
        }
        
        if(!empty($_SESSION['errC'])) {
            $errC = $_SESSION['errC'];
            handleError($errC);
            unset($_SESSION['errC']);
        }
        
        if(!empty($_SESSION['userName'])) $userName = $_SESSION['userName'];
        if(!empty($_SESSION['password'])){
            $pass = $_SESSION['password'];
        } 
        if(!empty($_SESSION['sic'])) $sic = $_SESSION['sic'];
        if(!empty($_SESSION['sic']) && $_SESSION['sic'] > 2){
            $locked = true;
        }
    }

    function comparePass($user, $password, $dbRes){
        $response = false;
        $salt = "3e4iovcn-qnooen";
        $salt2 = "onvwhnlahjfijop";
        $password = $salt.$password.$salt2;
        $password = hash("sha512", $password);
        while($row = mysqli_fetch_array($dbRes, MYSQLI_ASSOC)){
            if($row['username'] == $user && $row['pass'] == $password){
                $currUser = $row['username'];
                $_SESSION['logins'] = $row['counter'] + 1;
                return true;
            }
        }
           
        return $response;
    }
    
    if(isset($_POST['sbt'])){
        $_SESSION['sbt'] = true;
        $_SESSION['LAST_ACTIVITY'] = time();

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
            $errC = 2;
        } else if(!comparePass($userName, $pass, $res)){ 
            $errC = 2;
            $sic++;
            $_SESSION['sic'] = $sic;
        } else if($errC == 0){  
            $_SESSION['log'] = true;
            $msg = "";
            loginCounter($userName);
        }

        $_SESSION['errC'] = $errC;

        header("location: .");
    }

    function loginCounter($u){
        $conn = connectToDB();
        $sql = "UPDATE secureusers SET counter = (counter + 1) WHERE username = '$u'";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }

    function handleError(){
        global $msg;
        if(!empty($_SESSION['errC'])){
            $msg .= "<h1 class='denied'>Access Denied</h1>";
        }
    }

    function buildTable2(){
        $res = "";
        $fs2 = fopen("./includes/spies.txt", "r");
        $size2 = filesize("./includes/spies.txt");
        $fc2 = fread($fs2, $size2);
        $sr2 = explode("||>><<||", $fc2);
        
        for($i = 0; $i < sizeOf($sr2); $i++){
            $r = $sr2[$i];
            $res .= ($i % 2 == 0 ? "<tr class='col-12 yellow-bkg'>" : "<tr class='col-12 black-bkg'>"); 
            $codename = explode(",", $r);
            
            foreach($codename as $c){
                $res .= "<td class='col-6 p-3 text-center'>".$c."</td>";
            }
            
            $res .= "<tr>";
        }
        return $res;
    }

    function buildTable(){
        $res = "";
        $fs = fopen("./includes/fbi.txt", "r");
        $size = filesize("./includes/fbi.txt");
        $fc = fread($fs, $size);
        $sr = explode("||>><<||", $fc);
        
        for($i = 0; $i < sizeOf($sr); $i++){
            $r = $sr[$i];
            $res .= ($i % 2 == 0 ? "<tr class='col-12 yellow-bkg'>" : "<tr class='col-12 black-bkg'>"); 
            $codename = explode(",", $r);
            
            foreach($codename as $c){
                $res .= "<td class='col-6 p-3 text-center'>".$c."</td>";
            }
            
            $res .= "<tr>";
        }
        return $res;
    }

    function getDisplay($userName, $pass, $locked, $msg, $errC, $sbt, $currLi){
        $res = '';
        if($locked){
            $res = '
            <div class="card bdr-25">
                <div class="card-title mt-5 text-center">
                    <h1>Account Locked</h1>
                </div>
                <div class="card-body">
                    <p>
                        Your account has now been locked forever. There is no hope of ever getting it back
                        because we haven\'t written the code to allow you to do so. Have a nice day :)
                    </p>
                    <p class="secondary">Jeff, if you go to the create account page it will destroy the session and this lock will magically vanish.</p>
                </div>
            </div>';
        } else if(!$sbt || $errC != 0){
            $res .= ($msg != "" ? "<div class='card bdr-25'><div class='card-title m-0 text-center'>". $msg .="
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
                                <div class='row pt-3'>
                                    <div class='col-12 text-center mt-2'>
                                        <a href='./create-account.php'>Don't have an account? Create one here.</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>" 
                    : 
                    "<div class='card bdr-25'>
                        <div class='card-title text-center mt-3'><h1 class='bold white mt-3'>Login</h1>
                            <h2 class='sec-font-color'>Please enter your username and password.</h2>
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
                                <div class='row pt-3'>
                                    <div class='col-12 text-center mt-2'>
                                        <a href='./create-account.php'>Don't have an account? Create one here.</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>");
        } else {
            $res .='<div class="card">
                        <div class="card-title text-center"><h1 class="success m-3 fs-36">Access Granted!</h1></div>
                        <div class="card-subtitle"><h2 class="text-center fs-40">'.$userName.'</h2></div>
                        <p class="text-center fs-24">You have logged in '.$currLi.' times</p>
                        <div class="card-body">
                            <table class="full m-auto text-center">
                                <tbody id="t1" class="col-12">
                                <tr>
                                    <th>Agent</th>
                                    <th>CodeName</th>
                                </tr>
                                    '.buildTable().'
                                </tbody>
                                <tbody id="t2" hidden class="col-12">
                                <tr>
                                    <th>Agent</th>
                                    <th>CodeName</th>
                                </tr>
                                    '.buildTable2().'
                                </tbody>
                                <tfoot>
                                    <form action="" id="form2" method="post">
                                    <div class="form-check text-center">
                                            <input type="checkbox" class="form-check-input" onclick="changeFile()" name="spies" id="spies">
                                            <label class="h5" onclick="changeFile()" class="form-check-label" for="spies">Check for Spies instead of FBI</label>
                                        </div>
                                    </form>
                                </tfoot>
                            </table>
                            <div class="row">
                                <div class="col-12 text-center mt-3">
                                    <a class="card-link btn btn-primary btn-lg" href=".">Home</a>
                                    <a class="card-link btn btn-danger btn-lg" href="logout.php">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
        return $res;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Hashbrown</title>
        <link rel="stylesheet" href="./css/styles.css" type="text/css">
        <script src="./js/jquery-3.7.1.min.js"></script>
        <script src="./js/script.js" defer></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <?php include("../partials/navbar.php") ?>
        <main <?php echo ($locked ? "class='bkg-red bkg-fire'" : (isset($_SESSION['log']) ? "class='fbi'" : "class='green-bkg'"))?>>
            <div class="container">
                <div class="row justify-content-center pt-3">
                    <div class="col-8 mt-3 pt-3">
                        <?php
                        // echo var_dump($_SESSION);
                        echo getDisplay($userName, $pass, $locked, $msg, $errC, $sbt, $currLi); ?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
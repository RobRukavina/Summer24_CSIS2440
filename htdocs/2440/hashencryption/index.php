<?php
    if(isset($_POST['sub-btn'])){
        $u = (isset($_POST['userName']) ? $_POST['userName']: false );
        $p = (isset($_POST['password']) ? $_POST['password']: false );
        $conn = mysqli_connect('localhost', 'root', '1550', 'palindromes');
        // salt and hash
        $salt = "3e4iovcn-qnooen";
        $salt2 = "onvwhnlahjfijop";
        $p = $salt.$p.$salt2;
        $p = hash("sha512", $p);

        $ins = 'INSERT INTO secureusers (username, password, counter) VALUES ("'.$u.'", "'.$p.'", count = count + 1)';

        mysqli_query($conn, $ins);
        mysqli_close($conn);

    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Hash</title>
        <link rel="stylesheet" href="./css/styles.css" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <?php include("../../partials/navbar.php") ?>
        <main class="">
            <div class="container">
                <div class="row">
                    <div class="col-8 m-auto vertical-center">
                        <div class="card">
                            <form method="post">
                                <input type="text" name="userName" placeholder="username">
                                <input type="text" name="password" placeholder="password">
                                <input type="submit" name="sub-btn" value="Add User">
                            </form>
                        </div>
                        <!-- <?php
                            //echo getDisplay($userName, $pass, $valid, $msg, $ec, $sbt); ?> -->
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
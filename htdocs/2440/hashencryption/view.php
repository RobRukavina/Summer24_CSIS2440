<?php
    if(isset($_POST['sub-btn'])){
        $u = (isset($_POST['userName']) ? $_POST['userName']: false );
        $p = (isset($_POST['password']) ? $_POST['password']: false );
        $conn = mysqli_connect('localhost', 'root', '1550', 'palindromes');
        
        // this turns html entities into plain text from user inputs
        $u = htmlentities($u);
        $p = htmlentities($p);

        // this is how you stop sql injection in php/mysql;
        // this is a mild form. dig more on this.
        $u = mysqli_real_escape_string($conn, $u);
        $p = mysqli_real_escape_string($conn, $p);
        
        
        //// this part goes in includes file as a function
        // salt and hash
        function hashFunc($pass, $user){
            $su1 = "fjdkl?s34oqpnv  s356!pnw!n";
            $su2 = "kljkwnon!!v niwnd?pifds2435ojbfphuiphpi";
            $user = $su1.$user.$su2;
            $userDouble = $su1.$user.$user.$su2;

            $salt = hash('sha512', $user);
            $salt2 = hash('sha512', $userDouble);

            $word = $salt.$pass.$salt2;
            $hashed = hash("sha512", $word);
            
            return $hashed;
        }
        //// 

        $p = hashFunc($p, $u);

        $sql = 'SELECT * FROM users WHERE username="'.$u.'" AND password="'.$p.'";';

        $results = mysqli_query($conn, $sql);
       
        if(mysqli_num_rows($results)) {
            echo 'This user exists'; 
        } else {
            echo 'user does not exist';
        }
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
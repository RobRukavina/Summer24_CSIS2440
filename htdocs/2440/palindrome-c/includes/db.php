<?php 
    // make constants
    if($_SERVER['HTTP_HOST'] == "localhost"){
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '1550');
        define('DB', 'palindromes');
    } else {
        define('HOST', 'sql309.infinityfree.com');
        define('USER', 'if0_36555305');
        define('PASS', 'MgMvXm8eq99r');
        define('DB', 'if0_36555305_palindromes');
    }
    
    echo $_SERVER['HTTP_HOST'].'<br><br>';
    // connect
    $conn = mysqli_connect(HOST, USER, PASS, DB);

?>
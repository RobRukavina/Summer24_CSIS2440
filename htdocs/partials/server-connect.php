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
    
    
    // connect
    $conn = mysqli_connect(HOST, USER, PASS, DB);
    //echo "<pre>".var_dump($conn)."</pre><br>";
    
    // write a query
    $sql = 'SELECT  * FROM palindrome;';

?>
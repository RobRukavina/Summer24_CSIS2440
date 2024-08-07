<?php 
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
    
    $conn = mysqli_connect(HOST, USER, PASS, DB);
    
    $sql = 'SELECT  * FROM palindrome;';
    
    $results = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
        echo $row['phrase'].'<br>';
    }

    mysqli_close($conn);
?>
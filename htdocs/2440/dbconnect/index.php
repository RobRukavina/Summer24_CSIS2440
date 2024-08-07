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
    
    // run query
    $results = mysqli_query($conn, $sql);
    //echo "<br><br><pre>".var_dump($results)."</pre><br>";

    // loop through data (on GET)
    
    while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
        echo $row['phrase'].'<br>';
    }


    function cleanWord($p){
        //stuff
        return $p;
    }

    function getPalDB(){
        $results = ""; // would be results from get call to db;
        return $results;
    };

    // duplicate check
    function isDuplicate($p){
        $con = connectToDB();
        $sql = 'SELECT * FROM palindrome;';
        
        $results = mysqli_query($con, $sql);
        
        while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
            if(cleanWord($row['phrase']) == cleanWord($p)){
                return $row['id'];
            }
        }

        mysqli_close($con);
    }


    // the following is in the addToDB($p);{
        $p; // is passed in as parameter;
        $con = connectToDB();
        $phrases = getPalDB();
        $duplicate = isDuplicate($p);
        
        
        !$duplicate ? $sql = 'INSERT INTO palindrome (phrase, counter) VALUES("'.$p.',1");' 
        : 'UPDATE palindrome SET counter = (counter + 1) where id = '.$duplicate;

        mysqli_query($con, $sql);
        mysqli_close($con, $sql);
    // }
?>
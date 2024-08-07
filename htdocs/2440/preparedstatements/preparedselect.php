<?php 
    if($_SERVER['HTTP_HOST'] == "localhost"){
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '1550');
        define('DB', 'users');
    } else {
        define('HOST', 'sql309.infinityfree.com');
        define('USER', 'if0_36555305');
        define('PASS', 'MgMvXm8eq99r');
        define('DB', 'if0_36555305_users');
    }
    
    function connectToDB (){
        $con = new mysqli (HOST, USER, PASS, DB);
    
        return $con;
    }
    $userInput = "bob";
    $pass = "something";
    $conn = connectToDB();
    $sql = "SELECT * from users WHERE user = ? AND password = ?;";
    
    if(mysqli_connect_error()){
        die();
    };
    
    $statement = $conn->prepare($sql);
    // The two s's in the first param are really separate. one s says userInput is a string. 
    // The second says pass is a string
    // if we had more fields, we would put their datatype in that param in order
    $statement->bind_param("ss", $userInput, $pass);
    $statement->execute();
    $results = $statement->get_result();
    
    while($row = $results->fetch_assoc()){
        echo $row['userName'];
    }
    // super important to close statement and connectioned
    $statement->close();
    $conn->close();
?>
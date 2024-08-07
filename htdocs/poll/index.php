<?php
if($_SERVER['HTTP_HOST'] == "localhost"){
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '1550');
    define('DB', 'poll');
} else {
    define('HOST', 'sql309.infinityfree.com');
    define('USER', 'if0_36555305');
    define('PASS', 'MgMvXm8eq99r');
    define('DB', 'if0_36555305_poll');
}

function connectToDB (){
    $con = mysqli_connect(HOST, USER, PASS, DB);

    return $con;
}

if(!isset($_SESSION)){
    session_start();
}

if(isset($_POST['sbt']) && !empty($_POST['answer'])){
    $id = $_POST['answer'];
    $conn = connectToDB();

    $query = "UPDATE answers SET counter = counter + 1 WHERE id = $id;";

    $success = mysqli_query($conn, $query);
    $_SESSION['success'] = $success;
    
    mysqli_close($conn);
}

function getDisplay()
{
    $render = "";
    if(!isset($_SESSION['success'])){
        $render.='
            <div class="card-title text-center">
                <h1>Do you like milk?</h1>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer" id="a1" value="1">
                        <label class="form-check-label" for="a1">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer" id="a2" value="2">
                        <label class="form-check-label" for="a2">
                            No
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer" id="a3" value="3">
                        <label class="form-check-label" for="a3">
                            I don\'t know
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer" id="a4" value="4">
                        <label class="form-check-label" for="a4">
                            How could you even ask me that?
                        </label>
                    </div>
                    <div class="btn-toolbar justify-content-center">
                        <button type="reset" class="text-center btn btn-danger btn-md mr-1">Reset</button>
                        <button type="submit" name="sbt" class="text-center btn btn-primary btn-md ml-1">Submit</button>
                    </div>
                </form>
            </div>';
    } else {
        $conn = connectToDB();
        $td = "";
        $th = "";
        $bg = "";
        $chart = "";
        $checkSize = 25;
        $multiplier = 10;

            $query = "SELECT * FROM answers ORDER BY counter DESC;";
            $results = mysqli_query($conn, $query);

            $aRes = mysqli_fetch_all($results);

            for($i = 0; $i < sizeof($aRes); $i++){
                $temp = $aRes[$i];
                if($temp[2] > 25 && $checkSize < $temp[2]){
                    $checkSize = $temp[2];
                };
            }
            
            if($checkSize > 100 && $checkSize < 150){
                $multiplier = 2;
            }
            if($checkSize >= 150){
                $multiplier = .50;
            }

            for($i = 0; $i < sizeof($aRes); $i++){
                $result = $aRes[$i];
                switch($result[0]){
                    case 1:
                        $bg = "background-color: green;";
                        break;
                    case 2:
                        $bg = "background-color: orange;";
                        break;
                    case 3:
                        $bg = "background-color: blue;";
                        break;
                    case 4:
                        $bg = "background-color: red;";
                        break;
                }
                $th.='<th scope="col">'.$result[1].'</th>';
                $td.='<td>'.$result[2].'</td>';
                $chart.='<td class="" style="align-content: flex-end;"><div style="min-height: '.($result[2] * $multiplier).'px; '.$bg.'"></div></td>';
            }

            $render.='
                <div class="card-title text-center">
                    <h1>Thank You for taking our survey!</h1>
                    <p>Check out the results below.</p>
                </div>

                <div class="card-body">
                    <table class="table" onload="onSuccess()">
                        <tbody class="text-center">
                            <tr>
                            '.$th.'
                            </tr>
                            <tr>
                            '.$td.'
                            </tr>
                            <tr>
                            '.$chart.'
                            </tr>
                        </tbody>
                    </table>
                </div>
            ';
        mysqli_close($conn);
        session_destroy();
    }
    return $render;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Poll</title>
        <link rel="stylesheet" href="./css/styles.css" type="text/css">
        <script src="https://cdn.jsdelivr.net/npm/js-confetti@latest/dist/js-confetti.browser.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body <?php echo (!empty($_SESSION['success']) && $_SESSION['success'] ? 'onload="onSuccess()"' : "")?>>
        <?php include("../partials/navbar.php") ?>
        <main class="milk">
            <div class="container">
                <div class="row">
                    <div class="col-8 m-auto relative">
                        <div class="card vertical-center">
                            <?php echo getDisplay(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>

<script>
    const jsConfetti = new JSConfetti()
    function onSuccess() {
        jsConfetti.addConfetti({
            confettiRadius: 6,
            confettiNumber: 500,
        });
    }
</script>
<?php
include_once("../hashbrown/includes/db.php");

function buildTable(){
    $r = "";
    $con = connectToDB();
    $query = "SELECT * FROM secureusers ORDER BY counter DESC;";
    $dbRes = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($dbRes, MYSQLI_ASSOC)){
        $r.='<tr><td>'.$row['id'].'<td>'.$row['username'].'</td><td>'.$row['pass'].'</td><td>'.$row['counter'].'</td></tr>';
    }
    mysqli_close($con);
    return $r;
}

function getDisplay(){
    $res = '
        <div class="card bdr-25">
            <div class="card-title text-center mt-5"><h1>Users</h1></div>
            <div class="card-body">
                <table class="table full m-auto text-center">
                    <tbody id="t1" class="col-12">
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Number of Logins</th>
                    </tr>
                        '.buildTable().'
                    </tbody>
                </table>
            </div>
        </div>';
    return $res;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users</title>
    <link rel="stylesheet" href="./css/styles.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php include("../partials/navbar.php") ?>
    <main class="bkg-other-blue">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-10 mt-5">
                    <?php echo getDisplay(); ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
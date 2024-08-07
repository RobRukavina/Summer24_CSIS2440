<?php 
    include_once("./includes/db.php");
    session_start();
    $userName = $_SESSION['userName'];

    $con = connectToDB();
    $query = "SELECT imageUrl FROM users WHERE userName = '$userName';";
    $result = mysqli_query($con, $query);
   while($row = mysqli_fetch_array($result)){
    $res = $row['imageUrl'];
   }
   mysqli_close($con);
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo "$userName's "?>Account</title>
        <link rel="stylesheet" href="./css/styles.css" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body class="green">
    <?php include("../partials/navbar.php") ?>
        <div class="container">
            <div class="row text-center">
                <div class="col-12 mt-5">
                    <h1 class="bold">Welcome <?php echo $userName ?></h1>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-6 m-auto">
                    <div class="img-container m-auto ">
                        <img class="d-flex m-auto profile-img" src=<?php echo $res ?> alt="profile img">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ullamcorper eget nulla facilisi etiam dignissim diam quis enim lobortis. Eget nunc lobortis mattis aliquam faucibus purus. Et leo duis ut diam quam nulla porttitor massa id. Pretium fusce id velit ut tortor pretium viverra suspendisse potenti. Amet commodo nulla facilisi nullam vehicula ipsum a arcu cursus. Vitae et leo duis ut diam quam nulla. Cursus eget nunc scelerisque viverra mauris in aliquam. Nibh mauris cursus mattis molestie a iaculis at. Faucibus turpis in eu mi bibendum neque egestas.</p>
                </div>
            </div>
        </div>
    </body>
</html>
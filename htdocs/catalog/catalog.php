<?php 
    include_once("./includes/db.php");
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_POST['product'])){
        header("location: /catalog/product.php?product=".$_POST['product']);
    }


function getDisplay(){
    $dis = "";
    $con = connectToDB();
    $sql = "SELECT * FROM products;";
    $res = mysqli_query($con, $sql);
    while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
        $dis.='
        <div class="col-md-4 col-12 mb-3 mt-3">
            <div class="card shadow resize bdr-25">
                <img class="card-img-top img-resize top-bdr-25" src="'.$row['image'].'">
                <div class="card-body">
                    <h2 class="text-center">'.$row['name'].'</h2>
                    <div class="text-left">
                        <p>'.str_split($row['description'], 83)[0].'...</p>
                    </div>
                    
                </div>
                <div class="footer">
                    <div class="text-center"><h3>$'.$row['price'].'</h3></div>
                    <form action="" method="post">
                        <div class="btn-group d-flex">
                            <button class="btn btn-primary bdr-25 mb-2 mr-2 ml-2" name="product" value="'.$row['id'].'" type="submit">View Product Details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        ';
    }
    mysqli_close($con);
    return $dis;
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Products</title>
        <link rel="stylesheet" href="./css/styles.css" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body class="salmon-bkg">
        <?php include("./includes/navbar.php") ?>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-12 bkg-grey top-bdr-25">
                        <h1 class="text-center pt-3 mt-3">Rob's Catalog</h1>
                        <h2 class="text-center pb-3">Of Crazy & Amazing Deals</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 btm-25 bkg-grey">
                        <div class="row justify-content-center mr-3 ml-3">
                            <?php  echo getDisplay() ?>
                        </div>  
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
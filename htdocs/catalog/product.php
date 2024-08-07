<?php 
    include_once("./includes/db.php");

    if(!isset($_SESSION)){
        session_start();
    }
    $prodId;
    $msg = "";
    $cart = array();
    $qty = 0;

    if(isset($_GET['product'])){
        $prodId = $_GET['product'];
    } else {
        header("location: ./catalog/products.php");
    }

    if(isset($_POST['addToCart'])){
        if(!isset($_SESSION['log'])){
            $msg .="<h2 class='bkg-white bdr-25 pt-2 pb-2 text-center'>Please log in <a href='.'>here</a> to view your cart</h2>";
        }
        if(isset($_POST['prodId'])){
            $prodId = (int)$_POST['prodId'];
        }
        if(isset($_POST['qty'])){
            $qty = (int)$_POST['qty'];
        }
        
        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
            $temp = $_SESSION['cart'];
            $found = false;

            for($i = 0; $i < sizeof($temp); $i++) {
                $product = $temp[$i];
                if (isset($product['prodId']) && $product['prodId'] === $prodId) {
                    $temp[$i]['qty'] = (int)$product['qty'] + $qty;
                    $found = true;
                    break;
                } 
            }

            if(!$found){
                array_push($temp, array("prodId"=>$prodId, "qty"=>$qty));
            }

            $_SESSION['cart'] = $temp;
        
        } else if(!isset($_SESSION['cart'])) {
                array_push($cart, ["prodId"=>$prodId, "qty"=>$qty]);
                $_SESSION['cart'] = $cart;
        }
    }


    function getDisplay($prodId){
        $dis = "";
        $con = connectToDB();
        $sql = "SELECT id, name, description, image, price FROM products WHERE id =".$prodId.";";
        $res = mysqli_query($con, $sql);
        
        while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
            $dis.='
            <div class="col-12 mt-3">
                <div class="card shadow bdr-25">
                    <img class="card-img-top prod-img-resize top-bdr-25" src="'.$row['image'].'">
                    <div class="card-body">
                        <h2 class="text-center">'.$row['name'].'</h2>
                        <div class="text-left">
                            <p>'.$row['description'].'</p>
                        </div>
                    </div>
                    <div class="footer">
                        <div class="text-center"><h3>$'.$row['price'].'</h3></div>
                        <form class="text-center" action="" method="post">
                            <label for="qty">Select a quantity: </label>
                            <input class="shrink-input mr-3" id="qty" placeholder="0" name="qty" min="0" autocomplete="off"  type="number" /><span id="qValid"></span>
                            <input hidden name="prodId" value="'.$row['id'].'" />
                            <div class="btn-group d-flex justify-content-center mb-2 mt-2">
                                <a class="btn btn-secondary m-w-25 mb-2" href="./catalog.php">Shop More</a>
                                <button class="btn btn-primary m-w-25 mb-2" disabled name="addToCart" id="addToCart" type="submit">Add To Cart</button>
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
        <title>Product</title>
        <link rel="stylesheet" href="./css/styles.css" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body class="salmon-bkg">
        <?php include("./includes/navbar.php") ?>
        <main>
            <div class="container">
                <div class="row justify-content-center pt-3">
                    <div class="col-8 mt-3 pt-3">
                        <?php 
                            echo $msg != "" ? $msg : "";
                            echo getDisplay($prodId) 
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </body>
    <script src="./js/script.js"></script>
</html>
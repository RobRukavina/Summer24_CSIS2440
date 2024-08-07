<?php 
    include_once("./includes/db.php");
    if(!isset($_SESSION)){
        session_start();
    }
    
    $cart;
    $userName;
    $prodToUpdate;
    $total = 0;
    $qtyToUpdate = false;
    $products = array();
    $ordered = false;

    if(isset($_POST['order'])){
        $ordered = true;
    }

    if(isset($_SESSION['userName'])){
        $userName = $_SESSION['userName'];
    }

    if(isset($_SESSION['qtyUpdate'])){
        $qtyToUpdate = $_SESSION['qtyUpdate'];
    }

    if(isset($_SESSION['cart']) && isset($_POST['update']) && isset($_POST['qty'])){
        if(!empty($_POST['prodId'])) {
            $prodToUpdate = $_POST['prodId'];
        }

        if(!empty($_POST['qty'])) {
            $qtyToUpdate = $_POST['qty'];
        }
        
        if($prodToUpdate > 0){
            $temp = $_SESSION['cart'];
            $iToRemove;
            for($i = 0; $i < sizeof($temp); $i++) {
                $product = $temp[$i];
                if (isset($product['prodId']) && $product['prodId'] == $prodToUpdate) {
                    if((int)$qtyToUpdate == 0){
                        $iToRemove = $i;
                        break;
                    }
                    else {
                        $temp[$i]['qty'] = (int)$qtyToUpdate;
                        break;
                    }
                } 
            }    
            if(isset($iToRemove)) {
                unset($temp[$iToRemove]);
            }
            $_SESSION['cart'] = $temp;
        }
    }

    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
        foreach($cart as $item){
            $con = connectToDB();
            $sql = "SELECT id, name, image, price FROM products WHERE id =".$item['prodId'].";";
            $res = mysqli_query($con, $sql);
            while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                $total = $total + ($row['price'] * $item['qty']);
                array_push($products, ["id"=>$row['id'], "name"=>$row['name'], "image"=>$row['image'], "price"=>$row['price'], "qty"=>$item['qty']]);
            }
        }
    }

    function getPurchase($products){
        $res = "";
        if(sizeof($products) > 0){
            for($i = 0; $i < sizeof($products); $i++){
                $res.='<li class="list-unstyled">'.($i + 1).'. '.$products[$i]['name'].'</li>';
            }
        }
        unset($_SESSION['cart']);
        return $res;
    }

    function buildTable($products){
        $res = "";
        
        for($i = 0; $i < sizeOf($products); $i++){
            $res .= "<tr class='col-12'>"; 

            $res .= "
                <td class='col-1 text-center'>".($i + 1)."</td>
                <td class='col-1 text-center p-3'><img src='".$products[$i]['image']."' class='bdr-10 cart-img d-flex m-auto img-fluid'/></td>
                <td class='col-2 text-center'>".$products[$i]['name']."</td>
                <td class='col-3 text-center'>
                    <form class='text-center' method='post'>
                        <div class='input-group justify-content-center'>
                            <input hidden name='prodId' value='".$products[$i]["id"]."' />
                            <input class='shrink-input' id='qty' name='qty'  min='0' type='number' autocomplete='off' value=".$products[$i]['qty']." />
                            <div class='input-group-append'>
                                <button class='btn btn-sm btn-primary' name='update' id='addToCart' type='submit'>Update</button>
                            </div>
                        </div>
                    </form>
                </td>
                <td class='col-2 text-center'>".$products[$i]['price']."</td>
                <td class='col-3 text-center'>".($products[$i]['qty'] * $products[$i]['price'])."</td>
            ";
            
            $res .= "<tr>";
        }
        return $res;
    }

    function getDisplay($userName, $products, $total, $ordered){
        $res = '';
        if($ordered){
            $res.='
            <div class="card bdr-25 bkg-grey">
                <div class="card-title">
                    <h1 class="text-center mt-3 fs-40">'.ucfirst($userName).',</h1>
                    <h3 class="text-center">Thank you for your order!</h3>
                    
                </div>
                <div class="card-body">
                    <h2 class="text-center">
                        Your items:
                        <ul class="list-unstyled text-center h3">'.getPurchase($products).'</ul> 
                    </h2>
                    <h3 class="text-center mt-3">Will be delivered as soon as possible!</h3>
                    <p class="text-center mt-3">We greatly appreciate your business. If you forgot something, you can go back
                        to our <a class="bold" href="./catalog.php">catalog</a> at any time.
                     </p>   
                </div>
            </div>
            ';
        }
        else if(sizeof($products) < 1){
            $res.= '<div class="card bdr-25 bkg-grey">
                        <div class="card-title">
                            <h1 class="text-center mt-3 fs-40">'.ucfirst($userName).'</h1>
                            <h3 class="text-center">Your cart is currently empty.</h3>
                            <p class="text-center">Check out our <a class="bold" href="./catalog.php">catalog</a> to add items to your cart.</p>   
                        </div>
                    </div>';
        } else {
            $res .='
                <div class="card bdr-25 bkg-grey">
                    <div class="card-title">
                        <h1 class="text-center fs-40 pt-3 mt-3">'.ucfirst($userName).'\'s Cart</h1>
                    </div>
                    <div class="card-body">
                        <table class="full m-auto text-center">
                            <tbody id="t1" class="col-12">
                            <tr>
                                <th></th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                                '.buildTable($products).'
                                </tbody>
                                </table>
                            <div class="row">
                                <div class="col"></div>
                                <div class="col">
                                    <div class="col-12"><h2 class="text-right">Total: '.$total.'</h2></div>
                                    <div class="col-12 text-right"><form method="post"><button class="btn btn-primary" type="submit" name="order">Place Order</button></form>
                                </div>
                            </div>
                    </div>
                </div>';
        }
        return $res;
    }



?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <title>Cart</title>
        <link rel="stylesheet" href="./css/styles.css" type="text/css">
        <script src="./js/script.js" ></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body class="salmon-bkg">
        <?php include("./includes/navbar.php") ?>
        <main>
            <div class="container">
                <div class="row justify-content-center pt-3">
                    <div class="col-12 mt-3 pt-3">
                        <?php
                        echo getDisplay($userName, $products, $total, $ordered); ?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
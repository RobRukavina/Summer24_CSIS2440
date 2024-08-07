<?php 
    include_once 'includes/importantstuff.php';
   
    if(!empty($_POST['search-term']) && !empty($_POST['pal-count'])){
        $searchTerm = $_POST['search-term'];
        $palCount = $_POST['pal-count'];

        if(preg_match('/\d+/', $_POST['search-term'])){
           $ew = $searchTerm;
           $en = $palCount;
           $erc = 4;
        }
        
    } else {
        if(!empty($_POST['pal-count'])){
            $en = $_POST['pal-count'];
        } else {
            $erc += 1;
        }
        if(!empty($_POST['search-term'])){
            $ew = $_POST['search-term'];
        }
        else {
            $erc += 2;
        }
    }
    
    if($ec > 0) {
        header('location: .?word='.$ew.'&num='.$en.'&ec='.$erc);
    }

    if(!isset($_POST['palindromes'])){
        $display.='<div class="row mb-2">';
        $display.= '<div class="col-6 m-auto">';
        $display.= '<form class="" method="post">';
        $display.= '<input type="hidden" name="search-term" value="'.$searchTerm.'">';
        $display.= '<input type="hidden" name="pal-count" value="'.$palCount.'">';
        for($i=0; $i < $palCount; $i++){
            $num = $i+1;
            $display.= "<input class='m-auto d-flex' placeholder='pal-$num' name='palindromes[]'><br>";
        }
        $display.= '<input class="btn btn-primary m-auto d-flex" type="submit">';
        $display.= '</form>';
        $display.= '</div>';
        $display.= '</div>';
    } else {
        $display.= '<div class="row">';
        $inputs = $_POST['palindromes'];
        $display.= output($inputs, $searchTerm);
        $display.= wordCountOutput($wordCounter, $searchTerm);
        $display.= '</div>';
    } 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Palindrome Stuff</title>
        <link rel="stylesheet" href="/2440/palindrome-b/css/style.css" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <?php include("../../partials/navbar.php"); ?>
        <main>
            <div class="container">
                <?php
                    echo $display;
                ?>
            </div>
        </main>
    </body>
</html>

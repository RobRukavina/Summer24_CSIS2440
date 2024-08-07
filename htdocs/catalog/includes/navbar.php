<?php 
$links = array();
$dir = scandir("../catalog");
$curPage = $_SERVER["PHP_SELF"];
$loggedIn = false;

if(isset($_SESSION['userName']) && isset($_SESSION['log']) && $_SESSION['log'] == true){
    $loggedIn = true;
}

for($i = 0; $i < sizeof($dir); $i++){
    $cur = $dir[$i];
    if(substr($cur, -4) === ".php"){
        $links[] = $cur;
    }    
}

function getLinks($links, $curPage, $loggedIn){
    $l = "";
    $t1 = "";

    foreach($links as $link){
        $lName = str_replace(substr($link, - 4), "", $link);
        if($lName == "index" && !$loggedIn){
            $lName = "login";
        } else if($lName == "index"){
            $lName = "home";
        }
        if($lName == "catalog"){
            $lName = "products";
        }

        if(str_contains($lName, "-")){
            $lName = str_replace("-", " ", $lName);
        }
            $lName = ucwords($lName);

        if($lName == "Product"){
            // do nothing
        } else if(str_contains($lName, "Create Account")){
            if(!$loggedIn){
                str_ends_with($curPage, $link) ? $l .= '<li class="nav-item active"><a class="nav-link" href="./'.$link.'">'.$lName.'</a></li>
                ' : $l.='<li class="nav-item"><a class="nav-link" href="./'.$link.'">'.$lName.'</a></li>';    
            }
            // do nothing
        } else if($lName == "Logout" && !$loggedIn){
            // do nothing
        } else if($lName == "Cart"){
            if($loggedIn){
                str_ends_with($curPage, $link) ? $t1 .= '
                <li class="nav-item active"><a class="nav-link" href="./'.$link.'">'.$lName.'</a></li>
            ' : $t1.='<li class="nav-item"><a class="nav-link" href="./'.$link.'">'.$lName.'</a></li>';
            } 
        } else if($lName == "Products"){
            str_ends_with($curPage, $link) ? $l .= '
                <li class="nav-item active"><a class="nav-link" href="./'.$link.'">'.$lName.'</a></li>
            ' : $l.='<li class="nav-item"><a class="nav-link" href="./'.$link.'">'.$lName.'</a></li>';
                $l.= $t1;
        } else {
            str_ends_with($curPage, $link) ? $l .= '<li class="nav-item active"><a class="nav-link" href="./'.$link.'">'.$lName.'</a></li>
            ' : $l.='<li class="nav-item"><a class="nav-link" href="./'.$link.'">'.$lName.'</a></li>';   
        }
    }
    
    if ($loggedIn){
        $fill = ($curPage == "/catalog/index.php" ? " active" : "");
        $string = '<li class="nav-item'.$fill.'"><a class="nav-link" href="./index.php">Home</a></li>';
        $l = str_replace($string, "", $l);
        $l = $string.$l;
    }
    return $l;
}

?>

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php echo getLinks($links, $curPage, $loggedIn) ?>
        </ul>
    </div>
</nav>
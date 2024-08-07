<?php
$ec = 0;
    if(!empty($_POST['c']) && !empty($_POST['s']) && !empty($_POST['ph'])){
        if(!preg_match("/\w+/", $_POST['c'])){
            $ec += 1;
        }
        if(!preg_match("/\w+/", $_POST['s'])){
            $ec += 2;
        }
        if(!preg_match("/\w+/", $_POST['ph'])){
            $ec += 4;
        }
        if($ec) {
            header('location: .?ec='.$ec.'&s='.$_POST['s'].'&c='.$_POST['c'].'&ph='.$_POST['ph']);
        }
    } else {
        // missing a field code
        // switch($ec){
        //     case 
        // }
        header('location: .?sub=true&ec=0&s='.$_POST['s'].'&c='.$_POST['c'].'&ph='.$_POST['ph']);
    }
?>
<?php

    // you can assign values to specific indexes with arrow functions as seen below.
    // now the array $metallica is now an associative array instead of an indexed array.
    // $metallica = array(1=>"lars", 2=>"kirk", 3=>"james", 4=>"robert");

    // doing the following shows that these do not have to be numbers. they can be words but now for loops don't work.
    // with the following you can only use foreach loops:
    $metallica = array("drums"=>"lars", "guitar"=>"kirk", "vocal"=>"james", "bass"=>"robert");

    foreach($metallica as $role => $member){
        echo "member: $member. role: $role.<br>";
    }

    //echo $metallica[0];

?>
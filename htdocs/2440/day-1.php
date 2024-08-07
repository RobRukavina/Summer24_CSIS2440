<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Day 1</title>
    </head>
    <body>
        <?php
            $day = "Monday";
                echo"<h1>Happy Birthday!</h1>";
                if($day == "Monday"){
                    echo "<p>Bummer. It's Monday</p>";
                }
                echo "<p>Today is $day" . "</p>"; // ******** this only works in double quotes!!!
                echo "<p>Today is " . $day . "</p>"; // this works with single or double quotes
                // sayStuff();
        ?>

        <!-- <div>
            <ul>
                < ?php
                    for($x = 1; $x<=4; $x++){
                        echo "<li>List Item #$x</li>";
                    }
                ?>
            </ul>
        </div> -->
    </body>
</html>
<!-- < ?php
    function sayStuff(){
        echo "stuff";
    }
?> -->
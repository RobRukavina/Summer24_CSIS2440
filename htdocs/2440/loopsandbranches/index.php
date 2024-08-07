<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Loops and Branches</title>
    </head>
    <body>
        <?php
        echo "<p>What is Jeff's favorite band?</p>";

        // some day users will be able to input here
        $userInput = "Maiden";

        switch($userInput){
            case "Metalica": $output = "Good job!"; break;
            case "Megadeth": $output = "So Close. They're #2"; break;
            case "Maiden": $output = "So Close. They're also #2"; break;
            default: $output = "Nope!";
        };

        echo $output;


        for($i = 0; $i < 9; $i++){
            echo "<p>something</p>";
        }

        $i = 0;
        while($i < 9){
            // increment's i first and then echo's value
            // results in 1-9 instead of 0-8
            echo ++$i."<br>";
        }

        $i = 0;
        while($i < 9){
            // echo's i's value and then increments
            // results in 0-8 instead of 1-9
            echo $i++."<br>";
        }



        // do{
        //     echo"enter your user name";
        // } while ($username != "beavis");
        ?>
        <ul>
            <?php
                for($i = 0; $i < 50; $i++){
                    echo "<li>This is bullet #$i</li>";
                }
            ?>
        </ul>
    </body>
</html>
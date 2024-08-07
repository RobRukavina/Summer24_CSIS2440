<?php
    $c = $ph = $s = $msg = "";
    $ec = 0;
    
    if(isset($_GET['sub']) && $_GET['sub'] == 'true'){
        $eMsg[] = "<p>Fill everything out</p>";
        $eMsg[] = "<p> Wrong format for City</p>";
        $eMsg[] = "<p> Wrong format for State</p>";
        $eMsg[4] = "<p> Wrong format for Phone</p>";
        
        if(isset($_GET['c'])) $c = $_GET['c'];
        if(isset($_GET['s'])) $s = $_GET['s'];
        if(isset($_GET['ph'])) $ph = $_GET['ph'];
        if(isset($_GET['ec'])) $ec = $_GET['ec'];
        
        switch($ec){
            case 7: $msg = $eMsg[1].$eMsg[2].$eMsg[4]; break;
            case 6: $msg = $eMsg[2].$eMsg[4]; break;
            case 5: $msg = $eMsg[1].$eMsg[4]; break;
            case 4: $msg = $eMsg[4]; break;
            case 3: $msg = $eMsg[2].$eMsg[1]; break;
            case 2: $msg = $eMsg[2]; break;
            case 1: $msg = $eMsg[1]; break;
            case 0: $msg = $eMsg[0]; break;
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Form</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12 m-auto d-flex">
                    <form class="m-auto" action="process.php" method="post">
                        <input placeholder="City" name="c" value="<?php echo $c ?>"><br><br>
                        <input placeholder="State" name="s" value="<?php echo $s ?>"><br><br>
                        <input placeholder="Phone" name="ph" value="<?php echo $ph ?>"><br><br>
                        <input type="reset">
                        <input type="submit">
                        <?php echo "<p>".$msg."</p>" ?>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
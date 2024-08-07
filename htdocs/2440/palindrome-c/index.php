<?php
   include("./includes/importantstuff.php");
   
   
?>

<!DOCTYPE html>
<html lang="en">
    <?php include("../../partials/head.php"); ?>
    <body>
    <?php include("../../partials/navbar.php"); ?>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col pt-3 m-auto d-flex text-center">
                        <form action="palindrome.php" method="post">
                            <?php 
                                echo buildSelect($selectedNum, $numPals);
                            ?>
                            <input class="" placeholder="search" type="text" name="search-term" value="<?php echo $errorWord ?>">
                            <div class="btn-group">
                                <input class="btn btn-primary mb-1" type="Submit" placeholder="Search">
                            </div>
                            <?php
                                echo errMessage($ec);
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
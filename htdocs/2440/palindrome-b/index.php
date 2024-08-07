<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Palindrome Stuff</title>
        <link rel="stylesheet" href="/2440/palindrome-b/css/style.css" type="text/css">
    </head>
    <body>
        <?php
            $evilCounter = 0;

            $inputs = array("Madam I'm Adam", "alley cats", "i did, did i?", "eve", "Stack Cats", "bob", "race car");

            // for ($i = 0; $i < sizeof($inputs); $i++){
            //     echo output($inputs[$i]);
            // }

            foreach($inputs as $input){
                echo output($input);
            }
            echo "<p>There is/are $evilCounter evil(s) on this site</p>";
        ?>
    </body>
</html>



<?php
    function output($input){
        global $evilCounter;
        if(strpos(strtolower($input), "cat")){
            $evilCounter++;
        }
        
        $result ="";
        $result .= "<h1>Facts about \"$input\"</h1>";
        $result .=  "<ul>";
        $result .=  "<li> Palindrome: ".(isPalindrome($input) ? "<span class='message'>True</span>" : "<span class='warning'>False</span>")."</li>";
        $result .=  "<li>Number of Characters: ". strlen($input)."</li>";
        $result .=  "<li>Number of Characters: ". str_word_count($input)."</li>";
        $result .= "</ul>";
        return $result;
    }

    // echo 'This word is a palindrome (true or false)? ' . (isPalindrome($input) ? "True" : "False");

    function isPalindrome($phrase){
        $phrase = str_replace(" ", "", $phrase);
        $phrase = str_replace("'", "", $phrase);
        $phrase = str_replace("?", "", $phrase);
        $phrase = str_replace("/", "", $phrase);
        $phrase = str_replace("\\", "", $phrase);
        $phrase = str_replace(".", "", $phrase);
        $phrase = str_replace(",", "", $phrase);
        
        $phrase = strtoLower($phrase);
        $revPhrase = strrev($phrase);

        if($revPhrase == $phrase){
            return true;
        } else {
            return false;
        }
    };

?>
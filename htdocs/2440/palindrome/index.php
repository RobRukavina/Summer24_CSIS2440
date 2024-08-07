<?php
$input = "Madam I'm Adam";
echo "<h1>Facts about \"$input\"</h1>";
echo "<ul>";
echo "<li> Palindrome: ".(isPalindrome($input) ? "True" : "False")."</li>";
echo "<li>Number of Characters: ". strlen($input)."</li>";
echo "<li>Number of Characters: ". str_word_count($input)."</li>";
echo "</ul>";

// echo 'This word is a palindrome (true or false)? ' . (isPalindrome($input) ? "True" : "False");

function isPalindrome($phrase){
    $phrase = str_replace(" ", "", $phrase);
    $phrase = strtoLower($phrase);
    $phrase = str_replace("'", "", $phrase);
    $revPhrase = strrev($phrase);

    if($revPhrase == $phrase){
        return true;
    } else {
        return false;
    }
};

?>
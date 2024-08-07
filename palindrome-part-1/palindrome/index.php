<?php 
	$input = "Madam I'm Adam";
	echo "<h1>Facts about \"$input\"</h1>";
	echo "<ul>";
	echo "<li> Palindrome: ".(isPalindrome($input) ? "TRUE" : "FALSE")."</li>";
	echo "<li> Number of Characters: ".strlen($input)."</li>";
	echo "<li> Number of Words: ".str_word_count($input)."</li>";
	echo "</ul>";
		
	function isPalindrome($phrase)
	{
		
		//removes spaces from phrase
		$phrase = str_replace(" ", "", $phrase); 
		$phrase = str_replace("'", "", $phrase); 
		
		//lower case the phrase
		$phrase = strtolower($phrase);
		
		//reverse phrase and assign to variable
		$revPhrase = strrev($phrase);
		
		//compare and return
		if($revPhrase == $phrase) return true;
		else return false;
	}
?>

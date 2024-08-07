<?php
    function wordCountOutput($ct, $tm){
        echo "<div class='col-4'><div class='card'><p>There are $ct instance(s) of '$tm' on this site</p></div></div>";
    }

    function output($inputs, $st){
        global $wordCounter;
        $results = "";
        foreach($inputs as $input){
            $result ="";
            $result .= "<div class='col-4'><div class='card'><h1 class='text-center'>$input</h1>";
            $result .=  "<ul>";
            $result .=  "<li> Palindrome: ".(isPalindrome($input) ? "<span class='message'>True</span>" : "<span class='warning'>False</span>")."</li>";
            $result .=  "<li>Number of Characters: ". strlen($input)."</li>";
            $result .=  "<li>Number of Characters: ". str_word_count($input)."</li>";
            $result .= "</ul></div></div>";
            $results = $results . $result;
            
            if(strpos(strtolower($input), $st) !== false){
                $wordCounter++;
            }
        }
        return $results;
    }

    // echo 'This word is a palindrome (true or false)? ' . (isPalindrome($input) ? "True" : "False");

    function isPalindrome($phrase){
        $phrase = str_replace("/(\w*)(\W*)/", "$1", $phrase);
        
        $phrase = strtoLower($phrase);
        $revPhrase = strrev($phrase);

        if($revPhrase == $phrase){
            return true;
        } else {
            return false;
        }
    };

    function getVars(){
        $numPals = 10;
        if(!empty($_GET['word'])){
            $errorWord = $_GET['word'];
        } else {
            $errorWord = "";
        }
        if(!empty($_GET['num'])){
            $selectedNum = $_GET['num'];
        } else {
            $selectedNum = 0;
        }
        if(!empty($_GET['ec'])){
            $ec = $_GET['ec'];
        } else {
            $ec = 0;
        }

        return array($errorWord, $selectedNum, $ec, $numPals);
    }
    

    function buildSelect($selectedNum, $numPals){
        $returnSelect = ""; 
        $returnSelect.= '<select name="pal-count">';
        $returnSelect.= '<option value="" ';
        $returnSelect.= ($selectedNum ? "" : " selected ");
        $returnSelect.= 'disabled hidden >How many palindromes?</option>';    
        for($i = 1; $i <= $numPals; $i++){
            $returnSelect.= '<option '.($i == $selectedNum ? " selected ": "").' value="'.$i.'">'.$i.' Palindrome'.($i == 1 ? "" : "s").'</option>';
        }
        $returnSelect.= '</select>';
        return $returnSelect;
    }

    function errMessage($ec){
     $returnMess = "";
        switch($ec){
            case 4:{
                $returnMess .= "<p class='text-center'><span class='warning'>Enter a word that has no numbers in it!</span></p>";
                break;
            }
            case 3:{
                
            }
            case 2:{
                // word missing
                $returnMess .= "<p class='text-center'><span class='warning'>Enter a word to search for!</span></p>";
                if($ec != 3){
                    break;
                }
            }
            case 1:{
                // pal count missing
                $returnMess .= "<p class='text-center'><span class='warning'>Select a number of Palindromes!</span></p>";
            }
        }
        return $returnMess;
    }
?>
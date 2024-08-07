<?php
// filestream reading stuff
$fs = fopen("/text.txt", "r");
//get's whole file
 echo fread($fs, filesize("text.txt"));

// get's single string
 echo fgets($fs);

// get's each string in file one at a time
 while(!feof($fs)){
     echo "<p>".fgets($fs)."</p>";
 }
 
 $size = filesize("/text.txt");

 if(!$size){ return false; }
 
 // comma separated file (csv)
 $content = fread($fs, filesize("text.txt"));
 // explode function creates an array out of a string which separates elements based on delimiter. In this case it's the comma
 $words = explode(",", $contents);
 // echo $contents;
 var_dump($words);


 // need to do this for passwords assignments
 foreach($words as $word){
    $names = explode(" ", $word);
    foreach($names as $name){
        echo "<p>".$name."</p>";
    }
 }

// function used in palindrome video
function getTextFile(){
    $fn = "/text.txt";
    $size = filesize($fn);
    if(!$size) return false;
    $fs = fopen($fn, 'r');
    $words = fread($fs, $size);
    return explode(',', $words);
}

 // filestream writing stuff
 
function appendToTextFile($inputs){
    $fn = 'text.txt';
    $size = filesize($fn);
    $curFile = getTextFile();
    $newAr = [];
    if($size){
        foreach($inputs as $input){
            if(!in_array($input, $curFile)){
                $newAr[]= $input;
            }
        }
        $comma = ",";
    } else {
        $newAr = $inputs;
        $comma = "";
    }
    if($newAr){
        $string = implode(",", $newAr);
        $string = $comma.$string;
        $fs = fopen($fn, 'a'); 
        fwrite($fs, $string);
    }           
    
}

 appendToTextFile($inputs)
?>
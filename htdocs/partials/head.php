<?php
    $title = basename($_SERVER["PHP_SELF"]);
    $title = substr($title, 0, -4);
    $title = ucfirst($title). ' Page';
    $title = ($title == 'index' ? 'Home' : $title);

echo '
    <head>
        <title>'.$title.'</title>
        <link rel="stylesheet" href="/2440/palindrome-b/css/style.css" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
';
?>
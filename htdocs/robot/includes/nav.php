<?php 
# $dir = scandir("../../2440/palindrome-c");
// loop through dir and create new array that has the order of filenames we want navbar to display in. 
// then use that array for the loop below

// loop through filenames in dir
// do that here!
// inside loop check this
# if(substr($dir, -4) === ".php"){
    //then show link in navbar
#}
// echo var_dump($_SERVER);
// if(isset($_SERVER["HTTP_REFERER"]) && str_ends_with($_SERVER["HTTP_REFERER"], '/session/')){
//     header("location: ./session");
// }
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/robot">Create a Robot</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search for nothing!!!" id="search" aria-label="Search">
        <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Don't try to Search</button>
        </form>
    </div>
</nav>
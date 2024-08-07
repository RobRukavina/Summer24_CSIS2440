<html>
    <!-- This will hide or show the p tag/h1 based on the value of $granted -->
    <?php if(!$granted) : ?>
        <p>Stuff to show or hide</p>
    <?php else : ?>
        <h1>Access Granted</h1>
    <?php endif; ?>
</html>
<!-- set a cookie that expires in one hour -->
<?php
    setcookie('name', $user, time() + 3600);

    // access cookie like a superglobal:
    $_COOKIE['name'];

    // to unset cookie just set it again for a time in the past:
    setcookie('name', '', time() - 3600);

?>
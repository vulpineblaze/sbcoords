<?php

require $_SERVER['DOCUMENT_ROOT'] . 'sbsecure/includes/header.php';

// ... ask if we are logged in here:
//$id =$_GET['id'];

$deleteurl=$_SERVER['DOCUMENT_ROOT'] . "sbsecure/views/coords_deleteform.php";
//$editurl.=$id;

//echo '<script>alert(" test : '.$id.' '.$editurl.' ");</script>' ;

if ($login->isUserLoggedIn() == true && $login->getUserPerm() < 10) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
	include($deleteurl);
} else {
	include($_SERVER['DOCUMENT_ROOT'] . "sbsecure/views/not_permission.php");
}

require $_SERVER['DOCUMENT_ROOT'] . 'sbsecure/includes/footer.php';

?>

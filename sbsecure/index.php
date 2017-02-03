<?php

require $_SERVER['DOCUMENT_ROOT'] . 'sbsecure/includes/header.php';

if ($login->isUserLoggedIn() == true) {		
	include($_SERVER['DOCUMENT_ROOT'] . "sbsecure/views/coords_insertform.php");
}

include $_SERVER['DOCUMENT_ROOT'] . 'sbsecure/views/coords_list.php'; # default page
require $_SERVER['DOCUMENT_ROOT'] . 'sbsecure/includes/footer.php';

?>

<?php

require $_SERVER['DOCUMENT_ROOT'] . 'sbsecure/includes/header.php';

// load the registration class
require_once($_SERVER['DOCUMENT_ROOT'] . "sbsecure/classes/Registration.php");

// create the registration object. when this object is created, it will do all registration stuff automatically
// so this single line handles the entire registration process.
$registration = new Registration();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true && $login->getUserPerm() < 2) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    include($_SERVER['DOCUMENT_ROOT'] . "sbsecure/views/register.php");
} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    include($_SERVER['DOCUMENT_ROOT'] . "sbsecure/views/not_permission.php");
}
// show the register view (with the registration form, and messages/errors)

require $_SERVER['DOCUMENT_ROOT'] . 'sbsecure/includes/footer.php';

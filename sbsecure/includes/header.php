<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require $_SERVER['DOCUMENT_ROOT'] . 'sbsecure/bootstrapper.php';

if (defined('bootstrapped')) {
    /**
     * A simple, clean and secure PHP Login Script / MINIMAL VERSION
     * For more versions (one-file, advanced, framework-like) visit http://www.php-login.net
     *
     * Uses PHP SESSIONS, modern password-hashing and salting and gives the basic functions a proper login system needs.
     *
     * @author Panique
     * @link https://github.com/panique/php-login-minimal/
     * @license http://opensource.org/licenses/MIT MIT License
     */

    // checking for minimum PHP version
    if (version_compare(PHP_VERSION, '5.3.7', '<')) {
        exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7!");
    } else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
        // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
        // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
        require_once($_SERVER['DOCUMENT_ROOT'] . "sbsecure/libraries/password_compatibility_library.php");
    }

?>
<!DOCTYPE html>

<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Starbound Coordinate Online-Database</title>
		<link rel="stylesheet" href="/sbsecure/css/main.css" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="starbound, coords, coordinates, locations, query, search, database, table, chucklefish, game, x, y, star, system, name, planet, biome, threat, level, seeds, tech, user" />
		<meta name="description" content="The #1 unofficial, user-driven informational database of worthwhile locations for Starbound, the sci-fi sandbox beta game by Chucklefish." />
		<meta property="og:title" content="Starbound Coordinate Online-Database" />
		<meta property="og:site_name" content="Starbound Coordinate Online-Database" />
		<meta property="og:description" content="Starbound Coordinate Online-Database, By Anondea Software &amp; Design" />
		<meta property="og:image" content="http://142.54.184.102/NI_icon2_200x200.jpg" />
		<meta property="og:url" content="http://142.54.184.102/sbsecure/index.php" />
	</head>
	<body>
		<section id="house">
			<a href="/sbsecure/" title="Starbound Coordinate Online-Database" style="display: inline-block; margin: 0 10px 10px;"><img id="logo" src="/sbsecure/images/logo.png" alt="sbcoords_logo" /></a>
			<section id="mast">
<?php

    include($_SERVER['DOCUMENT_ROOT'] . "sbsecure/views/searchbar.php");

    // include the configs / constants for the database connection
    require_once($_SERVER['DOCUMENT_ROOT'] . "sbsecure/../../www_not/includes/db.php");

    // load the login class
    require_once($_SERVER['DOCUMENT_ROOT'] . "sbsecure/classes/Login.php");

    // create a login object. when this object is created, it will do all login/logout stuff automatically
    // so this single line handles the entire login process. in consequence, you can simply ...
    $login = new Login();

    // ... ask if we are logged in here:
    if ($login->isUserLoggedIn() == true) {
        // the user is logged in. you can do whatever you want here.
        // for demonstration purposes, we simply show the "you are logged in" view.
        include($_SERVER['DOCUMENT_ROOT'] . "sbsecure/views/logged_in.php");
    } else {
        // the user is not logged in. you can do whatever you want here.
        // for demonstration purposes, we simply show the "you are not logged in" view.
        include($_SERVER['DOCUMENT_ROOT'] . "sbsecure/views/not_logged_in.php");
    }

?>
			</section>
			<section id="main">
<?php

    $mysqli = new mysqli(DB_HOST, COORD_DB_USER, COORD_DB_PASS, COORD_DB_NAME, 3306);

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
} else {
	ob_clean(); # discard any leading output
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
	die();
}

?>

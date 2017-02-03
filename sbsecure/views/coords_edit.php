<?php

require $_SERVER['DOCUMENT_ROOT'] . 'sbsecure/includes/header.php';

if (defined('bootstrapped') && $_POST) {
    //$db = $mysqli->query("SELECT * FROM coordtable;");
    $id_num = filter_var($_POST['ID'], FILTER_SANITIZE_NUMBER_INT);
    //echo '<script>alert("edit id : '.$id_num.' ");</script>' ;

    //$value = "Robert'); DROP TABLE Students;--";

    foreach ($_POST as $key => $value) {
        include($_SERVER['DOCUMENT_ROOT'] . "sbsecure/classes/Sanitize.php");
        //echo '<script>alert(" test : '.$value.' ");</script>' ;$_POST[$key] = 
        $_POST[$key]=mysqli_real_escape_string($mysqli, htmlspecialchars(trim($value)));
    }

    //echo '<script>alert(" test : '.$value.' ");</script>' ;

    $query="UPDATE coordtable SET
                X=?, 
                Y=?, 
                STARSYSTEM=?, 
                NAME=?, 
                PLANETNAME=?, 
                BIOME=?, 
                THREATLEVEL=?, 
                SEEDS=?, 
                TECH=?, 
                VERSION=?, 
                POINTSOFINTEREST=? 
            WHERE ID=?";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param('iissssissssi', $_POST['X'], $_POST['Y'], $_POST['STARSYSTEM'], $_POST['NAME'], $_POST['PLANETNAME'], $_POST['BIOME'], $_POST['THREATLEVEL'], $_POST['SEEDS'], $_POST['TECH'], $_POST['VERSION'], $_POST['POINTSOFINTEREST'], $id_num);

        if ($stmt->execute()) {
            echo "1 record edited";
        } else {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
} else {
	ob_clean(); # discard any leading output
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
	die();   
}

?>
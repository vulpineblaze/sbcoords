<?php

require $_SERVER['DOCUMENT_ROOT'] . 'sbsecure/includes/header.php';

if (defined('bootstrapped') && $_POST) {
    foreach ($_POST as $key => $value) {
        include($_SERVER['DOCUMENT_ROOT'] . "sbsecure/classes/Sanitize.php");
        //echo '<script>alert(" test : '.$value.' ");</script>' ;
        //Robert'); DROP TABLE Students;--
        $_POST[$key] = mysqli_real_escape_string($mysqli, htmlspecialchars(trim($value)));
    }
    
    #$validated_x = preg_match('/^[0-9-]$/', trim($_POST['X']));
    #$validated_y = preg_match('/^[0-9-]$/', trim($_POST['Y']));
    #$validated_starsystem = 
    
    $db = $mysqli->query("SELECT * FROM coordtable");
    #$id_num = $db->num_rows + 1; # you don't need to do this if you set the SQL field to auto_increment; easier

    if ($stmt = $mysqli->prepare("INSERT INTO coordtable VALUES ('', '0', '0', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
        $stmt->bind_param('iissssisssss', $_POST['X'], $_POST['Y'], $_POST['STARSYSTEM'], $_POST['NAME'], $_POST['PLANETNAME'], $_POST['BIOME'], $_POST['THREATLEVEL'], $_POST['SEEDS'], $_POST['TECH'], $username, $_POST['VERSION'], $_POST['POINTSOFINTEREST']);

        if ($stmt->execute()) {
            echo "1 record added";
        } else {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    require $_SERVER['DOCUMENT_ROOT'] . 'sbsecure/includes/footer.php';
} else {
	ob_clean(); # discard any leading output
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
	die();   
}

?>

<?php

require $_SERVER['DOCUMENT_ROOT'] . 'sbsecure/includes/header.php';

if (defined('bootstrapped') && $_POST) {
    $id_num = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    if (!empty($id_num)) {
        if ($stmt = $mysqli->prepare("DELETE FROM coordtable WHERE ID=?")) {
            $stmt->bind_param('i', $id_num);

            if ($stmt->execute()) {
                echo "1 record deleted";
            } else {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
    } else {
        echo '<p>Delete failed to capture ID number and aborted to preserve DB integrity.</p>';
    }

    require $_SERVER['DOCUMENT_ROOT'] . 'sbsecure/includes/footer.php';
} else {
	ob_clean(); # discard any leading output
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
	die();
}

?>

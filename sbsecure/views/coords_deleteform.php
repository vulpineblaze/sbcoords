<?php

// include the configs / constants for the database connection
//require_once("../../../www_not/includes/db.php");
//require_once("../classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
//$login = new Login();
//$username = $login->getUserName();
//$username = "test";

if (defined('bootstrapped')) {
    $id_num = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    //echo '<script>alert("edit id : '.$id_num.' ");</script>' ;

    if ($stmt = $mysqli->prepare("SELECT * FROM coordtable WHERE ID=?")) {
        $stmt->bind_param('i', $id_num);
        $stmt->execute();
        $db = $stmt->get_result();
        //echo '<script>alert("edit id : '.$id_num.' ");</script>' ;

        //$db->data_seek($id_num);
        $row = $db->fetch_assoc();

        //echo " id = " . $row['id'] . "\n";

        $id = $row['ID'];

        //echo '<script>alert("system : '.$system.' ");</script>' ;

        echo '
            <h2>Delete Coordinates</h2>

            <section id="delcoords">
                <table>

                    <form action="/sbsecure/views/coords_delete.php" method="post">

                    <tr>
                        <td><p>Are you <em>sure</em> you want to delete record <strong>', $id, '</strong>?</p></td>
                    </tr>
                    <tr>
                        <input type="hidden" name="ID" value="', $id_num, '" />
                        <td><input type="submit" value="Delete" /></td>
                    </tr>

                    </form>

                 </table>
            </section>
        ';

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

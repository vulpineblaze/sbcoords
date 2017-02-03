<?php

if (defined('bootstrapped')) {
	$default_column = 'starsystem';
	$default_order = 'desc';
    $sanitized_sort = @strtolower(preg_replace('/[^a-z_\s]/i', '', trim($_GET['sort']))); # should ideally match against an array of column names
    $sanitized_order = @strtolower(preg_replace('/^((?!^(asc|desc)$).)*$/i', $default_order, trim($_GET['order'])));
	$sanitized_search = @preg_replace('/[^a-z0-9_-\s]/i', ' ', trim($_GET['search'])); # might want to use \p{L} to match an accented character

	function sortColumnAndOrder($column, $friendly_name) {
		global $default_column;
		global $default_order;
        global $sanitized_sort;
        global $sanitized_order;
        global $sanitized_search;
		
        $column = strtolower($column);
        $search = $class = '';
        
        if (isset($sanitized_search) && !empty($sanitized_search)) {
            $search = 'search=' . $sanitized_search . '&amp;'; 
        }
	
		if (isset($sanitized_sort) && $sanitized_sort === $column) {
			if ($sanitized_order === 'desc') {
				$order = 'asc';
			} else {
				$order = 'desc';
			}
			
			$class = '" class="sorted-' . $sanitized_order;
		} else {
            if ((!isset($sanitized_sort) || empty($sanitized_sort)) && $column === $default_column) {
                $order = ($default_order === 'desc' ? 'asc' : 'desc');
                $class = '" class="sorted-' . $default_order;
            } else {
                $order = $default_order;
            }
		}
		
		return $search . 'sort=' . $column . '&amp;order=' . $order . $class . '" title="Sort by ' . $friendly_name;
	}
    
	function colorizeSortedColumn($column, $value) {
		global $default_column;
        global $sanitized_sort;
        global $sanitized_search;
        
        $column = strtolower($column);
        
        if ($column !== 'user') {
            $value = ucfirst($value);
        }

		if ((isset($sanitized_sort) && !empty($sanitized_sort) && $sanitized_sort === $column) || (!isset($sanitized_sort) || empty($sanitized_sort) && $column === $default_column)) {
			echo ' style="background: #a5a5a5; color: #000; font-weight: bold;">', (empty($value) ? '--' : $value);
		} else {
			echo '>', (empty($value) ? '--' : $value);
		}
	}

    // load the login class

    // include the configs / constants for the database connection

    // create a login object. when this object is created, it will do all login/logout stuff automatically
    // so this single line handles the entire login process. in consequence, you can simply ...
    //$login = new Login();
    //$username = $login->getUserName();
    //$db = mysql_select_db("lr") or die(mysql_error());
    //$sql=mysql_query("SELECT * FROM user ")or die(mysql_error());
    //$count=0;
    
    /*
	if (!$mysqli->query("DROP TABLE IF EXISTS test") ||
		!$mysqli->query("CREATE TABLE test(id INT)") ||
		!$mysqli->query("INSERT INTO test(id) VALUES (1), (2), (3)")) {
		echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	$res = $mysqli->query("SELECT id FROM test ORDER BY id ASC");
	
	echo "Reverse order...\n";
	for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
		$res->data_seek($row_no);
		$row = $res->fetch_assoc();
		echo " id = " . $row['id'] . "\n";
	}

	echo "Result set order...\n";
	$res->data_seek(0);
	while ($row = $res->fetch_assoc()) {
		echo " id = " . $row['id'] . "\n";
	}
	*/
	
	/*
	for($column_num = 0; $column_num < $column_count; $column_num++) {
		$field_name = mysql_field_name($result_id, $column_num);
		echo ("<TH><a href="page.php?order_by=$field_name&sorting=$sort</TH>");
	}
	$order_by = (isset($_GET['order_by'])) ? $_GET['order_by'] : 'Name';
	$sorting = (isset($_GET['sorting'])) ? $_GET['sorting'] : 'desc';

	switch($sorting) {
		case "asc":
			$sort = 'desc';
			break;
		case "desc":
			$sort = 'asc';
			break;
	}

	$sortby = trim($_GET["sort"]); //this line jsut grabs whatever sort?= has in address bar
	
	if (empty($sortby)) { //checks for no value, sets to TECH
		$sortby = "TECHS";
		$_SESSION["secondClick"] = false; //added to prevent reload sort toggling
	} else {
		$_SESSION["secondClick"] = true;
	}
	
	if (empty($lastsort)) {
		$lastsort = "STAR_SYSTEM";	
	}

	*	Checks for the 'second' button press to toggle 
	*		- current sortby =?= prev sortby held in SESSION
	*	Did not check for simply reload
	*		- default values set twice, thrice etc..
	*	added: "&& $_SESSION["secondClick"] "

	if ($sortby == $_SESSION['sortby'] && $_SESSION["secondClick"] ) { 
		if ($_SESSION['sortorder'] == "DESC"){
			$_SESSION['sortorder'] = "ASC";
		} else {
			$_SESSION['sortorder'] = "DESC";
		}
	} else { //prev sortby != current sortby
		$lastsort = $_SESSION['sortby'];
		$_SESSION['sortby'] = $sortby;
		$_SESSION['sortorder'] = "DESC";
	}
	*/

	//echo '<script>alert("search : '.$searchquery.' ");</script>';
	//old where VERSION='Furious Koala' AND SEEDS <> '123'

    $secondary_columns = array('starsystem', 'name', 'planetname'); # this could continue on...
    $secondary_sort = '';

    foreach ($secondary_columns as $sort) {
        $secondary_sort .= ', ' . $sort . ' desc';
    }

	$query_prefix = "SELECT * FROM coordtable WHERE version LIKE '%Koala%'";
	$query_suffix = "ORDER BY " . (!empty($sanitized_sort) ? $sanitized_sort : $default_column) . " " . (!empty($sanitized_order) ? $sanitized_order : $default_order) . $secondary_sort;

	if (!empty($sanitized_search)) { # this is a query based on the results of a search
		$query = $query_prefix . " AND (";
		$query .= " X LIKE ? OR";
		$query .= " Y LIKE ? OR";
		$query .= " STARSYSTEM LIKE ? OR";
		$query .= " NAME LIKE ? OR";
		$query .= " PLANETNAME LIKE ? OR";
		$query .= " BIOME LIKE ? OR";
		$query .= " SEEDS LIKE ? OR";
		$query .= " TECH LIKE ? OR";
        $query .= " USER LIKE ? OR";
		$query .= " POINTSOFINTEREST LIKE ?";
		$query .= ") ";
		$query .= $query_suffix;
	} else { // this is a standard query
		$query = $query_prefix . ' ' . $query_suffix;
	}

	if ($stmt = $mysqli->prepare($query)) {
		if (!empty($sanitized_search)) {
			$param_search = $sanitized_search . '%';
			$stmt->bind_param('ssssssssss', $param_search, $param_search, $param_search, $param_search, $param_search, $param_search, $param_search, $param_search, $param_search, $param_search); # bind parameters to placeholders of instead of inserting variables into query string itself -- this is how you avoid SQL injection!
		}
		
		if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (isset($sanitized_search) && !empty($sanitized_search)) {
            echo '<h2 style="margin-bottom: 10px;">Search Results</h2>';   
        }
              
		$db = $stmt->get_result();
        $colcount = 10; # HTML fails to validate if this is incorrect
        
        if ($db->num_rows > 0) {	
            echo '
                <table id="users">
                    <tr>
                        <th><a href="/sbsecure/index.php?', sortColumnAndOrder('X', 'X'), '">X<span></span></a></th>
                        <th><a href="/sbsecure/index.php?', sortColumnAndOrder('Y', 'Y'), '">Y<span></span></a></th>
                        <th><a href="/sbsecure/index.php?', sortColumnAndOrder('STARSYSTEM', 'Star System'), '" style="min-width: 150px;">Star System<span></span></a></th>
                        <th><a href="/sbsecure/index.php?', sortColumnAndOrder('NAME', 'Name'), '">Name<span></span></a></th>
                        <th><a href="/sbsecure/index.php?', sortColumnAndOrder('PLANETNAME', 'Planet'), '" style="min-width: 100px;">Planet<span></span></a></th>
                        <th><a href="/sbsecure/index.php?', sortColumnAndOrder('BIOME', 'Biome'), '">Biome<span></span></a></th>
                        <th><a href="/sbsecure/index.php?', sortColumnAndOrder('THREATLEVEL', 'Threat Level'), '" style="min-width: 150px;">Threat Level<span></span></a></th>
                        <th><a href="/sbsecure/index.php?', sortColumnAndOrder('SEEDS', 'Seeds'), '">Seeds<span></span></a></th>
                        <th><a href="/sbsecure/index.php?', sortColumnAndOrder('TECH', 'Tech'), '">Tech<span></span></a></th>
                        <th><a href="/sbsecure/index.php?', sortColumnAndOrder('USER', 'User'), '">User<span></span></a></th>
                        <!--<th><a href="/sbsecure/index.php?', sortColumnAndOrder('VERSION', 'Version'), '">Version<span></span></a></th>-->
                    </tr>
                    <tr>
                        <td colspan="', $colcount, '" style="border: 0; padding: 0;">&nbsp;</td>
                    </tr>
            ';

            for ($row_no = $db->num_rows - 1; $row_no >= 0; --$row_no) {
                $db->data_seek($row_no);
                $row = $db->fetch_assoc();
                //echo " id = " . $row['id'] . "\n";

                $id = $row['ID'];
                $x = $row['X'];
                $y = $row['Y'];
                $system = $row['STARSYSTEM'];
                $name = $row['NAME'];
                $planet = $row['PLANETNAME'];
                $biome = $row['BIOME'];
                $threat = $row['THREATLEVEL'];
                $seeds = $row['SEEDS'];
                $tech = $row['TECH'];
                $user = $row['USER'];
                $version = $row['VERSION'];
                $interest = $row['POINTSOFINTEREST'];

                if (true) { // $version=="Furious Koala"
                    echo '
                        <tr style="background: #333;">
                            <td class="data"', colorizeSortedColumn('X', $x), '</td>
                            <td class="data"', colorizeSortedColumn('Y', $y), '</td>
                            <td class="data"', colorizeSortedColumn('STARSYSTEM', $system), '</td>
                            <td class="data"', colorizeSortedColumn('NAME', $name), '</td>
                            <td class="data"', colorizeSortedColumn('PLANETNAME', $planet), '</td>
                            <td class="data"', colorizeSortedColumn('BIOME', $biome), '</td>
                            <td class="data"', colorizeSortedColumn('THREATLEVEL', $threat), '</td>
                            <td class="data"', colorizeSortedColumn('SEEDS', $seeds), '</td>
                            <td class="data"', colorizeSortedColumn('TECH', $tech), '</td>
                            <td class="data"', colorizeSortedColumn('USER', $user), '</td>
                            <!--<td class="data"', colorizeSortedColumn('VERSION', $version), '</td>-->
                        </tr>
                        <tr style="background: #333;">
                    ';

                    if ($login->isUserLoggedIn() == true) {
                        echo '
                            <td class="data" colspan="2">
                                <a href="/sbsecure/edit.php?id=', $id, '"><button>Edit</button></a>
                                <a href="/sbsecure/delete.php?id=', $id, '"><button>Delete</button></a>
                            </td>
                        ';
                    }

                    echo '
                            <td class="data" colspan="', $colcount, '" style="vertical-align: top;">', $interest, '</td>
                        </tr>
                        <tr>
                            <td colspan="', $colcount, '" style="border: 0; padding: 0;">&nbsp;</td>
                        </tr>
                    ';
                }
            }

            echo '
                <tr>
                    <th><a href="/sbsecure/index.php?', sortColumnAndOrder('X', 'X'), '">X<span></span></a></th>
                    <th><a href="/sbsecure/index.php?', sortColumnAndOrder('Y', 'Y'), '">Y<span></span></a></th>
                    <th><a href="/sbsecure/index.php?', sortColumnAndOrder('STARSYSTEM', 'Star System'), '" style="min-width: 150px;">Star System<span></span></a></th>
                    <th><a href="/sbsecure/index.php?', sortColumnAndOrder('NAME', 'Name'), '">Name<span></span></a></th>
                    <th><a href="/sbsecure/index.php?', sortColumnAndOrder('PLANETNAME', 'Planet'), '" style="min-width: 100px;">Planet<span></span></a></th>
                    <th><a href="/sbsecure/index.php?', sortColumnAndOrder('BIOME', 'Biome'), '">Biome<span></span></a></th>
                    <th><a href="/sbsecure/index.php?', sortColumnAndOrder('THREATLEVEL', 'Threat Level'), '" style="min-width: 150px;">Threat Level<span></span></a></th>
                    <th><a href="/sbsecure/index.php?', sortColumnAndOrder('SEEDS', 'Seeds'), '">Seeds<span></span></a></th>
                    <th><a href="/sbsecure/index.php?', sortColumnAndOrder('TECH', 'Tech'), '">Tech<span></span></a></th>
                    <th><a href="/sbsecure/index.php?', sortColumnAndOrder('USER', 'User'), '">User<span></span></a></th>
                    <!--<th><a href="/sbsecure/index.php?', sortColumnAndOrder('VERSION', 'Version'), '">Version<span></span></a></th>-->
                </tr>
            ';

            echo '</table>';
        } else {
            echo '<p style="margin: 0;">No data found!</p>';   
        }
		
		//$stmt->fetch();
		$stmt->close();
	} else {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
	
	/*

	while($row = mysql_fetch_array($sql))
	{
		$name=$row['Name'];
		$age=$row['age'];
		$email=$row['Email'];
		$dob=$row['DOB'];

		echo  '<table id="users" border="">';
		while($row = mysql_fetch_array($sql))
		{
		   $name=$row['Name'];
		   $age=$row['age'];
		   $email=$row['Email'];
		   $dob=$row['DOB'];

		   echo 
			   '<tr>
				   <td>'.$count.'</td>
				   <td>'.$name.'</td>
				   <td>'.$age.'</td>
				   <td>'.$email.'</td>
				   <td>'.$dob.'</td>
			   </tr>';

		   $count++;   
		}
		echo ' </table>  '; 
	$count++;   

	}

	*/

} else {
	ob_clean(); # discard any leading output
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
	die();   
}

?>

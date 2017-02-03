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

        //echo '<script>alert("system : '.$system.' ");</script>' ;

        echo '
            <h2>Edit Coordinates</h2>

            <section id="editcoords">
                <table>
                    <tr>
                        <th>X</th>
                        <th>Y</th>
                        <th>STAR SYSTEM</th>
                        <th>NAME</th>
                        <th>PLANET</th>
                    </tr>

                    <form action="/sbsecure/views/coords_edit.php" method="post">

                    <tr>
                        <td><div class="wrap-textput"><input type="number" name="X" value="'.$x.'" required="required" /></div></td>
                        <td><div class="wrap-textput"><input type="number" name="Y" value="'.$y.'" required="required" /></div></td>
                        <td>
                            <div class="wrap-textput">
                                <select name="STARSYSTEM">
                                    <option value="Alpha" '.($system=="Alpha"?"selected=\"selected\"":"").'>Alpha</option>
                                    <option value="Beta" '.($system=="Beta"?"selected=\"selected\"":"").'>Beta</option>
                                    <option value="Gamma" '.($system=="Gamma"?"selected=\"selected\"":"").'>Gamma</option>
                                    <option value="Delta" '.($system=="Delta"?"selected=\"selected\"":"").'>Delta</option>
                                    <option value="X" '.($system=="X"?"selected=\"selected\"":"").'>X</option>
                                </select>
                            </div>
                        </td>
                        <td><div class="wrap-textput"><input type="text" name="NAME" value="'.$name.'" required="required" /></div></td>
                        <td><div class="wrap-textput"><input type="text" name="PLANETNAME" value="'.$planet.'" required="required" /></div></td>
                    </tr>
                    <tr>
                        <th>BIOME</th>
                        <th>THREAT LEVEL</th>
                        <th>SEEDS</th>
                        <th>TECHS</th>
                        <th>VERSION</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="wrap-textput">
                                <select name="BIOME">
                                    <option value="Arid" '.($biome=="Arid"?"selected=\"selected\"":"").'>Arid</option>
                                    <option value="Asteroid Field" '.($biome=="Asteroid Field"?"selected=\"selected\"":"").'>Asteroid Field</option>
                                    <option value="Barren" '.($biome=="Barren"?"selected=\"selected\"":"").'>Barren</option>
                                    <option value="Desert" '.($biome=="Desert"?"selected=\"selected\"":"").'>Desert</option>
                                    <option value="Forest" '.($biome=="Forest"?"selected=\"selected\"":"").'>Forest</option>
                                    <option value="Grassland" '.($biome=="Grassland"?"selected=\"selected\"":"").'>Grassland</option>
                                    <option value="Jungle" '.($biome=="Jungle"?"selected=\"selected\"":"").'>Jungle</option>
                                    <option value="Magma" '.($biome=="Magma"?"selected=\"selected\"":"").'>Magma</option>
                                    <option value="Moon" '.($biome=="Moon"?"selected=\"selected\"":"").'>Moon</option>
                                    <option value="Savannah" '.($biome=="Savannah"?"selected=\"selected\"":"").'>Savannah</option>
                                    <option value="Snow" '.($biome=="Snow"?"selected=\"selected\"":"").'>Snow</option>
                                    <option value="Tundra" '.($biome=="Tundra"?"selected=\"selected\"":"").'>Tundra</option>
                                    <option value="Volcano" '.($biome=="Volcano"?"selected=\"selected\"":"").'>Volcano</option>
                                </select>
                            </div>
                        </td>
                        <td><div class="wrap-textput"><input type="number" name="THREATLEVEL" value="'.$threat.'" min="1" max="10" step="1" " /></div></td>
                        <td><div class="wrap-textput"><input type="text" name="SEEDS" value="'.$seeds.'" /></div></td>
                        <td>
                            <div class="wrap-textput">
                                <select name="TECH">
                                    <option value="None Found" '.(($tech=="None Found"||$tech=="")?"selected=\"selected\"":"").'>None Found</option>
                                    <option value="Energy Dash" '.($tech=="Energy Dash"?"selected=\"selected\"":"").'>Energy Dash</option>
                                    <option value="Pulse Jump" '.($tech=="Pulse Jump"?"selected=\"selected\"":"").'>Pulse Jump</option>
                                    <option value="Human Mech" '.($tech=="Human Mech"?"selected=\"selected\"":"").'>Human Mech</option>
                                    <option value="Butterfly Boost" '.($tech=="Butterfly Boost"?"selected=\"selected\"":"").'>Butterfly Boost</option>	
                                    <option value="Rocket Boost" '.($tech=="Rocket Boost"?"selected=\"selected\"":"").'>Rocket Boost</option>
                                    <option value="Bubble Boost" '.($tech=="Bubble Boost"?"selected=\"selected\"":"").'>Bubble Boost</option>
                                    <option value="Gravity Neutraliser" '.($tech=="Gravity Neutraliser"?"selected=\"selected\"":"").'>Gravity Neutraliser</option>
                                    <option value="Morph Ball" '.($tech=="Morph Ball"?"selected=\"selected\"":"").'>Morph Ball</option>
                                    <option value="Skyrail Rider" '.($tech=="Skyrail Rider"?"selected=\"selected\"":"").'>Skyrail Rider</option>
                                    <option value="Gravity Bubble" '.($tech=="Gravity Bubble"?"selected=\"selected\"":"").'>Gravity Bubble</option>
                                    <option value="Targeted Blink" '.($tech=="Targeted Blink"?"selected=\"selected\"":"").'>Targeted Blink</option>
                                    <option value="Many - See Points Of Interest" '.($tech=="Many - See Points Of Interest"?"selected=\"selected\"":"").'>More Than One</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="wrap-textput">
                                <select name="VERSION">
                                    <option value="Enraged Koala" '.($version=="Enraged Koala"?"selected=\"selected\"":"").'>Enraged Koala</option>
                                    <option value="Furious Koala" '.($version=="Furious Koala"?"selected=\"selected\"":"").'>Furious Koala</option>
                                    <option value="Angry Koala" '.($version=="Angry Koala"?"selected=\"selected\"":"").'>Angry Koala</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>POINTS OF INTEREST</th>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <textarea name="POINTSOFINTEREST">'.$interest.'</textarea>
                            <input type="hidden" name="ID" value="'.$id.'" />
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Save" /></td>
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

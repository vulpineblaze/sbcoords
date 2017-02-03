<?php

if (defined('bootstrapped')) {

?>
<h2>Insert New Coordinates</h2>

<section id="inscoords">
    <table>
        <tr>
            <th>X</th>
            <th>Y</th>
            <th>STAR SYSTEM</th>
            <th>NAME</th>
            <th>PLANET</th>
        </tr>

        <form action="/sbsecure/views/coords_insert.php" method="post">

        <tr>
            <td><div class="wrap-textput"><input type="number" name="X" required="required" /></div></td>
            <td><div class="wrap-textput"><input type="number" required="required" /></div></td>
            <td>
                <div class="wrap-textput">
                    <select name="STARSYSTEM">
                        <option value="Alpha" selected>Alpha</option>
                        <option value="Beta">Beta</option>
                        <option value="Gamma">Gamma</option>
                        <option value="Delta">Delta</option>
                        <option value="X">X</option>
                    </select>
                </div>
            </td>
            <td><div class="wrap-textput"><input type="text" name="NAME" required="required" /></div></td>
            <td><div class="wrap-textput"><input type="text" name="PLANETNAME" required="required" /></div></td>
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
                        <option value="Arid">Arid</option>
                        <option value="Asteroid Field">Asteroid Field</option>
                        <option value="Barren">Barren</option>
                        <option value="Desert">Desert</option>
                        <option value="Forest">Forest</option>
                        <option value="Grassland">Grassland</option>
                        <option value="Jungle">Jungle</option>
                        <option value="Magma">Magma</option>
                        <option value="Moon">Moon</option>
                        <option value="Savannah">Savannah</option>
                        <option value="Snow">Snow</option>
                        <option value="Tundra">Tundra</option>
                        <option value="Volcano">Volcano</option>
                    </select>
                </div>
            </td>
            <td><div class="wrap-textput"><input type="number" name="THREATLEVEL" value="1" min="1" max="10" step="1" /></div></td>
            <td><div class="wrap-textput"><input type="text" name="SEEDS" value="Unknown" /></div></td>
            <td>
                <div class="wrap-textput">
                    <select name="TECH">
                        <option value="None Found" selected>None Found</option>
                        <option value="Energy Dash">Energy Dash</option>
                        <option value="Pulse Jump">Pulse Jump</option>
                        <option value="Human Mech">Human Mech</option>
                        <option value="Butterfly Boost">Butterfly Boost</option>	
                        <option value="Rocket Boost">Rocket Boost</option>
                        <option value="Bubble Boost">Bubble Boost</option>
                        <option value="Gravity Neutraliser">Gravity Neutraliser</option>
                        <option value="Morph Ball">Morph Ball</option>
                        <option value="Skyrail Rider">Skyrail Rider</option>
                        <option value="Gravity Bubble">Gravity Bubble</option>
                        <option value="Targeted Blink">Targeted Blink</option>
                        <option value="Many - See Points Of Interest">More Than One</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="wrap-textput">
                    <select name="VERSION">
						<option value="Enraged Koala" selected="selected">Enraged Koala</option>
                        <option value="Furious Koala">Furious Koala</option>
                        <option value="Angry Koala">Angry Koala</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th>POINTS OF INTEREST</th>
        </tr>
        <tr>
            <td colspan="5">
                <textarea name="POINTSOFINTEREST" placeholder="Why visit this planet?"></textarea>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="Save" /></td>
        </tr>

        </form>

    </table>
</section>
<?php
    
} else {
	ob_clean(); # discard any leading output
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
	die();   
}

?>
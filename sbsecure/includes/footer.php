<?php

if (defined('bootstrapped')) {
    @mysqli_close($mysqli);

?>
			</section>
		</section>
	</body>
</html>
<?php 

} else {
	ob_clean(); # discard any leading output
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
	die();   
}

?>

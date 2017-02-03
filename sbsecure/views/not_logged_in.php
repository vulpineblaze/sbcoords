<?php

if (defined('bootstrapped')) {
    
?>
<div style="float: right;">
	<!-- login form box -->
	<?php

	// show potential errors / feedback (from login object)
	if (isset($login)) {
		if ($login->errors) {
			foreach ($login->errors as $error) {
				echo '<span style="color: #f00; float: left; line-height: 26px; padding-right: 10px;">', $error, '</span>';
			}
		}
		if ($login->messages) {
			foreach ($login->messages as $message) {
				echo '<span style="color: #888; float: left; line-height: 26px; padding-right: 10px;">', $message, '</span>';
			}
		}
	}

	?>
	<form id="frm-signin" method="post" action="/sbsecure/" name="loginform">
		<div class="wrap-textput">
			<!--<label for="login_input_username">Username</label>-->
			<input id="login_input_username" class="login_input" type="text" name="user_name" required placeholder="Username" />
		</div>

		<div class="wrap-textput">
			<!--<label for="login_input_password"></label>-->
			<input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required placeholder="Password" />
		</div>

		<input id="btn-signin" type="submit" name="login" value="" title="Sign In" />
	</form>

	<!--
	<span>OR</span>
	<a href="/sbsecure/register.php">
		<button id="btn-register">Register</button>
	</a>
	-->
</div>
<?php

} else {
	ob_clean(); # discard any leading output
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
	die();   
}

?>
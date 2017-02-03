<?php

if (defined('bootstrapped')) {
    echo '<h2>Register</h2>';
    
    // show potential errors / feedback (from registration object)
    if (isset($registration)) {
        if ($registration->errors) {
            foreach ($registration->errors as $error) {
                echo $error;
            }
        }
        if ($registration->messages) {
            foreach ($registration->messages as $message) {
                echo $message;
            }
        }
    }

?>
<section id="register">
    <!-- register form -->
    <form id="registerform" method="post" action="/sbsecure/register.php" name="registerform">
        <!-- the user name input field uses a HTML5 pattern check -->
        <label for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label>
        <div class="wrap-textput"><input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required /></div>

        <!-- the email input field uses a HTML5 email type check -->
        <label for="login_input_email">User's email</label>
        <div class="wrap-textput"><input id="login_input_email" class="login_input" type="email" name="user_email" required /></div>

        <label for="login_input_password_new">Password (min. 6 characters)</label>
        <div class="wrap-textput"><input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" /></div>

        <label for="login_input_password_repeat">Repeat password</label>
        <div class="wrap-textput"><input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" /></div>

        <input type="submit"  name="register" value="Register" />
    </form>
</section>
<?php

} else {
	ob_clean(); # discard any leading output
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
	die();
}

?>

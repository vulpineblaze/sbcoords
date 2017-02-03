<?php

if (defined('bootstrapped')) {
    
?>
<p style="float: right; line-height: 26px; margin: 0;">
    <!-- if you need user information, just put them into the $_SESSION variable and output them here -->
    Hey, <?php echo $_SESSION['user_name']; ?>. You are signed in.

    <!-- because people were asking: "index.php?logout" is just my simplified form of "index.php?logout=true" -->
    <a href="/sbsecure/?logout" title="Sign Out">Sign Out</a> or <a href="/sbsecure/register.php" title="Register">Register an Account</a>
    <!-- endof logged in -->
</p>
<?php

} else {
	ob_clean(); # discard any leading output
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
	die();   
}
    
?>
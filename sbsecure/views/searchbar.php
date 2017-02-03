<?php

if (defined('bootstrapped')) {
    
?>
<form id="frm-search" action="/sbsecure/index.php">
	<div class="wrap-textput" style="float: left;">
		<input id="fld-query" size="50" type="text" name="search" value="<?php if (!empty($_GET['search'])) echo trim($_GET['search']); ?>" placeholder="Search Data" />
	</div>

	<input id="btn-query" type="submit" value="" title="Submit Search" />
</form>
<?php

} else {
	ob_clean(); # discard any leading output
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
	die();   
}
    
?>
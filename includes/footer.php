
<?php
// This script serves as a footer for each webpage, closing out the html opened by the header. The script will be called by each page. 
?>

</div><br />

<div id="AccountMenu" align="center">

	<?php
	
	// Display buttons depending on what page the user is on.
	if( $page_title != 'Home' ){
		echo '<a href="index.php" title="Home"><img border="0" alt="home" src="buttons/btn_home.png" /></a>';
	}
	
	?>
	<a href="help.php" title="Help"><img border="0" alt="help" src="buttons/btn_help.png" /></a>

</div>
</html>

<?php
ob_end_flush();
?>

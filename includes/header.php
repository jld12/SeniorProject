<?php 
// This script serves as a header, providing links for each of the website
// pages. The script will be called by each page.

// Start an output buffer and a session.
// Sessions refresh when new page is loaded and expire after
// 30 minutes of inactivity.
ob_start();
session_start();

if (!isset($_SESSION['sessCreated'])) {
   
    $_SESSION['sessCreated'] = time();
    
} else if (time() - $_SESSION['sessCreated'] > 1800) {
    
    session_regenerate_id(true);    
    $_SESSION['sessCreated'] = time();  
    
} 

?>

<!DOCTYPE html><html>
    
<head>
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" type="text/css" href="layout-styles.css">
</head>

<div id="navbar">

<p style="float:left"> 
<?php if( $page_title != 'Home') {
	// If the user is on the home page, do not show a button for the home page.
	echo '<a href="index.php"><img border="0" alt="home" src="buttons/btn_home.png" /></a> ';
}
	// Some buttons display for everyone.
?>
        
        <a href="viewruns.php"><img border="0" alt="viewdata" src="buttons/btn_viewdata.png" /></a> 
        <a href="submitdata.php"><img border="0" alt="submitdata" src="buttons/btn_submitdata.png" /></a> 
        <a href="search.php"><img border="0" alt="search" src="buttons/btn_search.png" /></a>
	</p>

<?php // Change what other buttons appear based on whether user is logged in.
echo '<p style="float:right">';
if (isset($_SESSION['accountID'])) {
echo '<a href="account.php" title="Account"><img border="0" alt="account" src="buttons/btn_account.png" /></a> ';
echo '<a href="logout.php" title="Logout"><img border="0" alt="logout" src="buttons/btn_logout.png" /></a>';
} else {
echo '<a href="register.php" title="Register"><img border="0" alt="register" src="buttons/btn_register.png" /></a> ';
echo '<a href="login.php" title="Login"><img border="0" alt="login" src="buttons/btn_login.png" /></a>';
}
echo '</p><br /><br />';
?>
</div><br />
<div id="content" align="center">

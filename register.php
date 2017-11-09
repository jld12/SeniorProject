<?php

// This page allows a user who is not logged in to register.
// If a logged-in user tries to access this page, he or she will be redirect to the home page.

if (!isset($_SESSION['accountID'])) {

$page_title = 'Register';
include('includes/header.php');

// Connect to the database.
require('includes/mysqli_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Connect to the database.
	require('includes/mysqli_connect.php');
    
    // Trim data.
    $trimmed = array_map('trim', $_POST);
    $un = $em = $pw = $cpw = FALSE;
    
    // Check username.
    if (preg_match ('/^[A-Z \'.-]{2,15}$/i', $trimmed['username'])) {
		$un = mysqli_real_escape_string ($dbc, $trimmed['username']);
} else {
	echo '<p class="error" style="color:red"><b>Invalid username.</b></p>';
}
	
	// Check email.
if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
	$em = mysqli_real_escape_string ($dbc, $trimmed['email']);
} else {
	echo '<p class="error" style="color:red"><b>Invalid email.</b></p>';
}
	
	// Check password, verify matching passwords.
if (preg_match ('/^\w{4,30}$/', $trimmed['pw']) ) {
	if ($trimmed['pw'] == $trimmed['cpw']) {
		$pw = mysqli_real_escape_string ($dbc, $trimmed['pw']);
		$saltpw = password_hash($pw, PASSWORD_DEFAULT);
	} else {
		echo '<p class="error" style="color:red"><b>Passwords do not match.</b></p>';
	}
} else {
		echo '<p class="error" style="color:red"><b>Invalid password.</b></p>';
	}
	
	// Check security.
	if (preg_match ('/^[A-Z \'.-]{2,30}$/i', $trimmed['security'])) {
		$se = mysqli_real_escape_string ($dbc, $trimmed['security']);
	} else {
		echo '<p class="error" style="color:red"><b>Invalid security phrase.</b></p>';
	}
	
	if ($_POST['formQName'] == 'Seabed Exploration'){
		$qu = TRUE;
	} else {
		echo '<p class="error" style="color:red"><b>Wrong quest selected. The terms of use can be accessed via the help page.</b></p>';
		$qu = FALSE;
	}
	
	// Continue if fields entered correctly.
	if ($un && $em && $pw && $se && $qu) {
	    
	    // Verify email and username available.
	    $q = "SELECT accountEM FROM accounts WHERE accountEM='$em'";
	    $r = mysqli_query ($dbc, $q) or trigger_error("Email does not exist.");
	    
	    // Email available -- check username.
	    if ($r == FALSE || mysqli_num_rows($r) == 0) {
	        
	        $q = "SELECT accountUN FROM accounts WHERE accountUN='$un'";
	        $r = mysqli_query ($dbc, $q) or trigger_error("UN does not exist.");
	        
	        // Username and email evailable.
	        if ($r == FALSE || mysqli_num_rows($r) == 0){
	            
	            // Add new user to db.
	            $q = "INSERT INTO accounts (accountUN, accountEM, accountPW, accountSE, accountRD) VALUES ('$un', '$em', '$saltpw', '$se', '" . date("Y-m-d") . "' )";
	            $r = mysqli_query($dbc, $q);
	            
	            // If user added...
	            if (mysqli_affected_rows($dbc) == 1) {
	                
	                echo '<h1>Thank you for registering!</h1><br />';
	                echo '<h3>Continue to browse or <a href="login.php">log in here.</a></h3><br />';
	                include ('includes/footer.php');
	                exit();
	                	                
	            } 
	            
	        } else { // If username taken...
	            echo '<p class="error" style="color:red"><b>That username is already taken. Please try again or <a href="contact.php">contact an administrator</a></b></p>';
	        }
	        
	    } else { // If email is taken...
	        echo '<p class="error" style="color:red"><b>That email address is already taken. Please try again or <a href="contact.php">contact an administrator</a> if you think this message is in error.</b></p>';
	    }
	    
	} else { // If something was wrong with the entered fields...
	    echo '<p class="error"><b>Please try again.</b></p>';
	}
	
	// Close connection.
	mysqli_close($dbc);
    
} } else {

$url = '/index.php';
ob_end_clean();
header("Location: $url");
exit();

}

?>

<h1>Register</h1>

<div id="registration" align="center">

<p>Note: Registration requires a unique name and email address, in addition to a security phrase. This phrase should be something you will remember well, and can be used to recover your account in case you forget your password or lose control of your account.</p>
<form action="register.php" method="post">
    <fieldset>
    
    <table class="form">
    
    <tr><td><p><b>Username:</b></td><td><input type="text" name="username" size="15" maxlength="15" value="<?php if (isset($trimmed['username'])) echo $trimmed['username']; ?>" /> </td></p></tr>
    <tr><td><p><b>Email:</b></td><td><input type="text" name="email" size="30" maxlength="30" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" /> </td></p></tr>
    <tr><td><p><b>Password:</b></td><td><input type="password" name="pw" size="30" maxlength="30" value="<?php if (isset($trimmed['pw'])) echo $trimmed['pw']; ?>" /> </td></p></tr>
    <tr><td><p><b>Confirm password:</b></td><td><input type="password" name="cpw" size="30" maxlength="30" value="<?php if (isset($trimmed['cpw'])) echo $trimmed['cpw']; ?>" /> </td></p></tr>
    <tr><td><p><b>Security phrase:</b></td><td><input type="text" name="security" size="15" maxlength="15" value="<?php if (isset($trimmed['security'])) echo $trimmed['security']; ?>" /> </td></p></tr>
    
   <tr><td><p><b>Which quest is on the <a href="termsofuse.php">ToU</a> page?</b></td><td> 
   
<?php
$q = "SELECT questNM FROM quests"; 
$r = mysqli_query($dbc, $q);

echo "<select name='formQName' >";
echo "<option size='40' value=''>Select...</option>";

while ($row = mysqli_fetch_array($r)) {
	echo "<option value='" . $row['questNM'] . "'>" . $row['questNM'] . "</option>";
}
echo "</select><br /></td></tr>";
?>

    </table></fieldset><br />
    <div align="center"><input type="submit" name="submit" value="Register">
    <p>Already have an account? <a href="login.php">Log in here.</a></p><br />
    </div>
</form>


</div>

<?php include('includes/footer.php'); ?>
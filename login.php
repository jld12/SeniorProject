<?php

// Set title of page and add the header.
$page_title = 'Login';
include ('includes/header.php');

// If the user is not logged in, proceed to check for form submission.
if (!isset($_SESSION['accountID'])) {

// If the user submits the form, continue.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Connect to the database.
    require ('includes/mysqli_connect.php');
    
    // Check if email not entered; save it if entered.
    if (!empty($_POST['email'])) {
        $em = mysqli_real_escape_string($dbc, $_POST['email']);
    } else { // If email not entered, alert user.
        $em = FALSE;
        echo '<p class="error" style="color:red"><b>No email entered.</b></p>';
    }
    
    // Check if password not entered; save it if entered.
    if (!empty($_POST['password'])) {
        $pw = mysqli_real_escape_string($dbc, $_POST['password']);
        
    } else { // If password not entered, alert user.
        $pw = FALSE;
        echo '<p class="error" style="color:red"><b>No password entered.</b></p>';
    }
    
    // Continue if both fields entered.
    if ($em && $pw){
        
        // Verify that both email and password match up to an account in the account table and get
        // basic information for the session.
        $q = "SELECT accountPW FROM accounts WHERE accountEM='$em'";
        $r = mysqli_query($dbc, $q) or trigger_error(mysqli_error($dbc));
        
        while ($row = mysqli_fetch_object($r)) {
	$hpw = $row->accountPW;
	}
        
        if (password_verify($pw, $hpw)) {
        
        	$q = "SELECT accountID, accountUN, accountEM, accountTY FROM accounts WHERE accountEM='$em'";
        	$r = mysqli_query($dbc, $q) or trigger_error(mysqli_error($dbc));	
        
	        if ($r != FALSE && mysqli_num_rows($r) == 1){
	            
	            // Pass the accountID, accountUN, and accountTY to the session information.
	            $_SESSION = mysqli_fetch_array($r, MYSQLI_ASSOC);
	            // Clear $r and close the DB connection.
	            mysqli_free_result($r);
	            mysqli_close($dbc);
	            
	            // Redirect the user to the home page.
	            $url = '/index.php';
	            ob_end_clean();
	            header("Location: $url");
	            exit();
	            
	        } else { // If information does not match up to an account, alert the user.
	            echo '<p class="error" style="color:red"><b>Unable to login. Please check your credentials and try again.</b></p>';
	        } 
	 } 
        
    } else { // If one or more fields not entered, alert the user to try again.
        echo '<p class="error"><b>Please try again.</b></p>';
    }
    
    // Close connection to the DB.
    mysqli_close($dbc);
    
} } else { // If a user is logged in, redirect them to the home page.
// Someone who is logged in already has no need to log in again.

// Redirect to home page.
$url = '/index.php';
ob_end_clean();
header("Location: $url");
exit();

}


?>

<h1>Login</h1>

<div id="login" align="center">

<p>Logging into this site requires cookies.</p>
<form action="login.php" method="post">
    <fieldset>
        
        <table class="form">
        <tr><td><p><b>Email address:</b></td><td><input type="text" name="email" size="30" maxlength="30" /></td></p></tr>
        <tr><td><p><b>Password:</b></td><td><input type="password" name="password" size="30" maxlength="30" /></td></p></tr>
    	</table>
    
    </fieldset>
</div><br />    
    <input type="submit" name="submit" value="Login" /><br /><br />
    
</form>


<?php include ('includes/footer.php'); ?>
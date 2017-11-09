<?php

// This form enables the user to change his or her password.

$page_title = 'Change Password';
include ('includes/header.php');

if (isset($_SESSION['accountID'])) {
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$dbc = @mysqli_connect('localhost', 'PhanOnSelAlt', 'PASSWORD', 'PhantasyOnline');
	
	$trimmed = array_map('trim', $_POST);
    	$un = $em = $pw = $cpw = FALSE;
	
	$userID = $_SESSION['accountID'];
	$em = $_SESSION['accountEM'];
	
	// If all fields entered.
	if(!empty($_POST['cpw']) && !empty($_POST['npw']) && !empty($_POST['vpw'])) { 
	
	$pw = mysqli_real_escape_string ($dbc, $trimmed['cpw']);
	
	$q = "SELECT accountPW FROM accounts WHERE accountEM='$em'";
        $r = mysqli_query($dbc, $q) or trigger_error(mysqli_error($dbc));
        
        while ($row = mysqli_fetch_object($r)) {
	$hpw = $row->accountPW;
	}

		// If current password field correct.
		if(password_verify($pw, $hpw) && false !== $r) {
		
			$q = "SELECT accountID, accountUN FROM accounts WHERE accountID='$userID'";
			$r = mysqli_query($dbc, $q);
		
			// If new and verify password match.
			if($trimmed['npw'] == $trimmed['vpw']) {
			
			$pw = mysqli_real_escape_string ($dbc, $trimmed['npw']);
			$saltpw = password_hash($pw, PASSWORD_DEFAULT);
			
			// Alter database to change password.
			$q = "UPDATE accounts SET accountPW='$saltpw' WHERE accountID='$userID'";
			$r = mysqli_query($dbc, $q);
			
			if(mysqli_affected_rows($dbc) == 1){
				echo '<p style="color:green"><b>Password updated!</b></p>';
			} else {
				echo '<p class="error" style="color:red"><b>Unable to change password--check your credentials and try again.</b></p>';	
			}
			
			} else { // New and verify password do not match.
				echo '<p class="error" style="color:red"><b>Passwords do not match!
 Try again.</b></p>';	
			}		
		
		} else { // Current password incorrect.
			echo '<p class="error" style="color:red"><b>Unable to change password--check your credentials and try again.</b></p>';	
		}
		
	} else { // Not all fields entered.
		echo '<p class="error" style="color:red"><b>Empty fields!</b></p>';
	}
	
}
	
} else { // If user not logged in, redirect to login page.
$url = '/login.php';
ob_end_clean();
header("Location: $url");
exit();

}

// If something entered incorrectly, fields will retain typed information.

?>

<h1>Change Your Password</h1>

<div class="form" align="center"><fieldset>

<form action="changepassword.php" method="post">
<table id="form_changepass">
<tr><td><p><b>Current Password: </b></td><td><input type="password" name="cpw" size="30" maxlength="30" value="<?php if (isset($trimmed['cpw'])) echo $trimmed['cpw']; ?>" /></td></p></tr>
<tr><td><p><b>New Password: </b></td><td><input type="password" name="npw" size="30" maxlength="30" value="<?php if (isset($trimmed['npw'])) echo $trimmed['npw']; ?>" /> </td></p></tr>
<tr><td><p><b>Verify Password: </b></td><td><input type="password" name="vpw" size="30" maxlength="30" value="<?php if (isset($trimmed['vpw'])) echo $trimmed['vpw']; ?>" /> </td></p></tr>
<tr><td colspan="2"><div align="center"><input type="submit" name="submit" value="Change Password"></td></tr></div>
</table></form><br />

</fieldset></div><br />

<?php

include ('includes/footer.php');

?>

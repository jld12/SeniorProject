<?php

// This page allows admins to view and remove users. It displays basic, nonsensitive data on each user.

$page_title = 'View Users';
include('includes/header.php');

$dbc = @mysqli_connect('localhost', 'PhanOnSelDel', '24398yLo493dr2d2@t', 'PhantasyOnline');

// If delete button pressed, remove user.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$accountNum = $_POST['delete'];
	$dq = "DELETE FROM accounts WHERE accountID = '$accountNum'";
	$r = mysqli_query($dbc, $dq);
	
	if ($r) {
	echo '<p>User deleted successfuly.</p>';
	} else {
	echo '<p class="error" style="color:red">Something went wrong.</p>';
	}
}

// Make sure user viewing page is logged in as an admin.
if (isset($_SESSION['accountID']) && $_SESSION['accountTY'] == '69')  {
	
echo '<h1>Registered Users</h1>';
		
$q = "SELECT accountID AS UserID, accountUN AS Username, accountRD AS RegisterDate FROM accounts ORDER BY accountID ASC";
$r = mysqli_query($dbc, $q);
		
if (false !== $r) {
	
	$num = mysqli_num_rows($r);
		
	if ($num > 0) {
    
    	// Display user data.
    
		echo '<fieldset><table align="center">
		<tr>
		<td align="center"><b>ID</b></td>
		<td align="center"><b>Username</b></td>
		<td align="center"><b>Date Registered</b></td>
		<td align="center"><b>Delete User</b></td>
		</tr>';
    
		while ($row = mysqli_fetch_object($r)) {
    
		echo '<tr> 
		<td align="center">' . $row->UserID . '</td> 
		<td align="center">' . $row->Username . '</td> 
		<td align="center">' . $row->RegisterDate . '</td> 
		<td align="center"><form method="post" action="viewusers_admin.php" ><button type="submit" name="delete" value="' . $row->UserID . '">Delete</button></form></td>
		</tr>';
    
		}
		echo '</table></fieldset><br />';
		include('includes/footer.php');  
    		}
    
	} else {
    
}			
	
} else {
	
	// If not admin, redirect to home page.
	
	$url = '/login.php';
	ob_end_clean();
	header("Location: $url");
	exit();

}

?>

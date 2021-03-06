<?php

// This page is the admin view for quest runs. Here the admin can delete runs.

$page_title = 'View All Data Admin';
include ('includes/header.php');

// Ensure the user is logged into an admin account.
if (isset($_SESSION['accountID']) && $_SESSION['accountTY'] == '69')  {
	
echo '<h1>Quest Runs</h1>';

$dbc = @mysqli_connect('localhost', 'PhanOnSelDel', 'PASSWORD', 'PhantasyOnline');

$q = "SELECT questRuns.runID AS RunNum, 
questRuns.runEX AS Experience, 
questRuns.runMS AS Meseta, 
questRuns.runDF AS Difficulty, 
accounts.accountUN AS Username, 
quests.questNM AS QuestName, 
questRuns.runTM AS RunTime, 
questRuns.questID AS QuestNum 
FROM ((questRuns INNER JOIN quests ON questRuns.questID = quests.questID) 
INNER JOIN accounts ON questRuns.accountID = accounts.accountID)";

// If button pressed...
// Delete - delete the quest run
// Sort - sort the table data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

if (isset($_POST['delete'])) {
$runNum = $_POST['delete'];
$dq = "DELETE FROM questRuns WHERE runID = '$runNum'";
$r = mysqli_query($dbc, $dq);
	
if ($r) {
echo '<p>Run deleted successfully.</p>';
} else {
echo mysqli_error($dbc);
echo '<p class="error" style="color:red">Something went wrong.</p>';
}

} 

if (isset($_POST['QuestName'])) { 
$order = 'QuestName ASC';
$q .= ' ORDER BY ' . $order;
}

if (isset($_POST['Username'])) { 
$order = 'Username DESC';
$q .= ' ORDER BY ' . $order;
}

if (isset($_POST['Difficulty'])) { 
$order = 'Difficulty DESC';
$q .= ' ORDER BY ' . $order;
} 

if (isset($_POST['Experience'])) { 
$order = 'Experience DESC'; 
$q .= ' ORDER BY ' . $order;
} 

if (isset($_POST['Meseta'])) { 
$order = 'Meseta DESC'; 
$q .= ' ORDER BY ' . $order;
}

if (isset($_POST['RunTime'])) { 
$order = 'RunTime ASC'; 
$q .= ' ORDER BY ' . $order;
}

}

$r = mysqli_query($dbc, $q);

if (false != $r) {

$num = mysqli_num_rows($r);

if ($num > 0) {

// Buttons for sorting the table.
echo '<form name="Sort" method="post">';
echo '
<p>Sort by: 
<button type="submit" name="QuestName" value="QuestName">Quest Name</button>  
<button name="Username" value="Username">Username</button>  
<button name="Difficulty" value="Difficulty">Difficulty</button>  
<button name="Experience" value="Experience">Experience</button>  
<button name="Meseta" value="Meseta">Meseta</button>
<button name="RunTime" value="RunTime">Run Time</button>';
echo '</form>';

// Headers for data.
echo '<fieldset><table align="center" style="border-spacing: 15px 0">
<tr>
<td align="center"><b>Quest Name</b></td>
<td align="center"><b>Username</b></td>
<td align="center"><b>Run Difficulty</b></td>
<td align="center"><b>Experience Gained</b></td>
<td align="center"><b>Meseta Gained</b></td>
<td align="center" colspan="2"><b>Run Time</b></td>
<td align="center"><b>Delete Run</b></td>
</tr>';

while ($row = mysqli_fetch_object($r)) {

// Display quest runs.
echo '
<tr> 
<td align="center"><a href="questinfo.php?qn='. $row->QuestNum .'">' . $row->QuestName . '</a></td> 
<td align="center">' . $row->Username . '</td> 
<td align="center">' . $row->Difficulty . '</td>
<td align="center">' . $row->Experience . '</td> 
<td align="center">' . $row->Meseta . '</td>  
<td align="center">' . (floor(($row->RunTime)/60)) . 'm</td>
<td align="center">' . (($row->RunTime) - ((floor(($row->RunTime)/60))*60)) . 's</td>
<td align="center"><form method="post" action="viewruns_admin.php" ><button type="submit" name="delete" value="' . $row->RunNum . '">Delete</button></form></td>
</tr>';

}

echo '</table></fieldset><br />';
include('includes/footer.php');  

} }

// If user not logged in, redirect to home page.
 } else {

$url = '/login.php';
ob_end_clean();
header("Location: $url");
exit();

}
 
     
?>

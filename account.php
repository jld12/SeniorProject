<?php
$page_title = 'Account';
include ("includes/header.php");

// If the user is logged in, display their account page.
// The account page shows their user name, has a link for changing their password and submitting data,
// and shows a list of personal quest runs.
// If the user is an admin, it shows links to admin pages instead.

if (isset($_SESSION['accountID'])) {

if ($_SESSION['accountTY'] == 1) {

require ('includes/mysqli_connect.php');

echo '<h1>Hello, ' . $_SESSION['accountUN'] . '.</h1>';
echo '<p><h2><a href="changepassword.php">Change Password</a></h2></p>';
echo '<p><h2><a href="submitdata.php">Submit Data</a></h2></p>';

echo '<h1>Your Quest Runs:</h1><fieldset>';

$q = "SELECT questRuns.runEX AS Experience, questRuns.runMS AS Meseta, questRuns.runDF AS Difficulty, accounts.accountUN AS Username, quests.questNM AS QuestName, questRuns.runTM AS RunTime, questRuns.questID AS QuestNum FROM ((questRuns INNER JOIN quests ON questRuns.questID = quests.questID) INNER JOIN accounts ON questRuns.accountID = accounts.accountID) WHERE accounts.accountUN = '" . $_SESSION['accountUN'] . "'";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Logic for buttons to sort table.
if (isset($_POST['QuestName'])) { 
$order = 'QuestName ASC';
}

if (isset($_POST['Difficulty'])) { 
$order = 'Difficulty DESC';
} 

if (isset($_POST['Experience'])) { 
$order = 'Experience DESC'; 
} 

if (isset($_POST['Meseta'])) { 
$order = 'Meseta DESC'; 
}

if (isset($_POST['RunTime'])) { 
$order = 'RunTime ASC'; 
}

$q .= ' ORDER BY ' . $order;

} 

$r = mysqli_query($dbc, $q);
if (false != $r) { $num = mysqli_num_rows($r);

if ($num > 0) {

// Buttons to sort table.
echo '<form name="Sort" method="post">';
echo '<p>Sort by: 
<button type="submit" name="QuestName" value="QuestName">Quest Name</button>  
<button name="Difficulty" value="Difficulty">Difficulty</button>  
<button name="Experience" value="Experience">Experience</button>  
<button name="Meseta" value="Meseta">Meseta</button>
<button name="RunTime" value="RunTime">Run Time</button></p>';
echo '</form>';

echo '<table align="center" style="border-spacing: 15px 0">
<tr>
<td align="center"><b>Quest Name</b></td>
<td align="center"><b>Run Difficulty</b></td>
<td align="center"><b>Experience Gained</b></td>
<td align="center"><b>Meseta Gained</b></td>
<td align="center" colspan="2"><b>Run Time</b></td>
</tr>';

while ($row = mysqli_fetch_object($r)) {

// Display personal quest run data.
echo '
<tr> 
<td align="center"><a href="questinfo.php?qn='. $row->QuestNum .'">' . $row->QuestName . '</a></td> 
<td align="center">' . $row->Difficulty . '</td>
<td align="center">' . $row->Experience . '</td> 
<td align="center">' . $row->Meseta . '</td>  
<td align="center">' . (floor(($row->RunTime)/60)) . 'm</td>
<td align="center">' . (($row->RunTime) - ((floor(($row->RunTime)/60))*60)) . 's</td>
</tr>';
}

echo '</table></fieldset><br />';
include ("includes/footer.php");

}  }

// Display different account page for admins.
} else {
echo '<h1>Hello, ' . $_SESSION['accountUN'] . '.</h1>';
echo '<p><h2><a href="changepassword.php">Change Password</a></h2></p>';
echo '<p><h2><a href="viewruns_admin.php">View Runs</a></h2></p>';
echo '<p><h2><a href="viewusers_admin.php">View Users</a></h2></p><br />';

include ("includes/footer.php");
}


// If they are not logged in, redirect them to the login page.
} else {

$url = '/login.php';
ob_end_clean();
header("Location: $url");
exit();

}

?>
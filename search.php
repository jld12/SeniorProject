<?php

// This page houses various search functions.

$page_title = 'Search For Quest';
include ('includes/header.php');
require('includes/mysqli_connect.php');

// If searching by quest name...
if (isset($_POST['questName'])) {
if (!empty($_POST['formQName'])) {
 
	$questName = $_POST['formQName'];
	
	$q = "SELECT questID FROM quests WHERE questNM ='$questName'";
	$r = mysqli_query($dbc, $q);
	
	if ($r != FALSE) { 
		$questResult = mysqli_fetch_array($r);
		$questNum = $questResult['questID'];
		
		$url = '/questinfo.php?qn='. $questNum;	
		ob_end_clean();
		header("Location: $url");
		exit();	
} } }

// If searching for quest by zone...
if (isset($_POST['questZone'])) {
if (!empty($_POST['formZNameQuest'])) {

	$zoneName = $_POST['formZNameQuest'];

	echo '<h1>Quests in ' . $zoneName . '</h1>';
	
	$q = "SELECT zoneID FROM zones WHERE zoneNM = '$zoneName'";
	$r = mysqli_query($dbc, $q);
	
	while ($row = mysqli_fetch_object($r)) {
	$zoneNum = $row->zoneID;
	}
	
	$q = "SELECT questID, questNM FROM quests INNER JOIN zones ON zones.zoneID = quests.zoneID WHERE quests.zoneID = '$zoneNum'";
	$r = mysqli_query($dbc, $q);
	
	if ($r != FALSE){
		
		if (mysqli_num_rows($r) == 0) {
		
		echo 'Nothing was found. If you see this message, please notify an administrator.';
			
		} else {
		
		// Display results.
		
		echo '<p><h2><a href="search.php">Search Again</a></h2></p>
		<fieldset><table align="center" style="border-spacing: 15px 0">
		<tr><td align="center"><b>Quest Name</b></td></tr>';
		
		while ($row = mysqli_fetch_object($r)) {
		echo '<tr> <td align="center"><a href="questinfo.php?qn='. $row->questID .'">' . $row->questNM. '</a></td> </tr>';
		} echo '</table><br /></fieldset><br />';
		
		include ('includes/footer.php');
		exit();
		}
	}
} }

// If searching by client order name...
if (isset($_POST['clientOrder'])) {
if (!empty($_POST['formCOName'])) {

	$clientName = $_POST['formCOName'];
	
	$q = "SELECT clientID FROM clientOrders WHERE clientNM = '$clientName'";
	$r = mysqli_query($dbc, $q);
	
	if ($r != FALSE) { 
	
	$clientResult = mysqli_fetch_array($r);
	$clientNum = $clientResult['clientID'];
	
	// Open client order page, pass client order id
	$url = '/clientorderinfo.php?cn=' . $clientNum;
	ob_end_clean();
	header("Location: $url");
	exit();	
	}
} }

// If searching by NPC...
if (isset($_POST['npc'])) {
if (!empty($_POST['formNPC'])) {

	$npcName = $_POST['formNPC'];
	
	$q = "SELECT npcID FROM npcs WHERE npcNM = '$npcName'";
	$r = mysqli_query($dbc, $q);
	
	if ($r != FALSE) { 
	
	$npcResult = mysqli_fetch_array($r);
	$npcNum = $npcResult['npcID'];
	
	// Open npc page, pass npc id
	$url = '/npcinfo.php?pn=' . $npcNum;
	ob_end_clean();
	header("Location: $url");
	exit();	
	}
} }

// If searching for client order by zone...
if (isset($_POST['coZone'])) {
if (!empty($_POST['formZNameCO'])) {

	$zoneName = $_POST['formZNameCO'];

	echo '<h1>Client Orders in ' . $zoneName . '</h1>';
	
	$q = "SELECT zoneID FROM zones WHERE zoneNM = '$zoneName'";
	$r = mysqli_query($dbc, $q);
	//$zoneNum = mysqli_fetch_array($r);
	
	while ($row = mysqli_fetch_object($r)) {
	$zoneNum = $row->zoneID;
	}

	$q = "SELECT clientOrders.clientID, clientOrders.clientNM, clientOrders.clientMS, clientOrders.clientEX FROM 
	((clientOrders INNER JOIN zoneClientOrders ON clientOrders.clientID = zoneClientOrders.clientID)
	INNER JOIN zones ON zoneClientOrders.zoneID = zones.zoneID) 
	WHERE zones.zoneID = '$zoneNum'";
	$r = mysqli_query($dbc, $q);
	
	if ($r != FALSE){
		
		if (mysqli_num_rows($r) == 0) {
			echo 'Nothing was found. If you see this message, please notify an administrator.';
		} else {
		
		// Display results.
		
		echo '<p><h2><a href="search.php">Search Again</a></h2></p>';
		
		echo '<fieldset><table align="center" style="border-spacing: 15px 0">
		<tr>
		<td align="center"><b>Client Order Name</b></td>
		<td align="center"><b>Meseta</b></td>
		<td align="center"><b>Experience</b></td>
		</tr>';
		
		while ($row = mysqli_fetch_object($r)) {
		
		echo '<tr> 
		<td align="center"><a href="clientorderinfo.php?cn='. $row->clientID .'">' . $row->clientNM . '</a></td> 
		<td align="center">' . $row->clientMS . '</a></td> 
		<td align="center">' . $row->clientEX . '</a></td> 
		</tr>';
		
		} echo '</table><br /></fieldset><br />';
		
		include ('includes/footer.php');
		exit();
		}
	} 
}
}



// Below is search forms.

?>
<h1>Browse PSO2 Information</h1>

<fieldset>
<h2>SEARCH FOR A QUEST</h2>

<h3>Search by quest name.</h3>
<?php 
// Select an individual quest name from a drop down.
// Populate a dropdown list with quests from the DB.
$q = "SELECT questNM, questID FROM quests"; $r = mysqli_query($dbc, $q);

echo "<form method='post' name='questName'>
<select name='formQName' ><option size='40' value=''>Select...</option>";

while ($row = mysqli_fetch_array($r)) {
	echo "<option value='" . $row['questNM'] . "'>" . $row['questNM'] . "</option>";
}

echo "</select><input type='submit' name='questName' value='Search' /></form><br />";
?> 


<h3>Search for a quest by the zone.</h3>
<?php 
// Select an individual zone from a drop down.
// Populate a dropdown list with zones from the DB.
$q = "SELECT zoneNM, zoneID FROM zones"; $r = mysqli_query($dbc, $q);

echo "<form method='post' name='questZone'>
<select name='formZNameQuest' ><option size='40' value=''>Select...</option>";

while ($row = mysqli_fetch_array($r)) {
	echo "<option value='" . $row['zoneNM'] . "'>" . $row['zoneNM'] . "</option>";
}
echo "</select><input type='submit' name='questZone' value='Search' /></form><br />";
?> 

<hr />

<h2>SEARCH FOR A REPEATABLE CLIENT ORDER</h2>

<h3>Search for a specific client order.</h3>
<?php 
// Select an individual client order name from a drop down.
// Populate a dropdown list with COs from the DB.
$q = "SELECT clientNM, clientID FROM clientOrders"; $r = mysqli_query($dbc, $q);

echo "<form method='post' name='clientOrder'>
<select name='formCOName' ><option size='40' value=''>Select...</option>";

while ($row = mysqli_fetch_array($r)) {
	echo "<option value='" . $row['clientNM'] . "'>" . $row['clientNM'] . "</option>";
}
echo "</select><input type='submit' name='clientOrder' value='Search' /></form><br />";
?> 

<h3>Search by NPC.</h3>
<?php 
// Select an individual npc name from a drop down.
// Populate a dropdown list with npcs from the DB.
$q = "SELECT npcNM, npcID FROM npcs"; $r = mysqli_query($dbc, $q);

echo "<form method='post' name='npc'>
<select name='formNPC' ><option size='40' value=''>Select...</option>";

while ($row = mysqli_fetch_array($r)) {
	echo "<option value='" . $row['npcNM'] . "'>" . $row['npcNM'] . "</option>";
}
echo "</select><input type='submit' name='npc' value='Search' /></form><br />";
?>

<h3>Search for client orders in a zone.</h3>
<?php 
// Select an individual zone from a drop down.
// Populate a dropdown list with zones from the DB.
$q = "SELECT zoneNM, zoneID FROM zones"; $r = mysqli_query($dbc, $q);

echo "<form method='post' name='coZone'>
<select name='formZNameCO' ><option size='40' value=''>Select...</option>";

while ($row = mysqli_fetch_array($r)) {
	echo "<option value='" . $row['zoneNM'] . "'>" . $row['zoneNM'] . "</option>";
}
echo "</select><input type='submit' name='coZone' value='Search' /></form><br />";
?>

</fieldset>
<br />

<?php
include ('includes/footer.php');
?>
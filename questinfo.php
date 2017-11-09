<?php

// This page is dedicated to quests.

$page_title = 'View Quest Info';
include ('includes/header.php');
require ('includes/mysqli_connect.php');

$questNum = $_GET['qn'];

$q = "SELECT zones.zoneID FROM zones INNER JOIN quests on zones.zoneID = quests.zoneID WHERE questID='$questNum'";
$r = mysqli_query($dbc, $q);
while ($row = mysqli_fetch_object($r)) {
$zoneNum = $row->zoneID;
}

$q = "SELECT quests.questDS, quests.questNM, zones.zoneID, zones.zoneNM FROM quests INNER JOIN zones ON zones.zoneID = quests.zoneID WHERE questID ='$questNum'";
$r = mysqli_query($dbc, $q);

if (false != $r) {

$row = mysqli_fetch_object($r);

// Display basic quest information.
echo '<h1>' . $row->questNM . '</h1>';
echo '<h3><b>Zone:</b> ' . $row->zoneNM . '</h3>';
echo '<h3><b>Objective:</b> ' . $row->questDS . '</h3>';
}

// Show a list of runs of this quest, sorted by fastest run time.
$q = "SELECT questRuns.runEX AS Experience, questRuns.runMS AS Meseta, questRuns.runDF AS Difficulty, accounts.accountUN AS Username, quests.questID AS QuestNum, quests.questNM AS QuestName, questRuns.runTM AS RunTime, questRuns.questID AS QuestNum FROM ((questRuns INNER JOIN quests ON questRuns.questID = quests.questID) INNER JOIN accounts ON questRuns.accountID = accounts.accountID) WHERE quests.questID = '$questNum' ORDER BY RunTime ASC";

$r = mysqli_query($dbc, $q);

if (false != $r) {

$num = mysqli_num_rows($r);

if ($num > 0) {

echo '<h1> Runs of this Quest: </h1>';

// Headers for table.
echo '<fieldset><table align="center" style="border-spacing: 15px 0">
<tr>
<td align="center"><b>Username</b></td>
<td align="center"><b>Run Difficulty</b></td>
<td align="center"><b>EXP Gained</b></td>
<td align="center"><b>Meseta Gained</b></td>
<td align="center" colspan="2"><b>Run Time</b></td>
<td align="center"><b>Meseta Per Min</b></td>
</tr>';

while ($row = mysqli_fetch_object($r)) {

// Display data.
echo '
<tr>  
<td align="center">' . $row->Username . '</td> 
<td align="center">' . $row->Difficulty . '</td>
<td align="center">' . $row->Experience . '</td> 
<td align="center">' . $row->Meseta . '</td>  
<td align="center">' . (floor(($row->RunTime)/60)) . 'm</td>
<td align="center">' . (($row->RunTime) - ((floor(($row->RunTime)/60))*60)) . 's</td>
<td align="center">' . (floor(($row->Meseta)/(($row->RunTime)/60))) . '</td>
</tr>';

} echo '</table></fieldset>';

} } else {echo mysqli_error($dbc);}

// Provide a list of client orders in the same zone.
echo '<h1>Client Orders In Same Zone:</h1>';

echo '<form name="Sort" method="post">';
echo '<p>Sort by: 
<button name="CONSort" value="ClientName">Client Order Name</button>  
<button name="NPCSort" value="NPCName">NPC Name</button>  
<button name="MESSort" value="Meseta">Meseta</button>
<button name="EXPSort" value="EXP">Experience</button></p>';
echo '</form>';

$q = "SELECT DISTINCT 
	clientOrders.clientID AS ClientNum, 
	clientOrders.clientNM AS ClientName, 
	npcs.npcNM AS NPCName, 
	npcs.npcID,
	clientOrders.clientMS AS Meseta, 
	clientOrders.clientEX AS EXP, 
	zoneClientOrders.zoneID
	
	FROM (( clientOrders 
	INNER JOIN npcs ON npcs.npcID = clientOrders.npcID) 
	INNER JOIN zoneClientOrders ON zoneClientOrders.clientID = clientOrders.clientID)
	WHERE zoneClientOrders.zoneID = '$zoneNum'";

// If button pressed to sort, sort the client orders.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

if (isset($_POST['CONSort'])) { 
$order = 'ClientName ASC';
} 

if (isset($_POST['NPCSort'])) { 
$order = 'NPCName ASC'; 
} 

if (isset($_POST['MESSort'])) { 
$order = 'Meseta DESC'; 
}

if (isset($_POST['EXPSort'])) { 
$order = 'EXP DESC'; 
}

$q .= ' ORDER BY ' . $order;

}

// Display the client orders.
echo '<fieldset><table align="center" style="border-spacing: 15px 0">

<tr>
<td align="center"><b>Client Order</b></td>
<td align="center"><b>NPC</b></td>
<td align="center"><b>Meseta Reward</b></td>
<td align="center"><b>EXP Reward</b></td>
</tr>';

$r = mysqli_query($dbc, $q);

if (false != $r) {

while ($row = mysqli_fetch_object($r)) {

echo '
<tr> 
<td align="center"><a href="clientorderinfo.php?cn='. $row->ClientNum .'">' . $row->ClientName . '</a></td>
<td align="center"><a href="npcinfo.php?pn=' . $row->npcID .'">' . $row->NPCName . '</a></td>
<td align="center">' . $row->Meseta . '</td> 
<td align="center">' . $row->EXP . '</td>  
</tr>';

}

echo '</table></fieldset><br /><br />';

}

include ('includes/footer.php');
?>
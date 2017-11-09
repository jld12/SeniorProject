<?php

// On this page, one can view client order information.

$page_title = "View Client Order Info";
include ('includes/header.php');
require ('includes/mysqli_connect.php');

$clientNum = $_GET['cn'];

$q = "SELECT clientOrders.clientDS, clientOrders.clientNM, clientOrders.clientMS, clientOrders.clientEX, zones.zoneNM, zones.zoneID, npcs.npcID, npcs.npcNM FROM (((clientOrders INNER JOIN zoneClientOrders ON zoneClientOrders.clientID = clientOrders.clientID) INNER JOIN zones ON zones.zoneID = zoneClientOrders.zoneID) INNER JOIN npcs ON clientOrders.npcID = npcs.npcID) WHERE clientOrders.clientID = '$clientNum'";
$r = mysqli_query($dbc, $q);

if (false != $r) {

$row = mysqli_fetch_object($r);

$zoneNum = $row->zoneID;

echo '<h1>' . $row->clientNM . '</h1>';
echo '<h3><b>Zone:</b> ' . $row->zoneNM . '</h3>';
echo '<h3><b>Meseta:</b> ' . $row->clientMS . '</h3>';
echo '<h3><b>EXP:</b> ' . $row->clientEX . '</h3>';
echo '<h3><b>NPC:</b><a href="npcinfo.php?pn=' . $row->npcID . '"> ' . $row->npcNM . '</a></h3>';
echo '<h3><b>Objective:</b> ' . $row->clientDS . '</h3>';
}

// Display quests in the same zone.
echo '<h1>Quests In Same Zone:</h1>';

echo '<form name="Sort" method="post">';
echo '<p>Sort by: 
<button name="QuestSort" value="QuestName">Quest Name</button></p>';
echo '</form>';

$q = "SELECt questNM AS QuestName, questID AS QuestNum FROM quests WHERE zoneID = '$zoneNum'";

// If button pressed to sort, sort.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

if (isset($_POST['QuestSort'])) { 
$order = 'QuestName ASC';
}

$q .= ' ORDER BY ' . $order;

} 

// Display list of quests.
echo '<fieldset>
<div class="datatable">
<table align="center" style="border-spacing: 15px 0">

<tr>
<td align="center"><b>Quest</b></td>
</tr>';

$r = mysqli_query($dbc, $q);

if (false == $r) { echo mysqli_error($dbc); echo $q; } else {

while ($row = mysqli_fetch_object($r)) {

echo '
<tr><td align="center"><a href="questinfo.php?qn='. $row->QuestNum .'">' . $row->QuestName . '</a></td> </tr>';

}
echo '</table></div></fieldset><br /><br />';
}

include ('includes/footer.php');
?>
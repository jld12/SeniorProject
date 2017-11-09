<?php

// On this page, users can view basic NPC info.

$page_title = 'View NPC Info';
include ('includes/header.php');
require ('includes/mysqli_connect.php');

$npcNum = $_GET['pn'];

$q = "SELECT npcNM FROM npcs WHERE npcID = '$npcNum'";
$r = mysqli_query($dbc, $q);

if (false != $r) {

$row = mysqli_fetch_object($r);

$npcName = $row->npcNM;

echo '<h1>Repeatable Client Orders By ' . $npcName . ':</h1>';

}

// Buttons to sort table.
echo '<form name="Sort" method="post">';
echo '<p>Sort by: 
<button name="CONSort" value="ClientName">Client Order Name</button>   
<button name="MESSort" value="Meseta">Meseta</button>
<button name="EXPSort" value="EXP">Experience</button>';

// One NPC offers client orders in any zone. In that case, don't show zone.
if ($npcNum == 1){

$q = "SELECT clientOrders.clientID AS ClientNum, clientOrders.clientNM AS ClientName, clientOrders.clientMS AS Meseta, clientOrders.clientEX AS EXP
	FROM (clientOrders INNER JOIN npcs ON clientOrders.npcID = npcs.npcID)
	WHERE npcs.npcID = '$npcNum'";
	
	echo '</form>';

} else {

$q = "SELECT clientOrders.clientID AS ClientNum, clientOrders.clientNM AS ClientName, clientOrders.clientMS AS Meseta, clientOrders.clientEX AS EXP, zones.zoneNM AS ZoneName
	FROM (((clientOrders INNER JOIN npcs ON clientOrders.npcID = npcs.npcID) 
	INNER JOIN zoneClientOrders ON zoneClientOrders.clientID = clientOrders.clientID)
	INNER JOIN zones ON zones.zoneID = zoneClientOrders.zoneID)
	WHERE npcs.npcID = '$npcNum'";
	
	echo '<button name="ZONSort" value="ZoneName">Zone Name</button></p></form>';
	
}

// If button pressed to sort, do so.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

if (isset($_POST['CONSort'])) { 
$order = 'ClientName ASC';
} 

if (isset($_POST['MESSort'])) { 
$order = 'Meseta DESC'; 
} 

if (isset($_POST['EXPSort'])) { 
$order = 'EXP DESC'; 
}

if (isset($_POST['ZONSort'])) { 
$order = 'ZoneName ASC'; 
}

$q .= ' ORDER BY ' . $order;

}

// Display client orders.
echo '<fieldset><table align="center" style="border-spacing: 15px 0">

<tr>
<td align="center"><b>Client Order</b></td>
<td align="center"><b>Meseta Reward</b></td>
<td align="center"><b>EXP Reward</b></td>';

if ($npcNum != 1){
echo '<td align="center"><b>Zone Name</b></td>';
}

echo '</tr>';

$r = mysqli_query($dbc, $q);

if (false != $r) {

while ($row = mysqli_fetch_object($r)) {

echo '
<tr> 
<td align="center"><a href="clientorderinfo.php?cn='. $row->ClientNum .'">' . $row->ClientName . '</a></td>
<td align="center">' . $row->Meseta . '</td> 
<td align="center">' . $row->EXP . '</td>';

if ($npcNum != 1){ 
echo '<td align="center">' . $row->ZoneName . '</td>';
}

echo '</tr>';

}

echo '</table></fieldset><br />';

}

include ('includes/footer.php');

?>
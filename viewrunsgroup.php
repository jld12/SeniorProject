<?php

// With this page, one can view average quest run data.

$page_title = 'View Grouped Data';
include ('includes/header.php');
	
echo '<h1>Average Quest Runs</h1>';
require ('includes/mysqli_connect.php');

$q = "SELECT ROUND( AVG(questRuns.runTM),0 ) AS RunTime, ROUND( AVG(questRuns.runEX),0 ) AS Experience, ROUND( AVG(questRuns.runMS),0 ) AS Meseta, quests.questNM AS QuestName, quests.questID AS QuestNum, questRuns.accountID FROM ((questRuns INNER JOIN quests ON questRuns.questID = quests.questID) INNER JOIN accounts ON questRuns.accountID = accounts.accountID) GROUP BY questNM";

// If button pressed, sort table.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

if (isset($_POST['QuestName'])) { 
$order = 'QuestName ASC';
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

if (false != $r) {

$num = mysqli_num_rows($r);

if ($num > 0) {

// Buttons for sorting the table.
echo '<form name="Sort" method="post">';
echo '<p>Sort by: <button type="submit" name="QuestName" value="QuestName">Quest Name</button>
<button name="Experience" value="Experience">Experience</button>
<button name="Meseta" value="Meseta">Meseta</button>
<button name="RunTime" value="RunTime">Run Time</button></p>';
echo '</form>';

// Headers for table data.
echo '<fieldset><table align="center" style="border-spacing: 15px 0">
<tr>
<td align="center"><b>Quest Name</b></td>
<td align="center"><b>Avg Experience Gained</b></td>
<td align="center"><b>Avg Meseta Gained</b></td>
<td align="center" colspan="2"><b>Avg Time</b></td>
<td align="center"><b>Meseta Per Min</b></td>
</tr>';

while ($row = mysqli_fetch_object($r)) {

// Display average data.
echo '
<tr> 
<td align="center"><a href="questinfo.php?qn='. $row->QuestNum .'">' . $row->QuestName . '</a></td> 
<td align="center">' . $row->Experience . '</td> 
<td align="center">' . $row->Meseta . '</td>
<td align="center">' . (floor(($row->RunTime)/60)) . 'm</td>
<td align="center">' . (($row->RunTime) - ((floor(($row->RunTime)/60))*60)) . 's</td> 
<td align="center">' . (floor(($row->Meseta)/(($row->RunTime)/60))) . '</td> 
</tr>';

}

echo '</table></fieldset><br />';
include('includes/footer.php');  

} }
 
     
?>
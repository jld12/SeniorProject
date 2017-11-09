<?php

// This is the form for data submission.
// Quest options are populated via database.

$page_title = 'Submit Data';
include ('includes/header.php');
require ('includes/mysqli_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

if (!isset($_SESSION['accountID'])) {

} else {

$trimmed = array_map('trim', $_POST);

// If quest not selected, difficulty not selected, time not entered, both experience and mes methods empty...
if( !empty($_POST['formQName']) && !empty($_POST['formDifficulty']) && !empty($_POST['timeMinutes']) && (!empty($_POST['expTotal']) || (!empty($_POST['expStart']) && !empty($_POST['expEnd']))) && ( !empty($_POST['mesTotal']) || (!empty($_POST['mesStart']) && !empty($_POST['mesEnd'])))){

// Save user.
$questAcct = $_SESSION['accountID'];

// Save quest name; get questID.
$questName = $_POST['formQName'];

$q = "SELECT questID FROM quests WHERE questNM ='$questName'";
$r = mysqli_query($dbc, $q);

if ($r != FALSE) { 
	$questResult = mysqli_fetch_array($r);
	$questNum = $questResult['questID'];
}

// Save difficulty.
$questDiff = $_POST['formDifficulty'];

// Save time.
$questTime = ( ($_POST['timeMinutes'] * 60) + ($_POST['timeSeconds']) ); 

// If start and end, calculate and save experience.
if ( !empty($_POST['expStart']) && !empty($_POST['expEnd']) ){

$expStart = $_POST['expStart']; $expEnd = $_POST['expEnd'];
$expTotal = $expEnd - $expStart;

} else { // Else save total.

$expTotal = $_POST['expTotal'];

}

// If start and end, calculate and save meseta.
if ( !empty($_POST['mesStart']) && !empty($_POST['mesEnd']) ){

$mesStart = $_POST['mesStart']; $mesEnd = $_POST['mesEnd'];
$mesTotal = $mesEnd - $mesStart;

} else { // Else save meseta.

$mesTotal = $_POST['mesTotal'];

}

// Insert entered values into database.
$q = "INSERT INTO questRuns (runEX, runMS, runDF, runTM, accountID, questID) VALUES ('$expTotal', '$mesTotal', '$questDiff', '$questTime', '$questAcct', '$questNum')";
$r = mysqli_query($dbc, $q);
	            
if (mysqli_affected_rows($dbc) == 1) {
	echo 'Insert successful.';
} else {
	echo 'Something went wrong.';
}

} else {

echo '<p class="error"><b>Missing fields--please try again.</b></p>';

}

}
}

?>

<h1>Submit Data</h1>
<?php
if (!isset($_SESSION['accountID'])) {
	echo '<p class="error" style="color:red"><b>Data submission requires an account. <a href="/login.php">Log in</a> to submit.</b></p>';
} else {
	echo '<p class="error"><b>Data submitted will be linked to your account.</b></p>';
}
?>
<h4>Can't find the quest you're looking for? <a href="http://phantasy.online/contact.php">Drop me a message</a>.</h4>
<div id="submitdata" align="center">
</h3>
<fieldset>
<form action="submitdata.php" method="post">
<table class="form"><tr><td colspan="2">

<fieldset style="border:0px">
<table class="form">
<td><p><b>Quest:</b></td><td>
<?php
// Populate drop down list with quests from database.
$q = "SELECT questNM FROM quests"; $r = mysqli_query($dbc, $q);

echo "<select name='formQName' >";
echo "<option size='40' value=''>Select...</option>";

while ($row = mysqli_fetch_array($r)) {
	echo "<option value='" . $row['questNM'] . "'>" . $row['questNM'] . "</option>";
}
echo "</select><br />";

// Below are tables that allow the user to submit data.
?></td>
</p></tr>

<tr><td style="width:250px"><p><b>Difficulty:</b></td><td>
<select name="formDifficulty">

  <option value="">Select...</option>
  <option value="Normal">Normal</option>
  <option value="Hard">Hard</option>
  <option value="Very Hard">Very Hard</option>
  <option value="Super Hard">Super Hard</option>
  <option value="Extreme Hard">Extreme Hard</option>

</select></td></p></tr>

<tr><td><p><b>Time Taken: </b></td><td><input name="timeMinutes" type="number" maxlength="3" style="width: 5em"/> Minutes <input name="timeSeconds" type="number" maxlength="2" style="width: 5em"/> Seconds </td></p></tr></table></fieldset></tr>

<tr><td colspan="2"><fieldset>

<table class="form">
<tr><td style="width:250px"><p><b>Experience Gained: </b></td><td><input name="expTotal" type="number"/> </td></p></tr>
<tr><td colspan="2"><p>OR</td></p></tr>
<tr><td><p><b>Beginning Experience: </b></td><td><input name="expStart" type="number"/> </td></p></tr>
<tr><td><p><b>Ending Experience: </b></td><td><input name="expEnd" type="number"/> </td></p></tr>
</table>
</fieldset><br /></td></tr>

<tr><td colspan="2"><fieldset>

<table class="form">
<tr><td style="width:250px"><p><b>Meseta Gained: </b></td><td><input name="mesTotal" type="number"/> </td></p></tr>
<tr><td colspan="2"><p>OR</p></tr>
<tr><td><p><b>Beginning Meseta: </b></td><td><input name="mesStart" type="number"/> </td></p></tr>
<tr><td><p><b>Ending Meseta: </b></td><td><input name="mesEnd" type="number"/> </td></p></tr>
</table>

</fieldset></td></tr></table>

</fieldset><br />

<div align="center"><input type="submit" name="submit" value="Submit Data"></div><br />

</form>
</div>

<?php

include ('includes/footer.php');

?>
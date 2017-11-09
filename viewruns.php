<?php

// Page for selecting type of quest run view.
// Users can view all quest runs or view them grouped by quest.

$page_title = 'View Quest Run Data';
include ("includes/header.php");
?>

<p><h1>View Quest Data</h1><p>
<fieldset>
<p><h2><a href="viewrunsall.php">Separate Runs</a></h2></p>
<h4>View the range of submitted run data.</h4>
<hr>
<p><h2><a href="viewrunsgroup.php">View All Grouped By Quest</a></h2></p>
<h4>Figure out what to expect from an average run.</h4>
</fieldset><br />

<?php
include ("includes/footer.php");
?>
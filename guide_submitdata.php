<?php

// An in-depth guide for submitting data.

$page_title = 'Data Submission Guide';
include ('includes/header.php');
?>

<h1>How to Submit Data</h1>
<h4>Follow these steps if you'd like to contribute to the site's run data.</h4>

<fieldset>
<h3>Step 1: Either click on the 'submit data' link or head to <a href="http://phantasy.online/submitdata.php">phantasy.online/submitdata.php.</a></h3>
<img src="guideimages/guide_submitdata_1.png" border="4"/>
<p>Note that continuing to submit data requires one to both <a href="register.php">register for an account</a> and <a href="login.php">to log in to the account</a>. On the data submission page is a form with various boxes for data entry and selection.</p><br />
<hr>
<h3>Step 2: Find the quest you ran in the drop down.</h3>
<img src="guideimages/guide_submitdata_2.png" border="4"/>
<p>Quests available for run submissions are present in the dropdown list that you can select from. They are sorted by the zone that they are in. For example, if the quest is in the forest, it will show up towards the top, whereas if the quest is in Las Vegas, it will be towards the bottom.</p><br />
<hr>
<h3>Step 3: Choose a difficulty.</h3>
<img src="guideimages/guide_submitdata_3.png" border="4"/>
<p>Which difficulty did you run the quest on? Choose from the drop down list of difficulties.</p><br />
<hr>
<h3>Step 4: Enter time taken.</h3>
<img src="guideimages/guide_submitdata_4.png" border="4"/>
<p>Using a <a href="http://ipadstopwatch.com/full-screen-stopwatch.html">stopwatch</a> or other methods, note how long the quest run took. Time is separated into minutes and seconds. Can't remember how long it took? A rough estimate is acceptable, though keep in mind that suspect times are subject to removal.</p><br />
<hr>
<h3>Step 5: Enter meseta and experience gained.</h3>
<img src="guideimages/guide_submitdata_5.png" border="4"/>
<p>There are two options for both meseta and experience, and you can use either option for either item. You can either calculate how much of one or both you gained and enter that in the first box, or enter your starting and ending balances and the calculations will be done for you.</p><br />
<hr>
<h3>Step 6: Submit.</h3>
<img src="guideimages/guide_submitdata_6.png" border="4"/>
<p>Finally, hit the submit button! If you are <a href="login.php">logged in</a>, the data will be entered into the database, and will show up on the <a href="viewruns.php">run view pages</a>! Many thanks for helping contribute to the site. Your effort is appreciated.</p><br />


</fieldset><br />


<?php
include ('includes/footer.php');
?>
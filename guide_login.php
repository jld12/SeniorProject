<?php

// A quick guide to logging in.

$page_title = 'Login Guide';
include ('includes/header.php');
?>

<h1>How to Login</h1>
<h4><a href="guide_register.php">Just made an account</a> and want to log in? Follow this guide to learn how.</h4>

<fieldset>
<h3>Step 1: Either click on the 'login' link or head to <a href="http://phantasy.online/login.php">phantasy.online/login.php.</a></h3>
<img src="guideimages/guide_login_1.png" border="4"/>
<p>Here you will see a form with two fields to enter. Either login on your own, or continue through the guide if you're not sure what goes in each field.</p><br />
<hr>
<h3>Step 2: Enter information into the fields.</h3>
<img src="guideimages/guide_login_2.png" border="4"/>
<p>Your <b>email</b> is the email that you used to register to the site with. Emails used on the site are unique. Secondly, enter the <b>password</b> you set for your account. <a href="phantasy.online/changepassword.php">Passwords can be changed at any time.</a></p><br />
<hr>
<h3>Step 3: Click Login.</h3>
<img src="guideimages/guide_login_3.png" border="4"/>
<p>At the bottom of the login form is the submit button, labelled 'Login'. Use this to submit your fields and log in to the site. Red text will pop up to notify you in the event that one of your fields is entered incorrectly.</p>
<p>There are several things you can do while logged in, including <a href="guide_submitdata.php">submitting data</a>, <a href="guide_viewdata.php">viewing data</a>, <a href="guide_browsequest.php">browsing quests</a>, <a href="guide_browsenpc.php">browsing npcs</a>, <a href="guide_browseco.php">browsing client orders</a>, and  <a href="guide_changepassword.php">logging out</a>. To log out, simply click on the 'Logout' link that is viewable at any time when logged in. <b>Some features are unavailable when logged in, such as registration. To access these features, log out first.</b></p>
</fieldset><br />


<?php
include ('includes/footer.php');
?>
<?php

// A simple index that explains the website.

require ('includes/mysqli_connect.php');
$page_title = 'Home';
include ('includes/header.php');

?>

<h1>Phantasy Online</h1>
<h2>An Online Collection of PSO2 Quest Data</h2>

<fieldset>
<p><h3>Welcome to Phantasy Online.</h3></p>
<div align="left">
<p>As an English-speaking player of the Japanese MMORPG Phantasy Start Online 2, I grew dismayed at how daunting it was to get started. It seemed like there were so many options of what to do at any given time. Sure, I wanted meseta and experience, but I had no clue what quests were the best for that. From what I've heard from the community, nobody is ever really sure.</p>
<p>So, I thought, why not make a site for just that--figuring out, on average, what quests are the best for meseta or experience, or even what quests are good when you're on a tight schedule. This site gathers quest data and compiles it to show both averaged data and individual data so you can view both what to expect on an average run and the full range of what has been entered. The more data entered, the more accurate the averages will become.</p><hr>
<p><b>If you have any critique, advice, or questions, feel free to travel to <a href="http://phantasy.online/contact.php">Help>Contact</a> and let me know.</b></p>
</div><hr>
<img src="mountains.jpeg" alt="mountains" height="250" width="460">
</fieldset><br />

<?php include ('includes/footer.php'); ?>
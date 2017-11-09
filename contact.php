<?php

// This form allows a user to contact me through my email.

$page_title = 'Contact';
include ('includes/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])){
	
		$trimmed = array_map('trim', $_POST);
	
		// Make sure the email is valid.
		if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
			
		// Create and send the email.
		$body = "User: {$_POST['name']}\n\nMessage: {$_POST['message']}";
		mail('jenndaniel94@gmail.com', 'Contact Form Submission', $body, "From: {$_POST['email']}");
			
		echo '<p style="color:green">
		<b>Mail sent successfully. An administrator will contact as soon as possible.</b>
		</p>';
			
		$_POST = array();
			
		} else {
			echo '<p class="error" style="color:red"><b>Invalid email.</b></p>';
		}
	
	} else {
	
		echo '<p class="error" style="color:red"><b>Contact form incomplete! Please try again.</b></p>';
	
	}
}

// Below is the form for contacting, as well as a link to my Google+ for anyone to contact me.
// If something goes wrong with the form, it keeps the field contents.

?>

<h1>Contact an Administrator</h1>
<h3>Comments? Concerns? Use this form.</h3>
<h3>If you are having issues, <a href="https://plus.google.com/u/0/102824810959445054109"> you can also contact me here.</a></h3>
<div id="contact" align="center">


<form action="contact.php" method="post">
<fieldset><table class="form">
	<tr><td><p><b>Name or Username:</b></td><td><input type="text" name="name" size="30" maxlength="30" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" /></td></p></tr>
	<tr><td><p><b>Email Address:</b></td><td><input type="text" name="email" size="30" maxlength="30" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></td></p></tr>
	<tr><td><p><b>Message:</b></td><td><textarea name="message" rows="5" cols="30" value="<?php if (isset($_POST['message'])) echo $_POST['message']; ?>"></textarea></td></p></tr>
	<tr><td colspan="2"><div align="center"><p><input type="submit" name="submit" value="Send" /></div></td></p></tr>
</table></fieldset>
</form><br />
</div>

<?php

include ('includes/footer.php');

?>
<?php
	if (!isset($mailchimp_button)) {
		$mailchimp_button = "Inscriere la newsletter";
	}
?>

<!-- Begin MailChimp Signup Form -->
<form action="http://smuff.us5.list-manage.com/subscribe/post?u=95ca3987b6e9b0c1d25211911&amp;id=4622c90106" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">	
  <input class="text" type="email" name="EMAIL"  value="" id="mce-EMAIL" placeholder="Adresa Dvs. de email" required>
  <br/>
  <input class="button" type="submit" value="<?php echo $mailchimp_button ?>" name="subscribe" id="mc-embedded-subscribe" >
</form>
<!--End mc_embed_signup-->

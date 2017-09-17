	<h1>Options</h1>
	

<style>
	input[type=text], input[type=url] {
		display: block;
		max-width: 90%;
		width: 600px;
	}
	label{
		display: block;
		font-weight: bold;
		margin-bottom: 15px;
		margin-top: 25px;
	}
</style>

<form method="post" action="options.php">
	<h2>Boutons réseaux sociaux</h2>
	<? wp_nonce_field('update-options'); ?>
	<label>Facebook</label>
	<input type="url" name="facebook" id="facebook" value="<? echo get_option('facebook'); ?>">

	<label>Twitter</label>
	<input type="url" name="twitter" id="twitter" value="<? echo get_option('twitter'); ?>">

	<label>Instagram</label>
	<input type="url" name="instagram" id="instagram" value="<? echo get_option('instagram'); ?>">

	<label>Pinterest</label>
	<input type="url" name="pinterest" id="pinterest" value="<? echo get_option('pinterest'); ?>">
	
	<label>Linkedin</label>
	<input type="url" name="linkedin" id="linkedin" value="<? echo get_option('linkedin'); ?>">


<!-- Mise à jour des valeurs -->
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="facebook, twitter, instagram, pinterest,linkedin" />

<!-- Bouton de sauvegarde -->
<p>
<input type="submit" value="<?php _e('Save Changes'); ?>" />
</p>
</form>

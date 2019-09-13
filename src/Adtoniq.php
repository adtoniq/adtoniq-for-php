<?php include('Adtoniq.class.php'); ?>
<?php
	// Adtoniq config
	$adtoniq_config = array(
		'apiKey' => ''
	);

	// Create new Adtoniq class object
	$adtoniq = new Adtoniq($adtoniq_config);

	// This function fetches the required Javascript
	$adtoniq->getLatestJavaScript();
?>

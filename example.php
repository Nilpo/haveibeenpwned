<?php

require(__DIR__ . '/vendor/autoload.php');

$result[] = "No results";

if (isset($_POST['account']) && !empty($_POST['account'])) {
	$account = trim($_POST['account']);

	try {
		$result = \HIBP\HIBP::getAllBreaches($account);
	}
	catch (\Exception $e) {
		$result[0] = $e->getMessage();
	}
}

?>

<form method="POST" action="">
	<input id="account" name="account" type="text" placeholder="Email or user name">
	<button id="submit" name="submit" type="submit" value="Submit">Have I Been Pwned?</button>
</form>

<pre>
<?php

if (count($result) == 1) :
	print_r($result[0]);
else :
	var_dump($result);
endif;

?>
</pre>
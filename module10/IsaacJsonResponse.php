<?php declare(strict_types=1);

/*
 * CSD440: Server Side Scripting
 * Module 10: JSON
 *   Assignment 2: Programming Assignment
 * Isaac Ellingson
 * 10/3/2026
 *
 * Main assignment notes in IsaacJsonForm.php
 */

// Prevent floats from getting serialized with massive amounts of unnecessary precision
ini_set('serialize_precision', '2');

function clean(string $inputName, array|false $enumeratedValues = false): string {
	if (!isset($_POST[$inputName])) return "";
	$result = trim(stripslashes(htmlspecialchars($_POST[$inputName])));
	if ($enumeratedValues !== false) {
		if (!in_array($result, $enumeratedValues)) {
			header("Location: IsaacJsonForm.php?error");
			exit;
		}
	}
	return $result;
}

function jsonFromForm(): string|false {
	if ($_SERVER['REQUEST_METHOD'] !== "POST") return false;
	// Technically we could do this, but I want to do some validation and type conversion instead:
	//if ($_POST) return json_encode($_POST);
	
	try {
		$result = [];
		$result['min-level'] = (int) clean('level');
		$result['name'] = clean('name');
		$result['element'] = clean('element', ['fire', 'frost', 'lightning', 'earth']);
		$result['damage'] = (int) clean('damage');
		$result['damage-type'] = clean('damageType', ['instant', 'dot']);
		$result['cast-time'] = (float) clean('castTime');
		$result['cooldown-time'] = (float) clean('cooldownTime');
		$result['dispel-type'] = clean('dispelType', ['magic', 'curse', 'disease', 'poison', 'enrage']);
		$result['debuff'] = isset($_POST['isDebuff']);
		return json_encode($result, JSON_PRETTY_PRINT);
	} catch (Exception $ex) {
		header("Location: IsaacJsonForm.php?error");
		exit;
	}
}


$json = jsonFromForm();
if ($json === false) {
	header("Location: IsaacJsonForm.php?error");
	exit;
}

?>
<html>
<head>
	<link rel="stylesheet" href="IsaacJson.css">
</head>
<body>
<section>
	<h1>CSD440 Module 10: JSON</h1>
	<h2>Json created successfully.</h2>
	<pre><code><?= htmlspecialchars($json) ?></code></pre>
	<a href="IsaacJsonForm.php" class="button">Back to Form</a>
</section>
</body>
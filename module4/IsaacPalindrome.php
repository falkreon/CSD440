<?php declare(strict_types=1); ?>
<!--

CSD440: Server-Side Scripting
Module 4.2 Programming Assignment
Isaac Ellingson
8/30/2026

Includes a function that determines if a string is a palindrome. Demonstrates the function on three
palindromes and three non-palindromes.
-->
<?php
/**
 * Detects palindromes. Does this by comparing the string to its reversed counterpart.
 * @return true if $str is a palindrome, otherwise false.
 */
function isPalindrome(string $str): bool {
	return $str == strrev($str);
}

// Examples alternate between non-palindromes and palindromes
$examples = [
	"test",
	"racecar",
	"not_a_palindrome",
	"rotor",
	"things",
	"deified"
];

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>CSD440 Module 4</title>
		<style>
			body { font-family:sans-serif };
		</style>
	</head>
	<body>
		<h1>CSD440: Module 4.2 Programming Assignment</h1>
		<h3>Is it a palindrome?</h3>
		<?php
		foreach($examples as $example) {
			// Note: A <br /> "requirement" was not stated within the four corners of the
			//       assignment text, so it has been deliberately ignored.
		?>
			<p><?= $example ?>: <?= isPalindrome($example)?'YES':'NO'; ?>
		<?php
		}
		?>

	</body>
</html>

<!DOCTYPE html>
<?php
/**
 * CSD440: Server Side Scripting
 * Module 7: PHP Forms
 *   Assignment 2: Programming Assignment
 * Isaac Ellingson
 * 9/13/2026
 *
 * Presents the user with a form with 7 input fields, validates those fields, and then
 * displays the fields in a well-formatted results page.
 *
 * In this case, we present a real estate search questionnaire. This form will always
 * produce one result: The Navidson House, a fictional house from the book "House of Leaves",
 * which changes its physical size and layout according to its own tempers and whims. The
 * house shows up in the search with attributes identical to what the user claims to be
 * looking for.
 */
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>CSD440 Module 7</title>
		<style>
		* {
			font-family: sans-serif;
			box-sizing: border-box;
		}

		body {
			margin: 0;
			padding: 0;
			border: 0;
			background: #734;
		}

		section {
			margin: auto auto;
			padding: 40px;
			border: 2px solid #777;
			background: #fff;
			color: #000;

			max-width: 750px;
			margin-top: 100px;
			border-radius: 8px;
			box-shadow: 8px 8px 2px rgba(0,0,0,0.20);
		}

		form {
			margin: 0 40px;
			display: grid;
			grid-template-columns: 1fr 2fr;
			gap: 8px;
		}

		label {
			text-align: right;
			font-weight: bold;
			margin-right: 24px;
		}

		select, ::picker(select) {
			appearance: base-select;
		}

		input, select {
			padding: 12px;
			min-height: 2.5em;
		}

		input:invalid {
			border: 2px solid red;
		}

		input[type="submit"] {
			grid-column: 1 / span 2;
			min-height: 2.5em;
			margin-top: 4em;
		}

		input[type="checkbox"] {
			max-width: 2.5em;
		}

		input[type="color"] {
			height: 40px;
			padding: 2px;
		}

		textarea {
			min-height: 3em;
			max-width: 400px;
		}

		form span {
			grid-column: 1 / span 2;
			text-align: right;
			margin-top: -12px;
		}

		fieldset {
			grid-column: 1 / span 2;
			display: grid;
			justify-content: start;
			align-content: start;
			grid-template-columns: 300px 30px;
		}

		fieldset label {
			max-width: 200px;
		}

		strong {
			font-weight: inherit;
			color: #007;
			text-shadow: 0px 0px 3px rgba(128,188,255,1);
		}

		</style>
	</head>
	<body>
		<section>
		<h1>CSD440 Module 7</h1>
		<h2>Welcome to Ash Tree Apartments</h2>
		<p>Please answer this short questionnaire to help us find the right <strong>house</strong> for you.
		<form method="POST" action="IsaacResponse.php">
			<label for="">Bedrooms</label>
			<input type="number" name="bedrooms" id="bedrooms" min="1" max="12" value="2" required>
			<label for="closet">Closet Space</label>
			<input type="range" name="closet" id="closet" min="0" max="1200" value="24" required
				onChange="document.getElementById('closet_feedback').innerText = document.getElementById('closet').value + ' sq. ft.'">
			<span class="feedback" id="closet_feedback">24 sq. ft.</span>
			<label for="staircase">Bonus Staircase</label>
			<input type="checkbox" name="staircase" id="staircase">
			<label for="usage">Primary Usage</label>
			<select name="usage" id="usage">
				<option value="habitation">Habitation</option>
				<option value="filming">Filming / Streaming</option>
				<option value="exploration">Exploration</option>
			</select>
			<fieldset>
				<legend>I want a lot of room in...</legend>
				<label for="yard">Yard</label><input type="radio" id="yard" name="features" value="yard" checked="checked">
				<label for="livingroom">Living room</label><input type="radio" id="livingroom" name="features" value="livingroom">
				<label for="hallway">Hallway</label><input type="radio" id="hallway" name="features" value="hallway">
				<label for="ashen">Impossibly Old Ashen Corridors</label><input type="radio" id="ashen" name="features" value="ashen">
			</fieldset>
			<label for="color">Interior Paint Color</label>
			<input type="color" name="color" id="color" value='#ffffff' required>
			<label for="special">Special Requests</label>
			<textarea name="special" id="special"></textarea>

			<input type="submit" value="Search">
		</form>
		</section>
	</body>
</html>

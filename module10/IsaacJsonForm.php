<?php declare(strict_types=1);
/*
 * CSD440: Server Side Scripting
 * Module 10: JSON
 *   Assignment 2: Programming Assignment
 * Isaac Ellingson
 * 10/3/2026
 *
 * Displays a form for entering data to convert into JSON. In this case, we're entering in data about a spell.
 *
 * The corresponding IsaacJsonResponse.php validates this data and shows a well-formatted view of the pretty-printed
 * JSON. Make sure you have IsaacJson.css present for proper page layout and styling!
 */

?>
<html>
<head>
	<link rel="stylesheet" href="IsaacJson.css">
</head>
<body>
<section>
	<h1>CSD440 Module 10: JSON</h1>
	
	<h2>Please enter your spell data</h2>
	
	<?php if (isset($_GET['error'])) {
	?>
	<div class="error"><p>There was a problem processing this form. Please try again.</div>
	
	<?php } ?>
	
	<form action="IsaacJsonResponse.php" method="POST">
		<label for="level">Min. Level</label>
		<input type="number" id="level" name="level" min="1" max="50" step="1" value="1">
		
		<label for="name">Name</label>
		<input type="text" id="name" name="name" value="Frost Bolt">
		
		<label for="element">Element</label>
		<select id="element" name="element">
			<option value="fire">Fire</option>
			<option value="frost" selected>Frost</option>
			<option value="lightning">Lightning</option>
			<option value="earth">Earth</option>
		</select>
		
		<label for="damage">Damage</label>
		<input type="number" id="damage" name="damage" min="1" max="10000" step="1" value="110">
		
		<!-- If we had multiple button-groups we'd use a fieldset and really complicate the layout. But we don't,
		     so I'm not going to bother. -->
		<fieldset>
			<legend>Damage Type</legend>
			<label for="damageTypeInstant">Instant</label>
			<input type="radio" id="damageTypeInstant" name="damageType" value="instant" checked required>
			<label for="damageTypeDot">Damage Over Time</label>
			<input type="radio" id="damageTypeDot" name="damageType" value="dot">
		</fieldset>
		
		<label for="castTime">Cast Time (s)</label>
		<input type="number" id="castTime" name="castTime" min="0" max="8" step="0.1" value="2.5" required>
		
		<label for="cooldownTime">Cooldown Time (s)</label>
		<input type="number" id="cooldownTime" name="cooldownTime" min="0" max="300" step="0.1" value="0" required>
		
		<label for="dispelType">Dispel Type</label>
		<select id="dispelType" name="dispelType">
			<option value="magic">Magic</option>
			<option value="curse">Curse</option>
			<option value="disease">Disease</option>
			<option value="poison">Poison</option>
			<option value="enrage">Enrage</option>
		</select>
		
		<label for="isDebuff">Is Debuff?</label>
		<input type="checkbox" id="isDebuff" name="isDebuff" value="true" checked>
		
		<!-- NEED A TOTAL OF 8 FIELDS, NO DATA TYPE RESTRICTIONS. CURRENT: 2 -->
		<input type="submit" class="button" value="Create JSON">
	</form>
	
</section>
</body>
</html>

<?php declare(strict_types=1);
/*
 * CSD440: Server Side Scripting
 * Module 9: Database Forms
 *   Programming Assignment
 * Isaac Ellingson
 * 9/15/2026
 *
 * Form to input new data into the database.
 */
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>CSD440: Module 8</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="IsaacTableStyle.css">
	</head>
	<body>
		<section>
			<?php include('IsaacTableNav.php'); ?>

			<h3>Add a new video game to the database</h3>
			<form class="two-col" method="POST" action="IsaacDoInsert.php">
				<label for="title">Title</label>
				<input type="text" name="title" id="title" required>
				<label for="year">Publication Year</label>
				<input type="number" min="1901" max="2155" value="<?= date('Y') ?>" name="year" id="year" required>
				<label for="genre">Genre</label>
				<input type="text" list="genres" name="genre" id="genre" required>
				<datalist id="genres">
					<option>RPG</option>
					<option>Action RPG</option>
					<option>Tactical RPG</option>
					<option>Action</option>
					<option>Adventure</option>
				</datalist>
				<label for-"developer">Developer</label>
				<input type="text" name="developer" id="developer" required>
				<label for="publisher">Publisher</label>
				<input type="text" list="publishers" name="publisher" id="publisher" required>
				<datalist id="publishers">
					<option>Sega</option>
				</datalist>
				<label for="console">Console</label>
				<input type="text" list="consoles" name="console" id="console" required>
				<datalist id="consoles">
					<option>Master System</option>
					<option>Genesis</option>
					<option>Sega CD</option>
					<option>NES</option>
					<option>SNES</option>
				</datalist>

				<input type="submit" value="Add">
			</form>
		</section>
	</body>
</html>


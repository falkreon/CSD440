<?php declare(strict_types=1);
/*
 * CSD440: Server Side Scripting
 * Module 9: Database Forms
 *   Programming Assignment
 * Isaac Ellingson
 * 9/15/2026
 *
 * Form for searching a VideoGame by name.
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

			<form method="POST" action="IsaacDoSearch.php">
				<label for="search">Search By Game Name:</label>
				<div class="searchbar">
				<input type="search" name="search" id="search">
				<input type="submit" value="Search">
				</div>
			</form>
		</section>
	</body>
</html>


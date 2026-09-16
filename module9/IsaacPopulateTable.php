<?php declare(strict_types=1);
/*
 * CSD440: Server Side Scripting
 * Module 8: MySQL and PHP
 *   Programming Assignment
 * Isaac Ellingson
 * 9/15/2026
 *
 * Populates the VideoGame table. Requires a database config roughly as follows:
 *
 *   DROP DATABASE IF EXISTS baseball_01;
 *   CREATE DATABASE baseball_01;
 *
 *   DROP USER IF EXISTS 'student1'@'localhost';
 *   CREATE USER 'student1'@'localhost' IDENTIFIED BY 'pass';
 *   GRANT SELECT, EXECUTE, INSERT, UPDATE, CREATE, DROP ON `baseball_01`.* TO 'student1'@'localhost';
 *
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

			<?php
			$db = new mysqli(
				hostname: 'localhost',
				username: 'student1',
				password: 'pass',
				database: 'baseball_01'
			);

			try {
				$result = $db->query('USE baseball_01');
				$result &= $db->query('TRUNCATE TABLE VideoGame;'); // I like making every script repeatable
				$result &= $db->query(
					<<<SQL
					INSERT INTO VideoGame ( Id, Title, PublicationYear, Genre, Developer, Publisher, Console )
					VALUES
						( 1, "Beyond Oasis",       1995, "Action RPG",  "Sega",    "Sega", "Genesis"),
						( 2, "Landstalker: The Treasure of King Nole", 1993, "Action RPG", "Climax", "Sega", "Genesis"),
						( 3, "Phantasy Star",      1987, "RPG",         "Sega",    "Sega", "Master System"),
						( 4, "Phantasy Star II",   1989, "RPG",         "Sega",    "Sega", "Genesis"),
						( 5, "Phantasy Star III",  1990, "RPG",         "Sega",    "Sega", "Genesis"),
						( 6, "Phantasy Star IV",   1994, "RPG",         "Sega",    "Sega", "Genesis"),
						( 7, "Shadowrun",          1994, "Action RPG",  "BlueSky", "Sega", "Genesis"),
						( 8, "Shining In The Darkness", 1991, "RPG",    "Climax",  "Sega", "Genesis"),
						( 9, "Shining Force",      1992, "Tactical RPG","Climax",  "Sega", "Genesis"),
						(10, "Shining Force II",   1994, "Tactical RPG","Climax",  "Sega", "Genesis"),
						(11, "Vay",                1994, "RPG",         "Hertz",   "Working Designs", "Sega CD")
					SQL
				);

				if ($result) { ?>
					<p class="success">Table populated successfully. <?= $db->affected_rows ?> Rows created.
				<?php } else { ?>
					<p class="error">Something went wrong.
				<?php }
			} finally {
				$db->close();
			}

			?>
		</section>
	</body>
</html>


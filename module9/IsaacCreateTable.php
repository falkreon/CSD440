<?php declare(strict_types=1);
/*
 * CSD440: Server Side Scripting
 * Module 8: MySQL and PHP
 *   Programming Assignment
 * Isaac Ellingson
 * 9/15/2026
 *
 * A series of four pages that manage a table using MySQLi. Not my favorite API,
 * but there are worse ways to spend your time. The resulting table has three
 * types of data, seven columns, and eleven records, plenty of data to fill a
 * report with. Since I had plenty of extra time, I added a navbar to make it
 * a little easier to flip around and test. Note that all of these scripts are
 * idempotent, so the main remaining error you can intentionally recreate in
 * testing is by going directly from Delete to Populate.
 *
 *
 * Creates the VideoGame table. Requires a database config roughly as follows:
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
				$result &= $db->query('DROP TABLE IF EXISTS VideoGame');
				$result &= $db->query(
					<<<SQL
					CREATE TABLE VideoGame (
						Id INT AUTO_INCREMENT PRIMARY KEY,
						Title VARCHAR(128) NOT NULL,
						PublicationYear YEAR NOT NULL,
						Genre VARCHAR(32) NOT NULL,
						Developer VARCHAR(128) NOT NULL,
						Publisher VARCHAR(128) NOT NULL,
						Console VARCHAR(64) NOT NULL
					)
					SQL
				);
				if ($result) { ?>
					<p class="success">Table created successfully.
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

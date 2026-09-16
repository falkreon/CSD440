<?php declare(strict_types=1);
/*
 * CSD440: Server Side Scripting
 * Module 8: MySQL and PHP
 *   Programming Assignment
 * Isaac Ellingson
 * 9/15/2026
 *
 * Drops the VideoGame table. Requires a database config roughly as follows:
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
				if ($result === false) { ?>
					<p class="error">Something went wrong.
				<?php } else if ($result) { ?>
					<p class="success">Table dropped successfully.
				<?php
				}
			} finally {
				$db->close();
			}

			?>
		</section>
	</body>
</html>

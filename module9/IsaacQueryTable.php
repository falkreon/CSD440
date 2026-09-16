<?php declare(strict_types=1);
/*
 * CSD440: Server Side Scripting
 * Module 8: MySQL and PHP
 *   Programming Assignment
 * Isaac Ellingson
 * 9/15/2026
 *
 * Queries the VideoGame table, displaying all data. Requires a database config roughly as follows:
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
				$result = $db->query('SELECT * FROM VideoGame;'); // I like making every script repeatable

				if ($result === false) { ?>
					<p>Something went wrong.
				<?php } else if ($result) { ?>
					<table>
						<caption>Classic Video Games</caption>
						<thead></tr>
							<td>Id</td>
							<td>Title</td>
							<td>Publication Year</td>
							<td>Genre</td>
							<td>Developer</td>
							<td>Publisher</td>
							<td>Console</td>
						</tr></thead>
						<tbody>
						<?php while($row = $result->fetch_assoc()) { ?>
							<tr>
								<td><?= $row['Id'] ?></td>
								<td><?= $row['Title'] ?></td>
								<td><?= $row['PublicationYear'] ?></td>
								<td><?= $row['Genre'] ?></td>
								<td><?= $row['Developer'] ?></td>
								<td><?= $row['Publisher'] ?></td>
								<td><?= $row['Console'] ?></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>

				<?php
				}
			} finally {
				$db->close();
			}

			?>
		</section>
	</body>
</html>

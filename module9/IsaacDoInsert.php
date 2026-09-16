<?php declare(strict_types=1);
/*
 * CSD440: Server Side Scripting
 * Module 9: Database Forms
 *   Programming Assignment
 * Isaac Ellingson
 * 9/15/2026
 *
 * Script to process the input form and insert a record into the database.
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
				$valid =
					isset($_POST['title']) &&
					isset($_POST['year']) &&
					isset($_POST['genre']) &&
					isset($_POST['developer']) &&
					isset($_POST['publisher']) &&
					isset($_POST['console']) &&
					is_numeric($_POST['year']);

				if ($valid) try {
					$title = $_POST['title'];
					$year = (int) $_POST['year'];
					$genre = $_POST['genre'];
					$developer = $_POST['developer'];
					$publisher = $_POST['publisher'];
					$console = $_POST['console'];
				} catch (Exception $e) {
					$valid = false;
				}

				if (!$valid) { ?>

					<p class="error">There was a problem processing the query.
					</section></body></html>
					<?php
					exit;
				}

				$db = new mysqli(
					hostname: 'localhost',
					username: 'student1',
					password: 'pass',
					database: 'baseball_01'
				);

				try {
					$result = $db->query('USE baseball_01');
					$statement = $db->prepare(
						<<<SQL
						INSERT INTO VideoGame ( Title, PublicationYear, Genre, Developer, Publisher, Console )
						VALUES ( ?, ?, ?, ?, ?, ? )
						SQL
						);
					$statement->bind_param('sissss', $title, $year, $genre, $developer, $publisher, $console);
					$success = $statement->execute();
					if ($success === false) { ?>
						<p class="error">We were unable to insert that data.
						<p><a href="IsaacInsertRecord.php">Try Again</a>
					<?php } else { ?>
						<p class="success">Record inserted successfully.
						<p><a href="IsaacQueryTable.php">Go to Table</a>

					<?php }
				} finally {
					$db->close();
				}
			?>
		</section>
	</body>
</html>

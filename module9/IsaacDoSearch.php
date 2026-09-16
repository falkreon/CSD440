<?php declare(strict_types=1);
/*
 * CSD440: Server Side Scripting
 * Module 9: Database Forms
 *   Programming Assignment
 * Isaac Ellingson
 * 9/15/2026
 *
 * Script to process a VideoGame search and output a pleasing view of the results.
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

			if (!isset($_POST['search'])) {
				?>

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
				$searchTerm = '%' . $_POST['search'] . '%';
				$result = $db->query('USE baseball_01');
				$statement = $db->prepare('SELECT * FROM VideoGame WHERE Title LIKE ?;');
				$statement->bind_param('s', $searchTerm);
				$success = $statement->execute();

				if ($success === false) { ?>
					<p>Something went wrong.
				<?php } else {
					$result = $statement->get_result();
					if ($result->num_rows > 0) { ?>
						<table>
							<caption>Search Results</caption>
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

					<?php } else { ?>
						<p>No results found.

					<?php }
				}
			} finally {
				$db->close();
			}
			?>
			<p><a href="IsaacSearchTable.php">Search Again</a>
		</section>
	</body>
</html>

<?php declare(strict_types=1); ?>
<!--

CSD440: Server-Side Scripting
Module 3.2 Programming Assignment
Isaac Ellingson
8/23/2026

Reusing the table code from Module 2, move the determination of the number at each cell out to a function in an external file.
-->
<?php require_once('mod3_2_function.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>CSD440 Module 2</title>

		<style>
		/* Just enough css that I don't hate the page, not enough for an external file. */
		h1 { text-align: center; margin-bottom: 64px; }

		table {
			border: 1px solid #000;
			border-collapse: collapse;
			margin-left: auto;
			margin-right: auto;
		}

		td {
			border: 1px solid #000;
			padding: 8px;
			min-width: 32px;
			text-align: right;
		}

		table caption {
			border: 1px solid #000;
			padding: 8px;
		}
		</style>
	</head>
	<body>
		<h1>CSD440: Module 3.2 Programming Assignment</h1>

		<table>
			<caption>A small table of random numbers (refresh the page for different numbers)</caption>
			<tbody>
				<?php
				for($i = 1; $i <= 10; $i++) {
					?>
					<tr>
					<?php
					for($j = 1; $j <= 10; $j++) {
						?>
						<td>
						<?php
						// Numbers have been adjusted to keep the totals below 100
						// so the layout stays nice
						echo(my_sum(rand(1,49), rand(1,50)));
						?>
						</td>
						<?php
					}
					?>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		</ul>
	</body>
</html>

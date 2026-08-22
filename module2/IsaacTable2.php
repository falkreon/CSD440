<!--

CSD440: Server-Side Scripting
Module 2.2 Programming Assignment
Isaac Ellingson
8/23/2026

Creates a small (10x10) table of random numbers, carefully avoiding emitting any
html tags from within php statements.
-->

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
		<h1>CSD440: Module 2.2 Programming Assignment</h1>

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
						<?php echo(rand(1,99)); ?>
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

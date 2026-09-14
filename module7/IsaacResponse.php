<!DOCTYPE html>
<?php
/**
 * CSD440: Server Side Scripting
 * Module 7: PHP Forms
 *   Assignment 2: Programming Assignment
 * Isaac Ellingson
 * 9/13/2026
 *
 * Main assignment notes in IsaacForm.php
 */
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CSD440 Module 7</title>
		<style>
		* {
			font-family: sans-serif;
			box-sizing: border-box;
		}

		body {
			margin: 0;
			padding: 0;
			border: 0;
			background: #734;
		}

		section {
			margin: auto auto;
			padding: 40px;
			border: 2px solid #777;
			background: #fff;
			color: #000;

			max-width: 750px;
			margin-top: 100px;
			border-radius: 8px;
			box-shadow: 8px 8px 2px rgba(0,0,0,0.20);
		}

		.result {
			border: 2px solid #777;
			padding: 12px;
		}

		.result em {
			font-size: 0.8em;
			color: #555;
		}

		.result .features {
			margin-left: 3em;
		}

		.button {
			display: inline-block;
			border: 1px solid #000;
			margin: 8px;
			padding: 8px;
			min-width: 200px;
			text-align: center;
			text-decoration: none;
			color: #000;
			background: #FEA;
		}

		strong {
			font-weight: inherit;
			color: #007;
			text-shadow: 0px 0px 3px rgba(128,188,255,1);
		}

		footer {
			display: block;
			background: #eee;
			border: 1px solid #000;
			width: 240px;
			height: 100vh;

			position: absolute;
			left: 0px;
			top: 0px;

			overflow: scroll;
		}

		footer div {
			transform: rotate(-90deg);
			position:relative;
			left: -150px;
			top: 200px;
			width: 800px;
		}

		@media screen and (max-width: 1230px) {
			footer {
				display: none;
			}
		}

		.color {
			display: inline-block;
			width: 32px;
			height: 32px;
			border: 1px solid #000;
			margin-left: 8px;
		}

		</style>
	</head>
	<body>
		<section>
		<h1>CSD440 Module 7</h1>
		<?php
			$valid =
				isset($_POST['bedrooms']) && is_numeric($_POST['bedrooms']) &&
				isset($_POST['closet']) && is_numeric($_POST['closet']) &&
				// Staircase unset is just unchecked
				isset($_POST['usage']) &&
				isset($_POST['features']) && // At least one radio button MUST be unchecked
				isset($_POST['color']) &&
				isset($_POST['special']);

			if ($valid) {
				try {
					$bedrooms = (int) $_POST['bedrooms'];
					if ($bedrooms < 1) $valid = false;
					$closet = (int) $_POST['closet'];
					if ($closet < 1) $valid = false;
					$staircase = isset($_POST['staircase']);
					$usage = $_POST['usage'];
					$features = $_POST['features'];
					$color = $_POST['color'];
					if (preg_match('/^#[A-Fa-f0-9]{6}$/', $color) == false) $valid = false;
					$special = $_POST['special'];
				} catch (Exception $e) {
					$valid = false;
				}
			}


			if (!$valid) {
?>
<p>We're sorry. Something went wrong with your search.
<p><a class="button" href="IsaacForm.php">Try Again</a>

<?php
			} else {
		?>
		<h2>We have just the <strong>house</strong> for you!</h2>
		<p>Number of search results: 1
		<div class="result">
			<h3>The Navidson <strong>House</strong></h3>
			<p>Ash Tree Ln., Virginia
			<p><em>This splendid rural property was once the subject of an award-winning independent documentary, which was reviewed by an award-winning book</em>

			<div class="features">
			<p>Bedrooms: <?= $bedrooms ?>
			<p>Closet Space: <?= $closet ?> sq. ft.
			<p>Bonus Staircase: <?= $staircase ? 'Yes' : 'No' ?>
			<p>Great For: <?= htmlspecialchars(ucwords(strtolower($usage))) ?>
			<p>Lots of space <?php
				switch($features) {
					case 'yard':
						echo('in the front yard.');
						break;
					case 'livingroom':
						echo('in the living room.');
						break;
					case 'hallway':
						echo('in an unusually long hallway.');
						break;
					case 'ashen':
						echo('in nameless, impossibly-old secret ashen corridors.');
						break;
				}
			?>
			<p>Interior Paint Color: <span class="color" style="background-color: <?= $color ?>"></span>
			</div>
		</div>

		<p>Special Requests: <?= htmlspecialchars($special) ?>

		<p><a class="button" href="IsaacForm.php">Search Again</a>


		<?php
		}
		?>
		</section>

		<footer><div>
		<!--
		Source: https://en.wikipedia.org/wiki/House_of_Leaves
		-->
		<p>House of Leaves (stylized with "House" in blue) is the debut novel by American author Mark Z. Danielewski, published in March 2000 by Pantheon Books. A bestseller, it has been translated into a number of languages, and is followed by a companion piece, The Whalestoe Letters.

		<p>The novel is written as a work of epistolary fiction and metafiction focusing on a fictional documentary film titled The Navidson Record, presented as a story within a story discussed in a handwritten monograph recovered by the primary narrator, Johnny Truant. The narrative makes heavy use of multiperspectivity as Truant's footnotes chronicle his efforts to transcribe the manuscript, which itself reveals The Navidson Record's supposed narrative through transcriptions and analysis depicting a story of a family who discovers a larger-on-the-inside labyrinth in their house.

		<p>House of Leaves maintains an academic publishing format with exhibits, appendices, and an index; as well as numerous footnotes including citations from the original author for nonexistent works, interjections and personal anecdotes from the narrator, and notes from the editors to whom he supposedly sent the work for publication. It is also distinguished by convoluted page layouts: some pages contain only a few words or lines of text, arranged to mirror the events in the story. At points, the book must be rotated to be read, making it a prime example of ergodic literature.

		<p>The book is most often described as a horror story, though the author has also endorsed readers' interpretation of it as a love story. House of Leaves has also been described as an encyclopedic novel, or conversely a satire of academia.
		</div></footer>
	</body>
</html>

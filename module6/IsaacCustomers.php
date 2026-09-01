<?php declare(strict_types = 1);

/*
 * CSD440: Server Side Scripting
 * Module 5: Indexed and Associative Arrays
 *   Assignment 2: Programming Assignment
 * Isaac Ellingson
 * 9/6/2026
 *
 * Create an array of ten or more customers and display filtered views of the customer list.
 * This assignment is written badly. If I wanted, I could have written a class like this:

class Customer {
	$firstName;
	$lastName;
	$age;
	$phoneNumber;

	public function __construct($firstName, $lastName, $age, $phoneNumber) {
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->age = $age;
		$this->phoneNumber = $phoneNumber;
	}
}

 * ... and then we wouldn't be demonstrating associative arrays at all. In fact, this is the
 * more natural way to complete the assignment *as written*.
 *
 * So I'm going to add a few more requirements here. First, the Customer MUST be an associative array.
 * Second, there must be three filtered views, each based on a different field in the associative array.
 *
 * Example: All customers over the age of 25, or customers with a (308) area code.
 */

// With that out of the way, let's declare some data! Pretend the following came from somewhere
// important, like a database, but magically we weren't able to filter the data using SQL, *AND* we
// can't use WHERE to filter the data, AND YET we still want the filtering to run on the server side
// for some wildly unusual reason.

$customers = [
	[
		'firstName' => 'Fred',
		'lastName' => 'Saberhagen',
		'age' => 77,
		'phoneNumber' => '(273) 691-2070' // All phone nubmers randomly generated
	],
	[
		'firstName' => 'Arthur',
		'lastName' => 'Clarke',
		'age' => 90,
		'phoneNumber' => '(280) 147-8163'
	],
	[
		'firstName' => 'Philip',
		'lastName' => 'Dick',
		'age' => 53,
		'phoneNumber' => '(338) 587-5618'
	],
	[
		'firstName' => 'Ursula',
		'lastName' => 'Le Guin',
		'age' => 88,
		'phoneNumber' => '(848) 120-1728'
	],
	[ // Unlike other authors in this list, William Gibson yet lives
		'firstName' => 'William',
		'lastName' => 'Gibson',
		'age' => 78,
		'phoneNumber' => '(498) 415-0096'
	],
	[
		'firstName' => 'Octavia',
		'lastName' => 'Butler',
		'age' => 58,
		'phoneNumber' => '(638) 789-1652'
	],
	[
		'firstName' => 'Robert',
		'lastName' => 'Heinlein',
		'age' => 80,
		'phoneNumber' => '(973) 109-2440'
	],
	[
		'firstName' => 'Isaac',
		'lastName' => 'Asimov',
		'age' => 72,
		'phoneNumber' => '(498) 471-1459'
	],
	[
		'firstName' => 'Jules',
		'lastName' => 'Verne',
		'age' => 77,
		'phoneNumber' => '(889) 972-6690'
	],
	[
		'firstName' => 'Herbert',
		'lastName' => 'Wells',
		'age' => 79,
		'phoneNumber' => '(434) 183-2255'
	]
];

// Predicate-filtered arrays - This is the meat of the assignment
$under70 = array_filter(
	$customers,
	function(array $customer) { return $customer['age'] < 70; }
	);

$areaCode498 = array_filter(
	$customers,
	function(array $customer) { return str_starts_with($customer['phoneNumber'], '(498)'); }
	);

$fiveLetterFirstOrLastName = array_filter(
	$customers,
	function(array $customer) {
		return (strlen($customer['firstName']) == 5) || (strlen($customer['lastName']) == 5);
	});

// Pretty-print a customer as a beautiful html5 card
function printCustomer(array $customer): void {
	?>
	<div class='customer'>
	<p><em>First Name: </em><?= $customer['firstName'] ?>
	<p><em>Last Name: </em><?= $customer['lastName'] ?>
	<p><em>Age: </em><?= $customer['age'] ?>
	<p><em>Phone Number: </em><?= $customer['phoneNumber'] ?>
	</div>
	<?php
}

// Everything that follows is just spitting out the information above in a pleasant way
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>CSD440 Module 5</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
		section {
			display: flex;
			flex-direction: row;
			flex-wrap: wrap;
			justify-content: center;
			column-gap: 16px;
			row-gap: 16px;
		}
		.customer {
			display: flex;
			flex-direction: column;
			min-width: 300px;
			padding: 8px;
			border: 1px solid #000;
			border-radius: 6px;
			box-shadow: 5px 5px rgba(0,0,0,0.12);
		}
		h1, h2 { text-align: center; margin-top: 48px; }
		em {
			font-style: normal;
			font-weight: bold;
		}
		p {
			margin: 8px;
		}
		body { margin-bottom: 24px; font-family: sans-serif; color: black; background: white; }
		</style>
	</head>
	<body>
		<h1>CSD440 Module 5: Indexed and Associative Arrays</h1>
		<h2>All Customers</h2>
		<section>
		<?php
		foreach($customers as $customer) {
			printCustomer($customer);
		}
		?>
		</section>

		<h2>All Customers Under 70</h2>
		<section>
		<?php
		foreach($under70 as $customer) {
			printCustomer($customer);
		}
		?>
		</section>

		<h2>All Customers With Area Code 498</h2>
		<section>
		<?php
		foreach($areaCode498 as $customer) {
			printCustomer($customer);
		}
		?>
		</section>

		<h2>All Customers Whose First and/or Last Name Are Five letters</h2>
		<section>
		<?php
		foreach($fiveLetterFirstOrLastName as $customer) {
			printCustomer($customer);
		}
		?>
		</section>
	</body>
</html>

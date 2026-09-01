<?php declare(strict_types = 1);
/**
 * CSD440: Server Side Scripting
 * Module 6: PHP Objects
 *   Assignment 2: Programming Assignment
 * Isaac Ellingson
 * 9/6/2026
 *
 * Creates a boxed int class called MyInteger with getter, setter, and isPrime methods. Then, creates
 * two instances and runs them through a small battery of tests.
 */


class MyInteger {
	private $value = 0;

	public function __construct(int $value = 1) {
		$this->value = $value;
	}

	/**
	 * Tests this MyInteger's internal value for primeness.
	 * @return TRUE if MyInteger's value is prime, otherwise FALSE.
	 */
	public function isPrime(): bool {
		// Well. PHP has no bultin for this, so I guess we're doing it live.
		// Base case. For the sake of brevity we accept all negative numbers as nonprime.
		// There is a case for -1 as prime, but everything else should be good.
		if ($this->value <= 1) return FALSE;

		//Test for integer divisibility by each number within [2..value-1]
		for($i = 2; $i < $this->value; $i++) {
			if ($this->value % $i == 0) return FALSE;
		}
		return TRUE;
	}

	/**
	 * Gets this MyInteger's value.
	 * @return The value of this MyInteger
	 */
	public function getValue(): int {
		return $this->value;
	}

	/**
	 * Sets the value of this MyInteger.
	 * @param $value The new value to set this MyInteger to
	 */
	public function setValue(int $value): void {
		$this->value = $value;
	}
}

function showMyInteger(MyInteger $obj): void {
	if ($obj->isPrime()) {
	?>
		<div class="myint prime"><?= $obj->getValue(); ?></div>
	<?php
	} else {
	?>
		<div class="myint nonprime"><?= $obj->getValue(); ?></div>
	<?php
	}
}

function testPrimes(): void {
	$testNumbers = [
		// Some primes:
		3, 13, 691, 1087,
		// Some nonprimes:
		25, 822, 6, 104,
		// Some oddball nonprimes:
		-5, 1
	];

	$obj = new MyInteger();

	?>
	<div class="myints">
	<?php

	foreach($testNumbers as $testNumber) {
		$obj->setValue($testNumber);
		showMyInteger($obj);
	}
	?>
	</div>
	<?php
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>CSD440 Module 5</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
		.myints {
			display: flex;
			flex-direction: row;
			flex-wrap: wrap;
			justify-content: center;
			column-gap: 16px;
			row-gap: 16px;
		}
		.myint {
			min-width: 80px;
			padding: 8px;
			border: 1px solid #000;
			border-radius: 6px;
			box-shadow: 5px 5px rgba(0,0,0,0.12);
			text-align: center;
		}
		.prime {
			background: #9F9;
		}
		.nonprime {
			background: #F99;
		}
		h1, h2 { text-align: center; margin-top: 48px; }
		p { text-align: center; }
		body { margin-bottom: 24px; font-family: sans-serif; color: black; background: white; }
		</style>
	</head>
	<body>
		<h1>CSD440 Module 6: PHP Objects</h1>
		<h2>IsPrime Tests</h2>
		<p>(Green values are prime, red are nonprime)
		<?php
		testPrimes();
		?>
		<h2>Making a second instance for some reason</h2>
		<p>I made it huge just for fun.
		<div class="myints">
		<?php
		$extraInstance = new MyInteger(60661); // 60,661 is prime and should be green.
		showMyInteger($extraInstance);
		?>
		</div>

		<h2>Notes</h2>
		<p>IsPrime Tests uses a single instance of MyInteger for all its values. It repeatedly sets the value, tests the primeness, and emits the value and primeness based on getValue, so all code is adequately covered in just the first section here.
	</body>
</html>

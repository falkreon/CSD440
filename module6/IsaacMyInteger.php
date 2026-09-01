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

	public function isEven(): bool {
		return $this->value % 2 == 0;
	}

	public function isOdd(): bool {
		return $this->value % 2 != 0;
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

function showMyInteger(MyInteger $obj, callable $predicate): void {
	if ($predicate($obj)) {
	?>
		<div class="myint green"><?= $obj->getValue(); ?></div>
	<?php
	} else {
	?>
		<div class="myint red"><?= $obj->getValue(); ?></div>
	<?php
	}
}

function test(array $testNumbers, callable $predicate) {
	$obj = new MyInteger();
	foreach($testNumbers as $testNumber) {
		$obj->setValue($testNumber);
		showMyInteger($obj, $predicate);
	}
}

function testPrimes(): void {
	test(
		[
			// Some primes:
			3, 13, 691, 1087,
			// Some nonprimes:
			25, 822, 6, 104,
			// Some oddball nonprimes:
			-5, 1
		],
		function(MyInteger $it): bool { return $it->isPrime(); }
	);
}

function testEvens(): void {
	test(
		[
			// Evens
			2, 18, 26, 1982,
			// Odds
			7, 11, 691, 7901,
			// Oddballs
			0, -1, -2, -91
		],
		function(MyInteger $it): bool { return $it->isEven(); }
	);
}


function testOdds(): void {
	test(
		[
			// Evens
			2, 18, 26, 1982,
			// Odds
			7, 11, 691, 7901,
			// Oddballs
			0, -1, -2, -91
		],
		function(MyInteger $it): bool { return $it->isOdd(); }
	);
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
		.green {
			background: #9F9;
		}
		.red {
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
		<div class="myints">
		<?php
		testPrimes();
		?>
		</div>

		<h2>IsEven Tests</h2>
		<p>(Green values are even, red values are not)
		<div class="myints">
		<?php
		testEvens();
		?>
		</div>

		<h2>IsOdd Tests</h2>
		<p>(Green values are odd, green values are not. Should be the opposite if IsEven)
		<div class="myints">
		<?php
		testOdds();
		?>
		</div>
	</body>
</html>

<?php declare(strict_types=1);
/*
 * CSD440: Server Side Scripting
 * Module 11: PDF's
 *   Assignment 2: Programming Assignment
 * Isaac Ellingson
 * 10/10/2026
 *
 * Takes data previously entered in Module 8, retrieves it from the database, and emits it in a nicely-formatted
 * table in a PDF, along with information about the domain - in this case, classic video games.
 * 
 * Make sure you received fpdf.php as well as the font and makefont folder. If you did not, please place these files
 * from FPDF ( https://www.fpdf.org/ ) alongside the program. I'm using version 1.9.
 */


/**
 * Rather than tweak the column names and widths in two places - the header and the body,
 * I centralized the data here and refer to it from both places. This let me fine tune elements
 * to get them all fitting on the page without switching the page orientation to landscape.
 */
$COLUMNS = [
	'Id'              => [ 'width' =>  6, 'key' => 'Id' ],
	'Title'           => [ 'width' => 65, 'key' => 'Title' ],
	'PublicationYear' => [ 'width' => 12, 'key' => 'Year' ],
	'Genre'           => [ 'width' => 25, 'key' => 'Genre' ],
	'Developer'       => [ 'width' => 20, 'key' => 'Dev' ],
	'Publisher'       => [ 'width' => 30, 'key' => 'Publisher' ],
	'Console'         => [ 'width' => 30, 'key' => 'Console' ]
];

$TOTAL_WIDTH = 0;
foreach($COLUMNS as $col) {
	$TOTAL_WIDTH += $col['width'];
}

// Start the PDF early, so we don't have to buffer the database data separately,
// we can just stuff it into the PDF and forget it.

require('fpdf.php');
$pdf = new FPDF();
$pdf->SetTitle('CSD440, Module 11: My Game Library');
$pdf->SetAuthor('Isaac Ellingson');

$pdf->SetFont('Arial', 'B', 16);
$pdf->AddPage();
$pdf->Cell(0, 10, 'CSD440, Module 11');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, 'Isaac Ellingson'); $pdf->Ln();
$pdf->Cell(0, 8, '10/10/2026'); $pdf->Ln();

$pdf->Ln();


// Still using mysqli, since we're already doing so.
$db = new mysqli(
	hostname: 'localhost',
	username: 'student1',
	password: 'pass',
	database: 'baseball_01'
);

try {
	$result = $db->query('USE baseball_01');
	$result = $db->query('SELECT * FROM VideoGame;');

	
	if ($result) {
		
		$pdf->SetDrawColor(120, 100, 60);
		
		// === Table Header ===
		
		// Equivalent to table <caption>
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell($TOTAL_WIDTH, 10, 'My Game Library', 1, align: 'C');
		$pdf->Ln();
		// Equivalent to table <th>
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->SetFillColor(230, 210, 170);
		foreach($COLUMNS as $n => $w) {
			$pdf->Cell($w['width'], 10, $w['key'], 1, fill: true);
		}
		$pdf->Ln();
		
		// === Table Body ===
		$fill = false;
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetFillColor(250,250,220);
		
		while($row = $result->fetch_assoc()) {
			foreach($row as $k => $v) {
				$column = $COLUMNS[$k];
				$pdf->Cell($column['width'], 10, $v, 1, fill: $fill);
			}
			$fill = !$fill;
			$pdf->Ln();
		}
		
		// === Table Footer ===
		$pdf->SetFont('Arial', 'i', 10);
		$pdf->Cell($TOTAL_WIDTH, 10, 'Data fetched live from the baseball_01 database on ' . date("Y/m/d"), 1);
		
		
	} else {
		$pdf->MultiCell(0, 8,
			<<<TXT
			There was a problem retrieving the information from the database. Please check to make sure you have mysqli available, and the database and database-user from Module 8 are present.
			TXT
		);
	}
	
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 12);
	// 0 is a sentinel value that extends out to the right margin
	$pdf->MultiCell(0, 8,
		<<<TXT
		The data provided are classic RPGs from the cartridge era, centered on Sega consoles. The Sega Master System, Genesis, and Sega CD did not get many RPGs compared to the contemporary Super Nintendo, but the RPGs for this console and era are still cult classics today.
		
		In particular, the arrival of the publisher 'Working Designs' in the Sega CD era brought high-quality translations of Japanese RPGs to a new American audience, giving the small number of people who owned the CD platform a unique experience that you wouldn't find anywhere else.
		TXT
	);
	
} finally {
	$db->close();
	$pdf->Output();
}


?>

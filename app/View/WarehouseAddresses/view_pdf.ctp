<?php

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Mladen Karic');
$pdf->SetTitle('Repromaterijali');
$pdf->SetSubject('Repromaterijali');

$pdf->SetTopMargin(50);

$pdf->setFooterMargin(25);
$pdf->SetAutoPageBreak(true, 25);

$textfont = 'freesans';
$pdf->SetFont($textfont,'B', 20);

// add a page (required with recent versions of tcpdf)
$pdf->AddPage();
$pdf->SetXY(0, 40);

$pdf->Cell(0,0, "Kartica Magacinske Adrese", 0,1,'C');

$pdf->SetY(60);
$pdf->SetFont($textfont,'R', 10);
$pdf->SetXY(120, 90);
//$pdf->Cell(0, 0, $data['WarehouseAddress']['code'], 0, 1);
$pdf->Cell(120,10, $data['WarehouseAddress']['code'], 0,0,'');
//$pdf->Cell(100,10, $data['WarehouseAddress']['code'], 0,0,'L');

$style = array(
	'position' => '',
	'align' => '',
	'stretch' => false,
	'fitwidth' => true,
	'cellfitalign' => '',
	'border' => true,
	'hpadding' => 'auto',
	'vpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 8,
	'stretchtext' => 4
);
$pdf->SetXY(80, 100);
$pdf->write1DBarcode($data['WarehouseAddress']['barcode'], 'C39', '', '', '', 18, 0.4, $style, 'N');

//Generate pdf file
$filename .= '.pdf';
$pdf->Output('addresses.pdf', 'D');

?>

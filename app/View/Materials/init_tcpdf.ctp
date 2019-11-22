<?php

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Mladen Karic');
	$pdf->SetTitle('Repromaterijali');
	$pdf->SetSubject('Repromaterijali');

	$pdf->SetTopMargin(30);

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

	$pdf->Cell(120,10, "Šifra artikla: AAAA", 0,0,'L');
	$pdf->Cell(100,10, "Magacin: BBBB", 0,0,'L');

	//Generate pdf file
	$filename .= '.pdf';
	$pdf->Output('test.pdf', 'D');

?>

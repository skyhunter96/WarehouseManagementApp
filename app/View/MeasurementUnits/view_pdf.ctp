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

$pdf->Cell(0,0, "Kartica Artikla - Jedinica mere", 0,1,'C');

$pdf->SetY(60);
$pdf->SetFont($textfont,'R', 10);

//$pdf->Cell(120,10, "Ime jedinice:", 0,0,'L');
//$pdf->Cell(80,10, "Simbol jedinice:", 0,0,'L');

$html = '<br><br><br><br><table border="1" cellpadding="2" cellspacing="2" align="center"  > <tr><th>Ime jedinice:</th><th>Simbol jedinice:</th></tr>';

foreach($data as $d){
	$html .= "
					<tr>
						<td>{$d['MeasurementUnit']['name']}</td>
						<td>{$d['MeasurementUnit']['symbol']}</td>
					</tr><br>
				 ";
}

$html .= '</table>';

$pdf->writeHTML($html, true, false, false, false, '');

//Generate pdf file
$filename .= '.pdf';
$pdf->Output('mes.pdf', 'D');

?>

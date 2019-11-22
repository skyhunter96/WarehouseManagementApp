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

$pdf->Cell(0,0, "Kartica Artikla - Roba", 0,1,'C');

$pdf->SetY(60);
$pdf->SetFont($textfont,'R', 10);

//$pdf->Cell(120,10, "Ime artikla:", 0,0,'L');
//$pdf->Cell(100,10, "Kod artikla:", 0,0,'L');

$html = '<br><br><br><br><table border="1" cellpadding="2" cellspacing="2" align="center"> <tr><th>Ime artikla:</th>
		<th>Kod artikla:</th><th>Status artikla:</th><th>Za distributore:</th><th>Pid:</th>
		<th>HTS:</th><th>Tax:</th><th>Eccn:</th><th>Izlazi</th>
	</tr>';


foreach($data as $d){
	$distributors = $d['Good']['is_for_distributors'] ? 'Da' : 'Ne';
	$html .= "
					<tr>
						<td>{$d['Item']['name']}</td>
						<td>{$d['Item']['code']}</td>
						<td>{$d['Good']['status']}</td>
						<td>{$distributors}</td>
						<td>{$d['Good']['pid']}</td>
						<td>{$d['Good']['hts_number']}</td>
						<td>{$d['Good']['tax_group']}</td>
						<td>{$d['Good']['eccn']}</td>
						<td>{$d['Good']['release_date']}</td>
					</tr><br>
				 ";
}

$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

//Generate pdf file
$filename .= '.pdf';
$pdf->Output('roba.pdf', 'D');

?>

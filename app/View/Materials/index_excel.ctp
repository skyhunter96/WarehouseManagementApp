
<?php

	$objExcel->setActiveSheetIndex(0);

	// Add some data

	$objExcel->getActiveSheet()->mergeCells("A1:G1");

	$objExcel->getActiveSheet()->setCellValue("A1", "TEST");

	$objExcel->getActiveSheet()->getStyle("A1")->getFont()->setSize(22);


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet

	$objExcel->setActiveSheetIndex(0);

	$objExcelWriter->save("php://output");

?>

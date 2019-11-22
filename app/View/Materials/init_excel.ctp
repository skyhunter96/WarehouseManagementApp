
<?php
//if(empty($filename)) $filename = "untitled.xls";
//header('Content-Disposition: attachment;filename="'.$filename.'"');
//header('Cache-Control: max-age=0');
//// If you're serving to IE 9, then the following may be needed
//header('Cache-Control: max-age=1');
//
//// If you're serving to IE over SSL, then the following may be needed
//header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
//header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
//header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
//header ('Pragma: public'); // HTTP/1.0
//
//header('Content-Type: application/vnd.ms-excel');
//header('Content-Disposition: attachment; filename="file.xls"');

$sheet = $spreadsheet->getActiveSheet();
$sheet->fromArray($data, NULL, 'A1');
$writer->save('php://output');

?>

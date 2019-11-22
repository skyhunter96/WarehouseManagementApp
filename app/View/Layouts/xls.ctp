<?php
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename="file.xls"');
?>
<?php echo $this->fetch('content'); ?>

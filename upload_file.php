<?php
$par = $_FILES['filename1']['tmp_name'];
$schema = 'ONIX_BookProduct_Release3.0_reference.xsd';
$file = simplexml_load_file($par);
$xml = new DOMDocument();
$xml->load($par);
?>

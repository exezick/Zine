<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="SHORTCUT ICON" href="<?php echo base_url().'assets/img/E_logo.png'; ?>">
<head>
    <title><?= $title; ?></title>
<?php

$this->load->database();
$this->load->library('session');

foreach ($headercontents as $headercont):
  echo $headercont . "\n";
endforeach;

?>
</head>

<body>

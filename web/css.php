<?php
  if (!defined('WEB_PATH')) define('WEB_PATH', '../web/');
  if (!isset($PAGE_TITLE)) $PAGE_TITLE = 'Example';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo WEB_PATH; ?>css/images/ml.png">

    <title><?php echo $PAGE_TITLE;?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo WEB_PATH;?>bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Skeleton CSS -->
    <link rel="stylesheet" href="<?php echo WEB_PATH;?>skeleton/css/normalize.css">
    <link rel="stylesheet" href="<?php echo WEB_PATH;?>skeleton/css/skeleton.css">
    <link rel="stylesheet" href="<?php echo WEB_PATH;?>css/skeleton-modifications.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo WEB_PATH; ?>bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="<?php echo WEB_PATH; ?>fonts/raleway.css" rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="<?php echo WEB_PATH; ?>css/mysite-default.css" rel="stylesheet">

    <!-- Font-Awesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo WEB_PATH; ?>font-awesome/css/font-awesome.min.css">

    <!-- Printing -->
    <link rel="stylesheet" type="text/css" media="print" href="<?php echo WEB_PATH; ?>css/mysite-print.css" />

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo WEB_PATH;?>bootstrap/js/jquery.min.js"></script>
    <script src="<?php echo WEB_PATH;?>bootstrap/js/bootstrap.min.js"></script>

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="<?php echo WEB_PATH; ?>datatables.net/datatables.min.css"/>
    <script type="text/javascript" src="<?php echo WEB_PATH; ?>datatables.net/datatables.min.js"></script>

    <!-- Extract the following css -->
    <style>
      body {
        background-color: #dddddd;
      }
    </style>
  </head>

  <body>

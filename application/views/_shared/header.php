<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $page_title ?> | <?= $page_header ?></title>

    <!-- External stylesheet -->
    <link href="<?= base_url('assets/tb/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/pace/css/themes/flash.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/fa/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/animate/css/animate.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/dt_picker/css/jquery.datetimepicker.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/datatables/css/dataTables.bootstrap.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/themes/default/css/style.min.css') ?>" rel="stylesheet" title="main">

    <?php if (!is_connected()): ?>
        <script src="<?= base_url('assets/script/html5shiv.min.js'); ?>"></script>
        <script src="<?= base_url('assets/script/respond.min.js'); ?>"></script>
    <?php else: ?>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <?php endif; ?>

</head>
<body>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/default.css" rel="stylesheet" type="text/css"/>

<!--
additional bootstrap import for sidebar collapse style

-->

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
<div id="wrapper">
    <div id="header-wrapper">
        <div id="header" class="container">
            <div id="logo">
                <p style="font-size: 10px;text-align: right;">| <?php echo $_SESSION['username'];?> | <a href="<?= site_url('welcome/logout') ?>" rel="nofollow">Logout</a> |</p>
                <h1><img src="<?php echo base_url() ?>assets/images/opensrp.png" alt="" align="left" style="min-width: 100; height: 85px; padding-right: 10px;"/> <a href="http://sid-indonesia.org">DHO Report</a></h1>
                <h3 style="margin-top: 5px;"><a href="http://sid-indonesia.org/" rel="nofollow">Summit Institute of Development</a></h3>
            </div>
            <div>

            </div>
        </div>
        <div id="menu" class="container">
            <ul>
                <li ><a href="<?php echo site_url() ?>/welcome" accesskey="1" title="">Homepage</a></li>
                <li><a href="<?php echo site_url() ?>/dataentry/dataentry" accesskey="5" title="">Data Entry</a></li>

                <li align="center"><a href="<?php echo site_url() ?>/QCI/QCI" accesskey="5" title="">Quality Care of Indicator</a></li>

                <li><a href="<?php echo site_url() ?>/laporan/laporan" accesskey="5" title="">Laporan</a></li>
                <li><a href="<?php echo site_url() ?>/standarisasi/standarisasi" accesskey="5" title="">Standarisasi</a></li>
                
            </ul>
        </div>
    </div>
   
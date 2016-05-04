<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DHO REPORT - <?=strtoupper($this->uri->segment(1))?></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/default.css" rel="stylesheet" type="text/css"/>
<link rel="icon" href="<?=base_url()?>favicon.png" type="image/png"/>
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
            <div id="log_stat">
                <p style="font-size: 10px;text-align: right;">| <?php echo $_SESSION['username'];?> | <a href="<?= site_url('welcome/logout') ?>" rel="nofollow">Logout</a> |</p>
            </div>
            <div id="logo">
                <img src="<?php echo base_url() ?>assets/images/logo_loteng.gif" alt="" align="left" style="min-width: 60; height: 60px; padding-right: 10px;"/>
                <img src="<?php echo base_url() ?>assets/images/sid.jpg" alt="" align="left" style="min-width: 60; height: 60px; padding-right: 10px;"/>
                <img src="<?php echo base_url() ?>assets/images/opensrp.png" alt="" align="left" style="min-width: 60; height: 60px; padding-right: 10px;"/>
            </div>
            <div id="head" class="center">
                <h1>DHO Report</h1>
                <h3 style="margin-top: 5px;">Dinas Kesehatan Lombok Tengah</h3>
                <h3 style="margin-top: 5px;">Summit Institute of Development</h3>
            </div>
        </div>
        <div id="menu" class="container">
            <nav>
                <ul class="nav nav-justified">
                    <li<?=$this->uri->segment(1)=='welcome'?' class="current_page_item"':''?>><a href="<?php echo site_url() ?>welcome" accesskey="1" title="">Homepage</a></li>
                    <?php if($this->session->userdata('level')=="master"||$this->session->userdata('level')=="super"){?>
                    <li<?=$this->uri->segment(1)=='berita'?' class="current_page_item"':''?>><a href="<?php echo site_url() ?>berita/post" accesskey="5" title="">Berita</a></li>
                    <?php }if($this->session->userdata('level')!="master"){?>
                    <li<?=$this->uri->segment(1)=='dataentry'?' class="current_page_item"':''?>><a href="<?php echo site_url() ?>dataentry" accesskey="5" title="">Rekapitulasi Data Entry</a></li>
                    <li<?=$this->uri->segment(1)=='laporan'?' class="current_page_item"':''?>><a href="<?php echo site_url() ?>laporan" accesskey="5" title="">Laporan</a></li>
                    <li<?=$this->uri->segment(1)=='hhhscore'?' class="current_page_item"':''?>><a href="<?php echo site_url() ?>hhhscore" accesskey="5" title="">HHH Score</a></li>
                    <?php }?>
                </ul>
            </nav>
        </div>
    </div>
   
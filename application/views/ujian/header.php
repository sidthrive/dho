<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SID Ujian Online - <?=strtoupper($this->uri->segment(1))?></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="<?php echo base_url() ?>assets/css/default.css" rel="stylesheet" type="text/css"/>
<link rel="icon" href="<?=base_url()?>favicon.png" type="image/png"/>
<!--
additional bootstrap import for sidebar collapse style

-->

<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" href='<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css' />
<script src="<?php echo base_url() ?>assets/js/jquery-1.12.3.min.js"></script>
<script src='<?php echo base_url() ?>assets/js/bootstrap.min.js'></script>
<script src="<?php echo base_url() ?>assets/js/jquery.countdown.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/moment.min.js"></script>
<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);
    @media (max-device-width: 1024px){  
        input[type=radio] {
            border: 0px;
            width: 50%;
            height: 2em;
        }
        #wrapperujian {
            width: 100%;
            background-color: transparent;
        }
        #titleujian {
            padding-top: 20px;
        }
        #contentujian {
            margin: auto;
            width: 80%;
            //border: 3px solid #73AD21;
            padding: 10px;
            background-color: whitesmoke;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        #isiujian{
            margin: 15px; 
        }
        #isiujian td{
            text-align: center;
            vertical-align: middle;
        }
        #timercontainer{
            position: fixed;
            top: 5px;
            left: 5px;
            width: 110px;
            height: 40px;
            background-color: whitesmoke;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        #timer{
            font-size: 18pt;
            margin: 0;
            width: 80%;
            padding: 5px;
        }
        .jumbotron {
            padding-top: 20%;
        }
        h3 {
            font-size: 30pt;
        }
        .login-page {
          width: 360px;
          padding: 8% 0 0;
          margin: auto;
        }
        .form {
          position: relative;
          z-index: 1;
          background: #FFFFFF;
          max-width: 360px;
          margin: 0 auto 20px;
          padding: 45px;
          text-align: center;
          box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
        .form input {
          font-family: "Roboto", sans-serif;
          outline: 0;
          background: #f2f2f2;
          width: 100%;
          border: 0;
          margin: 0 0 15px;
          padding: 15px;
          box-sizing: border-box;
          font-size: 14px;
        }
        .form button {
          font-family: "Roboto", sans-serif;
          text-transform: uppercase;
          outline: 0;
          background: #4CAF50;
          width: 100%;
          border: 0;
          padding: 15px;
          color: #FFFFFF;
          font-size: 14px;
          -webkit-transition: all 0.3 ease;
          transition: all 0.3 ease;
          cursor: pointer;
        }
        .form button:hover,.form button:active,.form button:focus {
          background: #43A047;
        }
        .form .message {
          margin: 15px 0 0;
          color: #b3b3b3;
          font-size: 12px;
        }
        .form .message a {
          color: #4CAF50;
          text-decoration: none;
        }
        .form .register-form {
          display: none;
        }
        .container {
          position: relative;
          z-index: 1;
          max-width: 300px;
          margin: 0 auto;
        }
        .container:before, .container:after {
          content: "";
          display: block;
          clear: both;
        }
        .container .info {
          margin: 50px auto;
          text-align: center;
        }
        .container .info h1 {
          margin: 0 0 15px;
          padding: 0;
          font-size: 36px;
          font-weight: 300;
          color: #1a1a1a;
        }
        .container .info span {
          color: #4d4d4d;
          font-size: 12px;
        }
        .container .info span a {
          color: #000000;
          text-decoration: none;
        }
        .container .info span .fa {
          color: #EF3B3A;
        }
    }
    input[type=radio] {
        border: 0px;
        width: 50%;
        height: 1.5em;
    }
    #wrapperujian {
        width: 100%;
        background-color: transparent;
    }
    #titleujian {
        padding-top: 20px;
    }
    #contentujian {
        margin: auto;
        width: 80%;
        //border: 3px solid #73AD21;
        padding: 10px;
        background-color: whitesmoke;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    #isiujian{
        margin: 50px; 
    }
    #isiujian td{
        vertical-align: top;
    }
    #timercontainer{
        position: fixed;
        top: 5px;
        left: 5px;
        width: 110px;
        height: 40px;
        background-color: whitesmoke;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    #timer{
        font-size: 18pt;
        margin: auto;
        width: 80%;
        padding: 10px;
    }
    .jumbotron {
        padding-top: 20%;
    }
    h3 {
        font-size: 30pt;
    }
    .login-page {
      width: 360px;
      padding: 8% 0 0;
      margin: auto;
    }
    .form {
      position: relative;
      z-index: 1;
      background: #FFFFFF;
      max-width: 360px;
      margin: 0 auto 20px;
      padding: 45px;
      text-align: center;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
    .form input {
      font-family: "Roboto", sans-serif;
      outline: 0;
      background: #f2f2f2;
      width: 100%;
      border: 0;
      margin: 0 0 15px;
      padding: 15px;
      box-sizing: border-box;
      font-size: 14px;
    }
    .form button {
      font-family: "Roboto", sans-serif;
      text-transform: uppercase;
      outline: 0;
      background: #4CAF50;
      width: 100%;
      border: 0;
      padding: 15px;
      color: #FFFFFF;
      font-size: 14px;
      -webkit-transition: all 0.3 ease;
      transition: all 0.3 ease;
      cursor: pointer;
    }
    .form button:hover,.form button:active,.form button:focus {
      background: #43A047;
    }
    .form .message {
      margin: 15px 0 0;
      color: #b3b3b3;
      font-size: 12px;
    }
    .form .message a {
      color: #4CAF50;
      text-decoration: none;
    }
    .form .register-form {
      display: none;
    }
    .container {
      position: relative;
      z-index: 1;
      max-width: 300px;
      margin: 0 auto;
    }
    .container:before, .container:after {
      content: "";
      display: block;
      clear: both;
    }
    .container .info {
      margin: 50px auto;
      text-align: center;
    }
    .container .info h1 {
      margin: 0 0 15px;
      padding: 0;
      font-size: 36px;
      font-weight: 300;
      color: #1a1a1a;
    }
    .container .info span {
      color: #4d4d4d;
      font-size: 12px;
    }
    .container .info span a {
      color: #000000;
      text-decoration: none;
    }
    .container .info span .fa {
      color: #EF3B3A;
    }
</style>
</head>
<body>
<div id="wrapperujian">
    
   
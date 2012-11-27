<html>
    <head>
        <title>
            FreiChatX
        </title>
                <link rel="stylesheet" href="../client/jquery/js/jquery-ui.css" />
<link href="../favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <style type="text/css">
            
            
            * {
                margin: 0;
            }
            html, body {
                height: 100%;
            }
            .wrapper {
                min-height: 100%;
                height: auto !important;
                height: 100%;
                margin: 0 auto -2em;
            }
            .footer, .push {
                height: 0em;
            }



.logo{

text-align:center;
}


            .adminbutton {
                -moz-box-shadow:inset 0px 0px 0px 0px #bbdaf7;
                -webkit-box-shadow:inset 0px 0px 0px 0px #bbdaf7;
                box-shadow:inset 0px 0px 0px 0px #bbdaf7;
                background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5) );
                background:-moz-linear-gradient( center top, #79bbff 5%, #378de5 100% );
                filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5');
                background-color:#79bbff;
                -moz-border-radius:10px;
                -webkit-border-radius:10px;
                border-radius:10px;
                border:2px solid #84bbf3;
                display:inline-block;
                color:#ffffff;
                font-family:Arial;
                font-size:28px;
                font-weight:bold;
                padding:10px 42px;
                text-decoration:none;
                text-shadow:1px 0px 0px #528ecc;
            }.adminbutton:hover {
                background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff) );
                background:-moz-linear-gradient( center top, #378de5 5%, #79bbff 100% );
                filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff');
                background-color:#378de5;
            }.adminbutton:active {
                position:relative;
                top:1px;
            }


.acceptbutton {
	-moz-box-shadow:inset 0px 0px 0px 0px #caefab;
	-webkit-box-shadow:inset 0px 0px 0px 0px #caefab;
	box-shadow:inset 0px 0px 0px 0px #caefab;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #77d42a), color-stop(1, #5cb811) );
	background:-moz-linear-gradient( center top, #77d42a 5%, #5cb811 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#77d42a', endColorstr='#5cb811');
	background-color:#77d42a;
	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	border-radius:10px;
	border:2px solid #268a16;
	display:inline-block;
	color:#306108;
	font-family:Arial;
	font-size:28px;
	font-weight:bold;
	padding:10px 42px;
	text-decoration:none;
	text-shadow:1px 0px 0px #aade7c;
}.acceptbutton:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #5cb811), color-stop(1, #77d42a) );
	background:-moz-linear-gradient( center top, #5cb811 5%, #77d42a 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#5cb811', endColorstr='#77d42a');
	background-color:#5cb811;
}.acceptbutton:active {
	position:relative;
	top:1px;
}


.rejectbutton {
	-moz-box-shadow:inset 0px 0px 0px 0px #f29c93;
	-webkit-box-shadow:inset 0px 0px 0px 0px #f29c93;
	box-shadow:inset 0px 0px 0px 0px #f29c93;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #fe1a00), color-stop(1, #ce0100) );
	background:-moz-linear-gradient( center top, #fe1a00 5%, #ce0100 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fe1a00', endColorstr='#ce0100');
	background-color:#fe1a00;
	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	border-radius:10px;
	border:2px solid #d83526;
	display:inline-block;
	color:#ffffff;
	font-family:Arial;
	font-size:28px;
	font-weight:bold;
	padding:10px 42px;
	text-decoration:none;
	text-shadow:1px 0px 0px #b23e35;
}.rejectbutton:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ce0100), color-stop(1, #fe1a00) );
	background:-moz-linear-gradient( center top, #ce0100 5%, #fe1a00 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ce0100', endColorstr='#fe1a00');
	background-color:#ce0100;
}.rejectbutton:active {
	position:relative;
	top:1px;
}


.nextbutton {
	-moz-box-shadow:inset 0px 1px 0px 0px #caefab;
	-webkit-box-shadow:inset 0px 1px 0px 0px #caefab;
	box-shadow:inset 0px 1px 0px 0px #caefab;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #77d42a), color-stop(1, #5cb811) );
	background:-moz-linear-gradient( center top, #77d42a 5%, #5cb811 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#77d42a', endColorstr='#5cb811');
	background-color:#77d42a;
	-moz-border-radius:18px;
	-webkit-border-radius:18px;
	border-radius:18px;
	border:1px solid #268a16;
	display:inline-block;
	color:#306108;
	font-family:arial;
	font-size:28px;
	font-weight:bold;
	padding:18px 76px;
	text-decoration:none;
	text-shadow:1px 1px 0px #aade7c;
}.nextbutton:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #5cb811), color-stop(1, #77d42a) );
	background:-moz-linear-gradient( center top, #5cb811 5%, #77d42a 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#5cb811', endColorstr='#77d42a');
	background-color:#5cb811;
}.nextbutton:active {
	position:relative;
	top:1px;
}
.refreshbutton {
	-moz-box-shadow:inset 0px 1px 0px 0px #bbdaf7;
	-webkit-box-shadow:inset 0px 1px 0px 0px #bbdaf7;
	box-shadow:inset 0px 1px 0px 0px #bbdaf7;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5) );
	background:-moz-linear-gradient( center top, #79bbff 5%, #378de5 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5');
	background-color:#79bbff;
	-moz-border-radius:18px;
	-webkit-border-radius:18px;
	border-radius:18px;
	border:1px solid #84bbf3;
	display:inline-block;
	color:#ffffff;
	font-family:arial;
	font-size:28px;
	font-weight:bold;
	padding:18px 76px;
	text-decoration:none;
	text-shadow:1px 1px 0px #528ecc;
}.refreshbutton:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff) );
	background:-moz-linear-gradient( center top, #378de5 5%, #79bbff 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff');
	background-color:#378de5;
}.refreshbutton:active {
	position:relative;
	top:1px;
}



@font-face {
  font-family: 'Sonsie One';
  font-style: normal;
  font-weight: 400;
  src: local('Sonsie One'), local('SonsieOne-Regular'), url('images/sonsieone.woff') format('woff');
}

@font-face {
  font-family: 'Changa One';
  font-style: normal;
  font-weight: normal;
  src: local('Changa One'), local('ChangaOne'), url('images/changaone.woff') format('woff');
}

@font-face {
  font-family: 'Exo';
  font-style: italic;
  font-weight: 600;
  src: local('Exo DemiBold Italic'), local('Exo-DemiBoldItalic'), url('images/exo.woff') format('woff');
}
        </style>
        
        <script>var X_load_jn = "i am defined";</script>
        <script src="../client/jquery/js/jquery.1.7.1.js"></script>
        <script src="../client/jquery/js/jquery-ui.js"></script>
    </head>
    <body>


        <div class="wrapper">
            <div style="text-align:center">

                <a href="http://evnix.com"><img src="../server/admin_files/home/head.png" height=100  /></a>
            </div>



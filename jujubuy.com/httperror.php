<?php include("config.php"); ?>
<?php include("functions.php"); ?>
<?php 
$status = http_response_code();
$httpMessage = array(
		100 => 'Continue',
		101 => 'Switching Protocols',
		102 => 'Processing',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		207 => 'Multi-Status',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		306 => 'Switch Proxy',
		307 => 'Temporary Redirect',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		402 => 'Payment Required',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Timeout',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Long',
		415 => 'Unsupported Media Type',
		416 => 'Requested Range Not Satisfiable',
		417 => 'Expectation Failed',
		418 => 'I\'m a teapot',
		422 => 'Unprocessable Entity',
		423 => 'Locked',
		424 => 'Failed Dependency',
		425 => 'Unordered Collection',
		426 => 'Upgrade Required',
		449 => 'Retry With',
		450 => 'Blocked by Windows Parental Controls',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Unavailable',
		504 => 'Gateway Timeout',
		505 => 'HTTP Version Not Supported',
		506 => 'Variant Also Negotiates',
		507 => 'Insufficient Storage',
		509 => 'Bandwidth Limit Exceeded',
		510 => 'Not Extended'
);
?>
<!DOCTYPE html>
<html>
<head>
<title>HTTP Status <?php echo $status; ?> : <?php echo $httpMessage[$status]; ?></title>
<meta name="robots" content="noindex">
<?php include("includes/head.php"); ?>
</head>
<body>
<!-- Begin Wrapper -->
<div id="wrapper">
<!-- Begin Header -->
<div id="header">
<?php include("includes/header.php"); ?>
</div>
<!-- End Header -->
<!-- Begin Naviagtion -->
<div id="navigation">
<?php include("includes/navmenu.php"); ?>
<?php include("includes/usermenu.php"); ?>
<div class="clear"></div>
</div>
<!-- End Naviagtion -->
<!-- Begin Content -->
<div id="content">
<div style="float:left; width:260px; margin:0px 50px 0px 20px;">
<img src="<?php echo $config['site']; ?>/images/http-error-icon.png" style="width:250px; height:auto;" border="0" />
</div>
<div style="float:left; min-width:500px;">
<h1>HTTP Error <?php echo $status; ?> : <?php echo $httpMessage[$status]; ?></h1>
<div style="margin-top:20px;">
<?php
if($status=='404') {
	echo 'The page you\'ve requested was not found on the server. Please check the URL and try again. If the problem persists, please contact 
Website Administrator.';
}
else {
	echo 'An error has occured while processing your request. If the problem persists, please contact Website Administrator.';
}
?>
</div>
</div>
<div class="clear"></div>
</div>
<!-- End Content -->
<div id="footer">
<?php include("includes/footer.php"); ?>
<div class="clear"></div>
</div>
</div>
<!-- End Wrapper -->
</body>
</html>

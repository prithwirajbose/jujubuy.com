<?php
ini_set("display_errors", "true");
if(!isset($_SESSION)) {
	session_start();
}
if(isset($_REQUEST['password']) && !empty($_REQUEST['password'])) {
	if($_REQUEST['password']=='xyz123') {
		$_SESSION['adminsession']='1d23ewasfsfdf';

		header("Location: ".$_SERVER['PHP_SELF']);
	}
	else {
		die('<span style="color:red">Invalid Password</span>');
	}
}
elseif((isset($_SESSION) && !empty($_SESSION['adminsession']) && $_SESSION['adminsession']=='1d23ewasfsfdf')) {
	if(isset($_REQUEST['file'])) {
		print '<html><head></head><body><a href="'.$_SERVER['PHP_SELF'].'">Go Back</a><br />
				<textarea style="width:99%; height:700px;" id="log">'.file_get_contents("logs/".$_REQUEST['file']).'</textarea>';
		?>
		<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script type="text/javascript">
  function refresh() {
	$.ajax({url:'<?php echo $_SERVER['PHP_SELF'].'?ajaxfile='.$_REQUEST['file']; ?>',
		'success':function(resp) {
			$('#log').val(resp);
			var psconsole = $('#log');
		    if(psconsole.length)
		       psconsole.scrollTop(psconsole[0].scrollHeight - psconsole.height());
			setTimeout(refresh,2000);
		}
	});
  }
  refresh();
  </script>
  </body></html>
		<?php 
		
	}
	elseif(isset($_REQUEST['ajaxfile'])) {
		print file_get_contents("logs/".$_REQUEST['ajaxfile']);
	}
	else {
		$dir = "logs/";
		
		// Open a directory, and read its contents
		if (is_dir($dir)){
			if ($dh = opendir($dir)){
				while (($file = readdir($dh)) !== false){
					if($file != '.' && $file != '..' && $file != '.htaccess')
						echo '<a href="'.$_SERVER['PHP_SELF'].'?file='.$file.'">' . $file . '</a><br/>';
				}
				closedir($dh);
			}
		}
	}
	
}
else {
	?>
	<form method="post">
Enter password: <input type="password" name="password" /> <input type="submit" value="See Logs" />
</form>
<?php 
}
?>
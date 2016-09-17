<?php
define('LOCK_FILE_SUB_DIR', '/locks/');
	$uTime = microtime(true);

	function ASSERT_CHECKS_POSTED()
	{
		assertLock('AP_CHECKS_POST');
	}

	function assertLock($lockType)
	{
		$fname = 'lock.' . $lockType . '*LOCKED.html';
		$path = dirname(__FILE__);
		$fpath = $path . LOCK_FILE_SUB_DIR . $fname;
		$ret = glob($fpath);
		if($ret === false)
			die ('FATAL: Assertion error. Application:'. $_SERVER['ORIG_PATH_TRANSLATED'] . 
				' <br>cannot test to see if lock file(s) exists:' . $fpath); 
		if(count($ret) > 0)
			die ('FATAL: Assertion failed. Application:'. $_SERVER['ORIG_PATH_TRANSLATED'] . 
				' <br>lock file exists:' . $fpath); 
	}

	function getFPath($lockType)
	{
		global $uTime;
		$fname = 'lock.' . $lockType . '.' . $uTime . '.LOCKED.html';
		$path = dirname(__FILE__);
		return $path . LOCK_FILE_SUB_DIR . $fname;
	}	

	function createLock($lockType)
	{
		$fpath = getFPath($lockType);
		if(file_exists($fpath))
			die( 'Exiting because the application:'. $_SERVER['ORIG_PATH_TRANSLATED'] . 
				' tried to create a lock file that already exists:' . $fpath); 
		else
		{
			$thisScriptFile = __FILE__;
			$dt = date('l dS \of F Y h:i:s A');

			$serverStr = print_r($_SERVER, true);		
			$str = <<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta content="text/html; charset=ISO-8859-1"
 http-equiv="content-type">
  <title>Hoover Application Lock File</title>
  <meta content="Hoover" name="author">
  <meta content="Hoover Application Lock File"
 name="description">
</head>
<body style="color: rgb(0, 0, 0); background-color: rgb(51, 204, 0);"
 alink="#000099" link="#000099" vlink="#990099">
<h1>Hoover Application Lock File</h1>
An application has called for this lock file be to be created. If the
application successfully called for the release of the lock, the "<span
 style="font-weight: bold;">LOCKED</span>" part of this
file name has been changed to "<span style="font-weight: bold;">RELEASED</span>".
If this file name still contains "<span style="font-weight: bold;">LOCKED</span>"
the application could be executing now and/or have failed to release
the request.<br>
<span style="font-weight: bold;">Time</span>:$dt<br>
<span style="font-weight: bold;">Remote requester</span>:{$_SERVER['REMOTE_ADDR']}<br>
<span style="font-weight: bold;">Initial&nbsp;(not included) script</span>:{$_SERVER['ORIG_PATH_TRANSLATED']}<br>
<span style="font-weight: bold;">Lock type</span>:$lockType<br>
<span style="font-weight: bold;">Creating script (included library)</span>:$thisScriptFile<br>
<span style="font-weight: bold;">_SERVER PHP dump</span>:<br>
<textarea readonly="readonly" cols="100" rows="25"
 name="server_info">$serverStr</textarea>
</body>
</html>
EOD;
			file_put_contents($fpath, $str);	
		}
	}	// end function createLock()

	function releaseLock($lockType)
	{
		global $uTime;
		$fpath = getFPath($lockType);
		if(!file_exists($fpath))
			die ('Exiting because the application:'. $_SERVER['ORIG_PATH_TRANSLATED'] . 
				' tried to release a lock file that does not exist:' . $fpath); 
		else
		{
			$fname = 'lock.' . $lockType . '.' . $uTime . '.RELEASED.html';
			$path = dirname(__FILE__);
			$released = $path . LOCK_FILE_SUB_DIR . $fname;
			rename($fpath, $released);
		} 		
	}


?>

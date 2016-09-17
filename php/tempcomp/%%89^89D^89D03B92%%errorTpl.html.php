<?php /* Smarty version 2.6.13, created on 2011-01-12 15:02:31
         compiled from errorTpl.html */ ?>
<html>
<head>
<title>HTWP Error!</title>

<style><?php echo '

	TR.main_header {
		background-color:black; 
		color:white;
	}
	TR.main_footer {
		background-color:#396B42; 
		color:white;
	}
	div.error {
  		color: red;
  		font-weight: bold;
  	}
'; ?>
  
</style>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr class="main_header">
		<td align="left" width="25%">ERROR!!</td>
		<td align="center" width="25%">&nbsp</td>
		<td align="right" width="25%"><?php echo date("l F d,Y"); ?></td>

	</tr>
</table>
<h3>
<center>An error has been encountered:</center>
</h3>
<div class="error"><?php echo $this->_tpl_vars['message']; ?>
</div>
</body>
</html>
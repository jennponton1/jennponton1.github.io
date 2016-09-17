<?php /* Smarty version 2.6.13, created on 2011-01-07 17:36:06
         compiled from standard.html */ ?>
<html>
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>

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
		<td align="left" width="25%"><?php echo $this->_tpl_vars['title']; ?>
</td>
		<td align="center" width="25%"><?php echo $this->_tpl_vars['username']; ?>
 <?php echo $this->_tpl_vars['closelink']; ?>
</td>
		<td align="right" width="25%"><?php echo date("l F d,Y"); ?></td>

	</tr>
</table>
<?php echo $this->_tpl_vars['content']; ?>

</body>
</html>
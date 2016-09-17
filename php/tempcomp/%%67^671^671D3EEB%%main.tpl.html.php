<?php /* Smarty version 2.6.13, created on 2012-11-07 11:11:16
         compiled from C:%5Cinetpub%5Cwwwroot%5Cstkpricing%5CTrtPrices%5Ctrtprclist/views/main.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'C:\\inetpub\\wwwroot\\stkpricing\\TrtPrices\\trtprclist/views/main.tpl.html', 13, false),array('modifier', 'strstr', 'C:\\inetpub\\wwwroot\\stkpricing\\TrtPrices\\trtprclist/views/main.tpl.html', 16, false),array('modifier', 'substr', 'C:\\inetpub\\wwwroot\\stkpricing\\TrtPrices\\trtprclist/views/main.tpl.html', 17, false),)), $this); ?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="views/styles/append.css" rel="stylesheet"/>
    </head>
    <body>
        <button class="prtBtn" onclick="window.print()">Print This Page</button>
        <h3>Hoover-<?php echo $this->_tpl_vars['site']; ?>
 Price List <br /> 
            as of: <?php echo $this->_tpl_vars['date']; ?>
 </h3><br />
        <table class="prcLst">
            <?php echo smarty_function_counter(array('start' => 0,'skip' => 1,'assign' => 'next'), $this);?>

            <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['data'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['data']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['i']):
        $this->_foreach['data']['iteration']++;
?>
            <?php if ($this->_tpl_vars['next'] <= 1): ?>
            <?php if (((is_array($_tmp=$this->_tpl_vars['i'])) ? $this->_run_mod_handler('strstr', true, $_tmp, 'PYRO-GUARD') : strstr($_tmp, 'PYRO-GUARD'))): ?>
            <tr><td class="pg" colspan=<?php echo $this->_tpl_vars['count']-1; ?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['i'])) ? $this->_run_mod_handler('substr', true, $_tmp, 2) : substr($_tmp, 2)); ?>
</td></tr>
            <?php elseif (((is_array($_tmp=$this->_tpl_vars['i'])) ? $this->_run_mod_handler('strstr', true, $_tmp, 'Exterior Fire-X') : strstr($_tmp, 'Exterior Fire-X'))): ?>
            <tr><td class="efx" colspan=<?php echo $this->_tpl_vars['count']-1; ?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['i'])) ? $this->_run_mod_handler('substr', true, $_tmp, 2) : substr($_tmp, 2)); ?>
</td></tr>
            <?php elseif (((is_array($_tmp=$this->_tpl_vars['i'])) ? $this->_run_mod_handler('strstr', true, $_tmp, 'CCA Oxide') : strstr($_tmp, 'CCA Oxide'))): ?>
            <tr><td class="cca" colspan=<?php echo $this->_tpl_vars['count']-1; ?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['i'])) ? $this->_run_mod_handler('substr', true, $_tmp, 2) : substr($_tmp, 2)); ?>
</td></tr>
            <?php elseif (((is_array($_tmp=$this->_tpl_vars['i'])) ? $this->_run_mod_handler('strstr', true, $_tmp, 'Plywood') : strstr($_tmp, 'Plywood')) || ((is_array($_tmp=$this->_tpl_vars['i'])) ? $this->_run_mod_handler('strstr', true, $_tmp, 'Lumber') : strstr($_tmp, 'Lumber'))): ?>
            <tr class="subTitle"><td><?php echo $this->_tpl_vars['i']; ?>
</td>
                <?php echo smarty_function_counter(array(), $this);?>

                <?php elseif ($this->_tpl_vars['next'] == 0 && ((is_array($_tmp=$this->_tpl_vars['i'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 2) : substr($_tmp, 0, 2)) != '**'): ?>
            <tr><td class="catT"><?php echo $this->_tpl_vars['i']; ?>
</td>
                <?php echo smarty_function_counter(array(), $this);?>

                <?php else: ?>
                <?php if ($this->_tpl_vars['i'] == 0): ?>					
                <td></td>
                <?php else: ?>
                <td><?php echo $this->_tpl_vars['i']; ?>
</td>
                <?php endif; ?>
                <?php echo smarty_function_counter(array(), $this);?>

                <?php endif; ?>
                <?php elseif ($this->_tpl_vars['next'] == $this->_tpl_vars['count']-2): ?>
                <?php if ($this->_tpl_vars['i'] == 0): ?>
                <td></td></tr>
            <?php else: ?>
            <td><?php echo $this->_tpl_vars['i']; ?>
</td></tr>
        <?php endif; ?>     
        <?php echo smarty_function_counter(array('start' => 0,'skip' => 1,'assign' => 'next'), $this);?>

        <?php else: ?>
        <?php if ($this->_tpl_vars['i'] == 0): ?>
        <td></td>
        <?php else: ?>
        <td><?php echo $this->_tpl_vars['i']; ?>
</td>
        <?php endif; ?>                          
        <?php echo smarty_function_counter(array(), $this);?>

        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
    </table>
    <div id="disc"><br /><span id="disc1"></span><br /></div>
</body>
</html>
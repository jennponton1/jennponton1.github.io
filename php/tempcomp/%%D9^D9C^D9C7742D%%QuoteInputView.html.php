<?php /* Smarty version 2.6.13, created on 2012-03-12 09:45:44
         compiled from C:%5Cinetpub%5Cwwwroot%5Cordersandshipments%5Cdataentry%5Cquotes+-+Copy/views/QuoteInputView.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

>
></td>
></td>
></td></tr>
>&nbsp;
$this->_sections['TAssign']['name'] = 'TAssign';
$this->_sections['TAssign']['loop'] = is_array($_loop=$this->_tpl_vars['state']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['TAssign']['show'] = true;
$this->_sections['TAssign']['max'] = $this->_sections['TAssign']['loop'];
$this->_sections['TAssign']['step'] = 1;
$this->_sections['TAssign']['start'] = $this->_sections['TAssign']['step'] > 0 ? 0 : $this->_sections['TAssign']['loop']-1;
if ($this->_sections['TAssign']['show']) {
    $this->_sections['TAssign']['total'] = $this->_sections['TAssign']['loop'];
    if ($this->_sections['TAssign']['total'] == 0)
        $this->_sections['TAssign']['show'] = false;
} else
    $this->_sections['TAssign']['total'] = 0;
if ($this->_sections['TAssign']['show']):

            for ($this->_sections['TAssign']['index'] = $this->_sections['TAssign']['start'], $this->_sections['TAssign']['iteration'] = 1;
                 $this->_sections['TAssign']['iteration'] <= $this->_sections['TAssign']['total'];
                 $this->_sections['TAssign']['index'] += $this->_sections['TAssign']['step'], $this->_sections['TAssign']['iteration']++):
$this->_sections['TAssign']['rownum'] = $this->_sections['TAssign']['iteration'];
$this->_sections['TAssign']['index_prev'] = $this->_sections['TAssign']['index'] - $this->_sections['TAssign']['step'];
$this->_sections['TAssign']['index_next'] = $this->_sections['TAssign']['index'] + $this->_sections['TAssign']['step'];
$this->_sections['TAssign']['first']      = ($this->_sections['TAssign']['iteration'] == 1);
$this->_sections['TAssign']['last']       = ($this->_sections['TAssign']['iteration'] == $this->_sections['TAssign']['total']);
?>
><?php echo $this->_tpl_vars['state'][$this->_sections['TAssign']['index']]; ?>
</option>
$this->_sections['SAssign']['name'] = 'SAssign';
$this->_sections['SAssign']['loop'] = is_array($_loop=$this->_tpl_vars['site']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['SAssign']['show'] = true;
$this->_sections['SAssign']['max'] = $this->_sections['SAssign']['loop'];
$this->_sections['SAssign']['step'] = 1;
$this->_sections['SAssign']['start'] = $this->_sections['SAssign']['step'] > 0 ? 0 : $this->_sections['SAssign']['loop']-1;
if ($this->_sections['SAssign']['show']) {
    $this->_sections['SAssign']['total'] = $this->_sections['SAssign']['loop'];
    if ($this->_sections['SAssign']['total'] == 0)
        $this->_sections['SAssign']['show'] = false;
} else
    $this->_sections['SAssign']['total'] = 0;
if ($this->_sections['SAssign']['show']):

            for ($this->_sections['SAssign']['index'] = $this->_sections['SAssign']['start'], $this->_sections['SAssign']['iteration'] = 1;
                 $this->_sections['SAssign']['iteration'] <= $this->_sections['SAssign']['total'];
                 $this->_sections['SAssign']['index'] += $this->_sections['SAssign']['step'], $this->_sections['SAssign']['iteration']++):
$this->_sections['SAssign']['rownum'] = $this->_sections['SAssign']['iteration'];
$this->_sections['SAssign']['index_prev'] = $this->_sections['SAssign']['index'] - $this->_sections['SAssign']['step'];
$this->_sections['SAssign']['index_next'] = $this->_sections['SAssign']['index'] + $this->_sections['SAssign']['step'];
$this->_sections['SAssign']['first']      = ($this->_sections['SAssign']['iteration'] == 1);
$this->_sections['SAssign']['last']       = ($this->_sections['SAssign']['iteration'] == $this->_sections['SAssign']['total']);
?>
><?php echo $this->_tpl_vars['city'][$this->_sections['SAssign']['index']]; ?>
</option>
$this->_sections['SAssign']['name'] = 'SAssign';
$this->_sections['SAssign']['loop'] = is_array($_loop=$this->_tpl_vars['site']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['SAssign']['show'] = true;
$this->_sections['SAssign']['max'] = $this->_sections['SAssign']['loop'];
$this->_sections['SAssign']['step'] = 1;
$this->_sections['SAssign']['start'] = $this->_sections['SAssign']['step'] > 0 ? 0 : $this->_sections['SAssign']['loop']-1;
if ($this->_sections['SAssign']['show']) {
    $this->_sections['SAssign']['total'] = $this->_sections['SAssign']['loop'];
    if ($this->_sections['SAssign']['total'] == 0)
        $this->_sections['SAssign']['show'] = false;
} else
    $this->_sections['SAssign']['total'] = 0;
if ($this->_sections['SAssign']['show']):

            for ($this->_sections['SAssign']['index'] = $this->_sections['SAssign']['start'], $this->_sections['SAssign']['iteration'] = 1;
                 $this->_sections['SAssign']['iteration'] <= $this->_sections['SAssign']['total'];
                 $this->_sections['SAssign']['index'] += $this->_sections['SAssign']['step'], $this->_sections['SAssign']['iteration']++):
$this->_sections['SAssign']['rownum'] = $this->_sections['SAssign']['iteration'];
$this->_sections['SAssign']['index_prev'] = $this->_sections['SAssign']['index'] - $this->_sections['SAssign']['step'];
$this->_sections['SAssign']['index_next'] = $this->_sections['SAssign']['index'] + $this->_sections['SAssign']['step'];
$this->_sections['SAssign']['first']      = ($this->_sections['SAssign']['iteration'] == 1);
$this->_sections['SAssign']['last']       = ($this->_sections['SAssign']['iteration'] == $this->_sections['SAssign']['total']);
?>
><?php echo $this->_tpl_vars['city'][$this->_sections['SAssign']['index']]; ?>
</option>
$this->_sections['SAssign']['name'] = 'SAssign';
$this->_sections['SAssign']['loop'] = is_array($_loop=$this->_tpl_vars['site']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['SAssign']['show'] = true;
$this->_sections['SAssign']['max'] = $this->_sections['SAssign']['loop'];
$this->_sections['SAssign']['step'] = 1;
$this->_sections['SAssign']['start'] = $this->_sections['SAssign']['step'] > 0 ? 0 : $this->_sections['SAssign']['loop']-1;
if ($this->_sections['SAssign']['show']) {
    $this->_sections['SAssign']['total'] = $this->_sections['SAssign']['loop'];
    if ($this->_sections['SAssign']['total'] == 0)
        $this->_sections['SAssign']['show'] = false;
} else
    $this->_sections['SAssign']['total'] = 0;
if ($this->_sections['SAssign']['show']):

            for ($this->_sections['SAssign']['index'] = $this->_sections['SAssign']['start'], $this->_sections['SAssign']['iteration'] = 1;
                 $this->_sections['SAssign']['iteration'] <= $this->_sections['SAssign']['total'];
                 $this->_sections['SAssign']['index'] += $this->_sections['SAssign']['step'], $this->_sections['SAssign']['iteration']++):
$this->_sections['SAssign']['rownum'] = $this->_sections['SAssign']['iteration'];
$this->_sections['SAssign']['index_prev'] = $this->_sections['SAssign']['index'] - $this->_sections['SAssign']['step'];
$this->_sections['SAssign']['index_next'] = $this->_sections['SAssign']['index'] + $this->_sections['SAssign']['step'];
$this->_sections['SAssign']['first']      = ($this->_sections['SAssign']['iteration'] == 1);
$this->_sections['SAssign']['last']       = ($this->_sections['SAssign']['iteration'] == $this->_sections['SAssign']['total']);
?>
><?php echo $this->_tpl_vars['city'][$this->_sections['SAssign']['index']]; ?>
</option>
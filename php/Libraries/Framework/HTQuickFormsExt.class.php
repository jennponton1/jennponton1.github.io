<?php
class HTQuickFormsExt 
{
  private $form;
  public function __construct(&$inForm)
  {
    if($inForm instanceof HTML_QuickForm)
      $this->form = &$inForm;
    else
      throw new HTException("HTQuickFormsExt must be constructed with a HTML_QuickForms object.");
  }
  
  public function addDateControl($inpName, $inpLbl, $init = '')
  {
  // Hoover Date control depends on call_calendar(...), so include sec_header.php
  // before you get here. Initial date displayed defaults to yesterday.
  $init = ($init == '') ? date('m/d/Y', time() - (60 * 60 * 24)) : $init;
  $dateLabel = "
  <tr valign='top'>
      <td align='right' >
          <!-- BEGIN required --><span style='color: #F00;'>*</span><!-- END required --><b>{label}</b>
      </td>
      <td align='left'>
          <!-- BEGIN error --><span style='color: #F00;'>{error}</span><br /><!-- END error -->{element}
          <a href='javascript:void(0);' onclick='call_calendar(document."
          .$this->form->getAttribute('name'). "." . $inpName .
          ",false,true)';><img src='/img/cal.gif' align='bottom' border='0' height='16' width='16'>
          </a>
          <font size='-2'>Click for a calendar</font>    
      </td>
  </tr>";
  $renderer =& $this->form->defaultRenderer();
  $renderer->setElementTemplate($dateLabel, $inpName);
  $this->form->addElement('text', $inpName, $inpLbl, array('size' => 10, 'maxlength' => 10, 'value'=>$init));
  }
}


?>

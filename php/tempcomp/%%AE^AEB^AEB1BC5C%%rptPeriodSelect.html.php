<?php /* Smarty version 2.6.13, created on 2011-04-19 07:42:14
         compiled from rptPeriodSelect.html */ ?>
	<SCRIPT LANGUAGE="JavaScript" SRC="/calendar/calendar.js">
  </SCRIPT>
  <form method=POST name=fmMain id=fmMain <?php echo $this->_tpl_vars['form']['attributes']; ?>
>
  <?php echo $this->_tpl_vars['form']['hidden']; ?>

  
  <TABLE>  
     <TR>
        <TD><B><h3><?php echo $this->_tpl_vars['form']['RptName']['label']; ?>
</B></TD>
     </TR>
  </TABLE>
        
  <TABLE> 
     <TR>
        <TD><B>Select Site:</B></TD>
        <TD>
<select name=siteid >
<option value=ALL SELECTED>ALL</option>
<option value=DET >DET</option>
<option value=MIL >MIL</option>
<option value=PB >PB</option>
<option value=THO >THO</option>
<option value=WIN >WIN</option>
</select>        
    </TD>
     </TR> 
     <TR>
        <TD><B><?php echo $this->_tpl_vars['form']['period']['label']; ?>
</B></TD>     
        <TD>
          <?php echo $this->_tpl_vars['form']['period']['html']; ?>
&nbsp;&nbsp;
            <A HREF='javascript:void(0)'ONCLICK='call_calendar_monthly(document.fmMain.period);'><IMG SRC='/calendar/img/cal.gif' WIDTH='16' HEIGHT='16' BORDER='0' ALIGN='bottom'></A>
          <FONT SIZE='2'>
            &nbsp;Click for a calendar
          </FONT>
  			</TD>
     </TR>
     <TR>
        <TD>
        </TD>
        <TD>
          <FONT SIZE='2'>
        &nbsp;Use (YYYYMM) Format 
          </FONT>
        </TD>
     </TR>
	</TABLE>
	<TABLE>
	   <TR>
        <TD><br><?php echo $this->_tpl_vars['form']['run']['html']; ?>
</TD>
        <TD><br><?php echo $this->_tpl_vars['form']['exit']['html']; ?>
</TD>
  	 </TR>
	</TABLE>
	   <TR>
        <TD><br><?php echo $this->_tpl_vars['form']['message']['label']; ?>
</TD>
  	 </TR>
  </form>
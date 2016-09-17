<?php /* Smarty version 2.6.13, created on 2011-05-17 09:11:30
         compiled from C:%5Cinetpub%5Cwwwroot%5CHooverModule%5CSalesSummary%5Cviews%5CSalesSummarySel.html */ ?>
  <SCRIPT LANGUAGE="JavaScript" SRC="/calendar/calendar.js">
  </SCRIPT>

  <form method=POST name=SalesSummarySel id=SalesSummarySel >
      <input type="hidden" name="do" id="do" value="report">
  <TABLE style = "width: 100%">
      <TR>
         <br>
         <TD style = "width: 10%;"><B>Select Site:</B></TD>
         <TD style = "width: 10%;"><B><select name="siteid">
                     <option value="THO">Thomson</option>
                     <option value="PB">Pine Bluff</option>
                     <option value="MIL">Milford</option>
                     <option value="DET">Detroit</option>
                     <option value="WIN">Winston</option>
                 </select></B></TD>
         <TD style = "width: 80%;"></TD>
      </TR>
  </TABLE>
  <br>
  <fieldset style = "background-color:WhiteSmoke; color:Blue;">
  <legend><b>&nbsp;Date Information&nbsp;</b></legend>
  <TABLE style = "width: 100%">
      <TR>
         <TD style = "width: 15%;"><B>Enter the fiscal period for the report</B></TD>
         <TD style = "width: 30%;"><input type="text" name="period"><A HREF='javascript:void(0)'
             ONCLICK='call_calendar_monthly(document.SalesSummarySel.period,true,true);'><IMG
             SRC='/calendar/img/cal.gif' WIDTH='16' HEIGHT='16' BORDER='0' ALIGN='bottom'></A>
             <FONT SIZE='-1'>Click for a calendar</FONT><br><FONT SIZE='-1'>Use (YYYYMM) Format</FONT></TD>
         <TD style = "width: 6%;"></TD>
         <br>
      </TR>
  </TABLE>
  </fieldset>
  <TABLE style = "width: 100%">
      <TR>
         <br>
         <hr>
         <TD><input type="submit" value="Run"><TD>
     </TR>
  </TABLE>
  <script language="JavaScript"> document.getElementById("siteid").focus(); </script>
  </form>
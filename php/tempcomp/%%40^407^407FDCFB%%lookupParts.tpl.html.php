<?php /* Smarty version 2.6.13, created on 2012-11-15 11:44:20
         compiled from C:%5Cinetpub%5Cwwwroot%5Cdetstatus/views/lookupParts.tpl.html */ ?>
<script type="text/javascript" src="public/js/lookupParts.js"></script>
<div id="ordBy">
Part #:<input type="text" id="partNum"/>
Sort By:
         <select name='ordBy'>
              <option selected value='h.ordNbr'>Order Number</option>
              <option value='h.invtId,h.ordNbr'>Part Number</option>
              <option value='h.dtDueToShip,h.ordNbr'>Date Due To Ship</option>
              <option value='d.status'>Status</option>
         </select>
<button id="search">Search</button>
        <P>
	-You may enter one of the following wildcard characters if you don't know the entire part number:<BR>
       &nbsp;&nbsp; '?' matches any single character<BR>
       &nbsp;&nbsp; '*' matches any zero or more characters.<BR>
       - You may also use a combination of the above wildcard characters.<BR>
	</P>
</div>
<div id="lkpWrapper">
     <table id="lookPrtsGrid" class="display" >
        <thead class="theading" >
            <tr>
                <th>Order #                </th>
                <th>Part #                 </th>
                <th>Date Due to Ship       </th>
                <th>Pcs Rem                </th>
                <th>Footage Rem            </th>
                <th>Status                 </th>
                <th>Status Pcs On Hand     </th>
                <th>Status Footage On Hand </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
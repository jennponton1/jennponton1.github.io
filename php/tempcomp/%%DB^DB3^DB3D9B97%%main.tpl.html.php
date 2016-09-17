<?php /* Smarty version 2.6.13, created on 2012-02-29 13:06:12
         compiled from C:%5Cinetpub%5Cwwwroot%5CExportOrderEntry%5Ccomppricelist/views/main.tpl.html */ ?>
<link type="text/css" href="public/css/styles.css" rel="stylesheet" />
<link type="text/css" href="/Ajax/jqueryui/css/custom-theme2/jquery-ui-1.8.9.custom.css" rel="stylesheet" />        
        
<script src="/ajax/jquery/jquery.js" ></script>
<script src="public/js/main.js" ></script>

<div id="layout">   
    
    <div class="title">Export Price List</div>  
    
    <div class="form">    
        
        <form action="" method="GET">  
            
            <div class="cBox1">
                <input type="hidden" name="do" value="getcountry">     
                <label for="country">Ship to Country:</label>
                <select id="country" name="country"></select>
            </div>

            <div class="cBox2">
                <input type="hidden" name="do" value="getports"> 
                <label for="ports">Ship to ports:</label>
                <select id="ports" name="ports"></select>
            </div>
            
            <div class="cBox3">                    
                <label>Treatment:</label>
                <select Name='treatment' id="treated">
                    <option value=RAW>Untreated</option>
                    <option value=ACQ>ACQ</option>
                    <option value=CCA>CCA</option>
                    <option value=Q1K>Eco-Wood</option>
                    <option value=M1K>Eco-Lite</option>
                    <option value=PGD>PGD</option>
                    <option value=XFX>XFX</option>
               </select>
            </div>
            
            <input type="hidden" name="do" value="doreport"> 
            
            <div class="btn" >
                <input type="submit" id="btn" value="View Report" disabled="disabled">
            </div>
            
        </form>  
        
    </div>
</div>
        
        
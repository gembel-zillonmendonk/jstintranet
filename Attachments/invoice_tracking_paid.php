<script type="text/javascript" src="<?php echo base_url();  ?>themes/default/js/tiny_mce/tiny_mce.js"></script> 
<script language="javascript" >


	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});

function print_receipt_form() {
	window.open ("<?php echo base_url(); ?>index.php/invoice/print_receipt_form/<?php echo  $invoice_number;?>","mywindow","menubar=1,resizable=1,width=1000,height=650,left=200,top=100");
}

function print_receipt_note() {
	window.open ("<?php echo base_url(); ?>index.php/invoice/print_receipt_note/<?php echo  $invoice_number;?>","mywindow","menubar=1,resizable=1,width=1000,height=650,left=200,top=100");
}

$(document).ready(function() {
	$('#status_id').change(function() {
		if ($(this).val() == 2005) {
			$('#track_amount').val($('#inv_total_amount').val());
		}
		
	});
	
});

</script> 
<form  method="post" action="">
<!-- start general info !-->


<h2>Invoice Information</h2>
        
<div style="width:50%;float:left" >
 
	<div class="field">
		<label for="name">Invoice No:</label>
		<input type="text" class="input" name="invoice_number" id="invoice_number" value="<?php echo  $invoice_number;?>" readonly />
	</div>
	 <!--
	<div class="field">
		<label for="email">Period:</label>
		<input type="text" class="input" name="inv_period" id="inv_period"   value="<?php echo  $inv_period;?>" readonly  />
	</div>
	 
	<div class="field">
		<label for="message">Due Date:</label>
		 <input type="text" class="input" name="inv_due_date" id="inv_due_date" readonly value="<?php echo  $inv_due_date;?>"  />
	</div>
-->
 	<div class="field">
		<label for="email">Delivered Date:</label>
		<input type="text" class="input" name="inv_delivered_date" id="inv_delivered_date"   value="<?php echo  $inv_delivered_date;?>" readonly  />
	</div>
 <div class="field">
    <label for="name">Total Amount:</label>
    <input type="text" class="input_number" name="inv_total_amount" id="inv_total_amount" value="<?php echo  number_format($inv_total_amount); ?>" readonly />
</div>

</div>
<div style="width:50%;float:left" >


<div class="field">
    <label for="message">No Account:</label>
     <input type="text" class="input" style="font-weight: bold;" name="" id="l" readonly value="<?php echo  $account_number;?>" />
</div>
<div class="field">
    <label for="message">Company Name:</label>
     <input type="text" class="input" style="font-weight: bold;" name="" id="l" readonly value="<?php echo  $company_name;?>" />
</div>
<div class="field">
    <label for="message">Customer Name:</label>
     <input type="text" class="input" name="" id="l" readonly value="<?php echo  $customer_name;?>" />
</div>
	 
	<div class="field">
		<label for="message">Charge Net:</label>
		 <input type="text" class="input_number" name="inv_charge_net" id="inv_charge_net"   value="<?php echo  number_format($inv_charge_net); ?>"  readonly />
	</div>
	<div class="field">
		<label for="message">Tax Value:</label>
		 <input type="text" class="input_number" name="inv_tax_value" id="inv_tax_value"  value="<?php echo  number_format($inv_tax_value); ?>"   readonly />
	</div>

<div class="field">
    <label for="name">Total Amount Begining:</label>
    <input type="text" class="input_number" name="inv_total_amount" id="inv_total_amount" value="<?php echo  number_format($inv_total_amount_begining); ?>" readonly />
</div>
 


</div>
<div style="clear:both" ></div>
 
    </form>
 
 <div class="fullbox">

<!-- start general info !-->

<!--
<h2>Payment History</h2>
     
<table id="box-table-a" summary="Employee Pay Sheet">
    <thead>
    	<tr>
        	<th scope="col" width="5%" >No</th>
            <th scope="col" width="20%" >Date</th>
             <th scope="col" width="75%" >Amount</th>
    	</tr>
    </thead>
    <tbody>
	<?php
	$i = 1;	
	foreach($PaymentResult as $rows) {
		 
	?>
	
    	<tr>
        	<td><?php echo $i; ?></td>
            <td><?php echo $rows->payment_date; ?></td>
            <td><?php echo $rows->payment_amount; ?></td>
            
		</tr>
	<?php
	$i++;
		}
	?>	
    
    </tbody>
</table>
-->


 <?php
 if (count($CrDrResult) > 0) {
 ?>
 <div class="fullbox">
<h2>Debet/Credit Note</h2>
<table id="box-table-a" summary="Employee Pay Sheet">
    <thead>
    	<tr>
        	<th scope="col" width="5%" >No</th>
			<th scope="col" width="20%" >Type</th>
            
            <th scope="col" width="15%" >Date</th>
			<th scope="col" width="40%" >No Reff</th>            
			<th scope="col" width="20%" >Amount</th>
			
			 
    	</tr>
		</thead>
		<tbody>
		<?php
	$i = 1;
	$tot = 0;	
	foreach($CrDrResult as $rows) {
		 
	?>
	
    	<tr>
        	<td><?php echo $i; ?></td>
            <td><?php echo $rows->status_name; ?></td>
			<td><?php echo $rows->crdr_date; ?></td>
			 <td><?php echo $rows->inv_track_reff; ?></td>
            <td align="right" ><?php echo number_format($rows->crdr_amount,0); ?></td>
            
		</tr>
	<?php
	 
	$i++;
		}
	?>	
    </tbody>
</table>	
</div> 
<?php 
		}
	?>	


<h2>Payment History</h2>
     
<table id="box-table-a" summary="Employee Pay Sheet">
    <thead>
    	<tr>
        	<th scope="col" width="5%" >No</th>
			<th scope="col" width="10%" >Payment Type</th>
            <th scope="col" width="10%" >Payment Item</th>
            <th scope="col" width="10%" >Date</th>
             <th scope="col" width="20%" >Amount</th>
			 <th scope="col" width="20%" >No Reff</th>
			 <th scope="col" width="25%" >Bank Name</th>
    	</tr>
    </thead>
    <tbody>
	<?php
	$i = 1;
	$tot = 0;	
	foreach($PaymentResult as $rows) {
		 
	?>
	
    	<tr>
        	<td><?php echo $i; ?></td>
            <td><?php echo $rows->status_name; ?></td>
			<td><?php echo $rows->status_item_name; ?></td>
			<td><?php echo $rows->payment_date; ?></td>
            <td align="right" ><?php echo number_format($rows->payment_amount,0); ?></td>
            <td><?php echo $rows->inv_track_reff; ?></td>
			<td><?php echo $rows->bank_name; ?></td>
			
		</tr>
	<?php
	$tot += $rows->payment_amount;
	$i++;
		}
	?>	
    <tr>
        	<td colspan="4" align="right" ><b>Total<b></td>
            <td align="right" ><b><?php echo number_format($tot,0); ?></b></td>
             <td align="right" ><b>Balance</b></td>
            <td align="right" ><b><?php echo number_format($inv_total_amount - $tot,0); ; ?></b></td>
			
		</tr>
    </tbody>
</table>



</div>
 
 
 <!--   
<input type="button" value="Print Receipt Form" onclick="print_receipt_form()" /> 
&nbsp;
<input type="button" value="Print Receipt Note" onclick="print_receipt_note()" /> 
-->
<div class="fullbox">

<!-- start general info !-->


<h2>Invoice Status History</h2>
        
<table id="box-table-a" summary="Employee Pay Sheet">
    <thead>
    	<tr>
        	<th scope="col" width="5%" >No</th>
            <th scope="col" width="20%" >Status</th>
            <th scope="col" width="15%" >Date</th>
            <th scope="col" width="20%" >By</th>
            <th scope="col" width="40%" >Remarks</th>
    	</tr>
    </thead>
    <tbody>
	<?php
	$i = 1;	
	foreach($TrackResult as $rows) {
		$comment = str_replace("<p>","",$rows->inv_track_comment);
		$comment = str_replace("</p>","",$comment);
	?>
	
    	<tr>
        	<td><?php echo $i; ?></td>
            <td><?php echo $rows->status_name; ?></td>
            <td><?php echo $rows->datetime_updated; ?></td>
            <td><?php echo $rows->user_updated; ?></td>
            <td><?php echo $comment; ?></td    	
		</tr>
	<?php
	$i++;
		}
	?>	
    
    </tbody>
</table>

 

 
    
</div>
 
 

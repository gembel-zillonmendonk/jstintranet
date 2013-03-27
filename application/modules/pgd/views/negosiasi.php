<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

  
?>
<form class="clsinput" action="<?php echo base_url(); ?>index.php/pgd/negosiasi/add" method="POST" id="frm_InputNegosiasi" >
<input type="hidden" name="KODE_TENDER" value="<?php echo $KODE_TENDER;?>" />
<input type="hidden" name="KODE_KANTOR" value="<?php echo $KODE_KANTOR;?>" />

<table class="ui-jqgrid-htable" style="width: 100%;" cellspacing="0" cellpadding="0" border="0" >
 <tr>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 5%; height: 30px" >No</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 30%; height: 30px" >Nama Vendor</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 5%; height: 30px" >Buka Negosiasi</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 60%; height: 30px" >Pesan</th>
 </tr>
 <?php
 $i = 0;
 foreach($rs_nego as $row) { 
 ?>
  <tr>
  <td align="center" >&nbsp;<?php echo ($i+1);?></td>
  <td  >&nbsp;<?php echo $row->NAMA_VENDOR;?></td>
  <td align="center" >&nbsp;<input type="radio" name="KODE_VENDOR_PESAN" VALUE="<?php echo $row->KODE_VENDOR;?>" /></td>
 <td  >&nbsp;<input type="text" name="PESAN_<?php echo $row->KODE_VENDOR;?>" VALUE="" style="width: 95%"  /></td>
 
  </tr>  
  
 <?php
 $i++;
 
 }
 ?>
  
</table> 
</form>
<!--
<button type="button" id="btnAddNegosiasi" >Update</button> 
-->
<script>
var validator_InputNegosiasi;
$(document).ready(function(){
    
    validator_InputNegosiasi = $("#frm_InputNegosiasi").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
        
    
    $("#btnAddNegosiasi").click(function(){
        $("#frm_InputNegosiasi").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                       alert(msg);
                                      $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                      

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });
        
    });
    
    
}) 


</script>

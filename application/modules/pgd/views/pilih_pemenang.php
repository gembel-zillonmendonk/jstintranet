<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php $this->load->helper('form'); ?>
<fieldset class="ui-widget-content">
      <form class="clsinput" id="frm_InputPemenang" method="POST" action="update_penata_pelaksana" > 
         <p>
          <?php echo form_label("Pilih Pemenang  *") ?>
            <select name="KODE_VENDOR" class="{validate:{required:true,maxlength:1024}}">
                <option value="">--</option>
               <?php 
               foreach ($rs_calon as $row) {
                 echo "<option value='" . $row->KODE_VENDOR.   "' >".$row->NAMA_VENDOR."</option>";
               } 
               ?>
            </select>
           </p>
          <p>
          <button type="button"  id="btnAddPemenang" >UPDATE</button>
            </p>
             <input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR_TENDER" VALUE="<?php echo $KODE_KANTOR; ?>"  />
        <input type="hidden" name="KODE_TENDER" id="KODE_TENDER"  VALUE="<?php echo $KODE_TENDER; ?>"  />
    
          
      </form>
</fieldset> 
<script>
var validator_InputPemenang;

$(document).ready(function(){
     validator_InputPemenang =  $("#frm_InputPemenang").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
        
    $("#btnAddPemenang").click(function(){
      
        if(validator_InputPemenang.form()) {
                    $("#frm_InputPemenang").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                       alert(msg);
      //                                $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                     

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
                 
      
    })
    
})



</script>
      


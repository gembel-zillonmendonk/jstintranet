
<?php $this->load->helper('form'); ?>
<fieldset class="ui-widget-content">
     
<?php      
$attributes = array( 'id' => 'frmKurs');
echo form_open(  base_url() ."index.php/adm/kurs/edit", $attributes);  ?>
 
	 <div class="accordion">
            <h3 href="">KURS MATA UANG</h3>
            <div>
			<p>	
	 <?php echo form_label("Mata Uang Dari") ?>
		<select name="mata_uang_dari" >
			<?php foreach($mata_uang as $row ) {
			$sel = ($mata_uang_dari == $row["MATA_UANG"] ? " SELECTED " : "" );
			?>
			<option <?php echo $sel; ?>  value="<?php echo $row["MATA_UANG"]; ?>" ><?php echo $row["MATA_UANG"]; ?></option>
			<?php
			}
			?>			
		</select>	
	  <br/>
	  
	  <?php echo form_label("Mata Uang Ke") ?>
		<select name="mata_uang_ke" >
			<?php 
			foreach($mata_uang as $row ) {
			$sel = ($mata_uang_ke == $row["MATA_UANG"] ? " SELECTED " : "" );
			?>
			<option <?php echo $sel; ?> value="<?php echo $row["MATA_UANG"]; ?>" ><?php echo $row["MATA_UANG"]; ?></option>
			<?php
			}
			?>			
		</select>
		<br/>
	   <?php echo form_label("Tgl Kurs") ?>
	   <?php 
	   $tgl_kurs = array(
               'name'        => 'tgl_kurs',
               'id'          => 'tgl_kurs', 
               'class'       => 'datepicker',
			   'value'		 => $tgl_kurs	
             );
			 
	   echo form_input($tgl_kurs) ?>		
	   <br/>
	   <br/>
	   <?php echo form_label("Nilai") ?>
	   <?php 
	   
	   $nilai = array(
               'name'        => 'nilai',
               'id'          => 'nilai',  
                'class' => "number {validate:{required:true,maxlength:255}}",
			   'value'		 => $nilai	
             );
	   
	   echo form_input($nilai) ?>
	   
	    	
 
</p>		
			</div>
	</div>			

    <p>
        <button type="button" id="btncancel"  >Cancel</button>
            <button type="button" id="btnSubmit"  >Submit</button>
    </p>
</form>	
</fieldset> 
 <script>
  
  $(document).ready(function(){
  
	$("#btncancel").click(function(){
		window.location = "<?php echo base_url() ."index.php/adm/kurs"; ?>";  
	});
  
    $(".accordion")
    .addClass("ui-accordion ui-widget ui-helper-reset")
    //.css("width", "auto")
    .find('h3')
    .addClass("current ui-accordion-header ui-helper-reset ui-state-active ui-corner-top")
    .css("padding", ".5em .5em .5em .7em")
    //.prepend('<span class="ui-icon ui-icon-triangle-1-s"><span/>')
    .next()
    .addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active")
    .css('overflow','visible')


     var validator = $("#frmKurs").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
     });
     
     
       $("#btnSubmit").click(function(){
			 if(validator.form()) {
			 
			 
				 jQuery("#frmKurs").ajaxSubmit({
                    //clearForm: false,
                    success: function(msg){
                       // alert(msg);
			 
                            if(msg) {
                                    window.location = "<?php echo base_url(); ?>index.php/adm/kurs";    
                            }

                        //reload grid
                        
                    },
                    error: function(){
                        alert('Data gagal disimpan')
                    }
                });

//				 
			}
		});
	


  });
  
</script>        
 
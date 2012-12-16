<?php $this->load->helper('form'); ?>
<div class="accordion"> 
            <div>
   <fieldset class="ui-widget-content">
      <form   method="POST" action="add_tender" >
        <p>	
            <?php echo form_label("Metode Pengadaan") ?>
	    <input type="text" style="width: 50%" readonly="true"   value="<?php echo $nama_metode_tender;   ?>" />
	</p>
        <p>	
            <?php echo form_label("Panitia Pelelangan") ?>
	</p>
        <p>	
            <?php echo form_label("Sistem Sampul") ?>
	    <input type="text" style="width: 50%" readonly="true"   value="<?php echo $nama_metode_sampul;   ?>" />
	</p>
        <p>	
            <?php echo form_label("Metode Evaluasi") ?>
	    <input type="text" style="width: 50%" readonly="true"   value="<?php echo $nama_metode_sampul;   ?>" />
	</p>
        
        
    	<p>	
            <?php echo form_label("Template Evaluasi") ?>
	    <input type="text" style="width: 50%" readonly="true"     value="<?php echo $template_evaluasi; ?>" />
	</p>
        
         <p>	
            <?php echo form_label("Klasifikasi Peserta") ?>
	</p>
         <p>	
            <?php echo form_label("Keterangan Tambahan") ?>
            <input type="text" style="width: 50%" readonly="true"     value="<?php echo $keterangan_tambahan; ?>" /> 
	</p>
        
         
        
        
      </form>
   </fieldset>     
          </div>
</div> 

<?php $this->load->helper('form'); ?>
<div class="accordion"> 
            <div>
   <fieldset class="ui-widget-content">
      <form   method="POST" action="add_tender" >
        <p>	
            <?php echo form_label("Metode Pengadaan") ?>
	    <input type="text" style="width: 50%" readonly="true"   value="<?php echo $nama_metode_tender;   ?>" />
	</p>
        <?php 
        if (strlen($nama_panitia) > 0 ) {
        ?>    
         
        <p>	
            <?php echo form_label("Panitia Pelelangan") ?>
            	    <input type="text" style="width: 50%" readonly="true"   value="<?php echo $nama_panitia;   ?>" />
	</p>
        <?php
        }
        ?>
 
        <?php if  ($nama_metode_tender != "PENUNJUKAN LANGSUNG" ) {  ?>
        <p>	
            <?php echo form_label("Sistem Sampul") ?>
	    <input type="text" style="width: 50%" readonly="true"   value="<?php echo $nama_metode_sampul;   ?>" />
	</p>
        <?php }  ?> 
        
    	<p>	
            <?php echo form_label("Template Evaluasi") ?>
	    <input type="text" style="width: 50%" readonly="true"     value="<?php echo $template_evaluasi; ?>" />
	</p>
        
         <p>	
            <?php echo form_label("Klasifikasi Peserta") ?>
            <input type="checkbox" DISABLED  <?php echo $kode_klas_vendor_K == 'K' ? ' CHECKED ' : '  ' ; ?> >&nbsp;Kecil</input> 
            &nbsp;<input type="checkbox" DISABLED  <?php echo $kode_klas_vendor_M == 'M' ? ' CHECKED ' : '  ' ; ?>  >&nbsp;Menengah</input> 
            &nbsp;<input type="checkbox" DISABLED  <?php echo $kode_klas_vendor_B == 'B' ? ' CHECKED ' : '  ' ; ?> >&nbsp;Besar</input> 
             
	</p>
         <p>	
            <?php echo form_label("Keterangan Tambahan") ?>
            <input type="text" style="width: 50%" readonly="true"     value="<?php echo $keterangan_tambahan; ?>" /> 
	</p>
        
         
        
        
      </form>
   </fieldset>     
          </div>
</div> 

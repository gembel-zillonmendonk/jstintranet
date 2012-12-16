<?php $this->load->helper('form'); ?>
<div class="accordion"> 
            <div>
   <fieldset class="ui-widget-content">
      <form id="frmPermintaan" method="POST" action="add_tender" >
        <p>	
            <?php echo form_label("User *") ?>
	    <input type="text" style="width: 50%" readonly="true" name="NAMA_JABATAN"  value="<?php echo $this->session->userdata("nama_jabatan"); ; ?>" />
	</p>
        <p>	
            <?php echo form_label("Biro/Unit *") ?>
	    <input type="text" style="width: 50%" readonly="true" name="NAMA_KANTOR" value="<?php echo $this->session->userdata("nama_kantor"); ; ?>" />
	</p>
    	<p>	
            <?php echo form_label("NAMA PEKERJAAN *") ?>
	    <input type="text" style="width: 50%" readonly="true"     id="JUDUL_PEKERJAAN" name="JUDUL_PEKERJAAN" value="<?php echo $judul_pekerjaan; ?>" />
	</p>
        <p>	
            <?php echo form_label("DISKRIPSI PEKERJAAN *") ?>
	    <input type="text" style="width: 50%" readonly="true"    id="LINGKUP_PEKERJAAN" name="LINGKUP_PEKERJAAN" value="<?php echo $lingkup_pekerjaan; ?>" /> 
	</p>
    
        <p>	
            <?php echo form_label("JENIS KONTRAK *") ?>
             <input type="text" style="width: 50%" readonly="true" value="<?php echo $tipe_kontrak; ?>" />
        </p>
        
         
      </form>
   </fieldset>     
          </div>
</div> 

 
  
<?php $this->load->helper('form'); ?>
   
 
            
            <div   >
  <fieldset class="ui-widget-content">
   <form id="frmHargaJasa" method="POST" action="" >
    <legend>Fields with remark (*) is required.</legend>
 
			<p>	
			 <?php echo form_label("Kode Jasa") ?>
	   <?php 
	   $kode_jasa = array (
			'id' => 'kode_jasa',
			'name' => 'kode_jasa',
			'readonly' => true,
                        'value' => $KODE_JASA
			
	   );
	   
	   echo form_input($kode_jasa) ?> 
	   </p>
	   <p> 
	  <label for="nama_jasa" class="control-label">Nama Jasa *</label>
	   <?php 
		$nama_jasa = array(
					 'id' => 'nama_jasa',
					 'name' => 'nama_jasa',
                                         'readonly' => TRUE,
					 'style' => 'width: 50%',
					 'class' => " {validate:{required:true,maxlength:255}}",
					 'value' => $NAMA_JASA
                    );
	   
	   echo form_input($nama_jasa) ?>
	   </p>
	   <p> 
	   <?php echo form_label("Kode Kantor") ?>
            <?php 
	   $kode_kantor = array (
			'id' => 'kode_kantor',
			'name' => 'kode_kantor',
			'readonly' => true,
                        'value' => $KODE_KANTOR
			
	   );
           echo form_input($kode_kantor) ?> 
           <!--
	   <select name="kode_kantor" >
			$sel = ($row["KODE_KANTOR"] == $this->session->userdata("kode_kantor") ? " SELECTED " : ""); 
			
			?>
			<option value="<?php echo $row["KODE_KANTOR"]; ?>"  <?php echo $sel; ?> ><?php echo $row["NAMA_KANTOR"]; ?></option>
			<?php
			 
			?>			
		</select>
	 -->	
	   </p> 
           <p>
               <?php echo form_label("Tanggal") ?>
               <input type="text" style="" name="TGL_SUMBER"  value="<?php echo $TGL_SUMBER; ?>" id="TGL_SUMBER" style="" class="datepicker  {validate:{required:true,date:true}}"  />  
           </p>
           
		<p> 
	   <?php echo form_label("Sumber") ?>
	   <?php 
	   $nama_sumber = array (
			'id' => 'nama_sumber',
			'name' => 'nama_sumber',
			'readonly' => true,
                        'value' => $NAMA_SUMBER
			
	   );
           echo form_input($nama_sumber) ?> 
	   </p> 
 
	   <p>
		<?php echo form_label("Mata Uang") ?>

	 	<select name="mata_uang" type="dropdown" >
			<?php foreach($mata_uang as $row ) {
			?>
			<option value="<?php echo $row["MATA_UANG"]; ?>" ><?php echo $row["MATA_UANG"]; ?></option>
			<?php
			}
			?>			
		</select>	
	  	</p>
		
			
		<p> 
                <label for="harga"   >Harga Satuan</label>                 
                    <input type="number" name="harga" value="<?php echo $HARGA; ?>" id="harga"   maxlength="22" style=""    />                
        </p>		
	   <p> 
                <label     >Vendor</label>                 
                  <?php 
                  	$nama_vendor = array(
					 'id' => 'nama_vendor',
                                         'readonly' => true,   
					 'name' => 'nama_vendor',
					  'style' => 'width: 50%',
					 'class' => " {validate:{maxlength:4000}}",
                                         'value' => $NAMA_VENDOR
					 );		

				echo form_input($nama_vendor) ?>
  
        </p>		
	   <p> 
                <label     >Catatan</label>                 
                  <?php 
					$catatan = array(
					 'id' => 'catatan',
                                         'readonly' => true,   
					 'name' => 'catatan',
					  'style' => 'width: 50%',
					 'class' => " {validate:{maxlength:4000}}",
                                          'value' => $CATATAN  
					 );		

		echo form_input($catatan) ?>
  
        </p>		
		<p> 
                <label     >Lampiran</label>                 
                <a target="_blank" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;"  href="<?php echo base_url(); ?>uploaded_test/<?php echo $LAMPIRAN; ?>" ><?php echo $LAMPIRAN; ?></a>
        </p>
		 
	  </form>
</fieldset>
	  	
			</div>
		 
   
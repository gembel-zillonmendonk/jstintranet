<?php $this->load->helper('form'); ?>
<div   >
  <fieldset class="ui-widget-content">
   <legend>Kolom dengan tanda (*) wajib diisi.</legend>
   <form id="frmHargaBarang" method="POST" action="" >
    
	   <p>	
	   <?php echo form_label("Kode Barang") ?>
	   <?php 
	   $kode_barang = array (
			'id' => 'kode_barang',
			'name' => 'kode_barang',
			'readonly' => true,
                        'value' => $KODE_BARANG
			
	   );
	   
	   echo form_input($kode_barang) ?>&nbsp;<button type="button" id="btnPopup"  >...</button>
	   </p>
	   <p>	
	   <?php echo form_label("Kode Sub Barang") ?>
	   <?php 
	   $kode_sub_barang = array (
			'id' => 'kode_sub_barang',
			'name' => 'kode_sub_barang',
			'readonly' => true,
                        'value' => $KODE_SUB_BARANG

			
	   ); 
	   echo form_input($kode_sub_barang) ?> 
	   </p>
	   <p> 
	  <label for="nama_jasa" class="control-label">Nama Barang *</label>
	   <?php 
		$nama_jasa = array(
					 'id' => 'nama_barang',
					 'name' => 'nama_barang',
					 'style' => 'width: 50%',
					 'class' => " {validate:{required:true,maxlength:255}}",
                                         'readonly' => true,
                                         'value' => $NAMA_BARANG
                                    );
	   
	   echo form_input($nama_jasa) ?>
	   </p>
	   <p> 
	   <?php echo form_label("Kode Kantor") ?>
	   <?php 
		$kode_kantor = array(
					 'id' => 'kode_kantor',
					 'name' => 'kode_kantor',
					 'style' => 'width: 50%',
					 'class' => " {validate:{required:true,maxlength:255}}",
                                         'readonly' => true,
                                         'value' => $KODE_KANTOR
                                    );
	   
	   echo form_input($kode_kantor) ?>	
	   </p> 
		 <p> 
	   <?php echo form_label("Sumber") ?>
	   <?php 
		$nama_sumber = array(
					 'id' => 'nama_sumber',
					 'name' => 'nama_sumber',
					 'style' => 'width: 50%',
					 'class' => " {validate:{required:true,maxlength:255}}",
                                         'readonly' => true,
                                         'value' => $NAMA_SUMBER
                                    );
	   
	   echo form_input($nama_sumber) ?>	
	   </p> 
 
	   <p>
		<?php echo form_label("Mata Uang") ?>
<?php 
		$mata_uang = array(
					 'id' => 'mata_uang',
					 'name' => 'mata_uang',
					 'style' => 'width: 50%',
					 'class' => " {validate:{required:true,maxlength:255}}",
                                         'readonly' => true,
                                         'value' => $MATA_UANG
                                    );
	   
	   echo form_input($mata_uang) ?>	
	  	</p>
		
		<div style="width: 50%;float: left" >		
		<p> 
                <label for="harga"   >Harga Satuan</label>                 
                <input type="number" name="harga" value="0" id="harga" value="<?php echo $HARGA ; ?>"  maxlength="22" style=""    />                
        </p>
		<p> 
                <label for="harga"   >Biaya Penanganan</label>                 
                <input type="number" name="biaya_penanganan" value="<?php echo $BIAYA_PENANGANAN ; ?>" id="biaya_penanganan"   maxlength="22" style=""    />                
        </p>
		<p> 
                <label for="harga"   >Biaya Asuransi</label>                 
                <input type="number" name="biaya_asuransi" value="<?php echo $BIAYA_ASURANSI ; ?>" id="biaya_asuransi"   maxlength="22" style=""    />                
        </p>
		</div>
		<div style="width: 50%;float: left" >
		<p> 
                <label for="harga"   >Biaya Kargo</label>                 
                <input type="number" name="biaya_kargo"  value="<?php echo $BIAYA_KARGO ; ?>"  id="biaya_kargo"   maxlength="22" style=""    />                
        </p>
		<p> 
                <label for="harga"   >Bea Pajak</label>                 
                <input type="number" name="bea_pajak"   value="<?php echo $BEA_PAJAK ; ?>" id="bea_pajak"   maxlength="22" style=""    />                
        </p>
		<p> 
                <label for="harga"   >Diskon</label>                 
                <input type="number" name="diskon"   value="<?php echo $DISKON ; ?>" id="diskon"   maxlength="22" style=""    />                
        </p>
		</div>
		<p> 
                <label for="harga"   >Total Biaya</label>                 
                <input type="number" name="total_biaya"   value="<?php echo $TOTAL_BIAYA ; ?>" id="total_biaya"   maxlength="22" style=""    />                
        </p>
		
	   <p> 
                <label     >Vendor</label>                 
                   <?php 
					$nama_vendor = array(
					 'id' => 'nama_vendor',
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
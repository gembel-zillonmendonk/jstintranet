<?php $this->load->helper('form'); ?>
<div class="accordion">
 <h3 href="<?php echo base_url()?>index.php/adm/gridr/ep_kom_harga_barang_banding?KODE_BARANG=<?php echo $KODE_BARANG; ?>&KODE_SUB_BARANG=<?php echo $KODE_SUB_BARANG; ?>">PERBANDINGAN HARGA BARANG</h3>
            <div>
  
			 <fieldset class="ui-widget-content">
   
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
	   
	   echo form_input($kode_barang) ?>&nbsp; 
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
   </form>
                         </fieldset>
			
			 
			
			 
			<div id="list" ></div>
			</div>
  </div>
<p align="center">
        <button type="button"  id="btnKembali" >Kembali</button>
</p>
 <script>
  
  $(document).ready(function(){
	//$("#mysearch").jqGrid('filterGrid','#grid_ep_kom_kelompok_jasa');
	
     $("#btnKembali").click(function(){
         window.location = "<?php echo base_url(); ?>index.php/adm/harga_barang";
         
     });   
        
     $(".accordion" ).each(function(){
                 
                
                $('h3', $(this)).each(function(){
                    var uri = $(this).attr('href');
                    if(uri != '' && uri != '#'){
                        var ctn = $("#list") ;
                        //alert($(ctn).width());
                        //alert(uri);
                        if(ctn.html() == '')
                            ctn.load(uri);
                    }
                });
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
	  
    });
  
</script>   			
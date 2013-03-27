
<?php $this->load->helper('form'); ?>
<fieldset class="ui-widget-content">
     
 
   
	 <div class="accordion">
            <h3 href="">PANITIA</h3>
            <div>
                 <form>
			<p>	
	 <?php echo form_label("Nama  Panitia") ?>
	 <?php 
	 $nama_panitia = array(
					 'id' => 'nama_panitia',
					 'name' => 'nama_panitia',
					 'value' => $val_nama_panitia,
					 'readonly' => true,
					 'style' => 'width: 50%',
					 'class' => " {validate:{required:true,maxlength:255}}"
					 );
	 
	 echo form_input($nama_panitia); 
	 ?>
	 </p>	
	 <p>	
	<?php echo form_label("Kantor") ?> 
		<select name="kode_kantor" >
			<?php foreach($kode_kantor as $row ) {
			?>
			<option value="<?php echo $row["KODE_KANTOR"]; ?>" ><?php echo $row["NAMA_KANTOR"]; ?></option>
			<?php
			}
			?>			
		</select>	
	</p>	
        </form> 
	</div>
	</div>			
	
	
	 <div class="accordion">
            <h3 href="<?php echo base_url()?>index.php/adm/gridr/ep_ms_anggota_panitia?search=true&searchField=KODE_PANITIA&searchString=1&searchOper=bw" >DETAIL ANGGOTA PANITIA</h3>
            <div>
			<p>	
		<?php
                $attributes = array( 'id' => 'frmanggota');
                echo form_open("", $attributes);; ?>
  
		<?php echo form_label("Jabatan") ?> 
		<select name="kode_jabatan" >
			<?php foreach($kode_jabatan as $row ) {
			?>
			<option value="<?php echo $row["KODE_JABATAN"]; ?>" ><?php echo $row["NAMA_JABATAN"]; ?></option>
			<?php
			}
			?>			
		</select>	
		<br/> 
		<?php echo form_label("Status Pemimpin") ?> 
		<input type="checkbox" name="status_pemimpin" value="1"  ></input>	 
                
		<p>
				<button type="button" id="btnAddAnggota"  >Tambah Anggota</button> 
				<input type="hidden" id="add_type" name="add_type"  value="" /> 
				<input type="hidden" id="kode_kantor" name="kode_kantor_key"  value="<?php echo $kode_kantor_key; ?>" /> 
				<input type="hidden" id="kode_panitia" name="kode_panitia_key"  value="<?php echo $kode_panitia; ?>" /> 
				 
			</p>
                </form>	        
                        
	 	<div id="list" ></div>
	  </p>
			</div>
		
			
	</div>			
 
    <p>
        <button type="button" id="btncancel"  >Kembali</button>
  
    </p>

</fieldset> 
 <script>
  
  $(document).ready(function(){
  
	$("#btncancel").click(function(){
		window.location = "<?php echo base_url() ."index.php/adm/panitia"; ?>";  
	});
  
	$("#btnAddAnggota").click(function(){
		$("#add_type").val("add_anggota");
		$("#frmanggota").submit();
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
  
  function fnDeleteAnggotaPanitia(str) {
      
    $('#grid_ep_ms_anggota_panitia').jqGrid('setSelection',str); 
    var selected = $('#grid_ep_ms_anggota_panitia').jqGrid('getGridParam', 'selrow');
    selected = jQuery('#grid_ep_ms_anggota_panitia').jqGrid('getRowData',selected );
    
    var KODE_PANITIA = selected["KODE_PANITIA"];
    var KODE_KANTOR = selected["KODE_KANTOR"];
    var KODE_JABATAN = selected["KODE_JABATAN"];
    
    
    if (confirm("Akan Menghapus Anggota")) { 
         window.location = "<?php echo base_url(); ?>index.php/adm/panitia/delete?KODE_PANITIA=" +  KODE_PANITIA + "&KODE_KANTOR=" +  KODE_KANTOR + "&KODE_JABATAN=" +  KODE_JABATAN;
    }
    
  }
  
  
</script>        
 
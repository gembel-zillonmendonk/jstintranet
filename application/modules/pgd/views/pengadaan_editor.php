<?php
// echo $kode_aktifitas . "-> " . $nama_aktifitas . "<br/>";
 
// print_r($arr_antarmuka);

?>
<div id="trace"></div>
<?php $this->load->helper('form'); ?>
 <script type="text/javascript" src="<?php echo base_url();  ?>js/tiny_mce/tiny_mce.js"></script> 
<?php
if (in_array("MonitorTender", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="MonitorTender" href="<?php echo base_url(); ?>index.php/pgd/pengadaan_monitor/header?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">HEADER</h3>
    <div>
        
          <div id="list" ></div> 
    </div>
 </div>
<?php
}
?> 
<?php
if (in_array("MonitorMataAnggaran", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="MonitorMataAnggaran" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_perencanaan_anggaran?KODE_PERENCANAAN=<?php echo $kode_perencanaan; ?>&KODE_KANTOR_PERENCANAAN=<?php echo $kode_kantor_perencanaan; ?>">MATA ANGGARAN</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
<?php
}
?> 

  
 
<?php
if (in_array("MonitorTenderDetail", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="MonitorTenderDetail" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_tender_view?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">ITEM </h3>
    <div>
          <div id="list" ></div>
          <div id="item_total" ref="<?php echo base_url(); ?>index.php/pgd/item_total/total?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>"  >
          </div>
    </div>
 </div>
 
 <script>
 $(document).ready(function(){
     
     $('#item_total').each(function(){
        
                    var uri = $(this).attr('ref');
				//	alert(uri);
                            $(this).load(uri);
                    }
                 );
     
 });
 
 
 </script> 
 
 
<?php
}
?> 

 <?php
if (in_array("MonitorTenderDetailTanpaHps", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="MonitorTenderDetailTanpaHps" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_tender_tanpa_hps?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">ITEM </h3>
    <div>
          <div id="list" ></div>
           
          </div>
    </div>
 </div>
 
 <script>
 $(document).ready(function(){
     
     $('#item_total').each(function(){
        
                    var uri = $(this).attr('ref');
				//	alert(uri);
                            $(this).load(uri);
                    }
                 );
     
 });
 
 
 </script> 
 
 
<?php
}
?> 


<?php
if (in_array("InputTenderDetail", $arr_antarmuka)) {
?>
<div id="modal_form_barangjasa" ></div> 
<div class="accordion">
 <h3 id="InputTenderDetail" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_tender_edit?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >ITEM</h3>
    <div>
        <fieldset class="ui-widget-content">
      <form id="frmBarangJasa" method="POST" action="update_item_tender" >            
    	<p>	
            <?php echo form_label("Kode *") ?>
	    <input type="text" readonly style="width: 50%" class="{validate:{required:true}}"   id="KODE_BARANG_JASA" name="KODE_BARANG_JASA" value="" />
            <!--
            <button type="button" id="btnBarangJasa" >...</button>
            -->
	</p>   
        <p>	
            <?php echo form_label("Sub Barang/Jasa *") ?>
	    <input type="text" readonly style="width: 50%" class="{validate:{required:true}}"   id="KODE_SUB_BARANG_JASA" name="KODE_SUB_BARANG_JASA" value="" />
	</p>   
        <p>	
            <?php echo form_label("Deskripsi *") ?>
	    <input type="text" readonly style="width: 50%" class="{validate:{required:true}}"   id="KETERANGAN" name="KETERANGAN" value="" />
	</p>   
        <p>	
            <?php echo form_label("Jumlah *") ?>
	    <input type="number"   readonly class="{validate:{required:true}}"   id="JUMLAH" name="JUMLAH" value="" />
	</p>   
        <p>	
            <?php echo form_label("Satuan") ?>
	    <input type="text"   readonly   id="UNIT" name="UNIT" value="" />
	</p>
        <p>	
            <?php echo form_label("Harga *") ?>
	    <input type="number"   class="{validate:{required:true}}"   id="HARGA" name="HARGA" value="" />
	</p>
        <p>	
            <?php echo form_label("PPN *") ?>
	    <select  class="{validate:{required:true}}"   id="PPN" name="PPN" >
                <option value="Y" >YA</option>
                <option value="T" >TIDAK</option>
            </select>    
	</p>
        
        <input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR_TENDER" VALUE="<?php echo $kode_kantor  ; ?>"  />
        <input type="hidden" name="KODE_TENDER" id="KODE_TENDER"  VALUE="<?php echo $kode_tender  ; ?>"  />
        
        <button type="button"  id="btnAddBarangJasa" >UPDATE</button>
       
        <button type="button"  id="btnResetBarangJasa" >Kosongkan</button>
       
        
        
      </form>
           </fieldset>     
       
        <div id="list" ></div>
        <div id="item_total" ref="<?php echo base_url(); ?>index.php/pgd/item_total/total?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>"  >
    </div>
 </div>     
 <script>
 
   
  $(document).ready(function(){
	
        var uri = $('#item_total').attr('ref');
        $("#item_total").load(uri);
     
     
        var validatorBarangJasa = $("#frmBarangJasa").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
      
        
      
        $("#btnResetBarangJasa").click(function(){
            $("#frmBarangJasa input[type=text], #frmBarangJasa input[type=number]").val("");
          //   $("#btnAddBarangJasa").html("TAMBAH");
            
        });
      
        $("#btnAddBarangJasa").click(function() {
        
     
            	 if(validatorBarangJasa.form()) {
                    $("#frmBarangJasa").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                       //alert(msg);
      //                                $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                                      var grid = $("#grid_ep_pgd_item_tender_edit");
			
                        		grid.trigger("reloadGrid",[{page:1}]);
                                     
                                      var uri = $('#item_total').attr('ref');
				//	alert(uri);
                                        $("#item_total").load(uri);
                                        
                                         $("#frmBarangJasa input[type=text], #frmBarangJasa input[type=number]").val("");
                                          
                                          
                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
                 
      });
        $("#btnBarangJasa").click(function() {
        
		str= "";
		jQuery('#modal_form_barangjasa')
                     .load($site_url + '/pgd/barang_jasa_get' + str)
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_barangjasa').dialog("open");
        });    
        
        
  });	
  
   
 function fnBarangJasa(arr){
     
     $("#KODE_BARANG_JASA").val(arr[0]);
     $("#KODE_SUB_BARANG_JASA").val(arr[1]);
     $("#KETERANGAN").val(arr[2]);
     jQuery('#modal_form_barangjasa').dialog("close");
     
 }
 
   
 function fnEditBarangJasa(str){    
     
      //  alert(str);
        $('#grid_ep_pgd_item_tender_edit').jqGrid('setSelection',str); 
     	var selected = $('#grid_ep_pgd_item_tender_edit').jqGrid('getGridParam', 'selrow');
				 selected = jQuery('#grid_ep_pgd_item_tender_edit').jqGrid('getRowData',selected);
			 
				 
                                 
     $("#KODE_BARANG_JASA").val(selected["KODE_BARANG_JASA"]);
     $("#KODE_SUB_BARANG_JASA").val(selected["KODE_SUB_BARANG_JASA"]);
     
     $("#KETERANGAN").val(selected["KETERANGAN"]);
     $("#JUMLAH").val(selected["JUMLAH"]);
     $("#UNIT").val(selected["UNIT"]);
     $("#PPN").val(selected["PPN"]);
      harga = selected["HARGA"].replace(/,/g,"");
    
     $("#HARGA").val(Number(harga)  );
     $("#btnAddBarangJasa").html("UPDATE");

jQuery('#modal_form_barangjasa').dialog("close");
 }
 
 
 
 
 
 </script>
 


<?php
}
?>


<?php
if (in_array("AddTenderDetail", $arr_antarmuka)) {
?>
<div id="modal_form_barangjasa" ></div> 
<div class="accordion">
 <h3 id="InputTenderDetail" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_tender?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >ITEM</h3>
    <div>
        <fieldset class="ui-widget-content">
      <form id="frmBarangJasa" method="POST" action="add_item_tender" >            
    	<p>	
            <?php echo form_label("Kode *") ?>
	    <input type="text" readonly style="width: 50%" class="{validate:{required:true}}"   id="KODE_BARANG_JASA" name="KODE_BARANG_JASA" value="" /><button type="button" id="btnBarangJasa" >...</button>
	</p>   
        <p>	
            <?php echo form_label("Sub Barang/Jasa *") ?>
	    <input type="text" readonly style="width: 50%" class="{validate:{required:true}}"   id="KODE_SUB_BARANG_JASA" name="KODE_SUB_BARANG_JASA" value="" />
	</p>   
        <p>	
            <?php echo form_label("Deskripsi *") ?>
	    <input type="text" style="width: 50%" class="{validate:{required:true}}"   id="KETERANGAN" name="KETERANGAN" value="" />
	</p>   
        <p>	
            <?php echo form_label("Jumlah *") ?>
	    <input type="number"   class="{validate:{required:true}}"   id="JUMLAH" name="JUMLAH" value="" />
	</p>   
        <p>	
            <?php echo form_label("Satuan") ?>
	    <input type="text"     id="UNIT" name="UNIT" value="" />
	</p>
        <p>	
            <?php echo form_label("Harga *") ?>
	    <input type="number"   class="{validate:{required:true}}"   id="HARGAX" name="HARGA" value="" />
	</p>
        
        <input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR_TENDER" VALUE="<?php echo $kode_kantor  ; ?>"  />
        <input type="hidden" name="KODE_TENDER" id="KODE_TENDER"  VALUE="<?php echo $kode_tender  ; ?>"  />
        
        
        
      </form>
            <button type="button"  id="btnAddBarangJasa" >TAMBAH</button>
        <button type="button"  id="btnResetTenderDetail" >Kosongkan</button>
        
        
           </fieldset>     
       
        <div id="list" ></div>
        <div id="item_total" ref="<?php echo base_url(); ?>index.php/pgd/item_total/total?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>"  >
    </div>
 </div>     
 <script>
 
   
  $(document).ready(function(){
	 
        var validatorBarangJasa = $("#frmBarangJasa").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
     
        $("#btnResetTenderDetail").click(function(){
            $("#frmBarangJasa input[type=text], #frmBarangJasa input[type=number]").val("");  
            $("#btnAddBarangJasa").html("TAMBAH");
        });
      
      var uri = $('#item_total').attr('ref');
      $("#item_total").load(uri);
                                     
     
        $("#btnAddBarangJasa").click(function() {
        
     
            	 if(validatorBarangJasa.form()) {
                    $("#frmBarangJasa").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                       //alert(msg);
      //                                $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                                      var grid = $("#grid_ep_pgd_item_tender");
			
                        		grid.trigger("reloadGrid",[{page:1}]);
                                     
                                      var uri = $('#item_total').attr('ref');
				//	alert(uri);
                                        $("#item_total").load(uri);
                                        
                                        // Kosongkan
                                        
                                        $("#frmBarangJasa input[type=text], #frmBarangJasa input[type=number] ").val("");
                                        

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
                 
      });
        $("#btnBarangJasa").click(function() {
        
		str= "";
		jQuery('#modal_form_barangjasa')
                     .load($site_url + '/pgd/barang_jasa_get' + str)
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_barangjasa').dialog("open");
        });    
  });	
  
   
 function fnBarangJasa(arr){
     
     $("#KODE_BARANG_JASA").val(arr[0]);
     $("#KODE_SUB_BARANG_JASA").val(arr[1]);
     $("#KETERANGAN").val(arr[2]);
     jQuery('#modal_form_barangjasa').dialog("close");
     
 }
 
 
   
 function fnEditBarangJasa(str){    
     
    //    alert(str);
        $('#grid_ep_pgd_item_tender').jqGrid('setSelection',str); 
     	var selected = $('#grid_ep_pgd_item_tender').jqGrid('getGridParam', 'selrow');
				 selected = jQuery('#grid_ep_pgd_item_tender').jqGrid('getRowData',selected);
			 
				 
                                 
     $("#KODE_BARANG_JASA").val(selected["KODE_BARANG_JASA"]);
     $("#KODE_SUB_BARANG_JASA").val(selected["KODE_SUB_BARANG_JASA"]);
     
    $("#KETERANGAN").val(selected["KETERANGAN"]);
     $("#JUMLAH").val(selected["JUMLAH"]);
     $("#UNIT").val(selected["UNIT"]);
     harga = selected["HARGA"].replace(/,/g,"");
     
     
     $("#HARGAX").val(Number(harga));
     
    // alert(selected["HARGA"].replace(/,/g ,""));
     $("#btnAddBarangJasa").html("UPDATE");
    jQuery('#modal_form_barangjasa').dialog("close");
 }
 
 function fnDeleteBarangJasa(str){
    // alert(str);
     $('#grid_ep_pgd_item_tender').jqGrid('setSelection',str); 
     var selected = $('#grid_ep_pgd_item_tender').jqGrid('getGridParam', 'selrow');
     selected = jQuery('#grid_ep_pgd_item_tender').jqGrid('getRowData',selected);
	
     if (confirm("Akan Menghapus Item Barang/Jasa")) {    
     $.ajax({
        type: "POST",
        data : "KODE_TENDER="   + selected["KODE_TENDER"] + "&KODE_KANTOR=" + selected["KODE_KANTOR"] + "&KODE_BARANG_JASA=" +  selected["KODE_BARANG_JASA"] + "&KODE_SUB_BARANG_JASA=" + selected["KODE_SUB_BARANG_JASA"] ,
        url: "<?php echo base_url(); ?>index.php/pgd/pekerjaan_pgd/delete_tender_item",
        success : function(msg) {
           // alert(msg);
          // $("#trace").html(msg);
          
            
            var grid = $("#grid_ep_pgd_item_tender");
            grid.trigger("reloadGrid",[{page:1}]);
            
            var uri = $('#item_total').attr('ref');
            $("#item_total").load(uri);
      
        } ,
        error : function() {
            alert("Hapus Data Item Tender");
            
        }
       
         });
       }  
          
        
 }
 
 
 </script>
 


<?php
}
?>

<?php
if (in_array("InputPembelianDetail", $arr_antarmuka)) {
?>
 
 
 
<div id="modal_form_barangjasa" ></div> 
<div class="accordion">
    <h3 id="Pembelian" href="" >DATA PEMBELIAN</h3>
    <div>
        <fieldset class="ui-widget-content">
            <form id="frmPembelian" method="POST" action="update_pembelian" >
                  <input type="hidden" name="KODE_TENDER" id="KODE_TENDER"  VALUE="<?php echo $kode_tender  ; ?>"  />
                  <input type="hidden" name="KODE_KANTOR" id="KODE_TENDER"  VALUE="<?php echo $kode_kantor  ; ?>"  />
    
                <p>
                    <?php echo form_label("Nama Vendor *") ?>
                    <input type="text" style="width: 50%" class="{validate:{required:true}}"   id="NAMA_VENDOR" name="NAMA_VENDOR" value="<?php echo $PEMBELIAN_NAMA_VENDOR; ?>" />
                </p>
                <p> 
                    <?php echo form_label("Tgl Pembelian *") ?>
                    <input type="text" style="" value="<?php echo $PEMBELIAN_TGL_PEMBELIAN; ?>" name="TGL_PEMBELIAN" value="" id="TGL_PEMBELIAN" style="" class="datepicker  {validate:{required:true,date:true}}"  />  
                </p>
                <p> 
                    <?php echo form_label("Menggunakan PPN * ") ?>
                     <select name="PPN" class="{validate:{required:true}}"  >
                         <option   <?php echo ($PEMBELIAN_PPN == "0" ? " SELECTED " : "") ; ?> value="0" >TIDAK</option>
                         <option    <?php echo ($PEMBELIAN_PPN == "1" ? " SELECTED " :"") ; ?>  value="1" >YA</option>
                     </select>
                </p>
                <p> 
                    <?php echo form_label("Keterangan") ?>
                    <input type="text" value="<?php echo $PEMBELIAN_KETERANGAN; ?>" style="width: 50%" name="KETERANGAN" value="" id="KETERANGAN" style=""  />  
                </p>
                
                 
            </form>     
            
        </fieldset>   
        <button type="button" id="btnPembelianSubmit" >Submit</button>
        
        
    </div>    
    
 <h3 id="InputPembelianDetail" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_pembelian_edit?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >ITEM PEMBELIAN</h3>
    
    <div>
        
        <fieldset class="ui-widget-content">
      <form id="frmPembelianBarangJasa" method="POST" action="update_item_pembelian" >            
    	<p>	
            <?php echo form_label("Kode *") ?>
	    <input type="text" style="width: 50%" class="{validate:{required:true}}"   READONLY  id="KODE_BARANG_JASA" name="KODE_BARANG_JASA" value="" />
            <!--
            <button type="button" id="btnBarangJasa" >...</button>
            -->
	</p>   
        <p>	
            <?php echo form_label("Sub Barang/Jasa *") ?>
	    <input type="text" style="width: 50%" class="{validate:{required:true}}"  READONLY  id="KODE_SUB_BARANG_JASA" name="KODE_SUB_BARANG_JASA" value="" />
	</p>   
        <p>	
            <?php echo form_label("Deskripsi *") ?>
	    <input type="text" style="width: 50%" class="{validate:{required:true}}"  READONLY  id="KETERANGAN_ITEM" name="KETERANGAN" value="" />
	</p>   
        <p>	
            <?php echo form_label("Jumlah *") ?>
	    <input type="number"   class="{validate:{required:true}}"  READONLY  id="JUMLAH" name="JUMLAH" value="" />
	</p>   
        <p>	
            <?php echo form_label("Satuan") ?>
	    <input type="text"     id="UNIT" name="UNIT"  READONLY value="" />
	</p>
        <p>	
            <?php echo form_label("Harga *") ?>
	    <input type="number"   class="{validate:{required:true}}"   id="HARGA" name="HARGA" value="" />
	</p>
        
        <input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR_TENDER" VALUE="<?php echo $kode_kantor  ; ?>"  />
        <input type="hidden" name="KODE_TENDER" id="KODE_TENDER"  VALUE="<?php echo $kode_tender  ; ?>"  />
        
        
        
        
      </form>
        <button type="button"  id="btnPembelianBarangJasa" >UPDATE</button>
        
        </fieldset>     
       
        <div id="list" ></div>
        <div id="item_total_pembelian" ref="<?php echo base_url(); ?>index.php/pgd/item_total/total_pembelian?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>"  >xx
    </div>
 </div>     
 <script>
 
   
  $(document).ready(function(){

            $('#item_total_pembelian').each(function(){

                               var uri = $(this).attr('ref');
                                           //	alert(uri);
                                       $(this).load(uri);
                               }
                            );
    


        var validatorPembelian = $("#frmPembelian").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
     
     
        $("#btnPembelianSubmit").click(function() {
                alert("btnPembelianSubmit");
                if(validatorPembelian.form()) {
                    $("#frmPembelian").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                       //alert(msg);
      //                                $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                              
                                    
 
                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
        });
        
        
        var validatorPembelianBarangJasa = $("#frmPembelianBarangJasa").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
     
     
     
        $("#btnPembelianBarangJasa").click(function() {
        
              
            	 if(validatorPembelianBarangJasa.form()) {
                    $("#frmPembelianBarangJasa").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                     //    alert(msg);
      //                                $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                                      var grid = $("#grid_ep_pgd_item_pembelian_edit");
			
                        		grid.trigger("reloadGrid",[{page:1}]);
                                     
                                      var uri = $('#item_total_pembelian').attr('ref');
				//	alert(uri);
                                        $("#item_total_pembelian").load(uri);

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
                 
      });
        $("#btnBarangJasa").click(function() {
        
		str= "";
		jQuery('#modal_form_barangjasa')
                     .load($site_url + '/pgd/barang_jasa_get' + str)
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_barangjasa').dialog("open");
        });    
        
        $("#btnResetBarangJasa").click(function() {
           alert("btnResetBarangJasa");
           $("#KODE_BARANG_JASA").val("");
            $("#KODE_SUB_BARANG_JASA").val("");
            $("#KETERANGAN").val("");
            $("#JUMLAH").val(0);
            $("#UNIT").val("");
            $("#HARGA").val(0);

        });
  });	
  
   
 function fnBarangJasa(arr){
     
     $("#KODE_BARANG_JASA").val(arr[0]);
     $("#KODE_SUB_BARANG_JASA").val(arr[1]);
     $("#KETERANGAN").val(arr[2]);
     jQuery('#modal_form_barangjasa').dialog("close");
     
 }
 
   
 function fnEditBarangJasa(str){    
     
      //  alert(str);
        $('#grid_ep_pgd_item_pembelian_edit').jqGrid('setSelection',str); 
     	var selected = $('#grid_ep_pgd_item_pembelian_edit').jqGrid('getGridParam', 'selrow');
				 selected = jQuery('#grid_ep_pgd_item_pembelian_edit').jqGrid('getRowData',selected);
			 
				 
                                 
     $("#KODE_BARANG_JASA").val(selected["KODE_BARANG_JASA"]);
     $("#KODE_SUB_BARANG_JASA").val(selected["KODE_SUB_BARANG_JASA"]);
      
     $("#KETERANGAN_ITEM").val(selected["KETERANGAN"]);
     $("#JUMLAH").val(selected["JUMLAH"]);
     $("#UNIT").val(selected["UNIT"]);
     $("#HARGA").val(selected["HARGA"]);

jQuery('#modal_form_barangjasa').dialog("close");
 }
 
 
 
 
 
 </script>
 


<?php
}
?>

 
 
 
  
 <?php
if (in_array("InputPenataPerencana", $arr_antarmuka)) {
?>
 <div class="accordion">
 <h3 id="InputPenataPerencana" href="" >PENATA PERENCANA</h3>
    <div>
      <fieldset class="ui-widget-content">
      <form class="clsinput" id="frm_InputPenataPerencana" method="POST" action="update_penata_perencana" > 
         <p>
          <?php echo form_label("Penata Perencana *") ?>
            <select name="NAMA_PERENCANA" class="{validate:{required:true,maxlength:1024}}">
                <option value="">--</option>
               <?php 
               foreach ($arr_penataperencana as $k=>$v) {
                 echo "<option value='" . $k. "-" . $v . "' >".$v."</option>";
                   
               } 
               ?>
               
            </select>
           </p>
  
          <p>
              
          <button type="button"  id="btnAddPenataPerencana" >UPDATE</button>
            </p>
 
             <input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR_TENDER" VALUE="<?php echo $kode_kantor  ; ?>"  />
        <input type="hidden" name="KODE_TENDER" id="KODE_TENDER"  VALUE="<?php echo $kode_tender  ; ?>"  />
    
          
      </form>
      </fieldset>     
       
        <div id="list" ></div>
    </div>
 </div>  
 
 <script>
 var validator_InputPenataPerencana;
    
        
   $(document).ready(function(){
	  validator_InputPenataPerencana = $("#frm_InputPenataPerencana").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
        
     
         $("#btnAddPenataPerencana").click(function() {
        
     
            	 if(validator_InputPenataPerencana.form()) {
                    $("#frm_InputPenataPerencana").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                   //    alert(msg);
                                   //    $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                                    
                                     

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
                 
      });
        
     
     
   });
 
 </script> 
<?php
 }
?> 
 
 
 <?php
if (in_array("InputPenataPelaksanaNonLelang", $arr_antarmuka)) {
?>
 <div class="accordion">
 <h3 id="InputPenataPelaksanaNonLelang" href="" >PENATA PELAKSANA NON PELELANGAN</h3>
    <div>
      <fieldset class="ui-widget-content">
      <form class="clsinput" id="frm_InputPenataPelaksanaNonLelang" method="POST" action="update_penata_pelaksana" > 
         <p>
          <?php echo form_label("Penata Pelaksana Non Pelelangan *") ?>
            <select name="NAMA_PELAKSANA" class="{validate:{required:true,maxlength:1024}}">
                <option value="">--</option>
               <?php 
               foreach ($arr_penatapelaksana as $k=>$v) {
                 echo "<option value='" . $k. "-" . $v . "' >".$v."</option>";
                   
               } 
               ?>
               
            </select>
           </p>
          <p>
          <button type="button"  id="btnAddPenataPelaksanaNonLelang" >UPDATE</button>
            </p>
             <input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR_TENDER" VALUE="<?php echo $kode_kantor  ; ?>"  />
        <input type="hidden" name="KODE_TENDER" id="KODE_TENDER"  VALUE="<?php echo $kode_tender  ; ?>"  />
    
          
      </form>
      </fieldset>     
       
        <div id="list" ></div>
    </div>
 </div>  
 
 <script>
 var validator_InputPenataPelaksanaNonLelang;
   $(document).ready(function(){
	 
            validator_InputPenataPelaksanaNonLelang = $("#frm_InputPenataPelaksanaNonLelang").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
        
         $("#btnAddPenataPelaksanaNonLelang").click(function() {
        
     
            	 if(validator_InputPenataPelaksanaNonLelang.form()) {
                    $("#frm_InputPenataPelaksanaNonLelang").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                    //   alert(msg);
                                    //   $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                                    
                                     

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
                 
      });
        
     
     
   });
 
 </script> 
<?php
}
?> 

  
 <?php
if (in_array("InputPenataPelaksanaLelang", $arr_antarmuka)) {
?>
 <div class="accordion">
 <h3 id="InputPenataPelaksanaLelang" href="" >PENATA PELAKSANA PELELANGAN</h3>
    <div>
      <fieldset class="ui-widget-content">
      <form class="clsinput" id="frm_InputPenataPelaksanaLelang" method="POST" action="update_penata_pelaksana" > 
         <p>
          <?php echo form_label("Penata Pelaksana Pelelangan *") ?>
            <select name="NAMA_PELAKSANA" class="{validate:{required:true,maxlength:1024}}">
                <option value="">--</option>
               <?php 
               foreach ($arr_penatapelaksanalelang as $k=>$v) {
                 echo "<option value='" . $k. "-" . $v . "' >".$v."</option>";
                   
               } 
               ?>
               
            </select>
           </p>
          <p>
          <button type="button"  id="btnAddPenataPelaksanaLelang" >UPDATE</button>
            </p>
             <input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR_TENDER" VALUE="<?php echo $kode_kantor  ; ?>"  />
        <input type="hidden" name="KODE_TENDER" id="KODE_TENDER"  VALUE="<?php echo $kode_tender  ; ?>"  />
    
          
      </form>
      </fieldset>     
       
        <div id="list" ></div>
    </div>
 </div>  
 
 <script>
 var validator_InputPenataPelaksanaLelang;
   $(document).ready(function(){
	 
            validator_InputPenataPelaksanaLelang = $("#frm_InputPenataPelaksanaLelang").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
        
         $("#btnAddPenataPelaksanaLelang").click(function() {
        
     
            	 if(validator_InputPenataPelaksanaLelang.form()) {
                    $("#frm_InputPenataPelaksanaLelang").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                   //    alert(msg);
                                   //    $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                                    
                                     

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
                 
      });
        
     
     
   });
 
 </script> 
<?php
}
?> 

  <?php
if (in_array("InputPilihPanitia", $arr_antarmuka)) {
?>
 <div class="accordion">
     <fieldset class="ui-widget-content">
         <form class="clsinput" >
 
         </form>
     </fieldset>
 </div> 
 
 
 <?php
}
 ?>
 
 
 <?php
if (in_array("InputMetodePengadaan", $arr_antarmuka)) {
?>
 <div id="modal_form_panitia" ></div> 
  <div id="modal_form_lihat_panitia" ></div> 
 <div id="modal_form_evaluasi" ></div> 

 <div class="accordion">
 <h3 id="InputMetodePengadaan" href="" >METODE PENGADAAN</h3>
    <div>
      <fieldset class="ui-widget-content">
      <form class="clsinput" id="frm_InputMetodePengadaan" method="POST" action="update_metode_pengadaan" > 
          <p>
                <?php echo form_label("Metode Pengadaan *") ?>
              <select name="METODE_TENDER" id="METODE_TENDER" class="{validate:{required:true}}"  >
                  <option value="" >--</option>
                  <?php
                  foreach ($rs_metodetender as $row) {
                      echo "<option value='".$row->METODE_TENDER ."'>".$row->NAMA_METODE_TENDER."</option>";
                  }
                  ?>
                  
                  
              </select>
          </p>
           <div id="div_pilih_panitia" style="display: none;" >
          <p>
             <?php echo form_label("Menggunakan Panitia *") ?>
             <select name="PANITIA" id="PANITIA" class="{validate:{required:true}}"  >
                 <option value="-1" >--Pilih--</option>
                 <option value="0" >TIDAK</option>
                  
                 <option value="1" >YA</option>
                
             </select>    
          </p>     
           </div>

          <div id="div_panitia" style="display: none;" >
          <p>
                <?php echo form_label("Panitia Lelang ") ?>
               <input type="text" style="width: 50%" id="NAMA_PANITIA" name="NAMA_PANITIA" value=""  /><button type="button" id="btnPanitia" >...</button>
               <input type="hidden" name="KODE_PANITIA" id="KODE_PANITIA" value="" />
               <input type="hidden" name="KODE_KANTOR_PANITIA" id="KODE_KANTOR_PANITIA" value="" />
          </p>
          
          
           </div>
          <div id="div_sampul"  >
          <p>
                <?php echo form_label("Sistem Sampul *") ?>
              <select name="METODE_SAMPUL" id="METODE_SAMPUL" class="{validate:{required:true}}"  ></select>
          </p>
          </div>
          <p>
                <?php echo form_label("Template Evaluasi *") ?>
              <input type="text" style="width: 50%" readonly class="{validate:{required:true}}"   id="KETERANGAN_EVALUASI" name="KETERANGAN_EVALUASI" value="" /><button type="button" id="btnEvaluasi" >...</button>

           </p>
          <p>
                <?php echo form_label("Kualifikasi Peserta *") ?>
          <groupradio>
  <input type="checkbox" name="VENDOR_TIPE_K"  /> KECIL 
  <input type="checkbox" name="VENDOR_TIPE_M" /> MENENGAH 
  <input type="checkbox" name="VENDOR_TIPE_B" /> BESAR
  
</groupradio>
          
              
          </p>
          <p>
                <?php echo form_label("Keterangan Tambahan") ?>
              <input type="text" name="PTP_INQUIRY_NOTES" style="width: 50%"   />
          </p>
         <p>	
            <?php echo form_label("JENIS KONTRAK *") ?>
            <select name="TIPE_KONTRAK" class="{validate:{required:true}}" >
                <?php
                   echo "<option value='' >-- Pilih Jenis Kontrak --</option>";
                 
                foreach($arr_tipekontrak as $k=>$v) {
                    echo "<option value='" .$k. "' >".$v."</option>";
                   
                }
                 
                ?>
            </select>
         </p> 
          
          
          
          <input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR_TENDER" VALUE="<?php echo $kode_kantor  ; ?>"  />
        <input type="hidden" name="KODE_TENDER" id="KODE_TENDER"  VALUE="<?php echo $kode_tender  ; ?>"  />
     <input type="hidden" name="KODE_EVALUASI" id="KODE_EVALUASI"     />
     
          <p>
          <button type="button"  id="btnAddMetodePengadaan" >UPDATE</button>
            </p>
          
      </form>
      </fieldset>     
       
        <div id="list" ></div>
    </div>
 </div>  

 <script>
 var validator_InputMetodePengadaan;
   $(document).ready(function(){
        $("#PANITIA").change(function(){
            if ($(this).val() == 1) {
                $("#div_panitia").show();
            } else {
                 $("#div_panitia").hide();
                 $("#KODE_PANITIA").val(0);
                 $("#KODE_KANTOR_PANITIA").val("");
            }
        });
        
       $("#METODE_TENDER").change(function(){
            $("#div_pilih_panitia").hide(); 
           $("#KODE_PANITIA").val("");
           $("#KODE_KANTOR_PANITIA").val("");
           $("#NAMA_PANITIA").val("");
           $("#div_sampul").show(); 
           if ($(this).val() == 2) {
               $("#div_pilih_panitia").show();
               // $("#div_panitia").show();
           } else {
               $("#div_panitia").hide();
                 $("#div_pilih_panitia").show();
               
               if ($(this).val() == 0) {
                   $("#div_sampul").hide();
                     $("#div_pilih_panitia").hide();
                   return;
               }
           }
           
           
           $.ajax({
            url: "getMetodeSampul/" + $("#METODE_TENDER").val() ,
            type: "POST",
            data: {metode_tender : $("#METODE_TENDER").val()},
            dataType: "html",
            success: function(msg) {
               // alert(msg);
                $("#METODE_SAMPUL").html(msg);
            }
            
          });
           
       });
       
       
        $("#btnPanitia").click(function() {
                str= "";
		jQuery('#modal_form_panitia')
                     .load($site_url + '/pgd/panitia_get' + str)
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_panitia').dialog("open");
        });   
       
        $("#btnEvaluasi").click(function() {
                str= "";
		jQuery('#modal_form_evaluasi')
                     .load($site_url + '/pgd/evaluasi_get' + str)
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_evaluasi').dialog("open");
        });   
        
        validator_InputMetodePengadaan = $("#frm_InputMetodePengadaan").validate({
                    meta: "validate",
                    submitHandler: function(form) {
                        jQuery(form).ajaxSubmit();
                    }
                });
                
                

        $("#btnAddMetodePengadaan").click(function(){
                if(validator_InputMetodePengadaan.form()) {
                    $("#frm_InputMetodePengadaan").ajaxSubmit({
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

                 }
            
        
        });
       
   }); 
 
 function fnSetEvaluasi(str) {
 
           $('#grid_ep_pgd_evaluasi_view').jqGrid('setSelection',str); 
     var selected = $('#grid_ep_pgd_evaluasi_view').jqGrid('getGridParam', 'selrow');
     selected = jQuery('#grid_ep_pgd_evaluasi_view').jqGrid('getRowData',selected);
			 
                         
    $("#KODE_EVALUASI").val(selected["KODE_EVALUASI"]);
    $("#KETERANGAN_EVALUASI").val(selected["NAMA"]);
     jQuery('#modal_form_evaluasi').dialog("close");
     
                                       
    
 
 }
 
 function fnSetPanitia(kode_panitia, kode_kantor_panitia, nama ) {
    $("#KODE_PANITIA").val(kode_panitia);
    $("#KODE_KANTOR_PANITIA").val(kode_kantor_panitia);
    $("#NAMA_PANITIA").val(nama);
     jQuery('#modal_form_panitia').dialog("close");
 }
 
 function fnLihatPanitia(str) {
    
     $('#grid_ep_pgd_panitia_view_get').jqGrid('setSelection',str); 
     var selected = $('#grid_ep_pgd_panitia_view_get').jqGrid('getGridParam', 'selrow');
     selected = jQuery('#grid_ep_pgd_panitia_view_get').jqGrid('getRowData',selected);

    
    str= "KODE_PANITIA=" + selected["KODE_PANITIA"] + "&KODE_KANTOR=" + selected["KODE_KANTOR"] ;
		jQuery('#modal_form_lihat_panitia')
                     .load($site_url + '/pgd/panitia_view?' + str)
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_lihat_panitia').dialog("open");
    
    
 }
 
 function fnPilihPanitia(str) {
    // alert(str);
    
    $('#grid_ep_pgd_panitia_view_get').jqGrid('setSelection',str); 
     var selected = $('#grid_ep_pgd_panitia_view_get').jqGrid('getGridParam', 'selrow');
     selected = jQuery('#grid_ep_pgd_panitia_view_get').jqGrid('getRowData',selected);
	 
     $("#KODE_PANITIA").val(selected["KODE_PANITIA"]);
     $("#KODE_KANTOR_PANITIA").val(selected["KODE_KANTOR"]);
     $("#NAMA_PANITIA").val(selected["NAMA_PANITIA"]);
     jQuery('#modal_form_panitia').dialog("close");    
         
     
 }
 
 
 
 
  </script>
 
<?php
 }
?>

<?php

if ($dl_hps != 0) {

// if (in_array("MonitorTenderDocumentHPS", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="MonitorTenderDocument" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_dokumen_view_hps?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">LAMPIRAN DOKUMEN HPS</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
  <script>
  function fnDownloadDokumenHPS(str) {
      
     // alert("Download");
     $('#grid_ep_pgd_dokumen_view_hps').jqGrid('setSelection',str); 
     var selected = $('#grid_ep_pgd_dokumen_view_hps').jqGrid('getGridParam', 'selrow');
     selected = jQuery('#grid_ep_pgd_dokumen_view_hps').jqGrid('getRowData',selected);
			 
				 
                                  
      
      window.location = "<?php echo base_url() ?>index.php/pgd/dokumen/get?KODE_DOKUMEN=" + selected["KODE_DOKUMEN"] ; 
      
  }
  
  </script> 
  
  
<?php
// }
}
?> 
  
<?php
if (in_array("MonitorTenderDocument", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="MonitorTenderDocument" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_dokumen_view?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">LAMPIRAN DOKUMEN</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
  <script>
  function fnDownloadDokumen(str) {
      
     // alert("Download");
     $('#grid_ep_pgd_dokumen').jqGrid('setSelection',str); 
     var selected = $('#grid_ep_pgd_dokumen').jqGrid('getGridParam', 'selrow');
     selected = jQuery('#grid_ep_pgd_dokumen').jqGrid('getRowData',selected);
			 
				 
                                  
      
      window.location = "<?php echo base_url() ?>index.php/pgd/dokumen/get?KODE_DOKUMEN=" + selected["KODE_DOKUMEN"] ; 
      
  }
  
  </script> 
  
  
<?php
}
?> 

<?php
if (in_array("InputTenderDocument", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="InputTenderDocument" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_dokumen?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">LAMPIRAN DOKUMEN</h3>
    <div>
        <fieldset class="ui-widget-content">
      <form   id="frmInputTenderDocument" method="POST" action="add_dokumen" enctype="multipart/form-data">
        <p>	
            <?php echo form_label("Kategori *") ?>
            <select name="KATEGORI"   class="{validate:{required:true,maxlength:1024}}">
                <option value="">--</option>
               <?php 
               foreach ($rs_dokumenkategori as $row) {
                 echo "<option value='" . $row->KATEGORI. "' >".$row->KATEGORI."</option>";
                   
               } 
               ?>
               
            </select>
        </p>
        <p>	
            <?php echo form_label("Deskripsi *") ?>
            <input type="text" style="width: 50%" class="{validate:{required:true,maxlength:1024}}" name="KETERANGAN" id="KETERANGAN" />
        </p>
        
        <p>	
            <?php echo form_label("File  (Max 2MB, PDF) * ") ?>
            <input type="file" class="{validate:{required:true,maxlength:64}}" name="userfile" id="NAMA_FILE" />
        </p>
        <button type="button" value="Tambah" id="btnInputTenderDocumentAdd"  >Tambah</button>
        <button type="button" value="Tambah" id="btnInputTenderDocumentReset" >Kosongkan</button>
        <input type="hidden" name="KODE_TENDER" value="<?php echo $kode_tender; ?>" />
        <input type="hidden" name="KODE_KANTOR" value="<?php echo $kode_kantor; ?>" />
        
      </form>
            </fieldset>      
        
          <div id="list" ></div>
    </div
 </div>
     <script>
 var validator_InputTenderDocument; 
  $(document).ready(function(){
	 
         validator_InputTenderDocument = $("#frmInputTenderDocument").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
        
        $("#btnInputTenderDocumentReset").click(function(){
            $("#frmInputTenderDocument input[type=text], #frmInputTenderDocument input[type=file]").val("");
        });
        
	$("#btnInputTenderDocumentAdd").click(function()  {
            
            	 if(validator_InputTenderDocument.form()) {
                    $("#frmInputTenderDocument").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                     
                                   //    $("#trace").html(msg);
                                       var grid = $("#grid_ep_pgd_dokumen");
			
                        		grid.trigger("reloadGrid",[{page:1}]);
                                       
                                      

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
            
        });
  });
  
  
   
  
  
  function fnDeleteLampiran(str) {
         
     if (confirm("Yakin Akan menghapus Dokumen")){     
     $('#grid_ep_pgd_dokumen').jqGrid('setSelection',str); 
     var selected = $('#grid_ep_pgd_dokumen').jqGrid('getGridParam', 'selrow');
     selected = jQuery('#grid_ep_pgd_dokumen').jqGrid('getRowData',selected);
			 
				 
                                 
        
       $.ajax({
        type: "POST",
        data : "KODE_DOKUMEN="   + selected["KODE_DOKUMEN"],
        url: "<?php echo base_url(); ?>index.php/pgd/pekerjaan_pgd/delete_dokumen",
        success : function(msg) {
           // alert(msg);
          // $("#trace").html(msg);
            var grid = $("#grid_ep_pgd_dokumen");
            grid.trigger("reloadGrid",[{page:1}]);
        } ,
        error : function() {
            alert("Hapus Data Dokumen Gagal");
            
        }
       
         });
         
         
     }
   }
  
  
  
  </script>

<?php
}
?> 
 

<?php
if (in_array("MonitorMetodePengadaan", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="MonitorMetodePengadaan" href="<?php echo base_url(); ?>index.php/pgd/pengadaan_monitor/metode_pengadaan?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">METODE PENGADAAN</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
<?php
}
?> 

 <?php
if (in_array("MonitorTenderVendor", $arr_antarmuka)) {
?> 
  <div class="accordion">
 <h3 id="MonitorTenderVendor" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_tender_vendor_view?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >DAFTAR VENDOR</h3>
    <div>
        
       <div id="list" ></div>
    </div>
 </div>   
<?php
}
?> 

 
 <?php
if (in_array("InputTenderVendor", $arr_antarmuka)) {
?>
<div id="modal_form_vendor" ></div>
  <div class="accordion">
 <h3 id="InputDaftarVendor" href="<?php echo base_url(); ?>index.php/pgd/gridrf_vendor/ep_pgd_tender_vendor?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >DAFTAR VENDOR</h3>
    <div>
        <button type="button" id="btnAddVendor" >Pilih Vendor</button>
        <button type="button" id="btnDeleteVendor" >Delete Vendor</button>
        
        
       <div id="list" ></div>
    </div>
 </div>      



  <script>
      
       $(document).ready(function(){  
       $("#btnAddVendor" ).click(function() {
           str = "?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>";
           jQuery('#modal_form_vendor')
                     .load($site_url + '/pgd/vendor_get' + str)
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                                var selected = $('#grid_ep_pgd_tender_vendor_klas').jqGrid('getGridParam', 'selarrrow');
                                    str = ""; 
                                    $.each(selected, function(k, v) { 
                                               sel  = jQuery('#grid_ep_pgd_tender_vendor_klas').jqGrid('getRowData',v);
                                               var keys = <?php echo json_encode(Array ( 0  => "KODE_VENDOR" )); ?>;
                                               $.each(keys, function(key, val) { 
                                                   data = {v:selected[val]};
                                                   str +=   sel[val] + ",";

                                               });


                                     });
                                      str = str.substring(0,str.length - 1);
                                    fnAddVendor(str);
                                    $(this).dialog("close");
                                    
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_vendor').dialog("open");
       });
       
        $("#btnDeleteVendor" ).click(function() {
	 
         
         if (confirm("Yakin Akan Menghapus")) {
                var selected = $('#grid_ep_pgd_tender_vendor').jqGrid('getGridParam', 'selarrrow');
                str = ""; 
                $.each(selected, function(k, v) { 
                           sel  = jQuery('#grid_ep_pgd_tender_vendor').jqGrid('getRowData',v);
                           var keys = <?php echo json_encode(Array ( 0  => "KODE_VENDOR" )); ?>;
                           $.each(keys, function(key, val) { 
                               data = {v:selected[val]};
                               str +=  sel[val] + ",";

                           });


                 });
                 str = str.substring(0,str.length - 1);
                fnDeleteVendor(str);
             }   
	});
	
        });
        
    function fnAddVendor(str) {
     // alert(str);
       $.ajax({
        type: "POST",
        data : "KODE_TENDER=<?php echo $kode_tender ; ?>&KODE_KANTOR=<?php echo $kode_kantor ; ?>&KODE_VENDOR=" + str,
        url: "<?php echo base_url(); ?>index.php/pgd/pekerjaan_pgd/add_vendor",
        success : function(msg) {
             // alert(msg);
            // $("#trace").html(msg);
            
                var grid = $("#grid_ep_pgd_tender_vendor");
                grid.trigger("reloadGrid",[{page:1}]);

           
        } ,
        error : function() {
            alert("Tambah Data Vendor Gagal");
            
        }
        
        
      }); 
                                      
                                      
      
    }    
    
function fnDeleteVendor(str) {
       
       $.ajax({
        type: "POST",
        data : "KODE_TENDER=<?php echo $kode_tender ; ?>&KODE_KANTOR=<?php echo $kode_kantor ; ?>&KODE_VENDOR=" + str,
        url: "<?php echo base_url(); ?>index.php/pgd/pekerjaan_pgd/delete_vendor",
        success : function(msg) {
            //alert(msg);
            //$("#trace").html(msg);
              var grid = $("#grid_ep_pgd_tender_vendor");
              grid.trigger("reloadGrid",[{page:1}]);
                                       
       
           
        } ,
        error : function() {
            alert("Hapus Data Vendor Gagal");
            
        }
        
        
      }); 
        
                                      
      
    }    
    
        
  </script>  
 <?php
 }
?> 

 
  
 
 
  
  
 <?php
 if (in_array("InputPembuatanJadwal", $arr_antarmuka)) {
?>
  <div class="accordion">
 <h3 id="InputPembuatanJadwal" href="" >PEMBUATAN JADWAL</h3>
    <div>
      <fieldset class="ui-widget-content">
      <form class="clsinput"  id="frm_InputPembuatanJadwal" method="POST" action="update_pembuatan_jadwal" > 
          <p>	
            <?php echo form_label("Tgl Pembukaan Pendaftaran  *") ?>
            <input type="text" style="" name="TGL_PEMBUKAAN_REG" value="<?php echo $TGL_PEMBUKAAN_REG; ?>" id="TGL_PEMBUKAAN_REG" style="" class="datetimepicker  {validate:{required:true,datetimeID:true}}"  />  
	  </p> 
          <p>	
            <?php echo form_label("Tgl Penutupan Pendaftaran  *") ?>
	    <input type="text" style="" name="TGL_PENUTUPAN_REG" value="<?php echo $TGL_PENUTUPAN_REG; ?>" id="TGL_PENUTUPAN_REG" class="datetimepicker  {validate:{required:true,datetimeID:true}}" />  
	 
          </p> 
          <p>	
            <?php echo form_label("Tgl Aanwijzing  *") ?>
            <input type="text" style="" name="TGL_PRE_LELANG" value="<?php echo $TGL_PRE_LELANG; ?>"  id="TGL_PRE_LELANG" class="datetimepicker  {validate:{required:true,datetimeID:true}}" />  
	 
          </p> 
          <p>	
            <?php echo form_label("Lokasi Aanwijzing  *") ?>
	  <input type="text" style="" name="LOKASI_PRE_LELANG" value="<?php echo $LOKASI_PRE_LELANG; ?>"   id="LOKASI_PRE_LELANG" class="{validate:{required:true,maxlength:150}}" />  
	 
          </p> 
          <p>	
            <?php echo form_label("Tgl Mulai Pemasukan Penawaran  *") ?>
	   <input type="text" style="" name="TGL_MULAI_PENAWARAN" value="<?php echo $TGL_MULAI_PENAWARAN; ?>"  id="TGL_MULAI_PENAWARAN" class="datetimepicker  {validate:{required:true,datetimeID:true}}" />  
	
          </p>
          
          <p>	
            <?php echo form_label("Tgl Pembukaan Penawaran  *") ?>
	   <input type="text" style="" name="TGL_PEMBUKAAN_LELANG" value="<?php echo $TGL_PEMBUKAAN_LELANG; ?>"  id="TGL_PEMBUKAAN_LELANG" class="datetimepicker  {validate:{required:true,datetimeID:true}}" />  
	
          </p>
          
          
          
          
          <input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR_TENDER" VALUE="<?php echo $kode_kantor  ; ?>"  />
          <input type="hidden" name="KODE_TENDER" id="KODE_TENDER"  VALUE="<?php echo $kode_tender  ; ?>"  />
      
          <p>
          <button type="button"  id="btnAddPembuatanJadwal" >UPDATE</button>
            </p>
          
      </form>
      </fieldset>     
       
        <div id="list" ></div>
    </div>
 </div>
  <script>
 var validator_InputPembuatanJadwal 
  $(document).ready(function(){
	 
        validator_InputPembuatanJadwal = $("#frm_InputPembuatanJadwal").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
        
         $("#btnAddPembuatanJadwal").click(function() {
         
            	 if(validator_InputPembuatanJadwal.form()) {
                    $("#frm_InputPembuatanJadwal").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                    //   alert(msg);
                                    //   $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                                    
                                     

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
                 
      });
        
     
     
   });
 
  </script> 
  
<?php
}
?>
  
  
 <?php
if (in_array("InputEvaluasiAdminVendor", $arr_antarmuka)) {
?>
  
  <div id="modal_form_verifikasi" ></div>  
   <div class="accordion">
 <h3 id="InputEvaluasiAdminVendor" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_tender_vendor_status?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >DAFTAR VENDOR - VERIFIKASI ADMINISTRASI</h3>
    <div>
        
        
       <div id="list" ></div>
    </div>
 </div>  
<script>

function fnVerifikasiVendor(str) {
   
    $('#grid_ep_pgd_tender_vendor_status').jqGrid('setSelection',str); 
    var selected = $('#grid_ep_pgd_tender_vendor_status').jqGrid('getGridParam', 'selrow');
     
    selected = jQuery('#grid_ep_pgd_tender_vendor_status').jqGrid('getRowData',selected );
			 
     str="?";                    
     str += "KODE_TENDER=" + selected["KODE_TENDER"] ;
     str += "&KODE_KANTOR=" + selected["KODE_KANTOR"] ;
     str += "&KODE_VENDOR=" + selected["KODE_VENDOR"] ;
     
     
    jQuery('#modal_form_verifikasi')
                     .load($site_url + '/pgd/vendor_verifikasi/edit' + str)
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                                    
                                    // $('#KETERANGAN_VERIFIKASI').val(tinyMCE.get('commentar_verifikasi').getContent());
                                    $('#KETERANGAN_VERIFIKASI').val($('#commentar_verifikasi').val());

                                    str = $("#frm_vendor_verifikasi").serialize();
                                    
                                    $.ajax({
                                        url: "verifikasi_admin_vendor" ,
                                        type: "POST",
                                        data: str,
                                        dataType: "html",
                                        success: function(msg) {
                                               //     alert(msg);
                                               //     $("#trace").html(msg);
                                                   var grid = $("#grid_ep_pgd_tender_vendor_view");
                                                   grid.trigger("reloadGrid",[{page:1}]);
         
                                           jQuery('#modal_form_verifikasi').dialog("close");
                                        
                                    }

                                      });
                                    
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_verifikasi').dialog("open");
            
}
  
</script> 
  
  
<?php
}
?>

<?php
if (in_array("MonitorEvaluasiVendor", $arr_antarmuka)) {
?>
<div id="modal_form_komentar_harga" ></div>
<div id="modal_form_komentar_teknis" ></div> 
<div id="modal_form_evaluasi_teknis" ></div>  
 <div id="modal_form_evaluasi_harga" ></div>
 <div class="accordion">
 <h3 id="InputEvaluasiTender" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_tender_evaluasi_view?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >EVALUASI</h3>
    <div>
        
        
       <div id="list" ></div>
    </div>
 </div>  
<script>


  function fnHitungNilaiHarga(){
      
                alert("Hitung Nilai");
                 $("#frm_EvaluasiHarga").ajaxSubmit({
                                             success: function(msg){
                                                 
                                          //   $("#trace").html(msg);
                                             alert(msg);
  jQuery('#modal_form_evaluasi_harga').load($site_url + '/pgd/pengadaan_evaluasi/harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
 // alert(msg);
                                                 //reload grid
                                                 //   window.location.reload();
                                                  
                     
                                             },
                                             error: function(){
                                                 alert('Data gagal disimpan')
                                             }
                    });
            
            
        } 
        
   
function fnKomentarHarga(kode_vendor,nama_vendor){
          nama_vendor = "VENDOR";   
      jQuery('#modal_form_komentar_harga')
                     .load($site_url + '/pgd/pengadaan_evaluasi/komentar_harga/' + kode_vendor + '/' + nama_vendor + '?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>')
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                       
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                                $('#KOMENTAR_EVALUASI_HARGA').val(tinyMCE.get('commentar_harga').getContent());
                               
                                $("#frmKomentarTeknis").ajaxSubmit({
                                      //clearForm: false,
                                      success: function(msg){
                                      //     alert("Harga");
                                         //  alert(msg);
                                          // $("#trace").html(msg);
                                         // alert(msg);
                                          //reload grid
                                        //  jQuery('#modal_form_evaluasi_harga').load($site_url + '/pgd/pengadaan_evaluasi/harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
                                        //  
                                        //  jQuery('#modal_form_komentar_harga').dialog("close");
                                        
                                             var grid = $("#grid_ep_pgd_komentar_evaluasi_harga");
                                          alert(grid);  
                        		grid.trigger("reloadGrid",[{page:1}]);
                               },
                                      error: function(){
                                          alert('Data gagal disimpan')
                                      }
                                  });

                               
                               
                               
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_komentar_harga').dialog("open");
    
}   


function fnKomentarTeknis(kode_vendor,nama_vendor){
             nama_vendor = "VENDOR";
      jQuery('#modal_form_komentar_teknis')
                     .load($site_url + '/pgd/pengadaan_evaluasi/komentar_teknis/' + kode_vendor + '/' + nama_vendor + '?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>')
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                       
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                               // $('#KOMENTAR_EVALUASI').val(tinyMCE.get('commentar_teknis').getContent());
                                $('#KOMENTAR_EVALUASI').val($('#commentar_teknis').val()  );
                                $("#frmKomentarTeknis").ajaxSubmit({
                                      //clearForm: false,
                                      success: function(msg){
                                          //  alert(msg);
                                         //  $("#trace").html(msg);
                                         // alert(msg);
                                          //reload grid
                                        jQuery('#modal_form_evaluasi_teknis').load($site_url + '/pgd/pengadaan_evaluasi/teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
                                        jQuery('#modal_form_komentar_teknis').dialog("close");
                                          },
                                      error: function(){
                                          alert('Data gagal disimpan')
                                      }
                                  });

                               
                               
                               
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_komentar_teknis').dialog("open");
    
}   


function fnNilaiHarga(str) {
   //   alert("Edit Nilai Harga : " + str);
      
             
      jQuery('#modal_form_evaluasi_harga')
                     .load($site_url + '/pgd/pengadaan_evaluasi/harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>')
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                        
                                      
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_evaluasi_harga').dialog("open");
            
      
  }  
  
  function fnNilaiTeknis(str) {
    //  alert("Edit Nilai Teknis : " + str);
      
      jQuery('#modal_form_evaluasi_teknis')
                     .load($site_url + '/pgd/pengadaan_evaluasi/teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' )
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                         height:350,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                                 //  alert("xxx"); 
                                   validator_EvaluasiTeknis = $("#frm_EvaluasiTeknis").validate({
                                        meta: "validate",
                                        submitHandler: function(form) {
                                            jQuery(form).ajaxSubmit();
                                        }
                                    });
                                    
                                       
                                      $("#frm_EvaluasiTeknis").ajaxSubmit({
                                             success: function(msg){
                                                 
                                             $("#trace").html(msg);
                                             alert(msg);
                                                 
                                                  
  jQuery('#modal_form_evaluasi_teknis').load($site_url + '/pgd/pengadaan_evaluasi/teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
 // alert(msg);
                                                 //reload grid
                                                 //   window.location.reload();
                                                  
                     
                                             },
                                             error: function(){
                                                 alert('Data gagal disimpan')
                                             }
                                          
                                      });
                                    
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_evaluasi_teknis').dialog("open");
      
  }  
  
</script>


  <?php
}
?>




<?php
if (in_array("MonitorPeringkatVendor", $arr_antarmuka)) {
?>
 <div class="accordion">
 <h3 id="InputPeringkatVendor" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_tender_evaluasi_peringkat_view?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >EVALUASI DAN USULAN PERINGKAT</h3>
    <div> 
       <div id="list" ></div>
    </div>
 </div>  
<?php
}
?>

<?php
if (in_array("InputPeringkatVendor", $arr_antarmuka)) {
?>
 <div class="accordion">
 <h3 id="InputPeringkatVendor" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_tender_evaluasi_peringkat?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >EVALUASI DAN USULAN PERINGKAT</h3>
    <div>
          <fieldset class="ui-widget-content">
      <form id="frmPeringkat" method="POST" action="update_peringkat" >  
          <input type="hidden" name="KODE_TENDER" value="<?php echo $kode_tender; ?>" />
          <input type="hidden" name="KODE_KANTOR" value="<?php echo $kode_kantor; ?>" />
    	<input type="hidden" name="KODE_VENDOR" id="KODE_VENDOR" value="" />
          <p>	
            <?php echo form_label("Vendor") ?>
	    <input type="text" readonly style="width: 50%" class="{validate:{required:true}}"   id="NAMA_VENDOR" name="NAMA_VENDOR" value="" />
        </p>	
        <p>	    
            <?php echo form_label("Peringkat") ?>
	    <select name="USULAN_PERINGKAT" > 
                <?php
                for($i=1;$i<= $max_rangking; $i++) {
                ?>
                <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                <?php
                
                }
                ?>
            </select>     
             
            
             
	</p>   
        <p>
            <button type="button"  id="btnPeringkat" >UPDATE</button>
        </p>
      </form>
          </fieldset>
        
       <div id="list" ></div>
    </div>
 </div>  
<script>

 
        var validatorPeringkat  = $("#frmPeringkat").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
       
     
        $("#btnPeringkat").click(function() {
        
     
            	 if(validatorPeringkat.form()) {
                    $("#frmPeringkat").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                        alert(msg);
      //                                $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                                      var grid = $("#grid_ep_pgd_tender_evaluasi_peringkat");
			
                        		grid.trigger("reloadGrid",[{page:1}]);
                                     
                                      
                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
                 
      });

function fnEditPeringkat(str) {
     
    $('#grid_ep_pgd_tender_evaluasi_peringkat').jqGrid('setSelection',str); 
      var selected = $('#grid_ep_pgd_tender_evaluasi_peringkat').jqGrid('getGridParam', 'selrow');
      selected = jQuery('#grid_ep_pgd_tender_evaluasi_peringkat').jqGrid('getRowData',selected);
      
    
    $("#KODE_VENDOR").val(selected["KODE_VENDOR"]);
    $("#NAMA_VENDOR").val(selected["NAMA_VENDOR"]);
    
}
   
</script>


  <?php
}
?>



 <?php
if (in_array("InputEvaluasiTeknisVendor", $arr_antarmuka)) {
?>
<div id="modal_form_komentar_harga" ></div>
<div id="modal_form_komentar_teknis" >
 
</div> 
<div id="modal_form_evaluasi_teknis" ></div>  
 <div id="modal_form_evaluasi_harga" ></div>
 <div class="accordion">
 <h3 id="InputEvaluasiTender" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_tender_evaluasi_teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >EVALUASI TEKNIS</h3>
    <div>
        
        
       <div id="list" ></div>
    </div>
 </div>  
<script>


  function fnHitungNilaiHarga(){
      
                // alert("Hitung Nilai");
                 $("#frm_EvaluasiHarga").ajaxSubmit({
                                             success: function(msg){
                                                 
                                          //   $("#trace").html(msg);
                                          //   alert(msg);
  jQuery('#modal_form_evaluasi_harga').load($site_url + '/pgd/pengadaan_evaluasi/harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
 // alert(msg);
                                                 //reload grid
                                                 //   window.location.reload();
                                                  
                     
                                             },
                                             error: function(){
                                                 alert('Data gagal disimpan')
                                             }
                    });
            
            
        } 
        
   
function fnKomentarHarga(kode_vendor,nama_vendor){
        nama_vendor = "VENDOR";     
      jQuery('#modal_form_komentar_harga')
                     .load($site_url + '/pgd/pengadaan_evaluasi/komentar_harga/' + kode_vendor + '/' + nama_vendor + '?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>')
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                       
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                               
                                
                                
                                $('#KOMENTAR_EVALUASI_HARGA').val(tinyMCE.get('commentar_harga').getContent());
                               
                                $("#frmKomentarTeknis").ajaxSubmit({
                                      //clearForm: false,
                                      success: function(msg){
                                       
                                         alert(msg);
                                          // $("#trace").html(msg);
                                         // alert(msg);
                                          //reload grid
                                         // jQuery('#modal_form_evaluasi_harga').load($site_url + '/pgd/pengadaan_evaluasi/harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
                                         // jQuery('#modal_form_komentar_harga').dialog("close");
                                         // Ubah DIsini
                                      
                                      /*
                                          var grid = $("#grid_ep_pgd_komentar_evaluasi_harga");
                                          alert(grid);  
                        		grid.trigger("reloadGrid",[{page:1}]);
                                       */ 
                                         
                                          },
                                      error: function(){
                                          alert('Data gagal disimpan')
                                      }
                                  });

                               
                               
                               
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_komentar_harga').dialog("open");
    
}   


function fnKomentarTeknis(kode_vendor,nama_vendor){
       // alert(kode_vendor + nama_vendor); 
       nama_vendor = 'VENDOR';
       jQuery('#modal_form_komentar_teknis').html("");
      jQuery('#modal_form_komentar_teknis')
                      
        .load($site_url + '/pgd/pengadaan_evaluasi/komentar_teknis/' + kode_vendor + '/' + nama_vendor + '?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>')
                   // .load($site_url + '/pgd/pengadaan_evaluasi/komentar_teknis/' + kode_vendor + '/' + nama_vendor)
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        
                       
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                                //alert(tinyMCE.get('commentar_teknis').getContent());
                                
                              
                                $('#KOMENTAR_EVALUASI').val($('#commentar_teknis').val()  );
                               
                                $("#frmKomentarTeknis").ajaxSubmit({
                                      //clearForm: false,
                                      success: function(msg){
                                        //    alert(msg);
                                         //  $("#trace").html(msg);
                                         // alert(msg);
                                          //reload grid
                                        jQuery('#modal_form_evaluasi_teknis').load($site_url + '/pgd/pengadaan_evaluasi/teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' )
                                        jQuery('#modal_form_komentar_teknis').dialog("close");
                                      
                                  },
                                      error: function(){
                                          alert('Data gagal disimpan')
                                      }
                                  });

                               
                               
                               
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_komentar_teknis').dialog("open");
    
}   


function fnNilaiHarga(str) {
   //   alert("Edit Nilai Harga : " + str);
      
             
      jQuery('#modal_form_evaluasi_harga')
                     .load($site_url + '/pgd/pengadaan_evaluasi/harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>')
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                        
                                      
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_evaluasi_harga').dialog("open");
            
      
  }  
  
  function fnNilaiTeknis(str) {
     //  alert("Edit Nilai Teknis : " + str);
      
      jQuery('#modal_form_evaluasi_teknis')
                     .load($site_url + '/pgd/pengadaan_evaluasi/teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' )
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                         height:500,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                                 //  alert("xxx"); 
                                   validator_EvaluasiTeknis = $("#frm_EvaluasiTeknis").validate({
                                        meta: "validate",
                                        submitHandler: function(form) {
                                            jQuery(form).ajaxSubmit();
                                        }
                                    });
                                    
                                       
                                      $("#frm_EvaluasiTeknis").ajaxSubmit({
                                             success: function(msg){
                                                 
                                           //  $("#trace").html(msg);
                                           //  alert(msg);
                                                 
                                                  
  jQuery('#modal_form_evaluasi_teknis').load($site_url + '/pgd/pengadaan_evaluasi/teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
 // alert(msg);
                                                 //reload grid
                                                 //   window.location.reload();
                                                  jQuery('#modal_form_evaluasi_teknis').dialog("close");  
                     
                                             },
                                             error: function(){
                                                 alert('Data gagal disimpan')
                                             }
                                          
                                      });
                                    
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_evaluasi_teknis').dialog("open");
      
  }  
  
</script>


  <?php
}
?>



 <?php
if (in_array("InputEvaluasiHargaVendor", $arr_antarmuka)) {
?>
<div id="modal_form_komentar_harga" ></div>
<div id="modal_form_komentar_teknis" ></div> 
<div id="modal_form_evaluasi_teknis" ></div>  
 <div id="modal_form_evaluasi_harga" ></div>
 <div class="accordion">
 <h3 id="InputEvaluasiTender" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_tender_evaluasi_harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >EVALUASI HARGA</h3>
    <div>
        
        
       <div id="list" ></div>
    </div>
 </div>  
<script>


  function fnHitungNilaiHarga(){
      
                alert("Hitung Nilai");
                 $("#frm_EvaluasiHarga").ajaxSubmit({
                                             success: function(msg){
                                                 
                                          //   $("#trace").html(msg);
                                             alert(msg);
  jQuery('#modal_form_evaluasi_harga').load($site_url + '/pgd/pengadaan_evaluasi/harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
 // alert(msg);
                                                 //reload grid
                                                 //   window.location.reload();
                                                  
                     
                                             },
                                             error: function(){
                                                 alert('Data gagal disimpan')
                                             }
                    });
            
            
        } 
        
   
function fnKomentarHarga(kode_vendor,nama_vendor){
      nama_vendor = "VENDOR";       
      jQuery('#modal_form_komentar_harga')
                     .load($site_url + '/pgd/pengadaan_evaluasi/komentar_harga/' + kode_vendor + '/' + nama_vendor + '?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>')
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                       
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                                $('#KOMENTAR_EVALUASI_HARGA').val(tinyMCE.get('commentar_harga').getContent());
                               
                                $("#frmKomentarTeknis").ajaxSubmit({
                                      //clearForm: false,
                                      success: function(msg){
                                        //    alert(msg);
                                        //   $("#trace").html(msg);
                                         // alert(msg);
                                          //reload grid
                                        jQuery('#modal_form_evaluasi_harga').load($site_url + '/pgd/pengadaan_evaluasi/harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
                                        jQuery('#modal_form_komentar_harga').dialog("close");
                                          },
                                      error: function(){
                                          alert('Data gagal disimpan')
                                      }
                                  });

                               
                               
                               
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_komentar_harga').dialog("open");
    
}   


function fnKomentarTeknis(kode_vendor,nama_vendor){
       nama_vendor = "VENDOR";      
      jQuery('#modal_form_komentar_teknis')
                     .load($site_url + '/pgd/pengadaan_evaluasi/komentar_teknis/' + kode_vendor + '/' + nama_vendor + '?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>')
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        
                       
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                              //  $('#KOMENTAR_EVALUASI').val(tinyMCE.get('commentar_teknis').getContent());
                               
                                $('#KOMENTAR_EVALUASI').val($('#commentar_teknis').val()  );
                               
                                $("#frmKomentarTeknis").ajaxSubmit({
                                      //clearForm: false,
                                      success: function(msg){
                                        //    alert(msg);
                                         //  $("#trace").html(msg);
                                         // alert(msg);
                                          //reload grid
                                        jQuery('#modal_form_evaluasi_teknis').load($site_url + '/pgd/pengadaan_evaluasi/teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
                                        jQuery('#modal_form_komentar_teknis').dialog("close");
                                          },
                                      error: function(){
                                          alert('Data gagal disimpan')
                                      }
                                  });

                               
                               
                               
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_komentar_teknis').dialog("open");
    
}   


function fnNilaiHarga(str) {
   //   alert("Edit Nilai Harga : " + str);
      
             
      jQuery('#modal_form_evaluasi_harga')
                     .load($site_url + '/pgd/pengadaan_evaluasi/harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>')
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                                                                   $(this).dialog("close");
                                      
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_evaluasi_harga').dialog("open");
            
      
  }  
  
  function fnNilaiTeknis(str) {
      // alert("Edit Nilai Teknis : " + str);
      
      jQuery('#modal_form_evaluasi_teknis')
                     .load($site_url + '/pgd/pengadaan_evaluasi/teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' )
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                         height:500,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                                 //  alert("xxx"); 
                                   validator_EvaluasiTeknis = $("#frm_EvaluasiTeknis").validate({
                                        meta: "validate",
                                        submitHandler: function(form) {
                                            jQuery(form).ajaxSubmit();
                                        }
                                    });
                                    
                                       
                                      $("#frm_EvaluasiTeknis").ajaxSubmit({
                                             success: function(msg){
                                                 
                                             $("#trace").html(msg);
                                             alert(msg);
                                                 
                                                  
  jQuery('#modal_form_evaluasi_teknis').load($site_url + '/pgd/pengadaan_evaluasi/teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
 // alert(msg);
                                                 //reload grid
                                                 //   window.location.reload();
                                                  
                     
                                             },
                                             error: function(){
                                                 alert('Data gagal disimpan')
                                             }
                                          
                                      });
                                    
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_evaluasi_teknis').dialog("open");
      
  }  
  
</script>


  <?php
}
?>



 <?php
if (in_array("InputEvaluasiVendor", $arr_antarmuka)) {
?>
<div id="modal_form_komentar_harga" ></div>
<div id="modal_form_komentar_teknis" ></div> 
<div id="modal_form_evaluasi_teknis" ></div>  
 <div id="modal_form_evaluasi_harga" ></div>
 <div class="accordion">
 <h3 id="InputEvaluasiTender" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_tender_evaluasi?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >EVALUASI</h3>
    <div>
        
        
       <div id="list" ></div>
    </div>
 </div>  
<script>


  function fnHitungNilaiHarga(){
      
                alert("Hitung Nilai");
                 $("#frm_EvaluasiHarga").ajaxSubmit({
                                             success: function(msg){
                                                 
                                          //   $("#trace").html(msg);
                                             alert(msg);
  jQuery('#modal_form_evaluasi_harga').load($site_url + '/pgd/pengadaan_evaluasi/harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
 // alert(msg);
                                                 //reload grid
                                                 //   window.location.reload();
                                                  
                     
                                             },
                                             error: function(){
                                                 alert('Data gagal disimpan')
                                             }
                    });
            
            
        } 
        
   
function fnKomentarHarga(kode_vendor,nama_vendor){
         nama_vendor = "VENDOR";    
         
         
         
      jQuery('#modal_form_komentar_harga')
                     .load($site_url + '/pgd/pengadaan_evaluasi/komentar_harga/' + kode_vendor + '/' + nama_vendor + '?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>')
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                       
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                                // alert(tinyMCE.get('commentar_harga').getContent());
                                $('#KOMENTAR_EVALUASI_HARGA').val(tinyMCE.get('commentar_harga').getContent());
                               
                                $("#frmKomentarTeknis").ajaxSubmit({
                                      //clearForm: false,
                                      success: function(msg){
                                          //  alert(msg);
                                          // $("#trace").html(msg);
                                        //  alert(msg);
                                          //reload grid
                                   //     jQuery('#modal_form_evaluasi_harga').load($site_url + '/pgd/pengadaan_evaluasi/harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
                                   //     jQuery('#modal_form_komentar_harga').dialog("close");
                                        
                                         var grid = $("#grid_ep_pgd_komentar_evaluasi_harga");
                                           
                        		 grid.trigger("reloadGrid",[{page:1}]);
                                         jQuery('#modal_form_komentar_harga').dialog("close");
                                          },
                                      error: function(){
                                          alert('Data gagal disimpan')
                                      }
                                  });

                               
                               
                               
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_komentar_harga').dialog("open");
    
}   


function fnKomentarTeknis(kode_vendor,nama_vendor){
             nama_vendor="VENDOR";
      jQuery('#modal_form_komentar_teknis')
                     .load($site_url + '/pgd/pengadaan_evaluasi/komentar_teknis/' + kode_vendor + '/' + nama_vendor + '?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>')
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        
                       
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                               // $('#KOMENTAR_EVALUASI').val(tinyMCE.get('commentar_teknis').getContent());
                                $('#KOMENTAR_EVALUASI').val($('#commentar_teknis').val()  );
                                
                                $("#frmKomentarTeknis").ajaxSubmit({
                                      //clearForm: false,
                                      success: function(msg){
                                        //    alert(msg);
                                         //  $("#trace").html(msg);
                                         // alert(msg);
                                          //reload grid
                                        jQuery('#modal_form_evaluasi_teknis').load($site_url + '/pgd/pengadaan_evaluasi/teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
                                        jQuery('#modal_form_komentar_teknis').dialog("close");
                                          },
                                      error: function(){
                                          alert('Data gagal disimpan')
                                      }
                                  });

                               
                               
                               
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_komentar_teknis').dialog("open");
    
}   


function fnNilaiHarga(str) {
   //   alert("Edit Nilai Harga : " + str);
      
             
      jQuery('#modal_form_evaluasi_harga')
                     .load($site_url + '/pgd/pengadaan_evaluasi/harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>')
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                        
                                      
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_evaluasi_harga').dialog("open");
            
      
  }  
  
  function fnNilaiTeknis(str) {
     // alert("Edit Nilai Teknis : " + str);
      
      jQuery('#modal_form_evaluasi_teknis')
                     .load($site_url + '/pgd/pengadaan_evaluasi/teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' )
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                         height:500,
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                                 //  alert("xxx"); 
                                   validator_EvaluasiTeknis = $("#frm_EvaluasiTeknis").validate({
                                        meta: "validate",
                                        submitHandler: function(form) {
                                            jQuery(form).ajaxSubmit();
                                        }
                                    });
                                    
                                       
                                      $("#frm_EvaluasiTeknis").ajaxSubmit({
                                             success: function(msg){
                                                 
                                             $("#trace").html(msg);
                                             alert(msg);
                                                 
                                                  
  jQuery('#modal_form_evaluasi_teknis').load($site_url + '/pgd/pengadaan_evaluasi/teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
 // alert(msg);
                                                 //reload grid
                                                 //   window.location.reload();
                                                  
                     
                                             },
                                             error: function(){
                                                 alert('Data gagal disimpan')
                                             }
                                          
                                      });
                                    
                            }, 
                            "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_evaluasi_teknis').dialog("open");
      
  }  
  
</script>


  <?php
}
?>



<?php
if (in_array("MonitorJadwal", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="MonitorMetodeJadwal" href="<?php echo base_url(); ?>index.php/pgd/pengadaan_monitor/jadwal?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">JADWAL PENGADAAN</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
<?php
}
?> 


<?php
if (in_array("MonitorMetodeJadwal", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="MonitorMetodeJadwal" href="<?php echo base_url(); ?>index.php/pgd/pengadaan_monitor/metode_jadwal?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">METODE DAN JADWAL PENGADAAN</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
<?php
}
?> 

<?php
if (in_array("InputTenderPemenang", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="InputTenderPemenang"  href="<?php echo base_url(); ?>index.php/pgd/pilih_pemenang/add?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">PILIH PEMENANG</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>  
<?php
}
?>  

    
    <?php
if (in_array("InputTenderNegosiasi", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="InputTenderNegosiasi" href="<?php echo base_url(); ?>index.php/pgd/negosiasi/add?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">PESAN NEGOSIASI</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>  
<?php
}
?>  
 
<?php
 if (in_array("MonitorTenderNegosiasi", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="MonitorTenderNegosiasi" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_pesan_tender?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">NEGOSIASI</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
<?php
  }
?>  

   
<?php
 if (in_array("MonitorPenawaranHistory", $arr_antarmuka)) {
?>
<div class="accordion">
 <div id="modal_form_penawaran_history" ></div>    
 <h3 id="MonitorPenawaranHistory" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_penawaran_history?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">HISTORI PENAWARAN</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
  <script>  
  
  function fnDetailPenawaranHistory(str) {
     // alert(str);
      
      $('#grid_ep_pgd_penawaran_history').jqGrid('setSelection',str); 
      var selected = $('#grid_ep_pgd_penawaran_history').jqGrid('getGridParam', 'selrow');
      selected = jQuery('#grid_ep_pgd_penawaran_history').jqGrid('getRowData',selected);
        		 
        strparam = "KODE_HIST_PENAWARAN=" + selected["KODE_HIST_PENAWARAN"] + "&KODE_TENDER=" + selected["KODE_TENDER"] + "&KODE_KANTOR=" + selected["KODE_KANTOR"] + "&KODE_VENDOR=" + selected["KODE_VENDOR"]   ;
        
      
      
       jQuery('#modal_form_penawaran_history')
                     .load($site_url + '/pgd/penawaran_history/view?' + strparam)
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                        modal:true,
                        //position:'top',
                        buttons: { 
                             "BATAL": function() { 
                                $(this).dialog("close");
                            } 
                        }
                    });
            jQuery('#modal_form_penawaran_history').dialog("open");
            
  }
  
  </script>  
  
<?php
}
?> 

  
<?php

if (1) {
?>
<div class="accordion">
 <h3 id="MonitorKomentar" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_komentar_tender?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">DAFTAR KOMENTAR</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
<?php
}
?> 

<?php   
if (1) {
?>

<div class="accordion">
 <h3 id="Komentar" href="<?php echo base_url(); ?>index.php/pgd/komentar_tender/edit?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>&KODE_KOMENTAR=<?php echo $kode_komentar; ?>&KODE_AKTIFITAS=<?php echo $kode_aktifitas; ?>">KOMENTAR</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
<?php
}
?> 
 <script>
  
  $(document).ready(function(){
	//$("#mysearch").jqGrid('filterGrid','#grid_ep_kom_kelompok_jasa');
	
        
     	
	$(".accordion" ).each(function(){
                 
                
                $('h3', $(this)).each(function(){
                    var uri = $(this).attr('href');
				//	alert(uri);
                    if(uri != '' && uri != '#'){
                            var ctn =  $(this).next().children("#list");   
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
    
    
    function fnSubmitKomentar() { 
        if ($(".clsinput").length) { 
            str = $(".clsinput").attr("id").split("_");
            strfrm =  $(".clsinput").attr("id");
        
        }
           
           
           
        
        frmlength = $(".clsinput").length;
       //  alert(frmlength);
        if (frmlength == 0) {
            
                   $.ajax({
                      type: "POST",
                      data : "KODE_TENDER=<?php echo $kode_tender ; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>",
                      url: "<?php echo base_url(); ?>index.php/pgd/pengadaan_check/check_tender_item",
                      success : function(msg) {

                     //  alert("check item" + msg); 
                       if(validatorKomentar.form()) {
                          $("#frmKomentar").ajaxSubmit({
                                      //clearForm: false,
                                      success: function(msg){
                                          //      alert(msg);
                                          //     $("#trace").html(msg);
                                         // alert(msg);
                                          //reload grid
                                           window.location = "<?php echo base_url(); ?>index.php/pgd/pekerjaan_pgd"; ;   
                                      },
                                      error: function(){
                                          alert('Data gagal disimpan')
                                      }
                                  });

                       } 


                        } ,
                        error : function() {
                            alert("Data Pengadaan Belum Lengkap");

                        }


            }); 
        
        }
         
        if (frmlength == 1) {
             
            if (   window['validator_' + str[1]].form() ) {
           //     alert("#" +  strfrm);

                 $("#" +  strfrm ).ajaxSubmit({
                    //clearForm: false,
                    success: function(msg){
             //              alert('FInal:' + msg);
                           $("#trace").html(msg);
                            	 if(validatorKomentar.form()) {
                                    $("#frmKomentar").ajaxSubmit({
                                                //clearForm: false,
                                                success: function(msg){
                                                 //       alert('Komentar:' + msg);
                                                 //       $("#trace").html(msg);
                                                     window.location = "<?php echo base_url(); ?>index.php/pgd/pekerjaan_pgd";
                                                },
                                                error: function(){
                                                    alert('Data Komentar gagal disimpan')
                                                }
                                            });

                                   } 



                    },
                    error: function(){
                        alert('Data gagal disimpan')
                    }
                });


            }
          } 
          
          
          }  
  </script>  
                
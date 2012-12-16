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
        
          <div id="list" ></div>o
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
    </div>
 </div>
<?php
}
?> 


<?php
if (in_array("InputTenderDetail", $arr_antarmuka)) {
?>
<div id="modal_form_barangjasa" ></div> 
<div class="accordion">
 <h3 id="InputTenderDetail" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_tender?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >ITEM</h3>
    <div>
        <fieldset class="ui-widget-content">
      <form id="frmBarangJasa" method="POST" action="update_item_tender" >            
    	<p>	
            <?php echo form_label("Kode *") ?>
	    <input type="text" style="width: 50%" class="{validate:{required:true}}"   id="KODE_BARANG_JASA" name="KODE_BARANG_JASA" value="" /><button type="button" id="btnBarangJasa" >...</button>
	</p>   
        <p>	
            <?php echo form_label("Sub Barang/Jasa *") ?>
	    <input type="text" style="width: 50%" class="{validate:{required:true}}"   id="KODE_SUB_BARANG_JASA" name="KODE_SUB_BARANG_JASA" value="" />
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
            <?php echo form_label("Unit") ?>
	    <input type="text"     id="UNIT" name="UNIT" value="" />
	</p>
        <p>	
            <?php echo form_label("Harga *") ?>
	    <input type="number"   class="{validate:{required:true}}"   id="HARGA" name="HARGA" value="" />
	</p>
        
        <input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR_TENDER" VALUE="<?php echo $kode_kantor  ; ?>"  />
        <input type="hidden" name="KODE_TENDER" id="KODE_TENDER"  VALUE="<?php echo $kode_tender  ; ?>"  />
        
        <button type="button"  id="btnAddBarangJasa" >UPDATE</button>
        <button type="button"  id="btnResetBarangJasa" >Kosongkan</button>
        
        
        
      </form>
           </fieldset>     
       
        <div id="list" ></div>
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
     
     
        $("#btnAddBarangJasa").click(function() {
        
     
            	 if(validatorBarangJasa.form()) {
                    $("#frmBarangJasa").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                       alert(msg);
      //                                $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                                      var grid = $("#grid_ep_pgd_item_tender");
			
                        		grid.trigger("reloadGrid",[{page:1}]);
                                     

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
     
        alert(str);
        $('#grid_ep_pgd_item_tender').jqGrid('setSelection',str); 
     	var selected = $('#grid_ep_pgd_item_tender').jqGrid('getGridParam', 'selrow');
				 selected = jQuery('#grid_ep_pgd_item_tender').jqGrid('getRowData',selected);
			 
				 
                                 
     $("#KODE_BARANG_JASA").val(selected["KODE_BARANG_JASA"]);
     $("#KODE_SUB_BARANG_JASA").val(selected["KODE_SUB_BARANG_JASA"]);
     
    $("#KETERANGAN").val(selected["KETERANGAN"]);
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
           <!--
          <p>
              
          <button type="button"  id="btnAddPenataPerencana" >UPDATE</button>
            </p>
           -->
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
 
 </script> 
<?php
}
?> 
 
 
 <?php
if (in_array("InputMetodePengadaan", $arr_antarmuka)) {
?>
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
          <p>
                <?php echo form_label("Sistem Sampul *") ?>
              <select name="METODE_SAMPUL" id="METODE_SAMPUL" class="{validate:{required:true}}"  ></select>
          </p>
          <p>
                <?php echo form_label("Template Evaluasi *") ?>
              <input type="text" style="width: 50%" class="{validate:{required:true}}"   id="KETERANGAN_EVALUASI" name="KETERANGAN_EVALUASI" value="" /><button type="button" id="btnEvaluasi" >...</button>

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
              <input type="text" name="PTP_INQUIRY_NOTES" style="width: 50%" class="{validate:{required:true}}" />
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
       $("#METODE_TENDER").change(function(){
           alert("ss");
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
 
 function fnSetEvaluasi(kode_evaluasi, nama) {
    $("#KODE_EVALUASI").val(kode_evaluasi);
    $("#KETERANGAN_EVALUASI").val(nama);
    
 
 }
 
  </script>
 
<?php
 }
?>

  
<?php
if (in_array("MonitorTenderDocument", $arr_antarmuka)) {
?>
<div class="accordion">
 <h3 id="MonitorTenderDocument" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_dokumen?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">LAMPIRAN DOKUMEN</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
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
            <select name="KATEGORI" class="{validate:{required:true,maxlength:1024}}">
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
            <?php echo form_label("File *") ?>
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
        
	$("#btnInputTenderDocumentAdd").click(function()  {
            
            	 if(validator_InputTenderDocument.form()) {
                    $("#frmInputTenderDocument").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                       alert(msg);
                                       $("#trace").html(msg);
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
        <button type="button" id="btnDeleteVendor" >Delete Vendor</button>
        <button type="button" id="btnAddVendor" >Tambah Vendor</button>
        
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
           alert(msg);
            $("#trace").html(msg);
           
        } ,
        error : function() {
            alert("Tambah Data Vendor Gagal");
            
        }
        
        
      }); 
        
         var grid = $("#grid_ep_pgd_tender_vendor");
	 grid.trigger("reloadGrid",[{page:1}]);
                                       
                                      
      
    }    
    
function fnDeleteVendor(str) {
       alert(str);
       $.ajax({
        type: "POST",
        data : "KODE_TENDER=<?php echo $kode_tender ; ?>&KODE_KANTOR=<?php echo $kode_kantor ; ?>&KODE_VENDOR=" + str,
        url: "<?php echo base_url(); ?>index.php/pgd/pekerjaan_pgd/delete_vendor",
        success : function(msg) {
           alert(msg);
            $("#trace").html(msg);
           
        } ,
        error : function() {
            alert("Hapus Data Vendor Gagal");
            
        }
        
        
      }); 
        
         var grid = $("#grid_ep_pgd_tender_vendor");
	 grid.trigger("reloadGrid",[{page:1}]);
                                       
                                      
      
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
            <input type="text" style="" name="TGL_PEMBUKAAN_REG" value="<?php echo $TGL_PEMBUKAAN_REG; ?>" id="TGL_PEMBUKAAN_REG" style="" class="datepicker  {validate:{required:true,date:true}}"  />  
	  </p> 
          <p>	
            <?php echo form_label("Tgl Penutupan Pendaftaran  *") ?>
	    <input type="text" style="" name="TGL_PENUTUPAN_REG" value="<?php echo $TGL_PENUTUPAN_REG; ?>" id="TGL_PENUTUPAN_REG" class="datepicker  {validate:{required:true,date:true}}" />  
	 
          </p> 
          <p>	
            <?php echo form_label("Tgl Aanwijzing  *") ?>
            <input type="text" style="" name="TGL_PRE_LELANG" value="<?php echo $TGL_PRE_LELANG; ?>"  id="TGL_PRE_LELANG" class="datepicker  {validate:{required:true,date:true}}" />  
	 
          </p> 
          <p>	
            <?php echo form_label("Lokasi Aanwijzing  *") ?>
	  <input type="text" style="" name="LOKASI_PRE_LELANG" value="<?php echo $LOKASI_PRE_LELANG; ?>"   id="LOKASI_PRE_LELANG" class="{validate:{required:true,maxlength:150}}" />  
	 
          </p> 
          <p>	
            <?php echo form_label("Tgl Pembukaan Penawaran  *") ?>
	   <input type="text" style="" name="TGL_PEMBUKAAN_LELANG" value="<?php echo $TGL_PEMBUKAAN_LELANG; ?>"  id="TGL_PEMBUKAAN_LELANG" class="datepicker  {validate:{required:true,date:true}}" />  
	
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
                                    
                                     $('#KETERANGAN_VERIFIKASI').val(tinyMCE.get('commentar_verifikasi').getContent());

                                    str = $("#frm_vendor_verifikasi").serialize();
                                    
                                    $.ajax({
                                        url: "verifikasi_admin_vendor" ,
                                        type: "POST",
                                        data: str,
                                        dataType: "html",
                                        success: function(msg) {
                                                alert(msg);
                                            
                                        
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
  jQuery('#modal_form_evaluasi_harga').load($site_url + '/pgd/Pengadaan_evaluasi/harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
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
             
      jQuery('#modal_form_komentar_harga')
                     .load($site_url + '/pgd/Pengadaan_evaluasi/komentar_harga/' + kode_vendor + '/' + nama_vendor + '?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>')
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
                                           $("#trace").html(msg);
                                         // alert(msg);
                                          //reload grid
                                        jQuery('#modal_form_evaluasi_harga').load($site_url + '/pgd/Pengadaan_evaluasi/harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' )
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
             
      jQuery('#modal_form_komentar_teknis')
                     .load($site_url + '/pgd/Pengadaan_evaluasi/komentar_teknis/' + kode_vendor + '/' + nama_vendor + '?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>')
                    .dialog({ //dialog form use for popup after click button in pager
                        autoOpen:false,
                        width:800,
                       
                        modal:true,
                        //position:'top',
                        buttons: { 
                            "SIMPAN": function() { 
                                $('#KOMENTAR_EVALUASI').val(tinyMCE.get('commentar_teknis').getContent());
                               
                                $("#frmKomentarTeknis").ajaxSubmit({
                                      //clearForm: false,
                                      success: function(msg){
                                            alert(msg);
                                           $("#trace").html(msg);
                                         // alert(msg);
                                          //reload grid
                                        jQuery('#modal_form_evaluasi_teknis').load($site_url + '/pgd/Pengadaan_evaluasi/teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' )
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
                     .load($site_url + '/pgd/Pengadaan_evaluasi/harga?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>')
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
      alert("Edit Nilai Teknis : " + str);
      
      jQuery('#modal_form_evaluasi_teknis')
                     .load($site_url + '/pgd/Pengadaan_evaluasi/teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' )
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
                                                 
                                                  
  jQuery('#modal_form_evaluasi_teknis').load($site_url + '/pgd/Pengadaan_evaluasi/teknis?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>' );
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
 <h3 id="MonitorPenawaranHistory" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_penawaran_history?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">HISTORI PENAWARAN</h3>
    <div>
          <div id="list" ></div>
    </div>
 </div>
  <script>  
  
  function fnDetailPenawaranHistory(str) {
      alert(str);
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
        //alert(frmlength);
        if (frmlength == 0) {
            
                   $.ajax({
                      type: "POST",
                      data : "KODE_TENDER=<?php echo $kode_tender ; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>",
                      url: "<?php echo base_url(); ?>index.php/pgd/pengadaan_check/check_tender_item",
                      success : function(msg) {

                       alert("check item" + msg); 
                       if(validatorKomentar.form()) {
                          $("#frmKomentar").ajaxSubmit({
                                      //clearForm: false,
                                      success: function(msg){
                                        //    alert(msg);
                                        //   $("#trace").html(msg);
                                         // alert(msg);
                                          //reload grid


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
                alert("#" +  strfrm);

                 $("#" +  strfrm ).ajaxSubmit({
                    //clearForm: false,
                    success: function(msg){
                           alert('FInal:' + msg);
                           $("#trace").html(msg);
                            	 if(validatorKomentar.form()) {
                                    $("#frmKomentar").ajaxSubmit({
                                                //clearForm: false,
                                                success: function(msg){
                                                      alert('Komentar:' + msg);
                                                     $("#trace").html(msg);
                                                    
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
                
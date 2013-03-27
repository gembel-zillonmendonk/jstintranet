<!-- 
<div class="accordion">
 <h3 href="<?php echo base_url()?>index.php/pgd/form/ep_pgd_tender">PEMBUATAN PERMINTAAN PENGADAAN</h3>
            <div>
			 
			<div id="list" ></div>
			</div>
  </div>
-->
<?php $this->load->helper('form'); ?>
<div id="modal_form_perencanaan"></div>
<div id="modal_form_barangjasa"></div>

<div class="accordion">
<h3 href="">PEMBUATAN PERMINTAAN PENGADAAN</h3>
            <div>
   <fieldset class="ui-widget-content">
      <form id="frmPermintaan" method="POST" action="add_tender_draft" >
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
	    <input type="text" style="width: 50%" class="{validate:{required:true}}"   id="JUDUL_PEKERJAAN" name="JUDUL_PEKERJAAN" value="" /><button type="button" id="btnPerencanaan" >...</button>
	</p>
        <p>	
            <?php echo form_label("DISKRIPSI PEKERJAAN *") ?>
	    <input type="text" style="width: 50%" class="{validate:{required:true}}"  id="LINGKUP_PEKERJAAN" name="LINGKUP_PEKERJAAN" value="" /> 
	</p>
       
        <p>	
            <?php echo form_label("LOKASI PENGIRIMAN") ?>
            <select name="KODE_KANTOR_KIRIM" class="{validate:{required:true}}"  >
                <?php
                echo "<option value='' >-- Pilih Kantor --</option>";
                 
                foreach($rs_kantor as $row) {
                    echo "<option value='" .$row->KODE_KANTOR. "' >".$row->NAMA_KANTOR."</option>";
                   
                }
                ?>
                
            </select> 
        </p>
        <!--
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
        -->
        <input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR" VALUE="<?php echo $this->session->userdata("kode_kantor") ; ?>"  />
        <input type="hidden" name="KODE_TENDER" id="KODE_TENDER_PERMINTAAN" value="0"    />
        <input type="hidden" name="KODE_JABATAN" id="KODE_JABATAN" VALUE="<?php echo $this->session->userdata("kode_jabatan") ; ?>"  />
        <input type="hidden" name="KODE_PERENCANAAN" id="KODE_PERENCANAAN"  />
        <input type="hidden" name="KODE_KANTOR_PERENCANAAN" id="KODE_KANTOR_PERENCANAAN"  />
         
      </form>
   </fieldset>     
          </div>
<h3 href="">MATA ANGGARAN</h3>
            <div>
                
                <div id="list_perencanaan_anggaran" ></div>      
          </div>
<!--
<h3 href="">LAMPIRAN DOKUMEN</h3>
            <div>
          </div>
-->
 <br/> 
<button type="button" id="btnSubmit"   >Submit</button>
<button type="button" id="btnCancel"    >Cancel</button> 
<div id="trace" > </div>  
 </div>



<script>
  
  $(document).ready(function(){
      
      
      $("#btnCancel").click(function(){ 
           
          window.location = "<?php echo base_url() ?>index.php/pgd/pekerjaan_pgd";
      });
      
	//$("#mysearch").jqGrid('filterGrid','#grid_ep_kom_kelompok_jasa');
   var kode_tender = 0;     
   var count_item_tender = 0;
        var validatorPermintaan = $("#frmPermintaan").validate({
            meta: "validate",
            submitHandler: function(form) {
              jQuery(form).ajaxSubmit();
            }
        });
        var validatorKomentar = $("#frmKomentar").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
        
        
        $("#btnSubmit").click(function(){ 
             
            if(validatorPermintaan.form()) {
                   
                $("#frmPermintaan").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                    //  alert(msg);
                                    //  $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                     
                                     if (msg != '0') {
                                         window.location = "<?php echo base_url(); ?>index.php/pgd/pekerjaan_pgd/editor?KODE_KOMENTAR=" + msg ;
                                     }    
                                },
                                error: function(){
                                    alert('Data gagal disimpan');
                                }
               });
 
            }

        });
     
     /*
     $("#btnSubmit").click(function(){ 
        $.ajax({
        type: "POST",
        data : "KODE_TENDER=" + kode_tender + "&KODE_KANTOR=<?php echo $this->session->userdata("kode_kantor"); ?>",
        url: "<?php echo base_url(); ?>index.php/pgd/pengadaan_check/check_tender_item",
        success : function(msg) {
                 SetCountItemTender(msg);
                  
                 
            	 if(validatorKomentar.form()) {
                    $("#frmKomentar").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                    //  alert(msg);
                                    //  $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    window.location = "<?php echo base_url(); ?>index.php/pgd/pekerjaan_pgd";
                   
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
        
      
        
     });
     */  
     
        var validatorBarangJasa = $("#frmBarangJasa").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });
        
        $("#btnAddBarangJasa").click(function() {
              alert(kode_tender);
            if (kode_tender == 0) {
                //alert("Header Tender Belum Tersimpan");
                            fnHeaderSubmit();
               
                if (kode_tender > 0) {
             
                strurl = "<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_tender?KODE_TENDER=" + kode_tender + "&KODE_KANTOR=<?php echo $this->session->userdata("kode_kantor"); ?>";
                           //alert(strurl);
                           fnShowItemTender(strurl); 
                  }         
                return;
                
            } else  {
             alert(kode_tender);
           //  $("#KODE_TENDER").val(kode_tender);
            // alert($("#KODE_TENDER").val());
            
            	 if(validatorBarangJasa.form()) {
                    $("#frmBarangJasa").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                      //alert(msg);
                                   / //  $("#trace").html(msg);
                                   // alert(msg);
                                    //reload grid
                                    
                                    if (msg>0) {
                                         strurl = "<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_tender?KODE_TENDER=" + kode_tender + "&KODE_KANTOR=<?php echo $this->session->userdata("kode_kantor"); ?>";
                                        // alert(strurl);
                                         fnShowItemTender(strurl); 
     
                                        
                                    }
                                    

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
            }    
            
            
            strurl = "<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_tender?KODE_TENDER=" + kode_tender + "&KODE_KANTOR=<?php echo $this->session->userdata("kode_kantor"); ?>";
            fnShowItemTender(strurl); 
            fnKosongkanBarangJasa();    
        });
        
        $("#btnResetBarangJasa").click(function() {
            	$('#frmBarangJasa')[0].reset();
            
        
        });
        
	$("#btnPerencanaan").click(function() {
		 
		str= "";
		jQuery('#modal_form_perencanaan')
                     .load($site_url + '/pgd/perencanaan_get' + str)
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
                    jQuery('#modal_form_perencanaan').dialog("open");
					
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
	 
/*	
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
*/	

 function SetCountItemTender(cnt) {
     
     count_item_tender = cnt;
 }

 function SetKodeTender(str) {
     
     kode_tender = str;
     $("#KODE_TENDER_PERMINTAAN").val(str);
     $("#KODE_TENDER").val(str);
     $("#KODE_TENDER_KOMENTAR").val(str);
      
    // alert($("#KODE_TENDER_KOMENTAR").val());
    // alert(kode_tender);
     
 }		
                 
 function fnHeaderSubmit() {
     if(validatorPermintaan.form()) {
         $("#frmPermintaan").ajaxSubmit({
            //clearForm: false,
            success: function(msg){
                //   alert("KODE_TENDER:" + msg);
               //  $("#trace").html(msg);
                 SetKodeTender(msg);  
                  
                   //  alert($("#KODE_TENDER").val());

                 if(validatorBarangJasa.form()) {
                    $("#frmBarangJasa").ajaxSubmit({
                                //clearForm: false,
                                success: function(msg){
                                      //alert(msg);
                  //                    $("#trace").html(msg);
                                  //  alert(msg);
                                    //reload grid
                                    
                                    strurl = "<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_tender?KODE_TENDER=" + kode_tender + "&KODE_KANTOR=<?php echo $this->session->userdata("kode_kantor"); ?>";
                           //alert(strurl);
                           fnShowItemTender(strurl); 

                                },
                                error: function(){
                                    alert('Data gagal disimpan')
                                }
                            });

                 }
                 
                //reload grid

            },
            error: function(){
                alert('Data gagal disimpan')
            }
        });
         
     }
     
 }
 
	 });
 
 
 function fnShowItemTender(strurl) {
     var uri = strurl + "&r=" + Math.random();
                    // alert(uri);
                     
                    if(uri != '' && uri != '#'){
                        var ctn = $("#list_itemtender") ;
                        
                    //    alert(ctn);
                        //alert(uri);
                        if(ctn.html() == '')
                            ctn.html('');

                            ctn.load(uri);
                    }
                         
     
 }

 
	 

 
 function fnShowMataAnggaran(strurl) {
     var uri = strurl + "&r=" + Math.random();
                 //   alert(uri);
                     
                    if(uri != '' && uri != '#'){
                        var ctn = $("#list_perencanaan_anggaran") ;
                        //alert($(ctn).width());
                        //alert(uri);
                        if(ctn.html() == '')
                            ctn.html('');

                            ctn.load(uri);
                    }
                         
     
 }
 
 
 function fnPerencanaan( arr) {
      
     $("#KODE_PERENCANAAN").val(arr[0]);
     $("#KODE_KANTOR_PERENCANAAN").val(arr[1]);
     $("#JUDUL_PEKERJAAN").val(arr[2]);
     $("#LINGKUP_PEKERJAAN").val(arr[3]);
     
     strurl = "<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_perencanaan_anggaran?KODE_PERENCANAAN=" + arr[0] + "&KODE_KANTOR_PERENCANAAN=" + arr[1];
     fnShowMataAnggaran(strurl);
     $('#modal_form_perencanaan').dialog("close");
      
 }        
 
 function fnBarangJasa(arr){
     
     $("#KODE_BARANG_JASA").val(arr[0]);
     $("#KODE_SUB_BARANG_JASA").val(arr[1]);
     $("#KETERANGAN").val(arr[2]);
     jQuery('#modal_form_barangjasa').dialog("close");
     
     
     
     
     
 }
 
 function fnEditBarangJasa(){
      
        var selected = $('#grid_ep_pgd_item_tender').jqGrid('getGridParam', 'selrow');
        if (selected) {
           selected = jQuery('#grid_ep_pgd_item_tender').jqGrid('getRowData',selected);
           $('#KODE_BARANG_JASA').val(selected["KODE_BARANG_JASA"]);
           $('#KODE_SUB_BARANG_JASA').val(selected["KODE_SUB_BARANG_JASA"]);
           $('#KETERANGAN').val(selected["KETERANGAN"]);
           $('#JUMLAH').val(selected["JUMLAH"]);
           $('#UNIT').val(selected["UNIT"]);
           $('#HARGA').val(selected["HARGA"]);
        }
         
 }
 
 function fnKosongkanBarangJasa(){ 
           $('#KODE_BARANG_JASA').val("");
           $('#KODE_SUB_BARANG_JASA').val("");
           $('#KETERANGAN').val("");
           $('#JUMLAH').val(0);
           $('#UNIT').val("");
           $('#HARGA').val(0);
 }
 
 
 
 
 function fnDeleteBarangJasa(str) {
         
         
        if (confirm("Yakin Akan Menghapus Item")) { 
            $('#grid_ep_pgd_item_tender').jqGrid('setSelection',str); 
            var selected = $('#grid_ep_pgd_item_tender').jqGrid('getGridParam', 'selrow');

               selected = jQuery('#grid_ep_pgd_item_tender').jqGrid('getRowData',selected);

              $.ajax({
                    url: "delete_item_tender/"   ,
                    type: "POST",
                    data: "KODE_TENDER=" + selected["KODE_TENDER"] + "&KODE_KANTOR="+selected["KODE_KANTOR"]+"&KODE_BARANG_JASA="+selected["KODE_BARANG_JASA"]+"&KODE_SUB_BARANG_JASA=" + selected["KODE_SUB_BARANG_JASA"] ,
                    dataType: "html",
                    success: function(msg) {
                          var grid = $("#grid_ep_pgd_item_tender");
                          grid.trigger("reloadGrid",[{page:1}]);
                    }
                });
        }    
        
         
        
        
            
        
     
 }
 
</script>   	 			
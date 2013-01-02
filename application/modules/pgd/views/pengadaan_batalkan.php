 <script type="text/javascript" src="<?php echo base_url();  ?>js/tiny_mce/tiny_mce.js"></script> 
<div class="accordion">
 <h3  id="MonitorHeader" href="<?php echo base_url(); ?>index.php/pgd/pengadaan_monitor/header?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">HEADER</h3>
    <div> 
          <div id="list" ></div> 
    </div>
 <h3  id="MonitorTenderDetail" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_tender_view?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">ITEM</h3>
    <div> 
          <div id="list" ></div> 
    </div>

  <h3 id="MonitorTenderVendor" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_tender_vendor_view?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >DAFTAR VENDOR</h3>
    <div>
        
       <div id="list" ></div>
    </div>
   <h3 id="MonitorTenderDocument" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_dokumen?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">LAMPIRAN DOKUMEN</h3>
    <div>
          <div id="list" ></div>
    </div>


 <h3  id="MonitorMetodePengadaan" href="<?php echo base_url(); ?>index.php/pgd/pengadaan_monitor/metode_jadwal?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">METODE DAN JADWAL PENGADAAN</h3>
    <div> 
          <div id="list" ></div> 
    </div>

  
  <h3 id="MonitorEvaluasiTender" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_tender_evaluasi?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>" >EVALUASI</h3>
    <div>
        
        
       <div id="list" ></div>
    </div>

  <h3 id="MonitorKomentar" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_komentar_tender?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">DAFTAR KOMENTAR</h3>
    <div>
          <div id="list" ></div>
    </div>
  
  <h3 id="Komentar" href="<?php echo base_url(); ?>index.php/pgd/tools/batalkan?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>&KODE_KOMENTAR=<?php echo $kode_komentar; ?>&KODE_AKTIFITAS=<?php echo $kode_aktifitas; ?>">KOMENTAR</h3>
    <div   >
			<fieldset>
			<form id="frmKomentar" action="<?php echo base_url() . "index.php/pgd/pekerjaan_pgd/fn_batalkan_pengadaan" ?>"  method="POST" >
			<p>                   
               <textarea  style="width:100%" id="commentar" name="commentar" ></textarea>
			</p>
	<input type="hidden" name="kode_alurkerja" id="KODE_ALURKERJA" value="<?php echo $kode_alurkerja ; ?>" />
			<input type="hidden" name="kode_komentar" id="kode_komentar" value="<?php echo $kode_komentar; ?>" />

                       
<input type="hidden" name="KODE_TENDER" id="KODE_TENDER" value="<?php echo $kode_tender ; ?>" />
<input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR" value="<?php echo $kode_kantor ; ?>" />						
<input type="hidden" id="komentar"  name="komentar" /> 			
			</form>
			</fieldset>
<br/> 
<p align="center" >
<button type="button" id="btnSubmit"   >Batalkan Pelelangan</button>
<button type="button" id="btnCancel"    >Cancel</button> 
</p>
   </div>
  <script>
     tinyMCE.init({
		mode : "textareas",
		theme : "simple", 
                setup : function(ed) {
               
                    ed.onChange.add(function(ed, evt) {



                        //$(ed.getBody()).find('p').addClass('headline');

                        // get content from edito
                        var content = ed.getContent().toUpperCase();

                        // tagname to toUpperCase
                        // content = content.replace(/< *\/?(\w+)/g,function(w){return w.toUpperCase()});
                       ed.setContent(content);
                        // write content to html source element (usually a textarea)
                        // $(ed.id).html(content );
                    });
                }
	});
      
      var validatorKomentar;
     
    $(document).ready(function(){


         validatorKomentar = $("#frmKomentar").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });

        
        
        $("#btnSubmit").click(function(){ 
            alert("btnSubmit");
         
  $('#komentar').val(tinyMCE.get('commentar').getContent());
                       if(validatorKomentar.form()) {
                          $("#frmKomentar").ajaxSubmit({
                                      //clearForm: false,
                                      success: function(msg){
                                            alert(msg);
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
      
$("#btnCancel").click(function(){

     window.location = "<?php echo base_url() ."index.php/pgd/tools/batalkan"; ?>";

})


        
  

    });
        
 </script>   
 
</div>


<script>
  
  $(document).ready(function(){
      
    
    	
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
    
    
                  $('#MonitorHeader, #MonitorTenderDetail,  #MonitorEvaluasiTender,  #MonitorTenderDocument, #MonitorMetodePengadaan,#MonitorTenderVendor, #MonitorKomentar' , $(this)).each(function(){
                      var uri = $(this).attr('href');
                      if(uri != '' && uri != '#'){
                            var ctn =  $(this).next().children("#list");   
                          //alert($(ctn).width());
                        
                          if(uri != '' && uri != '#'){
                       
                            ctn.load(uri);
                          }
                   }
                      
                  });
  
      
  });
 </script> 
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
 </div>


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
 

      alert("xx");
      
  });
 </script> 
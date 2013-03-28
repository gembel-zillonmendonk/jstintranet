<?php $this->load->helper('form'); ?>
<div class="accordion">
 <h3  id="MonitorHeader" href="<?php echo base_url(); ?>index.php/pgd/pengadaan_monitor/header?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">HEADER</h3>
    <div> 
          <div id="list" ></div> 
    </div>
 <h3  id="MonitorTenderDetail" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_item_tender_tanpa_hps?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">ITEM</h3>
    <div> 
          <div id="list" ></div> 
    </div>
 

 <h3  id="MonitorMetodePengadaan" href="<?php echo base_url(); ?>index.php/pgd/pengadaan_monitor/metode_pengadaan?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">METODE DAN JADWAL PENGADAAN</h3>
    <div> 
          <div id="list" ></div> 
    </div>

 <h3  id="MonitorMetodePengadaan" href="">JADWAL PENGADAAN</h3>
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
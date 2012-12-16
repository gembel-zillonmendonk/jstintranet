<form id="frm_vendor_verifikasi">
<input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR_TENDER" VALUE="<?php echo $kode_kantor  ; ?>"  />
<input type="hidden" name="KODE_TENDER" id="KODE_TENDER"  VALUE="<?php echo $kode_tender  ; ?>"  />
<input type="hidden" name="KODE_VENDOR" id="KODE_VENDOR"  VALUE="<?php echo $kode_vendor  ; ?>"  />
<input type="hidden" name="KETERANGAN" id="KETERANGAN_VERIFIKASI"     />             
     
<div class="accordion">
 <h3 id="h3_vendor_verifikasi" href="">VERIFIKASI ADMINISTRASI</h3>
            <div>
                <fieldset>
                   
                        
                    
                    <p>
                    <label>Nomor Pengadaan                    </label>  
                        <input type="text" style="width: 50%"  readonly="true"  value="<?php echo $kode_tender; ?>"  />
	
                    
                    </p>
                    <p>
                    <label>Nama Vendor                    </label>  
                        <input type="text" style="width: 50%"  readonly="true"  value="<?php echo $nama_vendor; ?>"  />
                    </p>
                      
                    
                    
                </fieldset>		 
			
			
			 
			<div id="listpopup_vendor" ></div>
			</div>
  <h3 id="h3_vendor_verifikasi" href="">ITEM</h3>
  <div>
      <table class="ui-jqgrid-htable" style="width: 100%;" cellspacing="0" cellpadding="0" border="0" >
          <tr>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 5%;" >No</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 75%;">Item</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%;" >Cek Vendor</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%;"  >Cek Verifikasi</th>  
          </tr>
          <?php
          $i = 1;
          foreach ($rs_teknisadm as $row) { 
          ?>
          for
          <tr>
              <td class="ui-state-default jqgrid-rownum" >&nbsp;<?php echo $i; ?></td>
              <td class="ui-state-default jqgrid-rownum" >&nbsp;<?php echo $row->KETERANGAN; ?></td>
              <td class="ui-state-default jqgrid-rownum" align="center" ><input type="checkbox" name="chkvendor__<?php echo $row->KETERANGAN; ?>" VALUE="1" /></td>
              <td class="ui-state-default jqgrid-rownum" align="center" ><input type="checkbox" name="chkverify__<?php echo $row->KETERANGAN; ?>" VALUE="1" /></td>
              
          </tr>
          <?php
          $i++;
          }
          ?>
          
      </table>
      
      
  </div>
  <h3 id="h3_vendor_verifikasi" href="">CATATAN</h3>
  <div>
          <textarea  style="width:100%" id="commentar_verifikasi" name="commentar_verifikasi" ></textarea>
  </div>

  </div>			
</form> 
 <script> 
     tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
        
 
  
  $(document).ready(function(){
	//$("#mysearch").jqGrid('filterGrid','#grid_ep_kom_kelompok_jasa');
	
	
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
                 
                
                $('#h3_vendor_popup', $(this)).each(function(){
                    var uri = $(this).attr('href');
                    if(uri != '' && uri != '#'){
                        var ctn = $("#listpopup_vendor") ;
                        //alert($(ctn).width());
                        //alert(uri);
                        if(ctn.html() == '')
                            ctn.load(uri);
                    }
                });
            });
 
	 
*/
	 });
         
  
</script>   			
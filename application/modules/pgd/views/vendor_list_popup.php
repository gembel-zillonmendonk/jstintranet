  <div class="accordion">
 <h3 id="h3_vendor_popup" href="<?php echo base_url(); ?>index.php/pgd/gridrf_vendor/ep_pgd_tender_vendor_klas?KODE_TENDER=<?php echo $kode_tender; ?>&KODE_KANTOR=<?php echo $kode_kantor; ?>">DAFTAR VENDOR</h3>
            <div>
	 		 
			
			
			 
			<div id="listpopup_vendor" ></div>
			</div>
  </div>			
 <script>
  
 
  
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
 
	 

	 });
  
</script>   			
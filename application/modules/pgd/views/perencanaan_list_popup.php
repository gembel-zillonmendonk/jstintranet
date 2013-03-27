  <div class="accordion">
 <h3 id="h3_perencanaan_popup" href="<?php echo base_url(); ?>index.php/pgd/gridpopup_perencanaan/ep_pgd_perencanaan_get">RENCANA PENGADAAN</h3>
            <div>
			<p>
			<div id="mysearch"></div>
                        <div style="float: left" >
                         <label>JUDUL PEKERJAAN&nbsp;&nbsp;</label>
                        </div>
                        <div style="float: left" >
				<input type="text" id="kolomPerencanaan" name="kolom"  value="" /> 
				<input type="button" id="btnSrcPerencanaan"  value="Cari" /> 
                                 </div> 
                        <div style="clear: both" ></div>
                            </p>
			 
			
			
			 
			<div id="listpopup_perencanaan" ></div>
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
	
	$("#btnSrcPerencanaan").click(function() {
	

	
	 
		
		srcval = $("#kolomPerencanaan").val();
		var myfilter = { groupOp: "AND", rules: []};
		myfilter.rules.push({field:"JUDUL_PEKERJAAN",op:"cn",data:srcval});
		
		var grid = $("#grid_ep_pgd_perencanaan_get");
			
		
		 
		
		grid[0].p.search = myfilter.rules.length>0;
		$.extend(grid[0].p.postData,{filters:JSON.stringify(myfilter)});
		grid.trigger("reloadGrid",[{page:1}]);
		 
		 
		//$('#grid_ep_kom_kelompok_jasa').jqGrid().trigger("reloadGrid");
		 
		 
		 
		//$('#grid_ep_kom_kelompok_jasa').jqGrid().trigger("reloadGrid");
		
	});
	
	
	$(".accordion" ).each(function(){
                 
                
                $('#h3_perencanaan_popup', $(this)).each(function(){
                    var uri = $(this).attr('href');
                    if(uri != '' && uri != '#'){
                        var ctn = $("#listpopup_perencanaan") ;
                        //alert($(ctn).width());
                        //alert(uri);
                        if(ctn.html() == '')
                            ctn.load(uri);
                    }
                });
            });
 
	 

	 });
  
</script>   			
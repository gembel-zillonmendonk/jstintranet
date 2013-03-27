
<div class="accordion">
 <h3 id="h3_panitia_view"  >PANITIA</h3>
            <div>
			 
			 
			<div   >
                            <form >
                            <label>Kode Kantor</label>
                            <input type="text" readonly value="<?php echo $KODE_KANTOR; ?>" />
                            <br/>
                            
                                <label>Nama Panitia</label>
                            <input type="text" style="width: 50%" readonly value="<?php echo $NAMA_PANITIA; ?>" />
                            
                            </form>  
                            
                        </div>
			</div>
 		
 <h3 id="h3_anggota_panitia_view" href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_ms_anggota_panitia_view?KODE_PANITIA=<?php echo $KODE_PANITIA; ?>&KODE_KANTOR=<?php echo $KODE_KANTOR; ?>">ANGGOTA</h3>
            <div>
			 
			 
			<div id="anggota_panitia_view"  ></div>
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
	
	$("#btnSrc").click(function() {
	

	
		//alert($("#kolom").val());
		
		
		
		srcval = $("#kolom").val();
		var myfilter = { groupOp: "AND", rules: []};
		myfilter.rules.push({field:"KODE_BARANG",op:"eq",data:srcval});
		
		var grid = $("#grid_ep_kom_jasa");
			
		
		alert(grid);
		
		grid[0].p.search = myfilter.rules.length>0;
		$.extend(grid[0].p.postData,{filters:JSON.stringify(myfilter)});
		grid.trigger("reloadGrid",[{page:1}]);
		alert(grid);
		 
		//$('#grid_ep_kom_kelompok_jasa').jqGrid().trigger("reloadGrid");
		
	});
	
	
	$(".accordion" ).each(function(){
                 
                
                $('#h3_anggota_panitia_view', $(this)).each(function(){
                    var uri = $(this).attr('href');
                    if(uri != '' && uri != '#'){
                        var ctn = $("#anggota_panitia_view") ;
                        //alert($(ctn).width());
                        //alert(uri);
                        if(ctn.html() == '')
                            ctn.load(uri);
                    }
                });
            });
 
	 

	 });
  
</script>   			
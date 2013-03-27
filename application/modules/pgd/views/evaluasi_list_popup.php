 <div id="modal_form_lihat_evaluasi" ></div>   
<div class="accordion">
 <h3 id="h3_evaluasi_popup" href="<?php echo base_url(); ?>index.php/pgd/gridpopup_evaluasi/ep_pgd_evaluasi_view">TEMPLATE EVALUASI</h3>
            <div>
			<p>
			<div id="mysearch"></div>
				<input type="text" id="kolom" name="kolom"  value="" /> 
				<input type="button" id="btnSrc"  value="Cari" /> 
			</p>
			 
			
			
			 
			<div id="listpopup_evaluasi" ></div>
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
                 
                
                $('#h3_evaluasi_popup', $(this)).each(function(){
                    var uri = $(this).attr('href');
                    if(uri != '' && uri != '#'){
                        var ctn = $("#listpopup_evaluasi") ;
                        //alert($(ctn).width());
                        //alert(uri);
                        if(ctn.html() == '')
                            ctn.load(uri);
                    }
                });
            });
 
	 

	 });
         
         
         
 function fnLihatEvaluasi(str){
      
     
          $('#grid_ep_pgd_evaluasi_view').jqGrid('setSelection',str); 
     var selected = $('#grid_ep_pgd_evaluasi_view').jqGrid('getGridParam', 'selrow');
     selected = jQuery('#grid_ep_pgd_evaluasi_view').jqGrid('getRowData',selected);
			 

     
                 str= "";
		jQuery('#modal_form_lihat_evaluasi')
                     .load($site_url + '/pgd/evaluasi/view?KODE_EVALUASI=' + selected["KODE_EVALUASI"])
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
            jQuery('#modal_form_lihat_evaluasi').dialog("open");
     
 }
 
  
</script>   			
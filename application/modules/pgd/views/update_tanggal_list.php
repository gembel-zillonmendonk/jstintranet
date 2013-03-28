  <div class="accordion">
 <h3 href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_pekerjaan_update_tanggal">DAFTAR PEKERJAAN</h3>
            <div>
			
			<fieldset class="ui-widget-content"> <h3 href="<?php echo base_url(); ?>index.php/pgd/gridrf/ep_pgd_pekerjaan_update_tanggal">DAFTAR PEKERJAAN - UPDATE TANGGAL</h3>

			<legend>Pencarian</legend>
			<form id="frmSearch" method="POST" action="" >
			
			<div id="mysearch"></div>
			<p>	
				<label>
					<select id="myfield" >
						<option value="KODE_TENDER" >Nomer Pengadaan</option>
						<option value="JUDUL_PEKERJAAN" >Deskripsi</option>
						<option value="STATUS" >Status</option>
                                                
						 
					</select>
				</label>
				<input type="text" id="kolom" name="kolom"  value="" /> 
				<input type="button" id="btnSrc"  value="Cari" /> 
			</p>
			</form>
			</fieldset>	
		 
			
			
			<div id="list" ></div>
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
		
		var myfield = $("#myfield").val();
		
		myfilter.rules.push({field: myfield ,op:"cn",data:srcval});
		
		var grid = $("#grid_ep_pgd_pekerjaan_update_tanggal");
			
	 
		grid[0].p.search = myfilter.rules.length>0;
		$.extend(grid[0].p.postData,{filters:JSON.stringify(myfilter)});
		grid.trigger("reloadGrid",[{page:1}]);
	 
		
		 
		 
		//$('#grid_ep_kom_kelompok_jasa').jqGrid().trigger("reloadGrid");
		
	});
	
	$(".accordion" ).each(function(){
                 
                
                $('h3', $(this)).each(function(){
                    var uri = $(this).attr('href');
				//	alert(uri);
                    if(uri != '' && uri != '#'){
                       // var ctn = $("#list") ;
						var ctn =  $(this).next().children("#list");   

					 			
					   //alert($(ctn).width());
                        //alert(uri);
                        // if(ctn.html() == '')
                            ctn.load(uri);
                    }
                });
            });
            
	$("#btnAdd" ).click(function() {
		window.location = "<?php echo base_url() ."index.php/adm/harga_jasa/add"; ?>";  
	});
	
	$("#btnEdit" ).click(function() {
	 
	 var selected = $('#grid_ep_kom_jasa').jqGrid('getGridParam', 'selrow');
		 if (selected) {
                    selected = jQuery('#grid_ep_kom_jasa').jqGrid('getRowData',selected);
                    var keys = <?php echo json_encode(Array ( 0  => "KODE_JASA" )); ?>;
                    var count = 0;
                
                    var data = {};
                    var str ="";
                    $.each(keys, function(k, v) { 
                        data = {v:selected[v]};
                        str += v + "=" + selected[v] + "&";
                        count++; 
                    });
                    window.location = "<?php echo base_url() . "index.php/adm/jasa/edit"; ?>?" + str;
		}			
	});
	
		
	$("#btnDelete" ).click(function() {
	
	 var selected = $('#grid_ep_kom_kelompok_jasa').jqGrid('getGridParam', 'selrow');
		 if (selected) {
                    selected = jQuery('#grid_ep_kom_kelompok_jasa').jqGrid('getRowData',selected);
                    var keys = <?php echo json_encode(Array ( 0  => "KODE_JASA" )); ?>;
                    var count = 0;
                
                    var data = {};
                    var str ="";
                    $.each(keys, function(k, v) { 
                        data = {v:selected[v]};
                        str += v + "=" + selected[v] + "&";
                        count++; 
                    }); 
					
                    window.location = "<?php echo base_url() . "index.php/adm/jasa/delete"; ?>?" + str;
		}			
	});
 
	 });
	 
	 
	 function fnProsesUpdateTanggal(strx) {
		// alert("fnProsesJasa" + str);
		// $('#grid_ep_kom_komentar_jasa').editRow('1');
		
		 $('#grid_ep_pgd_pekerjaan_update_tanggal').jqGrid('setSelection',strx); 
		 var selected = $('#grid_ep_pgd_pekerjaan_update_tanggal').jqGrid('getGridParam', 'selrow');
                   selected = jQuery('#grid_ep_pgd_pekerjaan_update_tanggal').jqGrid('getRowData',selected);
 
		   var str ="KODE_TENDER=" + selected["KODE_TENDER"] + "&KODE_KANTOR=" + selected["KODE_KANTOR"];  ;
                     
                   			
		 
		   window.location = "<?php echo base_url() . "index.php/pgd/update_tanggal/editor"; ?>?" + str;
	 }
	 
	  
	  
</script>   			
  <div class="accordion">
 <h3 href="<?php echo base_url()?>index.php/adm/gridr/ms_jabatan">JABATAN</h3>
            <div>
			<p>
                                <label>CARI BERDASARKAN</label>
                            		<select  id="kolom" name="kolom"  > 
                                            <option value="KODE_JABATAN">KODE JABATAN</option>
                                            <option value="NAMA_JABATAN">NAMA JABATAN</option>
                                            
                                         </select>    
                                <input type="text" id="cari" name="cari"  />
                                <button type="button" id="btnSrc"  >Cari</button> 
                        </p>
			<p>
                            <button type="button" id="btnEdit"  >Edit Otorisasi Menu Jabatan</button> 
				 
			</p>
			 
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
                val = $("#cari").val();
		var myfilter = { groupOp: "AND", rules: []};
		myfilter.rules.push({field:srcval,op:"cn",data:val});
		
		var grid = $("#grid_ms_jabatan");
			
	 
		grid[0].p.search = myfilter.rules.length>0;
		$.extend(grid[0].p.postData,{filters:JSON.stringify(myfilter)});
		grid.trigger("reloadGrid",[{page:1}]);
	 
		 
		 
		//$('#grid_ep_kom_kelompok_jasa').jqGrid().trigger("reloadGrid");
		
	});
	
	
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
 
	
	$("#btnEdit" ).click(function() {
	 
	 var selected = $('#grid_ms_jabatan').jqGrid('getGridParam', 'selrow');
		 if (selected) {
                    selected = jQuery('#grid_ms_jabatan').jqGrid('getRowData',selected);
                    var keys = <?php echo json_encode(Array ( 0  => "KODE_JABATAN" )); ?>;
                    var count = 0;
                
                    var data = {};
                    var str ="";
                    $.each(keys, function(k, v) { 
                        data = {v:selected[v]};
                        str += v + "=" + selected[v] + "&";
                        count++; 
                    });
                    window.location = "<?php echo base_url() . "index.php/adm/jabatan/edit"; ?>?" + str;
		}			
	});
	
		
	$("#btnDelete" ).click(function() {
	alert("xx");
	 var selected = $('#grid_ep_kom_kelompok_jasa').jqGrid('getGridParam', 'selrow');
		 if (selected) {
                    selected = jQuery('#grid_ep_kom_kelompok_jasa').jqGrid('getRowData',selected);
                    var keys = <?php echo json_encode(Array ( 0  => "KODE_KEL_JASA" )); ?>;
                    var count = 0;
                
                    var data = {};
                    var str ="";
                    $.each(keys, function(k, v) { 
                        data = {v:selected[v]};
                        str += v + "=" + selected[v] + "&";
                        count++; 
                    }); 
					
                    window.location = "<?php echo base_url() . "index.php/kel_jasa/delete"; ?>?" + str;
		}			
	});
	 
	 

	 });
  
</script>   			
  <div class="accordion">
 <h3 href="<?php echo base_url()?>index.php/adm/gridr/ep_kom_harga_jasa">HARGA JASA</h3>
            <div>
 
                        <fieldset class="ui-widget-content">
        <legend>Pencarian</legend>
			<form id="frmSearch" method="POST" action="" >
			
			<div id="mysearch"></div>
			<p>	
				<label>KELOMPOK JASA</label>
                                        <select id="keljasa">
                                            <option value="" >SEMUA</option>
                                            <?php
                                            foreach ($rskel as $row) {
                                                echo "<option value='" . $row->KODE_KEL_JASA . "' >".$row->NAMA_KEL_JASA."</option>";
                                                
                                            }
                                            ?>
                                        
                                        </select>
                               
			</p>
                        <p>	
				<label>STATUS</label>
                                        <select id="status">
                                            <option value="">SEMUA</option>
                                            <option value="SUDAH DISETUJUI">SUDAH DISETUJUI</option>
                                            <option value="BELUM DISETUJUI">BELUM DISETUJUI</option>
                                        </select>
                              
		
			</p>
                        <p>
                                <label>CARI BERDASARKAN</label>
                            		<select  id="kolom" name="kolom"  > 
                                            <option value="KODE_JASA">KODE JASA</option>
                                            <option value="NAMA_JASA">DESKRIPSI</option>
                                            <option value="NAMA_VENDOR">VENDOR</option>
                                            <option value="NAMA_SUMBER">SUMBER</option>
                                            
                                         </select>    
                                <input type="text" id="cari" name="cari"  />
                                <button type="button" id="btnSrc"  >Cari</button> 
                        </p>
			</form>
         </fieldset>                   

			<p>
                            <button type="button" id="btnAdd"  >Tambah  Harga Jasa</button> 
                            <button type="button" id="btnBanding"  >Bandingkan  Harga Jasa</button> 
			
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
                KODE_KEL_JASA = $("#keljasa").val();
                STATUS = $("#status").val();
        		srcval = $("#kolom").val();
		var myfilter = { groupOp: "AND", rules: []};
		var kolom = $("#kolom").val(); 
                var cari = $("#cari").val();
                
                if (KODE_KEL_JASA.length > 0) { 
                        myfilter = { groupOp: "OR", rules: []};
                        myfilter.rules.push({field:'KODE_KEL_JASA' ,op:"eq",data: KODE_KEL_JASA}, {field: kolom ,op:"cn",data: cari } );
                        if (STATUS != "") {
                            myfilter.rules.push({field:'KODE_KEL_JASA' ,op:"eq",data: KODE_KEL_JASA}, {field:'STATUS' ,op:"eq",data: STATUS} , {field: kolom ,op:"cn",data: cari } );
                        } else {
                            myfilter.rules.push({field:'KODE_KEL_JASA' ,op:"eq",data: KODE_KEL_JASA},   {field: kolom ,op:"cn",data: cari } ); 
                        }
                        
                } else { 
                        if (STATUS != "") {
                            myfilter = { groupOp: "AND", rules: []};
                            myfilter.rules.push({field:'STATUS' ,op:"eq",data: STATUS} , {field: kolom ,op:"cn",data: cari } );
                        } else {
                            myfilter.rules.push({field: kolom ,op:"cn",data: cari } );
                        }
                    
                }       
                  
		var grid = $("#grid_ep_kom_harga_jasa");
			
	 
		grid[0].p.search = myfilter.rules.length>0;
		$.extend(grid[0].p.postData,{filters:JSON.stringify(myfilter)});
		grid.trigger("reloadGrid",[{page:1}]);
	 
		
//		alert(grid);
		 
		//$('#grid_ep_kom_kelompok_jasa').jqGrid().trigger("reloadGrid");
		
 
/*
	
		//alert($("#kolom").val());
	 
		var myfilter = { groupOp: "AND", rules: []};
		myfilter.rules.push({field:"KODE_KEL_JASA",op:"eq",data:"J01"});
		
		var grid = $("#grid_ep_kom_jasa");
			
		
		alert(grid);
		
		grid[0].p.search = myfilter.rules.length>0;
		$.extend(grid[0].p.postData,{filters:JSON.stringify(myfilter)});
		grid.trigger("reloadGrid",[{page:1}]);
		alert(grid);
*/		 
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
                    window.location = "<?php echo base_url() . "index.php/jasa/edit"; ?>?" + str;
		}			
	});
	
        
        $("#btnBanding" ).click(function() {
	 
	 var selected = $('#grid_ep_kom_harga_jasa').jqGrid('getGridParam', 'selrow');
		 if (selected) {
                    selected = jQuery('#grid_ep_kom_harga_jasa').jqGrid('getRowData',selected);
                    var keys = <?php echo json_encode(Array ( 0  => "KODE_HARGA_JASA" )); ?>;
                    var count = 0;
                
                    var data = {};
                    var str ="";
                    $.each(keys, function(k, v) { 
                        data = {v:selected[v]};
                        str += v + "=" + selected[v] + "&";
                        count++; 
                    });
                    window.location = "<?php echo base_url() . "index.php/adm/harga_jasa/banding"; ?>?" + str;
		}			
	});
	
		 
	 
	 

	 });
  
</script>   			
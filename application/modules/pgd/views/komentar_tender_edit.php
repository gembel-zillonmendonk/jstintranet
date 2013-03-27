
        
            <div   >
			<fieldset>
			<form id="frmKomentar" action="<?php echo base_url() . "index.php/pgd/komentar_tender/update" ?>"  method="POST" enctype="multipart/form-data" >
			<p>	
                            <label>File (Max 2MB, PDF)</label>
                            <input type="file" class="{validate:{required:false,maxlength:64}}" name="userfile" id="NAMA_FILE" />
                        </p>
                            <p>                   
               <textarea  style="width:100%" id="commentar" name="commentar" ></textarea>
			</p>
	<input type="hidden" name="kode_alurkerja" id="KODE_ALURKERJA" value="<?php echo $kode_alurkerja ; ?>" />
			<input type="hidden" name="kode_komentar" id="kode_komentar" value="<?php echo $kode_komentar; ?>" />

                        <p>
			<label>Respon</label>
                         
			<select id="kode_transisi"  name="kode_transisi"   class="{validate:{required:true,maxlength:255}}" >
				<option value="" >-- </option>
				<?php
				foreach($rs_transisi as $row) {
				?>
					<option value="<?php echo $row->KODE_TRANSISI; ?>" ><?php echo $row->NAMA_TRANSISI; ?></option>
				<?php
				}
				?>
			</select>  
			</p>
<input type="hidden" name="KODE_TENDER" id="KODE_TENDER" value="<?php echo $kode_tender ; ?>" />
<input type="hidden" name="KODE_KANTOR" id="KODE_KANTOR" value="<?php echo $kode_kantor ; ?>" />						
<input type="hidden" id="komentar"  name="komentar" /> 			
			</form>
			</fieldset>
<br/> 
<button type="button" id="btnSubmit"   >Submit</button>
<button type="button" id="btnCancel"    >Cancel</button> 
<div id="trace" ></div>
  </div>
  <script>
     tinyMCE.init({
		mode : "textareas",
		theme : "simple", 
                setup : function(ed) {
               
                    ed.onChange.add(function(ed, evt) {



                        //$(ed.getBody()).find('p').addClass('headline');

                        // get content from edito
                        var content = ed.getContent().toUpperCase();

                        // tagname to toUpperCase
                        // content = content.replace(/< *\/?(\w+)/g,function(w){return w.toUpperCase()});
                       ed.setContent(content);
                        // write content to html source element (usually a textarea)
                        // $(ed.id).html(content );
                    });
                }
	});
      
      var validatorKomentar;
     
    $(document).ready(function(){


         validatorKomentar = $("#frmKomentar").validate({
            meta: "validate",
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit();
            }
        });

        
        
        $("#btnSubmit").click(function(){ 
            //alert("btnSubmit");
             $('#komentar').val(tinyMCE.get('commentar').getContent());
            fnSubmitKomentar();
            return;
            
            

            
                   $.ajax({
                      type: "POST",
                      data : "KODE_TENDER=<?php echo $this->input->get("KODE_TENDER"); ?>&KODE_KANTOR=<?php echo $this->input->get("KODE_KANTOR"); ?>",
                      url: "<?php echo base_url(); ?>index.php/pgd/pengadaan_check/check_tender_item",
                      success : function(msg) {


                       if(validatorKomentar.form()) {
                          $("#frmKomentar").ajaxSubmit({
                                      //clearForm: false,
                                      success: function(msg){
                                            alert(msg);
                                           $("#trace").html(msg);
                                         // alert(msg);
                                          //reload grid


                                      },
                                      error: function(){
                                          alert('Data gagal disimpan')
                                      }
                                  });

                       } 


              } ,
              error : function() {
                  alert("Data Pengadaan Belum Lengkap");

              }


            }); 
        
  
      }); 
        
  
        $("#btnCancel").click(function(){ 
            
           window.history.back();
        });

    });
        
 </script>           
 

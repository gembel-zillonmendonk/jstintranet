<form id="frmKomentarTeknis" method="POST" action="<?php echo base_url() . "index.php/pgd/pengadaan_evaluasi/komentar_teknis/" . $KODE_VENDOR . "/" . $NAMA_VENDOR; ?>"  >
<p>                   
               <textarea  style="width:100%" id="commentar_teknis" name="commentar_teknis" ></textarea>
</p>
<input type="hidden" id="KOMENTAR_EVALUASI" name="KOMENTAR_EVALUASI" value="" />
<input type="hidden" name="KODE_VENDOR" value="<?php echo $KODE_VENDOR; ?>" />
<input type="hidden" name="KODE_TENDER" value="<?php echo $KODE_TENDER; ?>" />
<input type="hidden" name="KODE_KANTOR" value="<?php echo $KODE_KANTOR; ?>" />
<input type="hidden" name="NAMA_VENDOR" value="<?php echo $NAMA_VENDOR; ?>" />
</form>
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
</script>      
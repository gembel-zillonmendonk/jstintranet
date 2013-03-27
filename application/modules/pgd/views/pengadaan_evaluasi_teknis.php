<?php $this->load->helper('form'); ?>

      <form id="frm_EvaluasiTeknis" method="POST" action="<?php echo base_url() . "index.php/pgd/pengadaan_evaluasi/teknis"; ?>" >
          <input type="hidden" name="KODE_TENDER" value="<?php echo $KODE_TENDER; ?>" />
          <input type="hidden" name="KODE_KANTOR" value="<?php echo $KODE_KANTOR; ?>" />
          
          
          
<div class="accordion"> 
   <h3 href="">PERBANDINGAN PENAWARAN TEKNIS</h3>
            <div>
                <fieldset class="ui-widget-content">
                     <p>	
                         <?php echo form_label("Bobot Teknis") ?>
                         <input type="text" style="width: 50%" readonly="true"  value="<?php echo $BOBOT_TEKNIS; ?>" />
                     </p>
                     <p>	
                         <?php echo form_label("Passing Grade") ?>
                         <input type="text" style="width: 50%" readonly="true"  value="<?php echo $GRADE; ?>" />
                     </p>
                </fieldset>     
             </div>
            <div style="overflow:scroll;">
          <table class="ui-jqgrid-htable" style="width: 100%;" cellspacing="0" cellpadding="0" border="0" >
          <tr>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10px; height: 30px" >No</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 100px; height: 30px" >Item</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 40px; height: 30px" >Bobot</th>
              <?php 
                foreach($rsvendor as $row) {
                ?>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 40px; height: 30px" ><?php echo $row->NAMA_VENDOR;?></th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10px; height: 30px" >NILAI</th>
                <?php
               }
               ?>
          </tr>
          <?php 
          $i=1;
          foreach($rsitemteknis as $rowy) {
          ?>
             <tr>
              <td >&nbsp;<?php echo $i;?></td>
              <td >&nbsp;<?php echo $rowy->KETERANGAN;?></td>
              <td >&nbsp;<?php echo $rowy->BERAT;?></td>
               <?php 
                foreach($rsvendorteknis as $rowx) {
                    if ($rowy->KETERANGAN == $rowx->KETERANGAN) {
                       
                        
                ?>
                    <input type="hidden" name="KETERANGAN[]" value="<?php echo $rowx->KETERANGAN;?>" />
                    <input type="hidden" name="KODE_VENDOR[]" value="<?php echo $rowx->KODE_VENDOR;?>" />
                    
                    <td   >&nbsp;<?php echo $rowx->KETERANGAN_VENDOR;?></td>
                    <td align="center" type="number"  >&nbsp;<input type="number" name="NILAI[]" style="width: 50px" value="<?php echo $rowx->NILAI;?>" /></td>
                <?php
                    }
               }
               ?>
           </tr>
           <?php
           $i++;
          }
          ?>
           </table>
             </div>
   
   
   <h3 href="">NILAI</h3>
            <div style="scroll" >
                     <table class="ui-jqgrid-htable" style="width: 100%;" cellspacing="0" cellpadding="0" border="0" >
          <tr>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 5%; height: 30px" >No</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 25%; height: 30px" >Nama Vendor</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >Nilai Teknis</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 50%; height: 30px" >Catatan</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >Komentar</th>
              
          </tr>
           <?php 
           $i=1;
                foreach($rsvendor as $row) {
                  
                    
           ?>
          <input type="hidden" name="KODE_VENDOR_EVAL[]" value="<?php echo $row->KODE_VENDOR;?>" />    
           <tr>
              <td >&nbsp;<?php echo $i;?></td>
              <td >&nbsp;<?php echo $row->NAMA_VENDOR;?></td>
              <td >&nbsp;<?php echo $row->NILAI_TEKNIS;?></td>
               
              <td >&nbsp;<input type="text" name="KETERANGAN_TEKNIS[]" alue=""style="width: 95%" value="<?php echo $row->KETERANGAN_TEKNIS;?>" ></td>
              <td >&nbsp;<a href="javascript:fnKomentarTeknis(<?php echo $row->KODE_VENDOR;?>,'<?php echo $row->NAMA_VENDOR;?>')" >Komentar</a></td>
               
           </tr>
           <?php 
           $i++;
                }
           ?>
            
                     </table>
                
                
                
                
            </div>
   <h3 href="<?php echo base_url() . "index.php/pgd/gridr/ep_pgd_komentar_evaluasi_teknis"; ?>">KOMENTAR</h3>
            <div>
      
                <div id="list" ></div>
            </div>
   
   
   
   
</div> 
          <input type="hidden" name="KOMENTAR_TEKNIS" id="KETERANGAN_TEKNIS" value="" />
      </form>

<script>
      
$(document).ready(function(){
     	
	$(".accordion" ).each(function(){
                 
                
                $('h3', $(this)).each(function(){
                    var uri = $(this).attr('href');
				//	alert(uri);
                    if(uri != '' && uri != '#'){
                            var ctn =  $(this).next().children("#list");   
                            ctn.load(uri);
                    }
                });
            });   

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
});
   
   

</script>
          

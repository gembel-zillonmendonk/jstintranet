<?php $this->load->helper('form'); ?>

      
<div class="accordion"> 
   <h3 href="">PERBANDINGAN PENAWARAN</h3>
   
            <div style="overflow: visible" >
             <table class="ui-jqgrid-htable" style="width:  700px;" cellspacing="0" cellpadding="0" border="0" >
             <tr>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10px; height: 30px" >No</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 100px; height: 30px" >Item</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 100px; height: 30px" >HPS</th>
        <?php 

          $arr =    $arrharga[0];
          $j=0;
          foreach($arr  as $k=>$v) {
              if ($j > 2 && $j < (count($arr) - 2) ) {
          ?>
            <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 100px; height: 30px" ><?php echo $k ; ?></th>
              
              <?php
             
              }
              $j++;
          }
             ?>
             
             </tr>
        <?php 
           
          //  print_r($arrharga);
            
           for($i=0;$i<count($arrharga);$i++) {
          
               ?>
             <tr>
                 
        <?php 
          $arr =    $arrharga[$i];
          $j=0;
          foreach($arr  as $k=>$v) {
              if ($j == 0 ) {
          ?>
             
              <td  >&nbsp;<?php echo ($i+1);?></td>
              <td  >&nbsp;<?php echo $arr["KODE_BARANG_JASA"] ." - " . $arr["NAMA_BARANG_JASA"] ; ?></td>
         <?php
              }
               if ($j > 1 && $j < (count($arr) - 2) ) {
         ?>
              <td style="text-align: right" >&nbsp;<?php echo number_format($arr[$k],2);?></td>
         <?php
               }
              $j++;
          }
         ?>
           </tr>
         <?php
          }
         ?>
           <tr class="ui-widget-content jqgrow ui-row-ltr" > 
               <td colspan="2" style="background-color: yellow" >&nbsp;Total Harga</td>
           </tr>
           <tr>
               <td colspan="2" style="background-color: yellow" >&nbsp;PPN</td>
           </tr>
           <tr>
               <td colspan="2" style="background-color: yellow" >&nbsp;Total Harga Setelah PPN</td>
           </tr> 
            <tr>
               <td colspan="2" style="background-color: yellow" >&nbsp;Bid Bond</td>
           </tr> 
            <tr>
               <td colspan="2" style="background-color: yellow" >&nbsp;Valid Sampai</td>
           </tr> 

             </table>
                    
 </div>
   
 <div class="accordion">        
   <h3 href="">NILAI</h3>
            <div>
            <form id="frm_EvaluasiHarga" method="POST" action="<?php echo base_url() . "index.php/pgd/pengadaan_evaluasi/harga"; ?>" >
             <input type="hidden" name="KODE_TENDER" value="<?php echo $KODE_TENDER; ?>" />
             <input type="hidden" name="KODE_KANTOR" value="<?php echo $KODE_KANTOR; ?>" />
          
             <table class="ui-jqgrid-htable" style="width:  100%;" cellspacing="0" cellpadding="0" border="0" >
             <tr>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 5%; height: 30px" >No</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 20%; height: 30px" >Nama Vendor</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >Nilai Harga</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 30%; height: 30px" >Catatan</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >Validitas<br/> Penawaran</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >Validitas<br/> Bid Bod</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10px; height: 30px" >Komentar</th>
              
             </tr>
             <?php
             $i=1;
             foreach($rsevalharga as  $row ) {
             ?>
             <tr>
                 <input type="hidden" name="KODE_VENDOR[]" value="<?php echo $row->KODE_VENDOR; ?>" />
                 <td style="height: 25px">&nbsp;<?php echo $i; ?></td>
                 <td>&nbsp;<?php echo $row->NAMA_VENDOR; ?></td>    
                 <td style="text-align: right" >&nbsp;<?php echo $row->NILAI_HARGA; ?></td>    
                 <td>&nbsp;<input style="width: 90%"  type="text" name="KETERANGAN_HARGA[]" value="<?php echo $row->KETERANGAN_HARGA; ?>" /> </td>    
                 <td style="text-align: center" >&nbsp;<input type="checkbox" <?php echo ($row->PENAWARAN ? " CHECKED " : "") ?> name="PENAWARAN_<?php echo $row->KODE_VENDOR; ?>" value="1" /></td>    
                 <td style="text-align: center" >&nbsp;<input type="checkbox" <?php echo ($row->BID_BOND ? " CHECKED " : "") ?> name="BIDBOND_<?php echo $row->KODE_VENDOR; ?>" value="1" /></td>    
                 <td>&nbsp;<a href="javascript:fnKomentarHarga(<?php echo $row->KODE_VENDOR;?>,'<?php echo $row->NAMA_VENDOR;?>')" >Komentar</a></td>    
                 
                 
             </tr>
             <?php
             $i++;
             }
             ?>
             
             </table>
           
                  </form>
            <p align="center">
                <button type="button"  id="btnHitungNilai" onclick="fnHitungNilaiHarga()" >Hitung Nilai</button>
            </p> 
   
            </div>
   <h3 href="<?php echo base_url() . "index.php/pgd/gridrf/ep_pgd_komentar_evaluasi_harga"; ?>">KOMENTAR</h3>
            <div>
                <div id="list" ></div>
            </div>
            
</div> 

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
          

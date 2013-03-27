<?php $this->load->helper('form'); ?>
<div class="accordion">
    <h3 href="">PENAWARAN</h3>
    <div>
        <div>
            <form>
            <fieldset class="ui-widget-content">
                    <p>	
                        <?php echo form_label("Nomor Penawaran") ?>
                        <input type="text" readonly="true" name="NO_PENAWARAN"  value="<?php echo $NO_PENAWARAN; ?>" />
                    </p>
                    <p>	
                        <?php echo form_label("Suplier") ?>
                        <input type="text" readonly="true" name="KODE_TENDER"  value="" />
                    </p>
                    <p>	
                        <?php echo form_label("Tipe Penawaran *") ?>
	                <input type="text" readonly="true" name="TIPE"  value="" />
                    </p>
                    <p>	
                        <?php echo form_label("Nilai Bidbond *") ?>
                        <input type="number"    readonly="true"  id="BID_BOND" name="BID_BOND" value="<?php echo $BID_BOND;  ?>" />
                    </p>
                    <p>	
                        <?php echo form_label("Kandungan Lokal *") ?>
                        <input type="number"  readonly="true"   id="KANDUNGAN_LOKAL" name="KANDUNGAN_LOKAL" value="<?php echo $KANDUNGAN_LOKAL;  ?>" />
                    </p>
                    <p>	
                        <?php echo form_label("Waktu Pengiriman *") ?>
                        <input type="number"  readonly="true"     id="WAKTU_PENGIRIMAN" name="WAKTU_PENGIRIMAN" value="<?php echo $WAKTU_PENGIRIMAN;  ?>" />
                        <select readonly="true" name="UNIT">
                            <option value="H" >HARI</option>
                            <option value="W" >MINGGU</option>
                            <option value="M" >BULAN</option>

                        </select>    
                    </p>
                    
            </fieldset>    
            </form>       
        </div>    
        <div id="list"></div>
    </div>
    <h3 href="">ITEM KOMERSIAL</h3>
    <div>
         <form id="frm_komersial" method="POST" action="" >
    
        <table class="ui-jqgrid-htable" style="width: 100%;" cellspacing="0" cellpadding="0" border="0" >
          <tr>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 5%; height: 30px"  >No</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >Kode</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 20%; height: 30px" >Deskripsi</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 5%; height: 30px" >Jumlah</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >[Penawaran Vendor] <br/> Deskripsi</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 5%; height: 30px" >[Penawaran Vendor] <br/>  Jumlah</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >[Penawaran Vendor] <br/>  Harga Satuan</th>
              <th class="ui-state-default ui-th-column ui-th-ltr" style="width: 10%; height: 30px" >[Penawaran Vendor] <br/> Sub Total</th>
              
          </tr>
          <?php
          $i = 1;
          foreach($rskomersial as $row) {
          ?>
          
          <tr>
              <td style="width: 5%; height: 30px"  align="center" >&nbsp;<?php echo $i; ?></td>
              <td>&nbsp;<?php echo $row->KODE_BARANG_JASA; ?></td>
              <td>&nbsp;<?php echo $row->KETERANGAN; ?></td>
              <td>&nbsp;<?php echo $row->JUMLAH; ?></td>
              <td  ><?php echo $row->KETERANGAN_PENAWARAN; ?></td>
              <td align="center" ><?php echo $row->JUMLAH_PENAWARAN; ?></td>
              <td align="right" ><?php echo $row->HARGA_PENAWARAN; ?></td>
              <td align="right" ><?php echo ($row->JUMLAH_PENAWARAN * $row->HARGA_PENAWARAN); ?></td>
              
          
          </tr>
          <input type="hidden" name="KODE_BARANG_JASA[]" value="<?php echo $row->KODE_BARANG_JASA; ?>" /> 
          <input type="hidden" name="KODE_SUB_BARANG_JASA[]" value="<?php echo $row->KODE_SUB_BARANG_JASA; ?>" /> 
          
                   
          <?php
          $i++;
          }
          ?>
        </table>
             
        <div id="list"></div>
    </div>
</div>

<script>
  
  $(document).ready(function(){
	//$("#mysearch").jqGrid('filterGrid','#grid_ep_kom_kelompok_jasa');
	
        
     	
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
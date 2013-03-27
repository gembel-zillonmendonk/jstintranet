<?php
$params = '';
if (count($_REQUEST) > 0) {
    foreach ($_REQUEST as $key => $value) {
        $params .= $key . '=' . rawurlencode($value) . '&';
    }

    if (strlen($params) > 0)
        $params = '?' . $params;
}
?>
<?php $this->load->helper('form'); ?>
<div class="accordion">
    <h3 href="#">PENCARIAN</h3>
    <div>
        <form action="" accept-charset="utf-8" id="id_form_form_deactivation" name="form_form_deactivation" method="GET" enctype="multipart/form-data" class="form-horizontal" novalidate="novalidate">
            <div class="row-fluid">
                <div class="span6">
                    <div class="control-group">
                        <?php echo form_label("PERIODE", "TGL_MULAI", array("class" => "control-label")) ?> 
                        <div class="controls">
                            <?php
                            echo form_dropdown("KODE_KANTOR", array(
                                'GANJIL' => 'SEMESTER GANJIL',
                                'GENAP' => 'SEMESTER GENAP',
                                '01' => 'JANUARI',
                                '02' => 'FEBRUARI',
                                '03' => 'MARET',
                                '04' => 'APRIL',
                                '05' => 'MEI',
                                '06' => 'JUNI',
                                '07' => 'JULY',
                                '08' => 'AGUSTUS',
                                '09' => 'SEPTEMBER',
                                '10' => 'OKTOBER',
                                '11' => 'NOPEMBER',
                                '12' => 'DESEMBER',
                            ), isset($_REQUEST['KODE_KANTOR']) ? $_REQUEST['KODE_KANTOR'] : "", 'class="{validate:{required:true,maxlength:22}}"');
                            echo "  ";
                            echo form_input("TAHUN"
                                    , isset($_REQUEST['TAHUN']) ? $_REQUEST['TAHUN'] : "", 'class="{validate:{required:true,maxlength:4}}"');
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="btnCari" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">CARI</span></button>
            <button type="button" id="btnCetak" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">CETAK</span></button>

        </form>
    </div>
    <h3 href="<?php echo site_url('/report/grid/pgd.rekap_perencanaan' . $params) ?>">LAPORAN PERENCANAAN</h3>
    <div></div>

</div>
<script>
    $(".accordion").each(function(){
        //alert("test");
                
        $('h3', $(this)).each(function(){
            var uri = $(this).attr('href');
            if(uri != '' && uri != '#'){
                var ctn = $(this).next();
                //alert($(ctn).width());
                //alert(uri);
                if(ctn.html() == '')
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
    //.css("width", "auto");
</script>
<?php
$params = '';
if (count($_REQUEST) > 0) {
    foreach ($_REQUEST as $key => $value) {
        $params .= $key . '=' . $value . '&';
    }

    if (strlen($params) > 0)
        $params = '?' . $params;
}
?>

<div class="accordion">
    <h3 href="<?php echo site_url('/contract/view_form/contract.ep_ktr_kontrak' . $params) ?>">HEADER</h3>
    <div></div>
    <h3 href="<?php echo site_url('/contract/view_form/contract.ep_ktr_kontrak_jaminan' . $params) ?>">JAMINAN PELAKSANAAN</h3>
    <div></div>


    <?php if (strlen($params) > 0 && isset($_REQUEST['KODE_KONTRAK']) && $_REQUEST['KODE_KONTRAK'] > 0): ?>
        <h3 href="<?php echo site_url('/contract/view_grid/contract.ep_ktr_kontrak_item' . $params) ?>">ITEM</h3>
        <div></div>
        <h3 href="<?php echo site_url('/contract/milestone/view_grid_form/milestone.ep_ktr_jangka_kontrak' . $params) ?>">MILESTONE</h3>
        <div></div>
        <h3 href="<?php echo site_url('/contract/view_grid_form/contract.ep_ktr_kontrak_dok' . $params) ?>">LAMPIRAN</h3>
        <div></div>
    <?php else: ?>
        <h3 href="<?php echo site_url('/contract/view_grid/contract.ep_pgd_item_penawaran' . $params) ?>">ITEM PENAWARAN</h3>
        <div></div>
    <?php endif; ?>

    <p>
        <button type="button" id="selesai">TUTUP KONTRAK</button>
    </p>
</div>
<script>
    // stylish button and input date
    $(function() {
        $( "input:submit, button").button();
        //$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
        
    });
    $(".accordion").each(function(){
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
    
    $(document).ready(function(){
        $('#selesai').live('click', function(){
            var f = $("#id_form_ep_ktr_kontrak");
            var params = "KODE_KONTRAK="+$("input[name='EP_KTR_KONTRAK[KODE_KONTRAK]']", f).val()
                +"&KODE_KANTOR="+$("#id_ep_ktr_kontrak_kode_kantor", f).val()
                +"&KODE_TENDER="+$("#id_ep_ktr_kontrak_kode_tender", f).val()
                +"&KODE_VENDOR="+$("#id_ep_ktr_kontrak_kode_vendor", f).val();
                
            if(params.length > 0)
                window.location = '<?php echo site_url('/contract/final_review?referer_url=/contract/monitoring&') ?>' + params;
        });
    });
    
</script>
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
    <h3 href="<?php echo site_url('/contract/form/contract.ep_ktr_kontrak_termination' . $params) ?>">KEPUTUSAN</h3>
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
    
    
    $(document).ready(function(){
        $('#selesai').live('click', function(){
            var f = $("#id_form_ep_ktr_kontrak");
            var params = "kode_kontrak="+$("#id_ep_ktr_kontrak_kode_kontrak", f).val()
                +"&kode_kantor="+$("#id_ep_ktr_kontrak_kode_kantor", f).val()
                +"&kode_tender="+$("#id_ep_ktr_kontrak_kode_tender", f).val()
                +"&kode_vendor="+$("#id_ep_ktr_kontrak_kode_vendor", f).val();
            
            if(params.length > 0)
                window.location = '<?php echo site_url('/wkf/start?kode_wkf=6&referer_url=/contract/todo&') ?>' + params;
        });
    });
    
</script>
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

<div class="accordion">
<!--    <h3 href="<?php echo site_url('/contract/po/view_form/po.ep_ktr_po' . $params) ?>">HEADER</h3>
    <div></div>
    <h3 href="<?php echo site_url('/contract/po/view_grid/po.ep_ktr_po_item_view' . $params) ?>">ITEM</h3>
    <div></div>-->
    <h3 href="<?php echo site_url('/contract/po/view_form/po.ep_ktr_po_perkembangan' . $params) ?>">PERKEMBANGAN</h3>
    <div></div>
    <h3 href="<?php echo site_url('/contract/po/view_grid/po.ep_ktr_po_item_perkembangan_view' . $params) ?>">ITEM PERKEMBANGAN</h3>
    <div></div>
    <h3 href="<?php echo site_url('/wkf/list_history' . $params) ?>">MONITORING PROSES</h3>
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
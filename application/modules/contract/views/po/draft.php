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
    <h3 href="<?php echo site_url('/contract/po/form/po.ep_ktr_po' . $params) ?>">HEADER</h3>
    <div></div>

    <?php if (isset($_REQUEST['KODE_PO']) && $_REQUEST['KODE_PO'] > 0): ?>
        <h3 href="<?php echo site_url('/contract/po/grid_form/po.ep_ktr_po_item' . $params) ?>">ITEM</h3>
        <div></div>
    <?php else: ?>
        <h3 href="<?php echo site_url('/contract/po/grid/po.ep_ktr_kontrak_item_editor' . $params) ?>">ITEM</h3>
        <div></div>
    <?php endif; ?>
</div>
<!--<div class="accordion">
    <h3 href="<?php echo site_url('/contract/po/view_form/po.ep_ktr_po' . $params) ?>">HEADER</h3>
    <div></div>
    
<?php if (isset($_REQUEST['KODE_PO']) && $_REQUEST['KODE_PO'] > 0): ?>
            <h3 href="<?php echo site_url('/contract/po/view_grid/po.ep_ktr_po_item' . $params) ?>">ITEM</h3>
            <div></div>
<?php endif; ?>
</div>-->
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
    
    $(document).ajaxComplete(function() {
        var f = $("#id_form_ep_ktr_po");
        var el = $("#id_form_ep_ktr_po #btnSimpan");
        if(el.length > 0) {
            $(el).off('click');
            
            var validator = $(f).validate({
                meta: "validate",
                submitHandler: function(form) {
                    jQuery(form).ajaxSubmit();
                }
            });
        
            // attach event to button
            $(el).click(function() {
                if(validator.form()) {
                    jQuery(f).ajaxSubmit({
                        beforeSerialize: function($form, options){
                            //                            alert('beforeSubmit is: ' + options.beforeSubmit);
                            //                            alert($form);
                        },
                        beforeSubmit: function(arr, $form, options) { 
                            $grid = $("#grid_ep_ktr_kontrak_item_editor");
                            
                            if($grid.length > 0) {
                                var $checked_items = $("input:checkbox[name='selected_items[]']:checked", $grid);
                                if(!$checked_items.length) {
                                    alert('Item Harus dipilih');
                                    return false;
                                }
                            
                                $("input:checkbox[name='selected_items[]']:checked", $grid).each(function(i){
                                
                                    var $input = $("input[name='selected_qty[]']", $(this).parent().parent()).val();
                                    if(parseInt($input) <= 0){
                                        alert("Jumlah item harus lebih besar dari nol");
                                        return false;
                                    }
                                    arr.push({ "name": "selected_items[]", "value": $(this).val() });
                                    arr.push({ "name": "selected_qty[]", "value": $input });
                                });
                            }
                        
                            //                            var queryString = $.param(arr); 
                            //                            alert(queryString);
                            // return false to cancel submit                  
                            return true;
                        },
                        success: function(data){
                            validator.prepareForm();
                            validator.hideErrors();
                            
                            var KODE_PO = $("input[name='EP_KTR_PO[KODE_PO]']", data).val();
                            var KODE_KONTRAK = $("input[name='EP_KTR_PO[KODE_KONTRAK]']", data).val();
                            var KODE_KANTOR = $("input[name='EP_KTR_PO[KODE_KANTOR]']", data).val();
                            var KODE_VENDOR = $("input[name='EP_KTR_PO[KODE_VENDOR]']", data).val();
                            $("#id_form_ep_ktr_po").replaceWith(data);
                            f = data;
                            
                            var params = "KODE_PO="+KODE_PO
                                +"&KODE_KONTRAK="+KODE_KONTRAK
                                +"&KODE_KANTOR="+KODE_KANTOR
                                +"&KODE_VENDOR="+KODE_VENDOR;
                            
                            alert(params);
                            //reload page
                            //window.location = $site_url +"/contract/create_draft?" + params;
                            //window.location = '<?php echo site_url('/wkf/start?kode_wkf=64&referer_url=/contract/todo&') ?>' + params;
                            
                            var newURL = window.location.href
                            newURL = updateURLParameter(newURL, 'KODE_KONTRAK', KODE_KONTRAK);
                            newURL = updateURLParameter(newURL, 'KODE_KANTOR', KODE_KANTOR);
                            newURL = updateURLParameter(newURL, 'KODE_VENDOR', KODE_VENDOR);
                            newURL = updateURLParameter(newURL, 'KODE_PO', KODE_PO);
                            window.location = newURL;   
                        },
                        error: function(){
                            alert('Data gagal disimpan')
                        }
                    });
                }
            });
        }
    });
    
    /**
     * http://stackoverflow.com/a/10997390/11236
     */
    function updateURLParameter(url, param, paramVal){
        var newAdditionalURL = "";
        var tempArray = url.split("?");
        var baseURL = tempArray[0];
        var additionalURL = tempArray[1];
        var temp = "";
        if (additionalURL) {
            tempArray = additionalURL.split("&");
            for (i=0; i<tempArray.length; i++){
                if(tempArray[i].split('=')[0] != param){
                    newAdditionalURL += temp + tempArray[i];
                    temp = "&";
                }
            }
        }

        var rows_txt = temp + "" + param + "=" + paramVal;
        return baseURL + "?" + newAdditionalURL + rows_txt;
    }
</script>
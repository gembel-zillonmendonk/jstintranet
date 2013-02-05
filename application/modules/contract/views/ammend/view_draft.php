<?php
$params = '';
if (count($_REQUEST) > 0) {
    foreach ($_REQUEST as $key => $value) {
        $params .= $key . '=' . $value . '&';
    }

    if (strlen($params) > 0)
        $params = '?' . $params;
}

//die($_REQUEST['KODE_PERUBAHAN']);
?>

<div class="accordion">
    <h3 href="<?php echo site_url('/contract/view_form/ammend.ep_ktr_perubahan' . $params) ?>">HEADER</h3>
    <div></div>

    <?php if (strlen($params) > 0 && ! isset($_REQUEST['KODE_PERUBAHAN']) && isset($_REQUEST['KODE_KONTRAK']) && $_REQUEST['KODE_KONTRAK'] > 0): ?>
        <h3 href="<?php echo site_url('/contract/view_grid/contract.ep_ktr_kontrak_item' . $params) ?>">ITEM</h3>
        <div></div>
        <h3 href="<?php echo site_url('/contract/view_grid/milestone.ep_ktr_jangka_kontrak' . $params) ?>">MILESTONE</h3>
        <div></div>
        <h3 href="<?php echo site_url('/contract/view_grid/contract.ep_ktr_kontrak_dok' . $params) ?>">LAMPIRAN</h3>
        <div></div>    


    <?php elseif (isset($_REQUEST['KODE_PERUBAHAN']) && $_REQUEST['KODE_PERUBAHAN'] > 0): ?>

        <h3 href="<?php echo site_url('/contract/ammend/view_grid/ammend.ep_ktr_perubahan_item' . $params) ?>">ITEM</h3>
        <div></div>
        <h3 href="<?php echo site_url('/contract/ammend/view_grid/ammend.ep_ktr_perubahan_jangka' . $params) ?>">MILESTONE</h3>
        <div></div>

    <?php endif; ?>
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
    
    
    $(document).ajaxComplete(function() {
        $("#id_ep_ktr_perubahan_kode_kontrak").change(function(){
            if($(this).val() != "")
                window.location = $site_url + "/wkf/start?kode_wkf=63&KODE_KONTRAK=" + $(this).val();
            else
                window.location = $site_url + "/wkf/start?kode_wkf=63&KODE_KONTRAK=-1";
        });
        
        var f = $("#id_form_ep_ktr_perubahan");
        var el = $("#id_form_ep_ktr_perubahan #btnSimpan");
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
                        success: function(data){
                            validator.prepareForm();
                            validator.hideErrors();
                            
                            var KODE_PERUBAHAN = $("input[name='EP_KTR_PERUBAHAN[KODE_PERUBAHAN]']", data).val();
                            var KODE_KONTRAK = $("input[name='EP_KTR_PERUBAHAN[KODE_KONTRAK]']", data).val();
                            var KODE_KANTOR = $("input[name='EP_KTR_PERUBAHAN[KODE_KANTOR]']", data).val();
                            $("#id_form_ep_ktr_perubahan").replaceWith(data);
                            f = data;
                            
                            var params = "KODE_KONTRAK="+$("#id_ep_ktr_perubahan_kode_kontrak", f).val()
                                +"&KODE_PERUBAHAN="+$("#id_ep_ktr_perubahan_kode_perubahan", f).val()
                                +"&KODE_KANTOR="+$("#id_ep_ktr_perubahan_kode_kantor", f).val();
                            
                            //reload page
                            //window.location = '<?php echo site_url('/wkf/start?kode_wkf=63&') ?>' + params;
                            
                            var newURL = window.location.href
                            newURL = updateURLParameter(newURL, 'KODE_KONTRAK', KODE_KONTRAK);
                            newURL = updateURLParameter(newURL, 'KODE_KANTOR', KODE_KANTOR);
                            newURL = updateURLParameter(newURL, 'KODE_PERUBAHAN', KODE_PERUBAHAN);
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
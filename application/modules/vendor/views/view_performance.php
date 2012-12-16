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
    <h3 href="<?php echo site_url('/vendor/view_form/ep_vendor_perusahaan' . $params) ?>">NAMA PERUSAHAAN</h3>
    <div></div>
    <h3 href="<?php echo site_url('/vendor/view_grid/list_performance_barang' . $params) ?>">DAFTAR KINERJA BARANG & JASA</h3>
    <div></div>
    <?php if(isset($_REQUEST['KODE_BARANG_JASA'])): ?>
    <h3 href="<?php echo site_url('/vendor/view_grid/list_performance_barang_detail' . $params) ?>">DETAIL KINERJA BARANG & JASA</h3>
    <div></div>
    
    <?php endif;?>
</div>
<!--<p>
<button type="button" id="batal">BATAL</button>
<button type="button" id="cetak">Cetak</button>
<button type="button" id="selesai">Lanjutkan ke persetujuan</button>
<button type="button" id="lewat">Lewat & Selesai</button>
<button type="button" id="selanjutnya">Simpan & Lanjutkan</button>
</p>-->
<script>
    // Tabs
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

    /*
        $('.accordion').accordion({
            active:false,
            //collapsible:true,
            change:function(event, ui) {
                if(ui.newContent.html()==''){
                    ui.newContent.load(ui.newHeader.find('a').attr('href'));
                }
            },
            create:function(event, ui){
                //alert($(this).html());
            },
            autoHeight: false
        }).css("width", "auto");
     */
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
    /*
        .parent().each(function(){
            $('a', $(this)).each(function(){
                var uri = $(this).attr('href');
                if(uri != '' && uri != '#'){
                    var ctn = $(this).parent().next();
                    //alert($(this).parent().parent().parent().width());
                    //alert(uri);
                    if(ctn.html() == '')
                        ctn.load(uri);
                }
            });
        });
     */
        
        
    $(document).ready(function(){
        
        // event for verifikasi object per page
        $('#selanjutnya').live('click', function(){
            $.ajax({
                url:'<?php echo site_url('/vendor/registration') ?>', 
                success:function(responseText, textStatus, XMLHttpRequest) {
                    var $data = jQuery.parseJSON(responseText);
                    if($data.hasOwnProperty('errors')){
                        var cList = $('<ul></ul>');
                        $.each($data['errors'], function(i, v){
                            $('<li></li>').text(v['message']).appendTo(cList);
                        });
                        $('#error-box p').html(cList).parent().show();
                    }
                    else{
                        $('#error-box p').html(cList).parent().hide();
                        $('.tabs')
                        .tabs('enable', $data['active_tabs'] )
                        .tabs('select', $data['active_tabs']);
                        //$('.tabs').tabs('option', 'disabled', $data['disable_tabs'] );
                        
                    }
                }
            });
        });
        
        // event for verifikasi all object
        $('#selesai').live('click', function(){
            $.ajax({
                url:'<?php echo site_url('/vendor/activation') ?>', 
                success:function(responseText, textStatus, XMLHttpRequest) {
                    if(jQuery.parseJSON(responseText)){
                        var cList = $('<ul></ul>');
                        $.each(jQuery.parseJSON(responseText)['errors'], function(i, v){
                            $('<li></li>').text(v['message']).appendTo(cList);
                        });
                        $('#error-box p').append(cList).parent().show();
                    }
                    else{
                        alert('success!!');
                    }
                }
            });
        });
        /*
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
         */
        /*
            $('.tabs div').each(function(){
                //alert($(this).html());
                $('a', $(this)).each(function(){
                    var uri = $(this).attr('href');
                    if(uri != '' && uri != '#'){
                        var ctn = $(this).parent().next();
                        //alert($(ctn).width());
                        //alert(uri);
                        if(ctn.html() == '')
                            ctn.load(uri);
                    }
                });
            });
         */
    });
</script>
<?php $this->load->helper('form'); ?>

<?php echo form_open($form->action, $form->form_params); ?>
<?php 

$i = 1; 

$el_keys = array_keys($form->elements);
foreach ($form->model->primary_keys as $v) {
    if (!in_array($v, $el_keys)) {
        $value = isset($form->model->attributes[$v]) ? $form->model->attributes[$v] : 0;
        echo form_hidden($form->model->table . '[' . $v . ']', $value);
    }
}
?>
<div class="row-fluid">
    <div class="span6">
        <?php
        $count = count($form->elements);
        $count = ( $count % 2 == 0 ? $count : $count + 1 );
        ?>
        <?php foreach ($form->elements as $k => $v): ?>

            <?php
            if (isset($read_only) && $read_only == true):
                $v['readonly'] = 'readonly';
            endif;
            ?>
            <div class="control-group">
                <?php echo form_label($v['label'] . " " . ($form->validation[$k]['validate']['required'] == true ? "*" : ""), $v['id'], array("class" => "control-label")) ?>
                <div class="controls">
                    <?php
                    $v['class'] = (isset($v['class']) ? $v['class'] : ' ' ) . ' ' . str_replace('"', '', json_encode($form->validation[$k]));

                    switch ($v['type']) {
                        case 'textarea':
                            echo form_textarea($v);
                            break;
                        case 'number':
                            echo form_input($v);
                            break;
                        case 'dropdown':
                            $opt = $v;
                            unset($opt['name'], $opt['options'], $opt['value']);
                            $opt = $form->implodeAssoc(' ', $opt);
                            echo form_dropdown($v['name'], $v['options'], $v['value'], $opt);
                            break;
                        case 'multiselect':
                            echo form_multiselect($v);
                            break;
                        case 'checkbox':
                            echo form_checkbox($v);
                            break;
                        case 'radiobutton':
                            echo form_radio($v);
                            break;
                        case 'date':
                            $v['type'] = 'text';
                            $v['class'] = 'datepicker ' . $v['class'];
                            echo form_input($v);
                            break;
                        case 'file':
                            echo form_upload($v);
                            break;
                        default:
                            echo form_input($v);
                    }
                    ?>
                </div>
            </div>

            <?php if ($count / $i == 2): ?>
            </div>
            <div class="span6">
            <?php endif; ?>
            <?php $i++; ?>
        <?php endforeach; ?>
    </div>
</div>
<div class="accordion">
    <h3 href="#">REVIEW KONTRAK</h3>
    <div>
        <?php if (count($form->model->review_rows) > 0): ?>
            <table class="table table-striped" width="100%">
                <thead>
                    <tr>
                        <th>KRITERIA</th>
                        <th>REVIEW</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($form->model->review_rows as $value): ?>
                        <tr>
                            <td style="<?php echo ((!$value['NILAI']) ? "font-weight:bold" : ""); ?>">
                                <?php echo str_repeat("&nbsp;&nbsp;&nbsp;", $value['LEVEL']) . $value['KETERANGAN']; ?>
                            </td>
                            <td>
                                <?php if ($value['NILAI'] > 0) : ?>
                                    <input type="hidden" value="<?php echo $value['KETERANGAN']; ?>" name="EP_VENDOR_KINERJA[<?php echo $value['KODE_PARAM']; ?>][NAMA_PARAM]" />
                                    <input type="radio" value="1" name="EP_VENDOR_KINERJA[<?php echo $value['KODE_PARAM']; ?>][PILIHAN_PARAM]" /> YA
                                    <input type="radio" value="0" name="EP_VENDOR_KINERJA[<?php echo $value['KODE_PARAM']; ?>][PILIHAN_PARAM]" /> TIDAK
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </div>
</div>
<br/>
    
<?php if (!isset($read_only) || $read_only != true): ?>
    <button type="button" id="btnSimpan">SIMPAN & TUTUP</button>
    <button type="button" id="btnBatal">BATAL</button>
    <script>
        $(".accordion")
        .addClass("ui-accordion ui-widget ui-helper-reset")
        //.css("width", "auto")
        .find('h3')
        .addClass("current ui-accordion-header ui-helper-reset ui-state-active ui-corner-top")
        .css("padding", ".5em .5em .5em .7em")
        //.prepend('<span class="ui-icon ui-icon-triangle-1-s"><span/>')
        .next()
        .addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active")
        .css('overflow','visible');
        
        $(document).ready(function(){
            // stylish button and input date
            $(function() {
                $( "input:submit, button").button();
                $( ".datepicker" ).datepicker();
                //$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
                    
            });
                
            var validator = $("#<?php echo $form->id; ?>").validate({
                meta: "validate",
                submitHandler: function(form) {
                    jQuery(form).ajaxSubmit();
                }
            });
                
            // attach event to button
            $("#<?php echo $form->id; ?> #btnSimpan").click(function() {
                if(validator.form()) {
                    jQuery("#<?php echo $form->id; ?>").ajaxSubmit({
                        clearForm: false,
                        success: function(){
                            alert('Data berhasil disimpan');
                            //reload grid
                            $('#grid_<?php echo strtolower(get_class($form->model)); ?>').trigger("reloadGrid");
                            window.location = $site_url + '/contract/monitoring';
                        },
                        error: function(){
                            alert('Data gagal disimpan')
                        }
                    });
                }
            });
                    
            $("#<?php echo $form->id; ?> #btnBatal").click(function() {
                $("#<?php echo $form->id; ?>").resetForm();
                validator.prepareForm();
                validator.hideErrors();
            });
        });
                
    </script>
<?php endif; ?>
</form>
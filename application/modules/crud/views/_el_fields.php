<?php $this->load->helper('form'); ?>
<?php
$i = 1;

echo form_hidden($form->model->table . '[ROW_ID]', isset($form->model->row_id) ? $form->model->row_id : 0);

//print_r($form->model->attributes);
//print_r(array_keys($form->elements));
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
            if ($v['type'] == 'hidden'):
                echo form_hidden($v['name'], $v['value']);
                continue;
            endif;

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
                        case 'money':
                            $v['type'] = 'text';
                            $v['class'] = 'money ' . $v['class'];
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
                            $opt = $v;
                            unset($opt['name'], $opt['options'], $opt['value']);
                            $opt = $form->implodeAssoc(' ', $opt);
                            echo form_checkbox($v['name'], 1, $v['value'] ? true : false, $opt);
                            break;
                        case 'radiobutton':
                            echo form_radio($v);
                            break;
                        case 'date':
                            $v['type'] = 'text';
                            $v['class'] = 'datepicker ' . $v['class'];
                            echo form_input($v);
                            break;
                        case 'datetime':
                            $v['type'] = 'text';
                            $v['class'] = 'datetimepicker ' . $v['class'];
                            echo form_input($v);
                            break;
                        case 'file':
                            $this->load->helper('html');
                            echo form_upload($v);
                            if (strlen($v['value']) > 0) {
                                echo "<br/>";
                                echo anchor(site_url('file/download/' . $v['value']), "DOWNLOAD FILE");
                            }
                            break;
                        case 'label':
                            echo form_label($v['value'], $v['id'], array("class" => "checkbox inline"));
                            break;
                        case 'anchor_popup':
                            echo anchor_popup($v['url'], $v['value'], array_merge($v, array("class" => "checkbox inline")));
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
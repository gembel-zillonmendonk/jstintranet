<?php
//echo "<pre>";
//print_r($grid->columns);
//die();
$pager_id = 'pager_' . $grid->id;
$form_id = 'modal_form_' . $grid->id;


//echo json_encode(array_values($grid->columns));
//$colums = array();
foreach ($grid->columns as $k => $val)
{
    $grid->columns[$k]['name'] = $form->model->table . '[' . $grid->columns[$k]['name'] . ']';
    $grid->columns[$k]['index'] = $form->model->table . '[' . $grid->columns[$k]['index'] . ']';
}

//echo "<pre>";
//print_r($grid->columns);
//die();
?>
<div id="<?php echo $form_id ?>" style="padding-bottom: 20px">
    <?php $this->load->helper('form'); ?>
    <?php echo form_open($form->action, $form->form_params); ?>
    <?php
    // load partial fields
    if (isset($el_fields)):
        echo $el_fields;
    endif;

    // load partial buttons with js
    if (isset($el_buttons)):
        echo $el_buttons;
    endif;
    ?>
</form>
</div>

<table id="<?php echo $grid->id ?>"></table>
<div id="<?php echo $pager_id ?>"></div>
<div id="pager"></div>
<button id="btnSimpanAll">Simpan Data Table</button>
<script type="text/javascript" src="<?php echo base_url("js/jquery.formparams.js") ?>"></script>
<script type="text/javascript">
    
    $(function () {
        "use strict";
        var lastSel,
        mydata = [],
        form_id = "#<?php echo $form_id; ?> form",
        form = $(form_id),
        grid = $("#<?php echo $grid->id ?>"),
        grid_p = grid.prop('p'),
        grid_id = grid.prop('id'),
        table = "<?php echo $form->model->table ?>",
        pager_id = "#<?php echo $pager_id ?>",
        pager = $(pager_id),
        test = "xxxx",
        getColumnIndex = function (columnName) {
            var cm = $(grid).jqGrid('getGridParam', 'colModel'), i, l = cm.length;
            console.log(cm);
            for (i = 0; i < l; i++) {
                if ((cm[i].index || cm[i].name) === columnName) {
                    return i; // return the colModel index
                }
            }
            return -1;
        },
        gridToForm = function() {
            var rowid = grid.jqGrid('getGridParam','selrow');
            if(rowid){
                var data = grid.jqGrid('getRowData', rowid);
                                
                for(var i in data) {
                    if(data.hasOwnProperty(i)) {
                        if ( $("[name="+$.jgrid.jqID(i)+"]",form).is("input:radio") || $("[name="+$.jgrid.jqID(i)+"]",form).is("input:checkbox"))  {
                            $("[name="+$.jgrid.jqID(i)+"]",form).each( function() {
                                if( $(this).val() == data[i] ) {
                                    $(this)[grid.prop('p').useProp ? 'prop': 'attr']("checked",true);
                                } else {
                                    $(this)[grid.prop('p').useProp ? 'prop': 'attr']("checked", false);
                                }
                            });
                        } else {
                            // this is very slow on big table and form.
                            $("[name="+$.jgrid.jqID(i)+"]",form).val(data[i]);
                        }
                    }
                }
                console.log(form);
                $("[name='"+table + "[" + grid_id + "_id]']",form).val(rowid);
            } else {
                alert("Please select Row")
            }
        },
        submitToGrid = function(form, data) {
            //            console.log(form, data);
            //            console.log($(form).formParams());
            
            //            var params = $(form).formParams();
            //            var postdata = params["EP_VENDOR"];
            var postdata = data;
            var options=  $(grid).jqGrid('getGridParam');
            console.log(postdata)
            //            console.log(postdata);
            
            
            var $this = grid, grid_p = $this.prop('p'),
            idname = grid_p.prmNames.id,
            grid_id = $this.prop('id'),
            id_in_postdata = table + "[" + grid_id + "_id]",
            rowid = postdata[id_in_postdata],
            addMode = rowid === "_empty",
            oldValueOfSortColumn,
            new_id,
            tr_par_id,
            colModel = grid_p.colModel,
            cmName,
            iCol,
            cm;
            
            console.log(id_in_postdata);
            console.log(addMode);
            
            // postdata has row id property with another name. we fix it:
            if (addMode) {
                // generate new id
                new_id = $.jgrid.randId();
                while ($("#" + new_id).length !== 0) {
                    new_id = $.jgrid.randId();
                }
                postdata[idname] = String(new_id);
            } else if (typeof postdata[idname] === "undefined") {
                // set id property only if the property not exist
                postdata[idname] = rowid;
            }
            delete postdata[id_in_postdata];
        
            // prepare postdata for tree grid
            if (grid_p.treeGrid === true) {
                if (addMode) {
                    tr_par_id = grid_p.treeGridModel === 'adjacency' ? grid_p.treeReader.parent_id_field : 'parent_id';
                    postdata[tr_par_id] = grid_p.selrow;
                }
        
                $.each(grid_p.treeReader, function (i) {
                    if (postdata.hasOwnProperty(this)) {
                        delete postdata[this];
                    }
                });
            }
        
            // decode data if there encoded with autoencode
            if (grid_p.autoencode) {
                $.each(postdata, function (n, v) {
                    postdata[n] = $.jgrid.htmlDecode(v); // TODO: some columns could be skipped
                });
            }
        
            // save old value from the sorted column
            oldValueOfSortColumn = grid_p.sortname === "" ? undefined : grid.jqGrid('getCell', rowid, grid_p.sortname);
        
            // save the data in the grid
            if (grid_p.treeGrid === true) {
                if (addMode) {
                    $this.jqGrid("addChildNode", new_id, grid_p.selrow, postdata);
                } else {
                    $this.jqGrid("setTreeRow", rowid, postdata);
                }
            } else {
                if (addMode) {
                    // we need unformat all date fields before calling of addRowData
                    for (cmName in postdata) {
                        if (postdata.hasOwnProperty(cmName)) {
                            iCol = getColumnIndex.call(this, cmName);
                            if (iCol >= 0) {
                                cm = colModel[iCol];
                                if (cm && cm.formatter === "date") {
                                    postdata[cmName] = $.unformat.date.call(this, postdata[cmName], cm);
                                }
                            }
                        }
                    }
                    //                    $this.jqGrid("addRowData", new_id, postdata, options.addedrow);
                    $this.jqGrid("addRowData", new_id, postdata, options.addedrow);
                } else {
                    $this.jqGrid("setRowData", rowid, postdata);
                    console.log("test");
            
                }
            }
            
            if ((addMode && options.closeAfterAdd) || (!addMode && options.closeAfterEdit)) {
                // close the edit/add dialog
                $.jgrid.hideModal("#editmod" + grid_id, {
                    gb: "#gbox_" + grid_id,
                    jqm: options.jqModal,
                    onClose: options.onClose
                });
            }
        
            if (postdata[grid_p.sortname] !== oldValueOfSortColumn) {
                // if the data are changed in the column by which are currently sorted
                // we need resort the grid
                setTimeout(function () {
                    $this.trigger("reloadGrid", [{current: true}]);
                }, 100);
            }
        
            form.resetForm();
                                
            // !!! the most important step: skip ajax request to the server
            options.processing = true;
            return {};
            //            console.log($this);
            
            //            var $this = $(grid), grid_p = $this.prop('p');
            //            console.log($this.prop('p'));
            //            console.log(grid_p);
        },
        deleteRow = function (rowid) {
            var $this = grid, grid_id = $.jgrid.jqID(grid_id), grid_p = $this.prop('p'),
            newPage = grid_p.page, options = $this.jqGrid('getGridParam');
            
            // reset the value of processing option to true to
            // skip the ajax request to 'clientArray'.
            options.processing = true;
        
            // delete the row
            $this.jqGrid("delRowData", rowid);
            if (grid_p.treeGrid) {
                $this.jqGrid("delTreeNode", rowid);
            } else {
                $this.jqGrid("delRowData", rowid);
            }
            $.jgrid.hideModal("#delmod" + grid_id, {
                gb: "#gbox_" + grid_id,
                jqm: options.jqModal,
                onClose: options.onClose
            });
        
            if (grid_p.lastpage > 1) {// on the multipage grid reload the grid
                if (grid_p.reccount === 0 && newPage === grid_p.lastpage) {
                    // if after deliting there are no rows on the current page
                    // which is the last page of the grid
                    newPage--; // go to the previous page
                }
                // reload grid to make the row from the next page visable.
                $this.trigger("reloadGrid", [{page: newPage}]);
            }
        
            form.resetForm();
            
            return true;
        },
        onclickSubmitLocal = function (options, postdata) {
            //            alert($.params(options));
            console.log(options);
            console.log(postdata);
            var $this = $(this), grid_p = this.p,
            idname = grid_p.prmNames.id,
            grid_id = this.id,
            id_in_postdata = grid_id + "_id",
            rowid = postdata[id_in_postdata],
            addMode = rowid === "_empty",
            oldValueOfSortColumn,
            new_id,
            tr_par_id,
            colModel = grid_p.colModel,
            cmName,
            iCol,
            cm;
            
            console.log(grid_id);
            console.log(this);
            console.log(grid_p);
            // postdata has row id property with another name. we fix it:
            if (addMode) {
                // generate new id
                new_id = $.jgrid.randId();
                while ($("#" + new_id).length !== 0) {
                    new_id = $.jgrid.randId();
                }
                postdata[idname] = String(new_id);
            } else if (typeof postdata[idname] === "undefined") {
                // set id property only if the property not exist
                postdata[idname] = rowid;
            }
            delete postdata[id_in_postdata];
        
            // prepare postdata for tree grid
            if (grid_p.treeGrid === true) {
                if (addMode) {
                    tr_par_id = grid_p.treeGridModel === 'adjacency' ? grid_p.treeReader.parent_id_field : 'parent_id';
                    postdata[tr_par_id] = grid_p.selrow;
                }
        
                $.each(grid_p.treeReader, function (i) {
                    if (postdata.hasOwnProperty(this)) {
                        delete postdata[this];
                    }
                });
            }
        
            // decode data if there encoded with autoencode
            if (grid_p.autoencode) {
                $.each(postdata, function (n, v) {
                    postdata[n] = $.jgrid.htmlDecode(v); // TODO: some columns could be skipped
                });
            }
        
            // save old value from the sorted column
            oldValueOfSortColumn = grid_p.sortname === "" ? undefined : grid.jqGrid('getCell', rowid, grid_p.sortname);
        
            // save the data in the grid
            if (grid_p.treeGrid === true) {
                if (addMode) {
                    $this.jqGrid("addChildNode", new_id, grid_p.selrow, postdata);
                } else {
                    $this.jqGrid("setTreeRow", rowid, postdata);
                }
            } else {
                if (addMode) {
                    // we need unformat all date fields before calling of addRowData
                    for (cmName in postdata) {
                        if (postdata.hasOwnProperty(cmName)) {
                            iCol = getColumnIndex.call(this, cmName);
                            if (iCol >= 0) {
                                cm = colModel[iCol];
                                if (cm && cm.formatter === "date") {
                                    postdata[cmName] = $.unformat.date.call(this, postdata[cmName], cm);
                                }
                            }
                        }
                    }
                    //                    $this.jqGrid("addRowData", new_id, postdata, options.addedrow);
                    $this.jqGrid("addRowData", new_id, postdata, options.addedrow);
                } else {
                    $this.jqGrid("setRowData", rowid, postdata);
                }
            }
        
            if ((addMode && options.closeAfterAdd) || (!addMode && options.closeAfterEdit)) {
                // close the edit/add dialog
                $.jgrid.hideModal("#editmod" + grid_id, {
                    gb: "#gbox_" + grid_id,
                    jqm: options.jqModal,
                    onClose: options.onClose
                });
            }
        
            if (postdata[grid_p.sortname] !== oldValueOfSortColumn) {
                // if the data are changed in the column by which are currently sorted
                // we need resort the grid
                setTimeout(function () {
                    $this.trigger("reloadGrid", [{current: true}]);
                }, 100);
            }
        
            // !!! the most important step: skip ajax request to the server
            options.processing = true;
            return {};
        },
        editSettings = {
            //recreateForm: true,
            jqModal: false,
            reloadAfterSubmit: false,
            closeOnEscape: true,
            savekey: [true, 13],
            closeAfterEdit: true,
            onclickSubmit: onclickSubmitLocal
        },
        addSettings = {
            //recreateForm: true,
            jqModal: false,
            reloadAfterSubmit: false,
            savekey: [true, 13],
            closeOnEscape: true,
            closeAfterAdd: true,
            onclickSubmit: onclickSubmitLocal
        },
        delSettings = {
            // because I use "local" data I don't want to send the changes to the server
            // so I use "processing:true" setting and delete the row manually in onclickSubmit
            onclickSubmit: function (options, rowid) {
                var $this = $(this), grid_id = $.jgrid.jqID(this.id), grid_p = this.p,
                newPage = grid_p.page;
        
                // reset the value of processing option to true to
                // skip the ajax request to 'clientArray'.
                options.processing = true;
        
                // delete the row
                $this.jqGrid("delRowData", rowid);
                if (grid_p.treeGrid) {
                    $this.jqGrid("delTreeNode", rowid);
                } else {
                    $this.jqGrid("delRowData", rowid);
                }
                $.jgrid.hideModal("#delmod" + grid_id, {
                    gb: "#gbox_" + grid_id,
                    jqm: options.jqModal,
                    onClose: options.onClose
                });
        
                if (grid_p.lastpage > 1) {// on the multipage grid reload the grid
                    if (grid_p.reccount === 0 && newPage === grid_p.lastpage) {
                        // if after deliting there are no rows on the current page
                        // which is the last page of the grid
                        newPage--; // go to the previous page
                    }
                    // reload grid to make the row from the next page visable.
                    $this.trigger("reloadGrid", [{page: newPage}]);
                }
        
                return true;
            },
            processing: true
        },
        initDateEdit = function (elem) {
            setTimeout(function () {
                $(elem).datepicker({
                    dateFormat: 'dd-M-yy',
                    //autoSize: true,
                    showOn: 'button',
                    changeYear: true,
                    changeMonth: true,
                    showButtonPanel: true,
                    showWeek: true
                });
            }, 100);
        },
        initDateSearch = function (elem) {
            setTimeout(function () {
                $(elem).datepicker({
                    dateFormat: 'dd-M-yy',
                    //autoSize: true,
                    //showOn: 'button', // it dosn't work in searching dialog
                    changeYear: true,
                    changeMonth: true,
                    showButtonPanel: true,
                    showWeek: true
                });
            }, 100);
        };

        grid.jqGrid({
            datatype: 'local',
            data: mydata,
            //            colNames: [/*'Inv No', */'Client', 'Date', 'Amount', 'Tax', 'Total', 'Closed', 'Shipped via', 'Notes'],
            //            colModel: [
            //                //{name: 'id', width: 70, align: 'center', sorttype: 'int', searchoptions: {sopt: ['eq', 'ne']}},
            //                {name: 'name', index: 'name', editable: true, width: 60, editrules: {required: true}},
            //                {name: 'invdate', index: 'invdate', width: 80, align: 'center', sorttype: 'date',
            //                    formatter: 'date', formatoptions: {newformat: 'd-M-Y'}, editable: true, datefmt: 'd-M-Y',
            //                    editoptions: {dataInit: initDateEdit, size: 14},
            //                    searchoptions: {dataInit: initDateSearch}},
            //                {name: 'amount', index: 'amount', width: 70, formatter: 'number', editable: true, align: 'right'},
            //                {name: 'tax', index: 'tax', width: 50, formatter: 'number', editable: true, align: 'right'},
            //                {name: 'total', index: 'total', width: 60, formatter: 'number', editable: true, align: 'right'},
            //                {name: 'closed', index: 'closed', width: 70, align: 'center', editable: true, formatter: 'checkbox',
            //                    edittype: 'checkbox', editoptions: {value: 'Yes:No', defaultValue: 'Yes'},
            //                    stype: 'select', searchoptions: {sopt: ['eq', 'ne'], value: ':All;true:Yes;false:No'}},
            //                {name: 'ship_via', index: 'ship_via', width: 100, align: 'center', editable: true, formatter: 'select',
            //                    edittype: 'select', editoptions: {value: 'FE:FedEx;TN:TNT;IN:Intim', defaultValue: 'Intime'},
            //                    stype: 'select', searchoptions: {value: ':All;FE:FedEx;TN:TNT;IN:Intim'}},
            //                {name: 'note', index: 'note', width: 60, sortable: false, editable: true, edittype: 'textarea'}
            //            ],
            colModel: <?php echo json_encode(array_values($grid->columns)) ?>,
            //            colModel: [
            //                {"name":"EP_VENDOR[KODE_VENDOR]","db_type":"NUMBER","size":22,"key":"","index":"EP_VENDOR[KODE_VENDOR]","sort_type":"number","label":"KODE VENDOR","editable":true},
            //                {"name":"EP_VENDOR[NAMA_VENDOR]","db_type":"VARCHAR2","size":50,"key":"","index":"EP_VENDOR[NAMA_VENDOR]","sort_type":"text","label":"NAMA VENDOR","editable":true},
            //                {"name":"EP_VENDOR[KODE_LOGIN]","db_type":"VARCHAR2","size":50,"key":"","index":"EP_VENDOR[KODE_LOGIN]","sort_type":"text","label":"KODE LOGIN","editable":true},
            //                {"name":"EP_VENDOR[ALAMAT_EMAIL]","size":"255","precision":null,"scale":null,"db_type":"VARCHAR2","allow_null":"Y","default_value":null,"key":0,"index":"EP_VENDOR[ALAMAT_EMAIL]","sort_type":"text","label":"ALAMAT EMAIL","type":"text","is_primary_key":0,"is_foreign_key":0,"is_searchable":true,"is_readonly":false,"auto_increment":false,"rules":[],"editable":true},
            //                {"name":"EP_VENDOR[KODE_VENDOR]","db_type":"NUMBER","size":22,"key":"","index":"EP_VENDOR[KODE_VENDOR]","sort_type":"number","label":"KODE VENDOR","hidden":true}],
            rowNum: 10,
            rowList: [5, 10, 20],
            pager: pager_id,
            gridview: true,
            rownumbers: true,
            autoencode: true,
            ignoreCase: true,
            sortname: 'invdate',
            viewrecords: true,
            sortorder: 'desc',
            caption: 'How to implement local form editing',
            height: '100%',
            editurl: 'clientArray',
            ondblClickRow: function (rowid, ri, ci) {
                var $this = $(this), p = this.p;
                if (p.selrow !== rowid) {
                    // prevent the row from be unselected on double-click
                    // the implementation is for "multiselect:false" which we use,
                    // but one can easy modify the code for "multiselect:true"
                    $this.jqGrid('setSelection', rowid);
                }
                $this.jqGrid('editGridRow', rowid, editSettings);
            },
            onSelectRow: function (id) {
                //                if (id && id !== lastSel) {
                //                    // cancel editing of the previous selected row if it was in editing state.
                //                    // jqGrid hold intern savedRow array inside of jqGrid object,
                //                    // so it is safe to call restoreRow method with any id parameter
                //                    // if jqGrid not in editing state
                //                    if (typeof lastSel !== "undefined") {
                //                        $(this).jqGrid('restoreRow', lastSel);
                //                    }
                //                    lastSel = id;
                //                }
                
                gridToForm();
            }
        })
        .jqGrid('navGrid',pager_id, {}, editSettings, addSettings, delSettings, {
            multipleSearch: true, 
            overlay: false,
            onClose: function (form) {
                // if we close the search dialog during the datapicker are opened
                // the datepicker will stay opened. To fix this we have to hide
                // the div used by datepicker
                $("div#ui-datepicker-div.ui-datepicker").hide();
            }
        })
        .jqGrid('navButtonAdd',pager_id,{caption:"Edit",
            onClickButton:function(){
                gridToForm();							
            } 
        })
        .jqGrid('navButtonAdd',pager_id,{caption:"Delete",
            onClickButton:function(){
                var rowid = grid.jqGrid('getGridParam','selrow');
                deleteRow(rowid);							
            } 
        });
            
        $(document).ready(function(){
            
            form.append('<input type="text" name="'+table+'['+grid_id+'_id]" value="_empty">');
            
            var el = $('#btnSimpan', form).live();
            if(el.length > 0) {
                $(el).off('click');
            
                var validator = form.validate({
                    meta: "validate",
                    submitHandler: function(form) {
                        form.ajaxSubmit();
                    }
                });
        
                // attach event to button
                $(el).live('click', function() {
                    if(validator.form()) {
                        form.ajaxSubmit({
                            beforeSubmit: function(data, form){
                                console.log(form.serializeArray());
                                console.log(data);
                                console.log($(form).formParams());
                                
                                var paramObj = {};
                                $.each(data, function(_, kv) {
                                    if (paramObj.hasOwnProperty(kv.name)) {
                                        paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
                                        paramObj[kv.name].push(kv.value);
                                    }
                                    else {
                                        paramObj[kv.name] = kv.value;
                                    }
                                });
                                
                                console.log(paramObj);
                                //                                var param = $(form).formParams();
                                //                                console.log(param["EP_VENDOR"]);
                                //                                var param = array[data.length];
                                
                                //                                var params;
                                //                                for(var i in data){
                                ////                                    console.log(i);
                                ////                                    console.log(data[i]["name"]);
                                //                                    params = "["+i+" : ] x : data[i]["value"]                                    }"";
                                //                                }
                                //                                console.log(params);
                                //                                $.each(data, function(i){
                                //                                    param[i]
                                //                                    console.log(data[i]);
                                //                                });
                                submitToGrid(form, paramObj);
                                return false;
                            },
                            success: function(data){
                                validator.prepareForm();
                                validator.hideErrors();
                            },
                            error: function(){
                                alert('Data gagal disimpan')
                            }
                        });
                    }
                });
            }
            
            el = $('#btnBatal', form).live();
            if(el.length > 0) {
                $(el).off('click');
                $("#btnBatal", form_id).live('click', function() {
                    form.resetForm();
                });
            }
            
            $("#btnSimpanAll").live('click', function(){
                var paramObj = {};
                var ids = grid.jqGrid('getDataIDs');
                var data, strdata = "";
                for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    
//                    paramObj = grid.jqGrid('getRowData', cl);
                    paramObj[table] = $.makeArray(paramObj[table]);
                    data = grid.jqGrid('getRowData', cl);
                    paramObj[table].push(data);
                    console.log(data);
                    
                    $.each(data, function(k, v){
                        k = k.replace(table, table + '[' + i + ']');
//                        console.log(k + '=' + v);
                        strdata += k + '=' + v + '&';
                    });
                }
                
                $.post(window.location.href, strdata);
                
                console.log(strdata);
//                $(form).formParams();
//                var paramObj = {};
//                $.each(data, function(_, kv) {
//                    if (paramObj.hasOwnProperty(kv.name)) {
//                        paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
//                        paramObj[kv.name].push(kv.value);
//                    } else {
//                        paramObj[kv.name] = kv.value;
//                    }
//                });
            });
            
            grid.jqGrid("setGridWidth", $('#gbox_' + grid_id).parent().width() , true); 
        });
    
        $(document).ajaxComplete(function(){
            
        });
    });
    
    
    
</script>
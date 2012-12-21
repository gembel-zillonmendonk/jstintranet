<?php
//echo "<pre>";
//print_r($grid);
//die();
$pager_id = 'pager_' . $grid->id;
$form_id = 'modal_form_' . $grid->id;
?>
<div id="<?php echo $form_id ?>" style="padding-bottom: 20px">
    <div id="form"></div>
    <div id="toolbar" class="ui-dialog-buttonpane ui-helper-clearfix">
        <!--        <button type="button" id="btnSimpan">SIMPAN</button>
                <button type="button" id="btnBatal">BATAL</button>-->
    </div>
</div>
<table id="<?php echo $grid->id ?>"></table>
<div id="<?php echo $pager_id ?>"></div>
<script type="text/javascript" src="<?php echo base_url("js/jquery.formparams.js") ?>"></script>
<script type="text/javascript">
    
    $(function () {
        "use strict";
        var lastSel,
        mydata = [],
        form = $("#<?php echo $form_id; ?> form"),
        grid = $("#<?php echo $grid->id ?>"),
        table = "<?php //echo $grid->model->table   ?>",
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
        submitToGrid = function(form, data) {
            //            console.log(form, data);
            //            console.log($(form).formParams());
            
            var params = $(form).formParams();
            var postdata = params["EP_VENDOR"];

            var options=  $(grid).jqGrid('getGridParam');
            //            console.log(options)
            //            console.log(postdata);
            
            
            var $this = grid, grid_p = $this.prop('p'),
            idname = grid_p.prmNames.id,
            grid_id = $this.prop('id'),
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
        
            // !!! the most important step: skip ajax request to the server
            options.processing = true;
            return {};
            //            console.log($this);
            
            //            var $this = $(grid), grid_p = $this.prop('p');
            //            console.log($this.prop('p'));
            //            console.log(grid_p);
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
            rowNum: 10,
            rowList: [5, 10, 20],
            pager: '#pager',
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
                if (id && id !== lastSel) {
                    // cancel editing of the previous selected row if it was in editing state.
                    // jqGrid hold intern savedRow array inside of jqGrid object,
                    // so it is safe to call restoreRow method with any id parameter
                    // if jqGrid not in editing state
                    if (typeof lastSel !== "undefined") {
                        $(this).jqGrid('restoreRow', lastSel);
                    }
                    lastSel = id;
                }
            }
        })
        .jqGrid('navGrid', '#pager', {}, editSettings, addSettings, delSettings, {
            multipleSearch: true, 
            overlay: false,
            onClose: function (form) {
                // if we close the search dialog during the datapicker are opened
                // the datepicker will stay opened. To fix this we have to hide
                // the div used by datepicker
                $("div#ui-datepicker-div.ui-datepicker").hide();
            }
        })
        .jqGrid('navButtonAdd','#pager',{caption:"Edit",
            onClickButton:function(){
                var gsr = $(grid).jqGrid('getGridParam','selrow');
                
                if(gsr){
                    var data = $(grid).jqGrid('getRowData', gsr);
                    var params = {"EP_VENDOR" : data};
//                    for(var i in data){
//                        params["EP_VENDOR"][i] = data[i];
//                        console.log(i);
//                        console.log(data[i]);
//                    }
                    console.log(params);
                    $(grid).jqGrid('GridToForm',gsr,"#id_form_Ep_vendor");
                } else {
                    alert("Please select Row")
                }							
            } 
        });
        var $form = 'modal_form';
<?php if (isset($read_only) && $read_only == true): ?>
            $form = 'view_modal_form';    
<?php endif; ?>
            
        $(document).ready(function(){
            // load empty form
            $('#<?php echo $form_id; ?> #form')
            .load($site_url + '/<?php echo $grid->module ?>/'+$form+'/<?php echo $grid->model . $grid->params; ?>');
        
            $('#<?php echo $grid->id ?>').jqGrid("setGridWidth", $('#gbox_<?php echo $grid->id ?>').parent().width() , true); 
        });
    
        $(document).ajaxComplete(function(){
            var f = $("#<?php echo $form_id; ?> form");
            var el = $('#<?php echo $form_id; ?> form #btnSimpan').live()
        
            $(f).append('<input type="text" name="<?php echo strtoupper($grid->name) ?>[<?php echo $grid->id ?>_id]" value="_empty">');
            
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
                            beforeSubmit: function(data, form){
                                console.log(form);
                                console.log(data);
                                console.log($(form).formParams());
                                
                                //                                var param = $(form).formParams();
                                //                                console.log(param["EP_VENDOR"]);
                                //                                var param = array[data.length];
                                //        $.each(data, function(i){
                                //            param[i]
                                //            console.log(data[i]);
                                //        });
                                submitToGrid(form, data);
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
        });
    });
    
    
    
</script>
</head>

<table id="list"><tr><td></td></tr></table>
<div id="pager"></div>
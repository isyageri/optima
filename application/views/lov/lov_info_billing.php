<div id="modal_lov_info_billing" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog" style="width:900px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title"> Info Billing </span>
                </div>
            </div>

            <!-- modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <table id="grid-table-lov_info_billing" width="100%"></table>
                        <div id="grid-pager-lov_info_billing"></div>
                    </div>
                </div>
            </div>

            <!-- modal footer -->
            <div class="modal-footer no-margin-top">
                <div class="bootstrap-dialog-footer">
                    <div class="bootstrap-dialog-footer-buttons">
                        <button class="btn btn-danger btn-xs radius-4" data-dismiss="modal">
                            <i class="ace-icon fa fa-times"></i>
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.end modal -->

<script>

    function modal_lov_info_billing_show(account_num) {
        $("#modal_lov_info_billing").modal({backdrop: 'static'});
        modal_lov_info_billing_prepare_table(account_num);
    }

    function modal_lov_info_billing_prepare_table(account_num) {

        var grid_selector = "#grid-table-lov_info_billing";
        var pager_selector = "#grid-pager-lov_info_billing";

        $.jgrid.gridUnload(grid_selector);
        jQuery("#grid-table-lov_info_billing").jqGrid({
            url: '<?php echo WS_JQGRID."schema.bill_summary_controller/crud"; ?>',
            postData: {
                account_num: account_num
            },
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 'id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'Account Num', name: 'account_num',width: 150, hidden: false},
                {label: 'Seq', name: 'bill_seq',width: 150, hidden: false},
                {label: 'Bill Dtm', name: 'bill_dtm',width: 150, hidden: false}
            ],
            height: '100%',
            width: 600,
            viewrecords: true,
            rowNum: 5,
            rowList: [5,10],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
            pager: '#grid-pager-lov_info_billing',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }
                modal_lov_info_billing_responsive_jqgrid(grid_selector, pager_selector);
            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo WS_JQGRID."schema.bill_summary_controller/crud"; ?>',
            caption: "Info Billing",
            subGrid: true, // set the subGrid property to true to show expand buttons for each row
            subGridRowExpanded: showDetails, // javascript function that will take care of showing the child grid
            subGridWidth : 40,
            subGridOptions : {
                reloadOnExpand :false,
                selectOnExpand : false,
                plusicon : "fa fa-plus center bigger-120 purple",
                minusicon  : "fa fa-minus center bigger-120 purple"
                // openicon : "ace-icon fa fa-chevron-right center orange"
            }

        });

        jQuery('#grid-table-lov_info_billing').jqGrid('navGrid', '#grid-pager-lov_info_billing',
            {   //navbar options
                edit: false,
                editicon: 'fa fa-pencil blue bigger-120',
                add: false,
                addicon: 'fa fa-plus-circle purple bigger-120',
                del: false,
                delicon: 'fa fa-trash-o red bigger-120',
                search: true,
                searchicon: 'fa fa-search orange bigger-120',
                refresh: true,
                afterRefresh: function () {
                    // some code here

                },

                refreshicon: 'fa fa-refresh green bigger-120',
                view: false,
                viewicon: 'fa fa-search-plus grey bigger-120'
            },

            {
                // options for the Edit Dialog
                closeAfterEdit: true,
                closeOnEscape:true,
                recreateForm: true,
                serializeEditData: modal_lov_info_billing_serializeJSON,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    modal_lov_info_billing_style_edit_form(form);

                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }
                    return [true,"",response.responseText];
                }
            },
            {
                //new record form
                closeAfterAdd: false,
                clearAfterAdd : true,
                closeOnEscape:true,
                recreateForm: true,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                serializeEditData: modal_lov_info_billing_serializeJSON,
                viewPagerButtons: false,
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    modal_lov_info_billing_style_edit_form(form);
                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }

                    $(".tinfo").html('<div class="ui-state-success">' + response.message + '</div>');
                    var tinfoel = $(".tinfo").show();
                    tinfoel.delay(3000).fadeOut();


                    return [true,"",response.responseText];
                }
            },
            {
                //delete record form
                serializeDelData: modal_lov_info_billing_serializeJSON,
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                    modal_lov_info_billing_style_delete_form(form);

                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                onClick: function (e) {
                    //alert(1);
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }
                    return [true,"",response.responseText];
                }
            },
            {
                //search form
                closeAfterSearch: false,
                recreateForm: true,
                afterShowSearch: function (e) {
                    var form = $(e[0]);
                    modal_lov_info_billing_style_search_form(form);
                    form.closest('.ui-jqdialog').center();
                },
                afterRedraw: function () {
                    modal_lov_info_billing_style_search_filters($(this));
                }
            },
            {
                //view record form
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                }
            }
        );
    }


    function modal_lov_info_billing_serializeJSON(postdata) {
        var items;
        if(postdata.oper != 'del') {
            items = JSON.stringify(postdata, function(key,value){
                if (typeof value === 'function') {
                    return value();
                } else {
                  return value;
                }
            });
        }else {
            items = postdata.id;
        }

        var jsondata = {items:items, oper:postdata.oper, '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'};
        return jsondata;
    }

    function modal_lov_info_billing_style_edit_form(form) {

        //update buttons classes
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-primary');
        buttons.eq(1).addClass('btn-danger');
    }

    function modal_lov_info_billing_style_delete_form(form) {
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-danger');
        buttons.eq(1).addClass('btn-default');
    }

    function modal_lov_info_billing_style_search_filters(form) {
        form.find('.delete-rule').val('X');
        form.find('.add-rule').addClass('btn btn-xs btn-primary');
        form.find('.add-group').addClass('btn btn-xs btn-success');
        form.find('.delete-group').addClass('btn btn-xs btn-danger');
    }

    function modal_lov_info_billing_style_search_form(form) {
        var dialog = form.closest('.ui-jqdialog');
        var buttons = dialog.find('.EditTable')
        buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'fa fa-retweet');
        buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'fa fa-comment-o');
        buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-success').find('.ui-icon').attr('class', 'fa fa-search');
    }

    function modal_lov_info_billing_responsive_jqgrid(grid_selector, pager_selector) {
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid( 'setGridWidth', $(".modal-dialog").width() - 50 );
        $(pager_selector).jqGrid( 'setGridWidth', $(".modal-dialog").width() - 50 );
    }

    function showDetails(parentRowID, parentRowKey) {
        var childGridID = parentRowID + "_billing_detail_table";
        var childGridPagerID = parentRowID + "_billing_detail_pager";

        var parentGrid = $('#grid-table-lov_info_billing');
        var account_num = parentGrid.jqGrid ('getCell', parentRowKey, 'account_num');
        var bill_seq = parentGrid.jqGrid ('getCell', parentRowKey, 'bill_seq');

        $('#' + parentRowID).append('<table id="' + childGridID + '"></table><div id="' + childGridPagerID + '"></div>');
        $("#" + childGridID).jqGrid({
            url: '<?php echo WS_JQGRID."schema.bill_summary_controller/detail"; ?>',
            postData: {
                account_num: account_num,
                bill_seq: bill_seq
            },
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 'id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'Account Num', name: 'account_num',width: 150, hidden: false},
                {label: 'Revenue Code', name: 'revenue_code_desc',width: 150, hidden: false},
                {label: 'Revenue Mny', name: 'revenue_mny', align:'right',width: 150, hidden: false}
            ],
            height: '100%',
            viewrecords: true,
            page: 1,
            rowNum: 0,
            height: 'auto',
            width:400,
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }

            },
            //memanggil controller jqgrid yang ada di controller crud
            pager:childGridPagerID,
            rowList: [],        // disable page size dropdown
            pgbuttons: false,     // disable page control like next, back button
            pgtext: null,         // disable pager text like 'Page 0 of 10'
            viewrecords: false    // disable current view record text like 'View 1-10 of 100'
        });

        jQuery("#"+childGridID).jqGrid('navGrid',"#"+childGridPagerID,
            {   //navbar options
                edit: false,
                editicon: 'fa fa-pencil blue bigger-120',
                add: false,
                addicon: 'fa fa-plus-circle purple bigger-120',
                del: false,
                delicon: 'fa fa-trash-o red bigger-120',
                search: false,
                searchicon: 'fa fa-search orange bigger-120',
                refresh: true,
                afterRefresh: function () {
                    // some code here
                },
                refreshicon: 'fa fa-refresh green bigger-120',
                view: false,
                viewicon: 'fa fa-search-plus grey bigger-120'
            },
            {
                //edit form
            },
            {
                //new record form
            },
            {
                //delete record form
            },
            {
                //search form
            },
            {
                //view record form
            }
        );
    }

</script>
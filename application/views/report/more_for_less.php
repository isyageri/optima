<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url();?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Report</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Report More For Less</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject font-blue-hoki bold uppercase">Filter</span>
        </div>
        <div class="tools">
            <a href="" class="collapse">
            </a>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form action="javascript:;" class="form-horizontal">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label class="control-label col-md-2">Period</label>
                            <div class="col-md-3">
                                <input type="text" name="period" id="period" class="form-control date-picker" data-date-format="yyyymm" placeholder="yyyymm">
                            </div>
                            <div class="col-md-4" style="padding-left: 0px;">
                                <button type="submit" id="findFilter" class="btn blue"><i class="fa fa-search"></i> Search</button>
                                <button type="submit" id="btn_export_excel" class="btn green-haze"><i class="fa fa-file-excel-o"></i> Save to Excel</button>
                            </div>       
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label class="control-label col-md-2">Divisi</label>
                            <div class="col-md-4">
                                <select name="divisi" id="divisi" class="form-control">
                                </select>
                            </div>                                                  
                        </div>
                    </div>
                </div>
                <!-- <div style="padding-bottom:5px;"></div> -->
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label class="control-label col-md-2">Filter</label>
                            <div class="col-md-4">
                                <select name="filter" id="filter" class="form-control">
                                    <option value="0" selected="">All</option>
                                    <option value="1">Aktif</option>
                                    <option value="2">Schema Terminated</option>
                                    <option value="3">Schema Terminated N+2</option>
                                    <option value="4">Anomali End Date</option>
                                    <option value="5">Error Transaction</option>
                                </select>
                            </div>                                                  
                        </div>
                    </div>
                </div>
                <!-- <div style="padding-bottom:5px;"></div> -->
                
            </div>

        </form>
        <!-- END FORM-->
    </div>
</div>
<div class="row">
    <div class="col-md-12" id="grid-tbl" style="display:none">
        <table id="grid-table"></table>
        <div id="grid-pager"></div>
    </div>
</div>

<script>

    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		});

        $.ajax({
            type: 'POST',
            url: '<?php echo "report/list_divisi"; ?>',
            timeout: 10000,
            success: function(data) {
                 $("#divisi").html(data);
            }
        });

		jQuery('#findFilter').click(function(){
            var div = jQuery('#divisi').val();
            var flt = jQuery('#filter').val();
            var prd = jQuery('#period').val();
            
			jQuery("#grid-table").jqGrid('setGridParam', {
                        url: '<?php echo WS_JQGRID."report.more_for_less_controller/crud"; ?>',
                        datatype: 'json',
                        postData: {
                                    divisi : div,
                                    filter : flt,
                                    period : prd
                                  }
                    });
			// alert(period);
			jQuery('#grid-tbl').show();
			jQuery("#grid-table").trigger("reloadGrid");
			responsive_jqgrid('#grid-table', '#grid-pager');
		});

        jQuery('#btn_export_excel').on('click', function (e) {   
            exportToExcel();        
        });

        jQuery("#grid-table").jqGrid({
            datatype: "json",
            mtype: "POST",
            colModel: [
                {
                    label: 'Trans Type',
                    name: 'transaction_type',
                    width: 300, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Name',
                    name: 'user_name',
                    width: 200, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Location',
                    name: 'company_name',
                    width: 150, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Customer Ref',
                    name: 'customer_ref',
                    width: 150, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Account Num',
                    name: 'account_num',
                    width: 150, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Customer Name',
                    name: 'customer_name',
                    width: 200, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Account Name',
                    name: 'account_name',
                    width: 200, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Address',
                    name: 'address',
                    width: 250, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'NPWP',
                    name: 'npwp',
                    width: 150, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Document Name',
                    name: 'nama_dokumen',
                    width: 200, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Invoice Address',
                    name: 'alamat_invoice',
                    width: 200, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Tariff ID',
                    name: 'tariff_id',
                    width: 100, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Tariff Name',
                    name: 'tariff_name',
                    width: 150, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Start Date',
                    name: 'cpdstart_dat',
                    width: 100, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'End Date',
                    name: 'cpdend_dat',
                    width: 100, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Sales Start Date',
                    name: 'sales_start_dat',
                    width: 100, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Sales End Date',
                    name: 'sales_end_dat',
                    width: 100, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Recurring Number',
                    name: 'recurring_number',
                    width: 150, 
                    align: "right",
                    editable: false,
                },
                {
                    label: 'S Min',
                    name: 's_min',
                    width: 150, 
                    align: "right",
                    editable: false,
                },
                {
                    label: 'S Max',
                    name: 's_max',
                    width: 150, 
                    align: "right",
                    editable: false,
                },
                {
                    label: 'Discount',
                    name: 'discount',
                    width: 150, 
                    align: "right",
                    editable: false,
                },
                {
                    label: 'Filter Name',
                    name: 'filter_name',
                    width: 200, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Schema Type',
                    name: 'schema_type',
                    width: 150, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Contact Name AM',
                    name: 'contact_name_am',
                    width: 150, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Contact Phone AM',
                    name: 'contact_phone_am',
                    width: 150, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Contact Email AM',
                    name: 'contact_email_am',
                    width: 150, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Contact Name IT',
                    name: 'contact_name_it',
                    width: 150, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Contact Phone IT',
                    name: 'contact_phone_it',
                    width: 150, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Contact Email IT',
                    name: 'contact_email_it',
                    width: 150, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Contact Name Finance',
                    name: 'contact_name_finance',
                    width: 150, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Contact Phone Finance',
                    name: 'contact_phone_finance',
                    width: 150, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Contact Email Finance',
                    name: 'contact_email_finance',
                    width: 150, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Keterangan',
                    name: 'status',
                    width: 150, 
                    align: "left",
                    editable: false,
                }
            ],
            height: '100%',
            autowidth: true,
            // width: 600,
            viewrecords: true,
            rowNum: 10,
            rowList: [10,20,50],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: false,
            multiboxonly: true,
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
            pager: '#grid-pager',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }

                responsive_jqgrid('#grid-table', '#grid-pager');
            },
            //memanggil controller jqgrid yang ada di controller crud
            caption: "Report More For Less"

        });

        // jQuery('#grid-table').jqGrid('filterToolbar', { searchOnEnter: true, enableClear: false });

        jQuery('#grid-table').jqGrid('navGrid', '#grid-pager',
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
                    jQuery("#detailsPlaceholder").hide();
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
                serializeEditData: serializeJSON,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    style_edit_form(form);

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
                serializeEditData: serializeJSON,
                viewPagerButtons: false,
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    style_edit_form(form);
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
                serializeDelData: serializeJSON,
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                    style_delete_form(form);

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
                    style_search_form(form);
                    form.closest('.ui-jqdialog').center();
                },
                afterRedraw: function () {
                    style_search_filters($(this));
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

    });

    function serializeJSON(postdata) {
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

    function style_edit_form(form) {

        //update buttons classes
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-primary');
        buttons.eq(1).addClass('btn-danger');


    }

    function style_delete_form(form) {
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-danger');
        buttons.eq(1).addClass('btn-default');
    }

    function style_search_filters(form) {
        form.find('.delete-rule').val('X');
        form.find('.add-rule').addClass('btn btn-xs btn-primary');
        form.find('.add-group').addClass('btn btn-xs btn-success');
        form.find('.delete-group').addClass('btn btn-xs btn-danger');
    }

    function style_search_form(form) {
        var dialog = form.closest('.ui-jqdialog');
        var buttons = dialog.find('.EditTable')
        buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'fa fa-retweet');
        buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'fa fa-comment-o');
        buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-success').find('.ui-icon').attr('class', 'fa fa-search');
    }

    function responsive_jqgrid(grid_selector, pager_selector) {

        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );

    }

    function exportToExcel() {
        
        var url = "<?php echo base_url();?>report/excelListNokesM4L?";
        url += "period=" + $('#period').val();
        url += "&divisi=" + $('#divisi').val();
        url += "&filter=" + $('#filter').val();
        url += "&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
        window.location = url;
    }

</script>
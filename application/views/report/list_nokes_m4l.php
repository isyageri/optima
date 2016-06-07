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
            <span>Report List NOKES M4L</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject font-blue-hoki bold uppercase">Period</span>
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
                            <label class="control-label col-md-2">Filter By</label>
                            <div class="col-md-4">
                                <select name="filterBy" id="filterBy" class="form-control">
                                    <option value="0" selected="">All</option>
                                    <option value="1">Customer Ref</option>
                                    <option value="2">Account Number</option>
                                    <option value="3">Customer Name</option>
                                </select>
                            </div>
                            <div class="col-md-4" style="padding-left: 0px;">
                                <button type="submit" id="findFilter" class="btn blue"><i class="fa fa-search"></i> Search</button>
                                <button type="submit" id="btn_export_excel" class="btn green-haze"><i class="fa fa-file-excel-o"></i> Save to Excel</button>
                            </div>                             
                        </div>
                        </div>
                </div>
                <!-- <div style="padding-bottom:5px;"></div> -->
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label class="control-label col-md-2">Value</label>
                            <div class="col-md-4">
                                <input name="filterName" id="filterName" type="text" class="form-control" placeholder="Value">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div style="padding-bottom:5px;"></div> -->
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label class="control-label col-md-2">Period</label>
                            <div class="col-md-3">
                                <input type="text" name="period" id="period" class="form-control date-picker" data-date-format="yyyymm" placeholder="yyyymm">
                            </div>
                        </div>
                    </div>
                </div>
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

		jQuery('#findFilter').click(function(){
            var filterBy = jQuery('#filterBy').val();
            var filterName = jQuery('#filterName').val();
            var prd = jQuery('#period').val();
            
			jQuery("#grid-table").jqGrid('setGridParam', {
                        url: '<?php echo WS_JQGRID."report.list_nokes_m4l_controller/crud"; ?>',
                        datatype: 'json',
                        postData: {
                                    filter_by : filterBy,
                                    filter_name : filterName,
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
                    label: 'Divisi',
                    name: 'company_name',
                    width: 300, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Period',
                    name: 'bill_period',
                    width: 150, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Customer',
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
                    label: 'Name',
                    name: 'nama',
                    width: 300, 
                    align: "left",
                    editable: false,
                },
                {
                    label: 'Skema',
                    name: 'paket',
                    width: 150, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Paket',
                    name: 'offering_name',
                    width: 150, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Start Date Schema',
                    name: 'start_dat',
                    width: 150, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'End Date Schema',
                    name: 'end_dat',
                    width: 150, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Commitment Rev',
                    name: 'commitment',
                    width: 150, 
                    align: "right",
                    editable: false,
                },
                {
                    label: 'Rev Reference',
                    name: 'rev_ref',
                    width: 150, 
                    align: "right",
                    editable: false,
                },
                {
                    label: 'Tgl. Transaksi',
                    name: 'tanggal_transaksi',
                    width: 150, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Rev',
                    name: 'tagihan',
                    width: 150, 
                    align: "right",
                    editable: false,
                },
                {
                    label: 'Eligible Rev',
                    name: 'eligible',
                    width: 150, 
                    align: "right",
                    editable: false,
                },
                {
                    label: 'Discount',
                    name: 'disc_amn',
                    width: 150, 
                    align: "right",
                    editable: false,
                },
                {
                    label: 'Rev. After Disc',
                    name: 'total_bill',
                    width: 150, 
                    align: "right",
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
            caption: "Report List NOKES M4L"

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
        url += "&filter_by=" + $('#filterBy').val();
        url += "&filter_name=" + $('#filterName').val();
        url += "&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
        window.location = url;
    }

</script>
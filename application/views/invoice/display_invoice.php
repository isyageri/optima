<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url();?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Invoice</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Display Invoice</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject font-blue-hoki bold uppercase">Invoice</span>
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
                             <label class="control-label col-md-2">Account Num</label>
                                <div class="col-md-4">
                                    <input type="text" name="account_num" id="account_num" class="form-control" >
                                </div>
                                 </div>
                            <div class="form-group">
                            <label class="control-label col-md-2">Periode</label>
                            <div class="col-md-4">
                                <input type="text" name="start_dat" id="start_dat" class="form-control date-picker" data-date-format="yyyymm" placeholder="yyyymm">
                            </div>
                            </div>
                            <div class="form-group">
                             <label class="control-label col-md-2"></label>
                            <div class="col-md-4">
                                <button style='display:none' type="submit" id="findFilter" class="btn blue"><i class="fa fa-search"></i> Search</button>
                                <button style='display:block' type="submit" id="btn_export_excel" class="btn green-haze"><i class="fa fa-file-excel-o"></i> Display Invoice</button>
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
            var acc = jQuery('#account_num').val();
            var prd = jQuery('#start_dat').val();
			var prd2 = jQuery('#end_dat').val();
            if(acc.length == 0){
                swal("Perhatian", "Account Num tidak boleh kosong", "warning");
                return false;
            }
			jQuery("#grid-table").jqGrid('setGridParam', {
                        url: '<?php echo WS_JQGRID."invoice.display_invoice/crud"; ?>',
                        datatype: 'json',
                        postData: {start_dat: prd, end_dat: prd2, account_num:acc},
                    });
			// alert(period);
			jQuery('#grid-tbl').show();
			jQuery("#grid-table").trigger("reloadGrid");
			responsive_jqgrid('#grid-table', '#grid-pager');
		});

        jQuery('#btn_export_excel').on('click', function (e) {   
            var prd = jQuery('#start_dat').val();         
            var prd2 = jQuery('#end_dat').val();         
            if(prd.length == 0){
                swal("Perhatian", "Period tidak boleh kosong", "warning");
                return false;
            }
            exportToExcel();        
        });

        jQuery("#grid-table").jqGrid({
            datatype: "json",
            mtype: "POST",
            colModel: [
                {
                    label: 'Account Num',
                    name: 'account_num',
                    width: 150, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Account Num',
                    name: 'account_name',
                    width: 150, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Periode Billing',
                    name: 'period',
                    width: 150, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Tagihan',
                    name: 'tagihan',
                    width: 150, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'PPN',
                    name: 'ppn',
                    width: 150, 
                    align: "center",
                    editable: false,
                },
                {
                    label: 'Total',
                    name: 'total',
                    width: 150, 
                    align: "center",
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
            shrinkToFit: true,
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
            caption: "Tagihan M4L"

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
        var url = "http://tos.telkom.co.id/CCS4/report/sin_invoice.php?";
        url += "BILL_PERIOD=" + $('#start_dat').val();
        url += "&ACCOUNT_NUM=" + $('#account_num').val();
        url += "&FORMAT_INVOICE=";
        url += "&WATERMARK=F";
        url += "&is_dev=Y";
        url += "&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
        //window.location = url;
         window.open(url, '_blank');
    }

</script>
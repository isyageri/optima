<div id="detailModal" class="modal fade" role="dialog">
		<div class="modal-dialog">		
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header page-content-wrapper">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Laporan Detail Skema</h4>
					<div class="space-4"></div>
				</div>				
				<div class="modal-body">
					<div class="">
						<div class="space-4"></div>
						<div class="form-group row">
							<label class="col-md-3 control-label">Nama Skema</label>
							<div class="col-md-8">
							<input type="text" class="form-control" placeholder="" readonly="" id="no_transaksi">
							<span class="help-block">
							</span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 control-label">NIPNAS</label>
							<div class="col-md-8">
							<input type="text" class="form-control" placeholder="" readonly="">
							<span class="help-block">
							</span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 control-label">Nama Customer</label>
							<div class="col-md-8">
							<input type="text" class="form-control" placeholder="" readonly="">
							<span class="help-block">
							</span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 control-label">Nomor Account</label>
							<div class="col-md-8">
							<input type="text" class="form-control" placeholder="" readonly="">
							<span class="help-block">
							</span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 control-label">NIPNAS</label>
							<div class="col-md-8">
							<textarea readonly=""></textarea>
							<span class="help-block">
							</span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 control-label">Jenis Skema</label>
							<div class="col-md-8">
							<input type="text" class="form-control" placeholder="" readonly="">
							<span class="help-block">
							</span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 control-label">Tanggal Berlaku</label>
							<div class="col-md-8">
							<input type="text" class="form-control" placeholder="" readonly="">
							<span class="help-block">
							</span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 control-label">Tanggal Berakhir</label>
							<div class="col-md-8">
							<input type="text" class="form-control" placeholder="" readonly="">
							<span class="help-block">
							</span>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4" style="width:560px;overflow:auto;">
								<table id="grid-table-fastel"></table>
								<div id="grid-pager-fastel"></div>
							</div>
						</div>
						<div class="space-4"></div>
						<div class="form-group row">
							<label class="col-md-3 control-label">Nama Paket</label>
							<div class="col-md-8">
							<input type="text" class="form-control" placeholder="" readonly="">
							<span class="help-block">
							</span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 control-label">Discount Incentive</label>
							<div class="col-md-8">
							<input type="text" class="form-control" placeholder="" readonly="">
							<span class="help-block">
							</span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 control-label">Event Filter</label>
							<div class="col-md-8">
							<input type="text" class="form-control" placeholder="" readonly="">
							<span class="help-block">
							</span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 control-label">Revenue Commitment / Rev. Reference</label>
							<div class="col-md-8">
							<input type="text" class="form-control" placeholder="" readonly="">
							<span class="help-block">
							</span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 control-label">Usage Limit</label>
							<div class="col-md-8">
							<input type="text" class="form-control" placeholder="" readonly="">
							<span class="help-block">
							</span>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5" style="width:560px;overflow:auto;">
								<table id="grid-table-diskon"></table>
								<div id="grid-pager-diskon"></div>
							</div>
						</div>
						<div class="space-4"></div>
						<div class="row">
							<div class="col-md-5" style="width:560px;overflow:auto;">
								<table id="grid-table-threshold"></table>
								<div id="grid-pager-threshold"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" id="closed">Close</button>
				</div>
			</div>		
		</div>
</div>

<script>
jQuery(function($) {
        var grid_selector = "#grid-table-fastel";
        var pager_selector = "#grid-pager-fastel";

        jQuery("#grid-table-fastel").jqGrid({
            url: '<?php echo WS_JQGRID."schema.terminasi_schema_controller/crud"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'Fastel', name: 'fastel_id', hidden: true},                
                {label: 'Keterangan', name: 'customer_ref', hidden: false},                
                {label: 'Abonemen', name: 'account_num', hidden: false},                
                {label: 'Lokasi', name: 'account_name', hidden: false},                
                {label: 'SLJJ', name: 'start_dat', hidden: false},                
                {label: 'Selular', name: 'end_dat', hidden: false},                
                {label: 'SLI', name: 'disc_description', hidden: false},                
                {label: 'Others', name: 'disc_description', hidden: false},                
            ],
            height: '100%',
            autowidth: false,
            viewrecords: true,
            rowNum: 5,
            rowList: [5],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
            pager: '#grid-pager-fastel',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }
				responsive_jqgrid(grid_selector,pager_selector);
            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo WS_JQGRID."schema.terminasi_schema_controller/crud"; ?>',
            caption: "Schema Details"

        });

        jQuery('#grid-table-fastel').jqGrid('navGrid', '#grid-pager-fastel',
            {   //navbar options
                edit: false,
				excel: true,
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
        )
    });
jQuery(function($) {
        var grid_selector = "#grid-table-fastel";
        var pager_selector = "#grid-pager-fastel";

        jQuery("#grid-table-fastel").jqGrid({
            url: '<?php echo WS_JQGRID."schema.terminasi_schema_controller/crud"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'Nama Diskon', name: 'fastel_id', hidden: true},                
                {label: 'Deskripsi Diskon', name: 'customer_ref', hidden: false},                
                {label: 'Periode', name: 'account_num', hidden: false},                                               
            ],
            height: '100%',
            autowidth: false,
            viewrecords: true,
            rowNum: 5,
            rowList: [5],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
            pager: '#grid-pager-fastel',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }
				responsive_jqgrid(grid_selector,pager_selector);
            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo WS_JQGRID."schema.terminasi_schema_controller/crud"; ?>',
            caption: "Schema Details"

        });

        jQuery('#grid-table-fastel').jqGrid('navGrid', '#grid-pager-fastel',
            {   //navbar options
                edit: false,
				excel: true,
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
        )
		.navButtonAdd('#grid-pager-fastel',{
				caption:"",
				buttonicon:"fa fa-file-excel-o green bigger-120",
				position:"last",
				title: "Export To Excel",
				cursor: "pointer",
				// onClickButton: toExcelAccount,
				id :"excel"
		});
    });

jQuery(function($) {
        var grid_selector = "#grid-table-diskon";
        var pager_selector = "#grid-pager-diskon";

        jQuery("#grid-table-diskon").jqGrid({
            url: '<?php echo WS_JQGRID."schema.terminasi_schema_controller/crud"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'Threshold', name: 'fastel_id', hidden: true},                
                {label: 'Nama Diskon', name: 'schema_id', hidden: false},                
                {label: 'Deskripsi Diskon', name: 'customer_ref', hidden: false},                
                {label: 'Periode', name: 'account_num', hidden: false}                                
            ],
            height: '100%',
            autowidth: false,
            viewrecords: true,
            rowNum: 5,
            rowList: [5],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
            pager: '#grid-pager-diskon',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }
				responsive_jqgrid(grid_selector,pager_selector);
            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo WS_JQGRID."schema.terminasi_schema_controller/crud"; ?>',
            caption: "Schema Details"

        });

        jQuery('#grid-table-diskon').jqGrid('navGrid', '#grid-pager-diskon',
            {   //navbar options
                edit: false,
				excel: true,
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
        )
		.navButtonAdd('#grid-pager-diskon',{
				caption:"",
				buttonicon:"fa fa-file-excel-o green bigger-120",
				position:"last",
				title: "Export To Excel",
				cursor: "pointer",
				// onClickButton: toExcelAccount,
				id :"excel"
		});
    });

jQuery(function($) {
        var grid_selector = "#grid-table-threshold";
        var pager_selector = "#grid-pager-threshold";

        jQuery("#grid-table-threshold").jqGrid({
            url: '<?php echo WS_JQGRID."schema.terminasi_schema_controller/crud"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'Threshold', name: 'fastel_id', hidden: true},                
                {label: 'Threshold', name: 'schema_id', hidden: false},                
                {label: 'Discount Account', name: 'customer_ref', hidden: false},                
                {label: 'Discount Percentage', name: 'account_num', hidden: false}                 
            ],
            height: '100%',
            autowidth: false,
            viewrecords: true,
            rowNum: 5,
            rowList: [5],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
            pager: '#grid-pager-threshold',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }
				responsive_jqgrid(grid_selector,pager_selector);
            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo WS_JQGRID."schema.terminasi_schema_controller/crud"; ?>',
            caption: "Schema Details"

        });

        jQuery('#grid-table-threshold').jqGrid('navGrid', '#grid-pager-threshold',
            {   //navbar options
                edit: false,
				excel: true,
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
        )
		.navButtonAdd('#grid-pager-threshold',{
				caption:"",
				buttonicon:"fa fa-file-excel-o green bigger-120",
				position:"last",
				title: "Export To Excel",
				cursor: "pointer",
				// onClickButton: toExcelAccount,
				id :"excel"
		});
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
</script>
<script>
	$(document).ready(){
		var myGrid = $('#grid-table-schema');
		selectedRowId = myGrid.jqGrid ('getGridParam', 'selrow');
		// alert(selectedRowId);
		cellValue = myGrid.jqGrid ('getCell', selectedRowId, 'account_num');
		cellValue = myGrid.jqGrid ('getCell', selectedRowId, 'account_num');
		cellValue = myGrid.jqGrid ('getCell', selectedRowId, 'account_num');
		cellValue = myGrid.jqGrid ('getCell', selectedRowId, 'account_num');
		cellValue = myGrid.jqGrid ('getCell', selectedRowId, 'account_num');
		// alert(cellValue);
		$('#grid-table-schema').jqGrid('getCell',row_id,'account_num');
	};
</script>
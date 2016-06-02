<div id="list_acc">
	<div class="portlet box green ">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-gift"></i> Daftar Account
			</div>
			<div class="tools">
				<a href="" class="collapse" data-original-title="" title="">
				</a>				
			</div>
		</div>
		<div class="portlet-body form">
			<form class="form-horizontal" role="form">
				<div class="form-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-2 control-label">Tax Status</label>
								<div class="col-md-8">
									<select class="form-control">
										<option>Account Number</option>
										<option>NIPNAS</option>
									</select>															
									<span class="help-block">
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Kata Kunci</label>
								<div class="col-md-8">
									<input type="text" class="form-control" placeholder="Masukkan kata kunci">
									<span class="help-block">
									</span>
								</div>
							</div>							
						</div>						
					</div>					
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-11 col-md-10">
							<button type="submit" class="btn green">Cari</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="portlet box green ">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-gift"></i> Tambah Account
			</div>
			<div class="tools">
				<a href="" class="collapse" data-original-title="" title="">
				</a>				
			</div>
		</div>
		<div class="portlet-body form">
			<form class="form-horizontal" role="form">
				<div class="form-actions">
					<div class="row">
						<div class="col-md-1">
							<button type="submit" class="btn green" id="show_form">Tambah Account</button>
						</div>
					</div>
					<p>
						&nbsp;
					</p>
					<div class="row">
						<div class="col-md-10">										
							<table id="grid-table-account"></table>
							<div id="grid-pager-account"></div>
						</div>
					</div>
				</div>
				<div class="form-body">										
				</div>				
			</form>
		</div>
	</div>
</div>

<script>
	jQuery(function($) {
        var grid_selector = "#grid-table-account";
        var pager_selector = "#grid-pager-account";

        jQuery("#grid-table-account").jqGrid({
            url: '<?php echo WS_JQGRID."administration.permissions_controller/crud"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 'permission_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'Permissions Name',name: 'permission_name',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Description',name: 'permission_description',width: 200, align: "left",editable: true,
                    edittype:'textarea',
                    editoptions: {
                        rows: 2,
                        cols:50
                    }
                }
            ],
            height: '100%',
            autowidth: true,
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
            pager: '#grid-pager-account',
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
            editurl: '<?php echo WS_JQGRID."administration.permissions_controller/crud"; ?>',
            caption: "Permissions"

        });

        jQuery('#grid-table-account').jqGrid('navGrid', '#grid-pager-account',
            {   //navbar options
                edit: true,
                editicon: 'fa fa-pencil blue bigger-120',
                add: true,
                addicon: 'fa fa-plus-circle purple bigger-120',
                del: true,
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
</script>
<script>
	$( "#show_form" ).click(function() {
		$("#list_acc").hide(1000);
		$("#wizard_form").show(1000);
	});
</script>
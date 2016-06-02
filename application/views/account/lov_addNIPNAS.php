<div id="modal_lov_addNIPNAS" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
	<div class="modal-dialog">
		<div class="modal-content">
		    <!-- modal title -->
			<div class="modal-header no-padding">
				<div class="table-header">
					<span class="form-add-edit-title"> Data addNIPNAS </span>
				</div>
			</div>
            <input type="hidden" id="modal_lov_addNIPNAS_id_val" value="" />
            <input type="hidden" id="modal_lov_addNIPNAS_code_val" value="" />
			<!-- modal body -->
			<div class="modal-body">
                <p>
                  <button type="button" class="btn btn-sm btn-success" id="modal_lov_addNIPNAS_btn_blank">
      	           <span class="fa fa-pencil-square-o" aria-hidden="true"></span> BLANK
                  </button>
                </p>

                <div class="row">
                    <div class="col-xs-12">
                        <table id="grid-table-lov_addNIPNAS" width="100%"></table>
                        <div id="grid-pager-lov_addNIPNAS"></div>
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

    jQuery(function($) {
        $("#modal_lov_addNIPNAS_btn_blank").on('click', function() {
            $("#"+ $("#modal_lov_addNIPNAS_id_val").val()).val("");
            $("#"+ $("#modal_lov_addNIPNAS_code_val").val()).val("");
            $("#modal_lov_addNIPNAS").modal("toggle");
        });
    });

    function modal_lov_addNIPNAS_show(the_id_field, the_code_field) {
        modal_lov_addNIPNAS_set_field_value(the_id_field, the_code_field);
        $("#modal_lov_addNIPNAS").modal({backdrop: 'static'});
        modal_lov_addNIPNAS_prepare_table();
    }

    function modal_lov_addNIPNAS_set_field_value(the_id_field, the_code_field) {
         $("#modal_lov_addNIPNAS_id_val").val(the_id_field);
         $("#modal_lov_addNIPNAS_code_val").val(the_code_field);
    }

    function modal_lov_addNIPNAS_fill_value(rowKey) {
         var code_val = $('#grid-table-lov_addNIPNAS').jqGrid('getCell', rowKey, 'permission_name');
         modal_lov_addNIPNAS_set_value(rowKey, code_val);
    }

    function modal_lov_addNIPNAS_set_value(the_id_val, the_code_val) {
         $("#"+ $("#modal_lov_addNIPNAS_id_val").val()).val(the_id_val);
         $("#"+ $("#modal_lov_addNIPNAS_code_val").val()).val(the_code_val);
         $("#modal_lov_addNIPNAS").modal("toggle");
    }

    function modal_lov_addNIPNAS_prepare_table() {

        var grid_selector = "#grid-table-lov_addNIPNAS";
        var pager_selector = "#grid-pager-lov_addNIPNAS";

        $.jgrid.gridUnload(grid_selector);

        jQuery("#grid-table-lov_addNIPNAS").jqGrid({
            url: '<?php echo WS_JQGRID."administration.permissions_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 'permission_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'Pilih',name: 'permission_id',width: 80, align: "center",editable: false,
                    formatter: function(cellvalue, options, rowObject) {
                        return '<a href="#'+ $("#modal_lov_addNIPNAS_code_val").val() +'" onclick="modal_lov_addNIPNAS_fill_value('+cellvalue+');"> <i class="fa fa-pencil-square-o bigger-200"></i> </a>';
                    }
                },
                {label: 'Permission Name',name: 'permission_name', width: 250, sortable: true, editable: true,
                    editoptions: {
                        size: 50,
                        maxlength:100
                    }
                }
            ],
            height: '100%',
            autowidth: true,
            rowNum: 5,
            viewrecords: true,
            rowList: [5],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            onSelectRow: function (rowid) {


            },
            sortorder:'',
            pager: '#grid-pager-lov_addNIPNAS',
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
            caption: "addNIPNAS"

        });

        jQuery('#grid-table-lov_addNIPNAS').jqGrid('navGrid', '#grid-pager-lov_addNIPNAS',
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
                    jQuery("#detailsPlaceholder").hide();
                },

                refreshicon: 'fa fa-refresh green bigger-120',
                view: false,
                viewicon: 'fa fa-search-plus grey bigger-120'
            },

            {
                // options for the Edit Dialog
                editCaption : 'View Record',
                closeAfterEdit: true,
                closeOnEscape:true,
                recreateForm: true,
                viewPagerButtons: false,
                serializeEditData: modal_lov_addNIPNAS_serializeJSON,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    modal_lov_addNIPNAS_style_edit_form(form);
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

                closeAfterAdd: true,
                clearAfterAdd : true,
                closeOnEscape:true,
                recreateForm: true,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                serializeEditData: modal_lov_addNIPNAS_serializeJSON,
                viewPagerButtons: false,
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    modal_lov_addNIPNAS_style_edit_form(form);
                },
                beforeInitData:function(form_id) {
                    jQuery("#grid-table").jqGrid('resetSelection');
                    return true;
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
                serializeDelData: modal_lov_addNIPNAS_serializeJSON,
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                    modal_lov_addNIPNAS_style_delete_form(form);
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
                    modal_lov_addNIPNAS_style_search_form(form);

                    form.closest('.ui-jqdialog').center();
                },
                afterRedraw: function () {
                    modal_lov_addNIPNAS_style_search_filters($(this));
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

        modal_lov_addNIPNAS_responsive_jqgrid(grid_selector, pager_selector);
    }


    function modal_lov_addNIPNAS_serializeJSON(postdata) {
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

    function modal_lov_addNIPNAS_style_edit_form(form) {
        //update buttons classes
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-primary');
        buttons.eq(1).addClass('btn-danger');
    }

    function modal_lov_addNIPNAS_style_delete_form(form) {
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-danger');
        buttons.eq(1).addClass('btn-default');
    }

    function modal_lov_addNIPNAS_style_search_filters(form) {
        form.find('.delete-rule').val('X');
        form.find('.add-rule').addClass('btn btn-xs btn-primary');
        form.find('.add-group').addClass('btn btn-xs btn-success');
        form.find('.delete-group').addClass('btn btn-xs btn-danger');
    }

    function modal_lov_addNIPNAS_style_search_form(form) {
        var dialog = form.closest('.ui-jqdialog');
        var buttons = dialog.find('.EditTable')
        buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'fa fa-retweet');
        buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'fa fa-comment-o');
        buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-success').find('.ui-icon').attr('class', 'fa fa-search');
    }

    function modal_lov_addNIPNAS_responsive_jqgrid(grid_selector, pager_selector) {
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid( 'setGridWidth', $(".modal-dialog").width() - 40);
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );
    }
</script>


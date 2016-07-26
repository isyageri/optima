<div>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<a href="<?php base_url();?>">Home</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="#">schema</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span>List schema</span>
			</li>
		</ul>
	</div>
	<div class="space-4"></div>
	<div>
		<table id="grid-table-schema"></table>
		<div id="grid-pager-schema"></div>
	</div>	
</div>
<?php $this->load->view('lov/lov_trx.php'); ?>
<?php $this->load->view('lov/lov_info_schema.php'); ?>
<?php //.$this->load->view('schema/detail_terminate_schema.php'); ?>
<script>
function open_modal_trx(account_num_lov,customer_ref,account_name,created_date_lov,schema_id, created_by){

    modal_lov_detail_terminate_skema_show(account_num_lov,customer_ref,account_name,created_date_lov,schema_id, created_by);
}
function open_modal_det(account_num_lov,customer_ref,account_name,created_date_lov,schema_id, created_by){

    modal_lov_detail_info_skema_show(account_num_lov,customer_ref,account_name,created_date_lov,schema_id);
}

	jQuery(function($) {
        var grid_selector = "#grid-table-schema";
        var pager_selector = "#grid-pager-schema";

        jQuery("#grid-table-schema").jqGrid({
            url: '<?php echo WS_JQGRID."schema.terminasi_schema_controller/crud"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'schema ID', name: 'schema_id', hidden: true},                
                {label: 'created_date', name: 'created_date', hidden: true},                
                {label: 'created_by', name: 'created_by', hidden: true},                
                {label: 'Customer Name', name: 'customer_ref', hidden: false},                
                {label: 'Account Number', name: 'account_num', hidden: false},                
                {label: 'Account Name', name: 'account_name', hidden: false},                
                {label: 'Start Date', name: 'start_dat', hidden: false},                
                {label: 'End Date', name: 'end_dat', hidden: false},                
                {label: 'Disc Description', name: 'disc_description', hidden: false},                
                {label: 'Detail | Terminate', name: 'dt', hidden: false,
					formatter:	function(cellvalue, options, rowObject){
						return '<i class="btn green btn-xs" id="lov-button-detail" onclick="open_modal_det(\''+rowObject.account_num+'\',\''+rowObject.customer_ref+'\',\''+rowObject.account_name+'\',\''+rowObject.created_date+'\',\''+rowObject.schema_id+'\',\''+rowObject.created_by+'\')">Details</i><i class="btn green btn-xs" onclick="open_modal_trx(\''+rowObject.account_num+'\',\''+rowObject.customer_ref+'\',\''+rowObject.account_name+'\',\''+rowObject.created_date+'\',\''+rowObject.schema_id+'\',\''+rowObject.created_by+'\')">Terminate</i>';
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
            pager: '#grid-pager-schema',
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

        jQuery('#grid-table-schema').jqGrid('navGrid', '#grid-pager-schema',
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
        $(grid_selector).jqGrid( 'setGridWidth', $(".form-body").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );

    }
	
	function swal_terminate(){
	  swal({
			title: "Apakah Anda Yakin?",
			text: "Anda akan menghentikan/terminasi schema",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Ya, terminasi schema",
			closeOnConfirm: false
			},
			function(){
				swal("Terminated", "Terminasi berhasil", "success");
			});
	};
</script>
<script>
// $(document).ready(function() {
  
// });
</script>

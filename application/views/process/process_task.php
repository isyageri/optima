<div>
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<a href="<?php base_url();?>">Home</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="#">Process</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<span>Task Request</span>
			</li>
		</ul>
	</div>
	<div class="space-4"></div>
	<div class="col-md-12">
        <div class="tabbable tabbable-tabdrop">
            <ul class="nav nav-tabs">
                <li id="tab-1">
                    <a data-toggle="tab"> File </a>
                </li>
                <li id="tab-2">
                    <a data-toggle="tab"> Proses </a>
                </li>
                <li  class="active">
                    <a data-toggle="tab"> Task Request </a>
                </li>
            </ul>
			<div class="tab-content">
                <div class="tab-pane active">
                    <table id="grid-table-prebill"></table>
                    <div id="grid-pager-prebill"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$(function($) {
        $("#tab-1").on( "click", function() {    
            loadContentWithParams("process.re_rating_billing", {                
            });
        });

        $("#tab-2").on( "click", function() { 

            loadContentWithParams("process.process_rerating_proc", {   
                input_data_control_id :"<?php echo $this->input->post('input_data_control_id'); ?>",           
                input_file_name :"<?php echo $this->input->post('input_file_name'); ?>"    
            });
        });;
    });
	jQuery(function($) {
        var grid_selector = "#grid-table-prebill";
        var pager_selector = "#grid-pager-prebill";

        jQuery("#grid-table-prebill").jqGrid({
            url: '<?php echo WS_JQGRID."process.rating_controller/crud"; ?>',
            datatype: "json",
            postData: {
                task_request_id : <?php echo $this->input->post('task_request_id'); ?>
            },
            mtype: "POST",
            colModel: [
                {label: 'Task Request ID', name: 'task_request_id', hidden: false},                
                {label: 'Task Instance ID', name: 'task_instance_id', hidden: false},                
                {label: 'Dari', name: 'start_dtm', hidden: false},                
                {label: 'Sampai', name: 'end_dtm', hidden: false},                
                {label: 'Total Error', name: 'total_errors', hidden: false},                
                {label: 'Status', name: 'task_status', hidden: false}
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
            pager: '#grid-pager-prebill',
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
            editurl: '<?php echo WS_JQGRID."process.rating_controller/crud"; ?>',
            caption: "Periode"

        });

        jQuery('#grid-table-prebill').jqGrid('navGrid', '#grid-pager-prebill',
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
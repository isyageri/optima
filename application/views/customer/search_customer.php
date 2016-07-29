<!-- breadcrumb -->
<style>
body .modal {
  width: 900px;
  margin-left: -450px;
  horizontal-align: middle;
}
</style>
<link href="<?php echo base_url(); ?>assets/global/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Customer</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Search Customer</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->

<div class='space-4'></div>
	<div>
		<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="caption">
				<span class="caption-subject font-blue-hoki bold uppercase">Period</span>
			</div>
			<div class="tools">
				<a class="collapse" href="">
				</a>
			</div>
		</div>
		<div class="portlet-body form">
			<!-- BEGIN FORM-->
			<form class="form-horizontal" action="javascript:;">
				<div class="form-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-md-1">Search</label>
								<div class="col-md-2">
									<select class="form-control" id="tpref">
										<option value=1>Customer Reference</option>
										<option value=2>Account Number</option>
										<option value=3>Account Name</option>
										<option value=4>Telephone Number</option>
									</select>									
								</div>
								<div class="col-md-2">
									<input class="form-control" id="form_reference">
								</div>
								<div style="padding-left: 0px;" class="col-md-2">
									<a class="btn blue" id="findFilter"><i class="fa fa-search"></i> Find</a>
									<a class="btn green-haze" id="reset_reference" ><i class=""></i> Reset </a>
								</div>                             
							</div>
						</div>
					</div>
				</div>
                    <table id="grid-table"></table>
                    <div id="grid-pager"></div>
    </div>
			</form>
			<!-- END FORM-->

		</div>
        <div class="col-md-12">
        <div class="tab-content">
                <div class="tab-pane active">
                    <table id="grid-table"></table>
                    <div id="grid-pager"></div>
                </div>
        </div>
    </div>
	</div>
</div>
<div class="space-4"></div>
	<div class="col-md-12">
		<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-social-dribbble font-blue-sharp"></i>
						<span class="caption-subject font-blue-sharp bold uppercase">Customer Hierarcy</span>
					</div>
				</div>
			<div class="portlet-body" id="cosntent_tree_js">
                <div id="treeviews">
					<div id="container" class="tree-demo">
						<ul>
							<li id="data"> Data								
							</li>
						</ul>
					</div>									
                </div>
			</div>
		</div>
	</div>
<div class="row" id="customer_details">

	<div class="space-4"></div>
		<!-- Trigger the modal with a button -->
		<button type="button" id="btbt" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
		
		<!-- Modal -->
		<div id="treeModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
			
				<!-- Modal content-->
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				</div>
				<div class="modal-body">
					<div class="col-md-12">
						<div class="tabbable tabbable-tabdrop">
							<ul class="nav nav-tabs">
								<li class="active">
									<a data-toggle="tab"> Informasi </a>
								</li>
								<li id="tab-22">
									<a data-toggle="tab"> Threshold </a>
								</li>
								<li id="tab-322">
									<a data-toggle="tab"> Fastel </a>
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
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</div>
			
			</div>
		</div>
	</div>	
<script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/global/plugins/jstree/dist/jstree.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/pages/scripts/ui-tree.min.js" type="text/javascript"></script>
<script>	
	// $(function(){
		// $('#container').jstree();
	// });
	// function get_node_tree(customer_ref){

         // $.ajax({
                // type: "POST",
                // url: "<?php echo WS_JQGRID.'customer.search_customer_controller/get_data_hierarcy'; ?>",
                // data: { customer_ref:customer_ref},
                // success: function (data) {
                 // $('#tree_1').html('');
                 // $('#tree_1').html(data);
                 // $('#tree_1').jstree({
                    // "core" : {
                        // "themes" : {
                            // "responsive": false
                        // }            
                    // },
                    // "types" : {
                        // "default" : {
                            // "icon" : "fa fa-folder icon-state-warning icon-lg"
                        // },
                        // "file" : {
                            // "icon" : "fa fa-file icon-state-warning icon-lg"
                        // }
                    // },
                    // "plugins": ["types"]
                // });
            // }
         // });

    // }
	
	$(document).ready(function(){
		$('#customer_details').hide();
		$('#treeviews').hide();
		$('#btbt').hide();
		// UITree.init();
	});
	$('#findFilter').click(function(){
		if( $('#form_reference').val().length >0 ){
			var grid_id = $("#grid-table");
			grid_id.jqGrid('setGridParam', {
				url: "<?php echo WS_JQGRID."customer.search_customer_controller/tableSearchResult"; ?>",
				datatype: 'json',
				postData: {	typeRef : $('#tpref').val(),
							valueRef : $('#form_reference').val()
							},
				// userData: {row: rowid}
			});	
			$("#grid-table").trigger("reloadGrid");
			responsive_jqgrid('#grid-table', '#grid-pager');
			$('#customer_details').show(1000);
		} else
		{
			swal("Perhatian","Isilah terlebih dahulu inputannya","info");
		};
	});
	
	$('#reset_reference').click(function(){
		$('#form_reference').val("");
	});
	
	// $('#dat').click(function(){
		// alert();
	// });
	function dats(x, y){
		loadContentWithParams("customer.customer_details", {
				celval:x,
				celprodseq:y
            });
		// $('#treeModal').modal('show');
		// alert($('#dat'+x).val());
		// alert($('#dat'+x).text());
		
		
	};
    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."customer.search_customer_controller/tableSearchResult"; ?>',
            datatype: "json",
            mtype: "POST",            
            colModel: [
                {label: 'Customer Ref', name: 'CUSTOMER_REF', hidden: false},                
                {label: 'Customer Name', name: 'ADDRESS_NAME', hidden: false},                
                {label: 'Account No', name: 'ACCOUNTNUM', hidden: false, editable: true},
                {label: 'Account Name', name: 'ACCOUNTNAME', hidden: false, editable: true},
                {label: 'Fastel', name: 'FASTEL', hidden: false, editable: true},
                {label: 'Start Date Fastel', name: 'START_DAT_FASTEL', hidden: false, editable: true},
                {label: 'End Date Fastel', name: 'END_DTM_FASTEL', hidden: false, editable: true},
                {label: 'RFISCAL', name: 'RFISCAL', hidden: false, editable: true}                
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
                // var customer_ref = $('#grid-table').jqGrid('getCell', rowid, 'CUSTOMER_REF');
                // get_node_tree(customer_ref);

                var celValue = $('#grid-table').jqGrid('getCell', rowid, 'CUSTOMER_REF');
				if (rowid != null){
					$.ajax({
						// async: false,
						url: "<?php echo WS_JQGRID."customer.search_customer_controller/createNodeTree"; ?>",
						type: "POST",
						datatype: "json",
						data: {celval:celValue},
						success: function (data) {
                          $("#data_2").html('');
							var items = jQuery.parseJSON(data);
							//Node teratas
							var ix = 0; var dataTreeLeaves = [];
							 while (ix < items.length){
								if(items[ix].parentNode == -1){
									data_1 = items[ix].nodeLabel;									
									k = 0; 
									while(k < items.length){										
										if(items[k].parentNode == items[ix].node){																				
											data_2 = items[k].nodeLabel;
											j = 0; datseq = 0;
											while(j < items.length){
												if(items[j].parentNode == items[k].node){
													dataTreeLeaves[datseq] = items[j].nodeLabel;
													datseq++;
												}
											j++;
											}
											datS = datseq;
											x = 0;
										}
										k++;
									};
								};
								ix++;
							}
							$("#data").append("<ul><li data-jstree=\''{ 'selected' : true, 'opened' : true }'\'>"+data_1+"<ul><li id='data_2'>"+data_2+"</li></ul></li></ul>");
							$("#data_2").append("<ul class='leaves'></ul>");
							while(x < datS){								
								$(".leaves").append("<li data-jstree=\''{ 'selected' : true, 'opened' : true }'\'><a id='dat"+x+"'  onclick=dats("+ $('#form_reference').val() +","+ x+1 +") value="+ $('#form_reference').val() +">"+ dataTreeLeaves[x] +"</a></li>");
								x++;
							};							
							$(function(){
								$('#container').jstree();
							});
							$('#treeviews').show(1000);
							// $('#treeModal').modal('show');
						}
					});
				}
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
				responsive_jqgrid(grid_selector,pager_selector);
            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '',
            caption: "Customer Details"

        });

        jQuery('#grid-table').jqGrid('navGrid', '#grid-pager',
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
                editData: {
                    p_finance_period_id: function() {
                        return <?php echo $this->input->post('p_finance_period_id'); ?>;
                    }
                },
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
</script>

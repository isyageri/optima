
<link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url();?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Schema</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Pembuatan Schema</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-md-12">

  		<div class="portlet light bordered" >
  			<div class="portlet-title">
  				<div class="caption">
  					<i class=" icon-info font-blue"></i>
  					<span class="caption-subject font-blue bold uppercase"> Informasi Schema
  					</span>
  				</div>
  			</div>
  			<form role="form">
  				<div class="row">
  					<div class="col-md-3">
  						<div class="col-md-12">
  							<div class="form-group form-md-line-input">
  								<input type="text" class="form-control" id="form_control_1" readonly value="SCHM-001">
  								<div class="form-control-focus"> </div>
  								<label for="form_control_1">Schema ID</label>
  							</div>
  						</div>
  						<div class="col-md-12">
  							<div class="form-group form-md-line-input">
  								<input type="text" class="form-control" id="form_control_1" readonly value="<?php echo date('d-m-Y');?>">
  								<div class="form-control-focus"> </div>
  								<label for="form_control_1">Tanggal Transaksi</label>
  							</div>
  						</div>
  					</div>
  					<div class="col-md-1">
  					</div>
  					<div class="col-md-8">
  						<div class="col-md-6">
  							<div class="form-group form-md-line-input">
  								<input type="text" class="form-control" id="form_control_1" readonly>
  								<div class="form-control-focus"> </div>
  								<label for="form_control_1">Petugas</label>
  							</div>
  						</div>
  						<div class="col-md-6">
  							<div class="form-group form-md-line-input">
  								<input type="text" class="form-control" id="form_control_1" readonly>
  								<div class="form-control-focus"> </div>
  								<label for="form_control_1">Lokasi</label>
  							</div>
  						</div>
  						<div class="col-md-4">
  							<div class="form-group form-md-line-input">
  								<input type="text" class="form-control" id="form_control_1" readonly>
  								<div class="form-control-focus"> </div>
  								<label for="form_control_1">Status</label>
  							</div>
  						</div>
  					</div>
  				</div>

  			</form>
  		</div>

    </div>

    <div class="col-md-12">
      <div class="portlet light bordered" id="form_wizard_1">
             <div class="portlet-title">
                 <div class="caption">
                     <i class=" icon-layers font-red"></i>
                     <span class="caption-subject font-red bold uppercase"> Pembuatan Schema -
                         <span class="step-title"> Step 1 of 4 </span>
                     </span>
                 </div>
             </div>
             <div class="portlet-body form">
                 <form class="form-horizontal" action="#" id="submit_form" method="POST">
                     <div class="form-wizard">
                         <div class="form-body">
                             <ul class="nav nav-pills nav-justified steps">
                                 <li>
                                     <a href="#tab1" data-toggle="tab" class="step">
                                         <span class="number"> 1 </span>
                                         <span class="desc">
                                             <i class="fa fa-check"></i> Account Number </span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="#tab2" data-toggle="tab" class="step">
                                         <span class="number"> 2 </span>
                                         <span class="desc">
                                             <i class="fa fa-check"></i> Fastel </span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="#tab3" data-toggle="tab" class="step active">
                                         <span class="number"> 3 </span>
                                         <span class="desc">
                                             <i class="fa fa-check"></i> Tren & Info </span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="#tab4" data-toggle="tab" class="step">
                                         <span class="number"> 4 </span>
                                         <span class="desc">
                                             <i class="fa fa-check"></i> Scheme </span>
                                     </a>
                                 </li>
                             </ul>
                             <div id="bar" class="progress progress-striped active" role="progressbar">
                                 <div class="progress-bar progress-bar-success"> </div>
                             </div>
                             <div class="tab-content">
                                 <div class="alert alert-danger display-none">
                                     <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>
                                 <div class="alert alert-success display-none">
                                     <button class="close" data-dismiss="alert"></button> Your form validation is successful! </div>
                                 <div class="tab-pane active" id="tab1">
                                      <!--- TAB 1 -->
                                      <div class="form-group">
                                          <label class="control-label col-md-3">Nipnas
                                             <span> * </span>
                                          </label>
                                          <div class="col-md-4">
                                            <div class="input-group">
                                               <input type="text" class="form-control required" id="nipnas" name="nipnos" placeholder="Nipnas" />
                                               <span class="input-group-btn">
                                                 <button class="btn btn-success" type="button" id="btn-lov-nipnas">
                                                    <i class="fa fa-search"></i>
                                                 </button>
                                               </span>
                                            </div>
                                         </div>
                                         <div class="col-md-3">
                                            <input type="text" class="form-control" id="customer_name" readonly="" placeholder="Customer Name"  />
                                         </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="control-label col-md-3">Account Num
                                             <span> * </span>
                                          </label>
                                          <div class="col-md-4">
                                             <div class="input-group">
                                                 <input type="text" class="form-control required" id="account_number" name="account_number" placeholder="Account Number" />
                                                 <span class="input-group-btn">
                                                   <button class="btn btn-success" type="button" id="btn-lov-accountnum">
                                                      <i class="fa fa-search"></i>
                                                   </button>
                                                 </span>
                                             </div>
                                         </div>
                                         <div class="col-md-3">
                                            <input type="text" class="form-control" id="customer_name2" readonly="" placeholder="Customer Name"  />
                                         </div>
                                      </div>

                                 </div>
                                 <div class="tab-pane" id="tab2">
                                     <!--- TAB 2 -->

                                      <div class="input-group col-md-1">
                                         <input type="file" name="file_upload" />
                                         <span class="input-group-btn btn-right">
                                              <button class="btn green-haze"> Upload </button>
                                         </span>
                                      </div>
                                      <div class="space-4"></div>
                                      <div class="row">
                                          <div class="col-md-8">
                                              <table id="grid-table"></table>
                                              <div id="grid-pager"></div>
                                          </div>
                                      </div>

                                 </div>
                                 <div class="tab-pane" id="tab3">
                                      <div class="space-4"></div>
                                      <div class="row">
                                          <div class="col-md-8">
                                              <table id="grid-table-trend"></table>
                                              <div id="grid-pager-trend"></div>
                                          </div>
                                      </div>
                                 </div>
                                 <div class="tab-pane" id="tab4">

                                      <div class="form-group form-md-line-input form-md-floating-label">
                                            <label class="col-md-3 control-label" for="trend">Trend:</label>
                                            <div class="col-md-4">
                                                <input type="text" name="trend" id="trend" class="form-control">
                                            </div>
                                      </div>

                                 </div>
                             </div>
                         </div>
                         <div class="form-actions">
                             <div class="row">
                                 <div class="col-md-offset-3 col-md-9">
                                     <a href="javascript:;" class="btn default button-previous">
                                         <i class="fa fa-angle-left"></i> Back </a>
                                     <a href="javascript:;" class="btn btn-outline green button-next"> Continue
                                         <i class="fa fa-angle-right"></i>
                                     </a>
                                     <a href="javascript:;" class="btn green button-submit"> Submit
                                         <i class="fa fa-check"></i>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
    </div>
</div>

<?php $this->load->view('lov/lov_nipnas2.php'); ?>

<script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>


<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/pages/scripts/form-wizard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
  $(document).ready(function(){
      $('#btn-lov-nipnas').on('click',function() {
          modal_lov_nipnas_show('nipnas','customer_name');
      });

      $('#btn-lov-accountnum').on('click',function() {
          modal_lov_nipnas_show('account_number','customer_name2');
      });
  })

  jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
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
                responsive_jqgrid(grid_selector, pager_selector)
            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo WS_JQGRID."administration.permissions_controller/crud"; ?>',
            caption: "Permissions"

        });

        jQuery('#grid-table').jqGrid('navGrid', '#grid-pager',
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


        jQuery("#grid-table-trend").jqGrid({
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
            pager: '#grid-pager-trend',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }
                responsive_jqgrid('#grid-table-trend', '#grid-pager-trend');
            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo WS_JQGRID."administration.permissions_controller/crud"; ?>',
            caption: "Permissions"

        });

        jQuery('#grid-table-trend').jqGrid('navGrid', '#grid-pager-trend',
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
        $(grid_selector).jqGrid( 'setGridWidth', $(".portlet-body").width() - 50 );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );

    }
</script>

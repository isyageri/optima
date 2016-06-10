<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

<style>
input.uppercase {
    text-transform: uppercase;
}
</style>

<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url();?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#" id="back-manage-account">Account</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Tambah Account</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
	<div class="col-md-12">
		<div id="wizard_form">
			<div class="portlet box green ">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gift"></i> Data Transaksi
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
									<label class="col-md-2 control-label">No Transaksi</label>
									<div class="col-md-8">
									<input type="text" class="form-control" placeholder="TELKOM-ACC/VI/03/16-??" readonly="" id="no_transaksi">
									<span class="help-block">
									</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tanggal Transaksi</label>
									<div class="col-md-8">
									<input type="text" class="form-control" placeholder="<?php echo date("F j, Y") ?>" readonly="">
									<span class="help-block">
									</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Status Transaksi</label>
									<div class="col-md-8">
									<input type="text" class="form-control" placeholder="New Transaction" readonly="">
									<span class="help-block">
									</span>
									</div>
								</div>
							</div>
							<div class="col-md-6">								
								<div class="form-group">
									<label class="col-md-2 control-label">Petugas</label>
									<div class="col-md-8">
									<input type="text" class="form-control" value="<?php  echo $this->ion_auth->user()->row()->username; ?>" readonly="">
									<span class="help-block">
									</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Lokasi</label>
									<div class="col-md-8">
									<input type="text" class="form-control" placeholder="TELKOM" readonly="">
									<span class="help-block">
									</span>
									</div>
								</div>
							</div>
						</div>
						</div>						
					</form>
				</div>
			</div>
			<div class="portlet light bordered" id="form_wizard_1">
				<div class="portlet-title">
					<div class="caption">
						<i class=" icon-layers font-red"></i>
						<span class="caption-subject font-red bold uppercase"> Penambahan Account -
						<span class="step-title"> Step 1 of 5 </span>
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
									<i class="fa fa-check"></i> Account and Tax </span>
									</a>
								</li>
								<li>
									<a href="#tab2" data-toggle="tab" class="step">
									<span class="number"> 2 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Finance </span>
									</a>
								</li>
								<li>
									<a href="#tab3" data-toggle="tab" class="step">
									<span class="number"> 3 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Billing Contact </span>
									</a>
								</li>
								<li>
									<a href="#tab4" data-toggle="tab" class="step">
									<span class="number"> 4 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Billing Detail </span>
									</a>
								</li>
								<li>
									<a href="#tab5" data-toggle="tab" class="step">
									<span class="number"> 5 </span>
									<span class="desc">
									<i class="fa fa-check"></i> Additional Information </span>
									</a>
								</li>
							</ul>
							<div id="bar" class="progress progress-striped active" role="progressbar">
								<div class="progress-bar progress-bar-success"> </div>
							</div>
							<div class="tab-content">
								<div class="alert alert-danger display-none">
									<button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. 
								</div>
								<div class="alert alert-success display-none">
									<button class="close" data-dismiss="alert"></button> Your form validation is successful! 
								</div>
								<div class="tab-pane" id="tab1">
									<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-2">NIPNAS*
											</label>														
											<div class="col-md-8">
												<div class="input-group">
												<div class="input-icon">															
													<input id="nipnas" class="form-control required" type="text" name="find_NIPNAS" readonly="">
												</div>
												<span class="input-group-btn">
													<button id="btn-lov-nipnas" class="btn btn-success" type="button">
														<i class="fa fa-search"></i>
													</button>
												</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Account Name *</label>
											<div class="col-md-8">
												<input type="text" class="form-control required uppercase" placeholder="Insert Name Here" id="acc_name_page1">
												<span class="help-block">
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Account To Go Live *</label>
											<div class="col-md-8">
												<input type="text" class="form-control required" placeholder="DD/MM/YYYY" id="datetimepicker2" readonly="">
												<span class="help-block">
												</span>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="col-md-2 control-label">Contracted Point of Supply</label>
											<div class="col-md-8">
												<select class="form-control">
												<option>PT Telkom Taxable</option>
												<option>PT Telkom Nontaxable</option>
												<option>PT Telkom for 5% Tax Set</option>
												</select>
												<span class="help-block">
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-2 control-label">Tax Status</label>
											<div class="col-md-8">
												<select class="form-control">
												<option>Tax Exclusive</option>
												<option>Tax Inclusive</option>
												</select>
												<span class="help-block">
												</span>
											</div>
										</div>
									</div>
									</div>
								</div>
								<div class="tab-pane" id="tab2">
									<div class="portlet-body form">
									<div class="form-body">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-2 control-label">Account Currency</label>
												<div class="col-md-8">
												<select class="form-control">
													<option>IDR - Indonesian Rupiah</option>
													<option>USD - US Dollar</option>
													<option>EUR - Euro</option>
												</select>
												<span class="help-block">
												</span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Information Currency</label>
												<div class="col-md-8">
												<select class="form-control">
													<option>IDR - Indonesian Rupiah</option>
													<option>USD - US Dollar</option>
													<option>EUR - Euro</option>
												</select>
												<span class="help-block">
												</span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Next Bill Date*
												</label>
												<div class="col-md-8">
													<input type="text" class="form-control required" placeholder="DD/MM/YYYY" id="datetimepicker1" readonly="">
													<span class="help-block">
													</span>
												</div>
											</div>
										</div>
									</div>
									</div>
								</div>
								<div class="tab-pane" id="tab3">
									<div class="portlet-body form">
									<div class="form-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
												<label class="col-md-2 control-label">Account Number</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="" readonly="">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">First Name *</label>
												<div class="col-md-8">
													<input type="text" class="form-control required uppercase" placeholder="Enter first Name">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Last Name *</label>
												<div class="col-md-8">
													<input type="text" class="form-control required uppercase" placeholder="Enter last name">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Company Name *</label>
												<div class="col-md-8">
													<input type="text" class="form-control uppercase required" id="company_name" name="company_name" value="" readonly="">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">NPWP *</label>
												<div class="col-md-8">
													<input type="text" class="form-control required" placeholder="Enter NPWP" id="npwp_val">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Email *</label>
												<div class="col-md-8">
													<input type="text" class="form-control required" placeholder="Enter Email Address">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Mobile Number *</label>
												<div class="col-md-8">
													<input type="text" class="form-control required" placeholder="Enter Mobile Number">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Contact Type</label>
												<div class="col-md-8">
													<select class="form-control">
														<option>Billing</option>
														<option>Contract</option>
														<option>Directory</option>
														<option>INTERNAL</option>
													</select>
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Contact Start Date *</label>
												<div class="col-md-8">
													<input type="text" class="form-control required" placeholder="Enter Contact Start Date" readonly="" id="datetimepicker3">
													<span class="help-block">
													</span>
												</div>
												</div>
												<p>
												&nbsp;
												</p>
												<div class="form-group">
												<label class="col-md-2 control-label">Contact IT</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Enter Contact IT">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Phone Number</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Enter Phone Number">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Email</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Enter Email">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Contact Finance</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Enter Contact Finance">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Phone Number</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Enter Phone Number">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Email</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Enter Email">
													<span class="help-block">
													</span>
												</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
												<label class="col-md-2 control-label">Street Name *</label>
												<div class="col-md-8">
													<input type="text" class="form-control required uppercase" placeholder="Enter Street Name" id="street_name" name="street_name" value="">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Block Name</label>
												<div class="col-md-8">
													<input type="text" class="form-control uppercase" placeholder="Enter Block Name" id="block_name" name="block_name" value="">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">District Name</label>
												<div class="col-md-8">
													<input type="text" class="form-control uppercase" placeholder="Enter District Name" id="district" name="district" value="">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">City</label>
												<div class="col-md-8">
													<input type="text" class="form-control uppercase" placeholder="Enter text" id="city_name" name="city_name" value="">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Province</label>
												<div class="col-md-8">
													<input type="text" class="form-control uppercase" placeholder="Enter Province" id="province_name" name="province_name" value="">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Zip Code</label>
												<div class="col-md-8">
													<input type="number" class="form-control" placeholder="Enter ZIP Code" maxlength="5" id="zip_code" name="zip_code">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Contact AM</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Enter Contact AM">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Phone Number</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Enter Phone Number" id="phone_number" name="phone_number" value="">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Email</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Enter Email">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Document Name</label>
												<div class="col-md-8">
													<input type="text" class="form-control" placeholder="Enter Document Name">
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Document Address
												<span> * </span>
												</label>
												<div class="col-md-8">
													<textarea class="form-control required uppercase" id="document_address" readonly=""></textarea>
													<span class="help-block">
													</span>
												</div>
												</div>
											</div>
										</div>
									</div>
									</div>
								</div>
								<div class="tab-pane" id="tab4">
									<div class="portlet-body form">
									<div class="form-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
												<label class="col-md-2 control-label">Bill Periode</label>
												<div class="col-md-6">
													<input type="text" class="form-control" placeholder="">
													<span class="help-block">
													</span>
												</div>
												<div class="col-md-4">
													<select class="form-control">
														<option>Default</option>
														<option>Daily</option>
														<option>Weekly</option>
														<option>Monthly</option>
													</select>
													<span class="help-block">
													</span>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Accounting Method</label>
												<div class="col-md-10">
													<select class="form-control">
														<option>Balance Forward</option>
													</select>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Payment Method</label>
												<div class="col-md-10">
													<select class="form-control">
														<option>Normal</option>
													</select>
												</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
												<label class="col-md-2 control-label">Bill Style</label>
												<div class="col-md-8">
													<select class="form-control">
														<option>Normal Billing</option>
													</select>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Bill Handling Code</label>
												<div class="col-md-8">
													<select class="form-control">
														<option>Account Single Billing</option>
														<option>Invoice Detail View</option>
														<option>Invoice Group View</option>
													</select>
												</div>
												</div>
												<div class="form-group">
												<label class="col-md-2 control-label">Credit Class</label>
												<div class="col-md-8">
													<select class="form-control">
														<option>IDR Standard Interface</option>
													</select>
												</div>
												</div>
											</div>
										</div>
									</div>
									</div>
								</div>
								<div class="tab-pane" id="tab5">
									<div class="row">
									<div class="col-md-10">
										<table id="grid-table"></table>
										<div id="grid-pager"></div>
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
	</div>
</div>
<?php $this->load->view('lov/lov_nipnas2.php'); ?>
<script>
	jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";		
		$("#npwp_val").keyup(function(){
			$("#4").find('td').eq('2').html($("#npwp_val").val());
		});
		var additionalInfo = [
		{Attribute_Name: "BUSINESS_AREA", 		Attribute_Value: 5001},
		{Attribute_Name: "BUSINESS_SHARE", 		Attribute_Value: "CC00"},
		{Attribute_Name: "REFERENSI_ACCOUNT", 	Attribute_Value: ""},
		{Attribute_Name: "PREFIX_ACCOUNT",		Attribute_Value: ""},
		{Attribute_Name: "NPWP", 				Attribute_Value: ""},
		{Attribute_Name: "NPPKP", 				Attribute_Value: ""},		
		{Attribute_Name: "BILL2PARTY", 			Attribute_Value: ""},		
		{Attribute_Name: "REGION", 				Attribute_Value: "1"},		
		];
        jQuery("#grid-table").jqGrid({
            // url: '<?php echo WS_JQGRID."administration.permissions_controller/crud"; ?>',
            data: additionalInfo,
			datatype: "local",
            // mtype: "POST",
			colNames:['Attribute Name','Attribute Value'],
            colModel:[
                {name: 'Attribute_Name', index:'Attribute_Name', width: 450, editable: true, hidden: false},
                {name: 'Attribute_Value', index:'Attribute_Value', width: 150, editable: true, hidden: false}                          
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

            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo WS_JQGRID."administration.permissions_controller/crud"; ?>',
            caption: "Additional Informations"

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
		.navButtonAdd('#grid-pager',{
            caption:"Export To Excel",
            buttonicon:"fa fa-file-excel-o green",
            position:"last",
            title: "Export To Excel",
            cursor: "pointer",
            onClickButton: toExcelAccountDetails,
			id :"reset"
		});

		

    });
	
	function toExcelAccountDetails() {
		// alert("Convert to Excel");
        var c = confirm('Export to Excel ?')
        if(c == true){
            var url = "<?php echo base_url();?>Account/excelAccountReport?";
			url += "&npwp_val=" + $('#npwp_val').val();
			// url += "&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
			window.location = url;
        }
    }
	
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
	  $('#acc_name_page1').attr('autocomplete','off');
		$('#btn-lov-nipnas').on('click',function() {
			modal_lov_nipnas_show('nipnas','customer_name');
		});

		$('#btn-lov-accountnum').on('click',function() {
			modal_lov_nipnas_show('account_number','customer_name2');
		});
		
		$('#back-manage-account').on('click', function() {
			loadContentWithParams('account.list_account',{});
		});
		$('#no_transaksi').val('TELKOM-ACC/'+ romanize(<?php echo date("m")?>) +'/'+ <?php echo date("d")?> +'/'+ <?php echo date("y")?> +'-??');
  })
	function romanize(num) {
		var lookup = {M:1000,CM:900,D:500,CD:400,C:100,XC:90,L:50,XL:40,X:10,IX:9,V:5,IV:4,I:1},roman = '',i;
		for ( i in lookup ) {
			while ( num >= lookup[i] ) {
			roman += i;
			num -= lookup[i];
			}
		}
		return roman;
	}	
  $(function (){
		$('#datetimepicker1').datepicker({
			format: 'dd/mm/yyyy'
		});
		$('#datetimepicker2').datepicker({
			format: 'dd/mm/yyyy'
		});
		$('#datetimepicker3').datepicker({
			format: 'dd/mm/yyyy'
		});
  });
  $("#street_name,#block_name,#district,#city_name,#province_name,#phone_number,#zip_code").keyup(function(){
	  $("#document_address").text($("#street_name").val()+" "+$("#block_name").val()
	  +" "+$("#district").val()+" "+$("#city_name").val()+" "+$("#province_name").val()
	  +" "+$("#phone_number").val()+" "+$("#zip_code").val());
  });
  
  $("#acc_name_page1").keyup(function(){
	  // $("#company_name").text($("#acc_name_page1").val());
	  $("#company_name").val($("#acc_name_page1").val());
	  // $("#company_name").val($("#acc_name_page1").text());
  });
  // function update_address_name(){
	  
  // }
</script>
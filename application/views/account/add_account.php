<style>
    input.uppercase {
        text-transform: uppercase;
    }
</style>

<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
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
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-info font-blue"></i>
  					<span class="caption-subject font-blue bold uppercase"> Data Transaksi
  					</span>
                </div>
            </div>
            <form role="form">
                <div class="row">
                    <div class="col-md-3">
                        <div class="col-md-12">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="trx_no" value="TELKOM-ACC/VI/02/16-???"
                                       disabled>
                                <div class="form-control-focus"></div>
                                <label for="form_control_1">Nomor Transaksi</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="form_control_1" readonly
                                       value="<?php echo date('d-m-Y'); ?>">
                                <div class="form-control-focus"></div>
                                <label for="form_control_1">Tanggal Transaksi</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-8">
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="form_control_1"
                                       value="<?php echo strtoupper($this->session->userdata('username')); ?>" readonly>
                                <div class="form-control-focus"></div>
                                <label for="form_control_1">Petugas</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="form_control_1" value="TELKOM" readonly>
                                <div class="form-control-focus"></div>
                                <label for="form_control_1">Lokasi</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="form_control_1" value="NEW TRANSACTION"
                                       readonly>
                                <div class="form-control-focus"></div>
                                <label for="form_control_1">Status</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <span style="color:#ff0000" id="text_AccountNumber"></span>
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
                                <div class="progress-bar progress-bar-success"></div>
                            </div>
                            <div class="tab-content">
                                <div class="alert alert-danger display-none">
                                    <button class="close" data-dismiss="alert"></button>
                                    You have some form errors. Please check below.
                                </div>
                                <div class="alert alert-success display-none">
                                    <button class="close" data-dismiss="alert"></button>
                                    Your form validation is successful!
                                </div>
                                <div class="tab-pane" id="tab1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Nipnas
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control required" id="inNipnas"
                                                               name="inNipnas" placeholder="Nipnas" readonly=""/>
                                                       <span class="input-group-btn">
                                                         <button class="btn btn-success" type="button"
                                                                 id="btn-lov-nipnas">
                                                             <i class="fa fa-search"></i>
                                                         </button>
                                                       </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="hidden" class="form-control" id="customer_name"
                                                           readonly="" placeholder="Customer Name"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Account Name
                                                    <span class="required"> * </span>
                                                </label>

                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required uppercase"
                                                           id="inAccountName"
                                                           name="inAccountName" onkeyup="setCompanyName(this.value)">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Account To Go Live
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required datepicker"
                                                           readonly="" name="inAccountToGoLive">
                                                </div>
                                            </div>
                                            <span class="">
                                                 <input type="hidden" value="22" name="groupId" id="groupId">
                                                 <input type="hidden"
                                                        value="<?php echo $this->session->userdata('user_id'); ?>"
                                                        name="userId" id="userId">
                                                 <input type="hidden"
                                                        value="<?php echo $this->session->userdata('location'); ?>"
                                                        name="locId"
                                                        id="locId">
                                                <input type="hidden"
                                                       name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                                       value="<?php echo
                                                       $this->security->get_csrf_hash(); ?>">
                                                <input type="hidden" name="hinCreditLimitMny" id="hinCreditLimitMny">
                                                <input type="hidden" name="hinPackageDiscAccNum" id="hinPackageDiscAccNum">
                                                <input type="hidden" name="hinEventDiscAccNum" id="hinEventDiscAccNum">
                                                <input type="hidden" name="hinStatementFrequency" id="hinStatementFrequency">
                                                <input type="hidden" name="hinInvoicingCoId" id="hinInvoicingCoId" value="2">
                                                <input type="hidden" name="hinLanguageId" id="hinLanguageId" value="1">
                                                <input type="hidden" name="hinEventsPerDay" id="hinEventsPerDay" value="1000">
                                                <input type="hidden" name="hinCountryId" id="hinCountryId" value="501">
                                                <input type="hidden" name="hinPrepayBoo" id="hinPrepayBoo">

                                            </span>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Contracted Point of Supply
                                                </label>
                                                <div class="col-md-8">
                                                    <?php echo buatcombo('inContractedPointOfSupply',
                                                        'inContractedPointOfSupply',
                                                        'gparams',
                                                        'name',
                                                        'rfid',
                                                        array('rfen' => 'CPS'),
                                                        'N',
                                                        ''
                                                    ); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Tax Status</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="inTaxStatus">
                                                        <option value="F">Tax Exclusive</option>
                                                        <option value="T">Tax Inclusive</option>
                                                    </select>
												<span class="help-block">
												</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Account Currency
                                                </label>
                                                <div class="col-md-8">
                                                    <?php echo buatcombo('inAccountCurrency',
                                                        'inAccountCurrency',
                                                        'gparams',
                                                        'name',
                                                        'code',
                                                        array('rfen' => 'CURRENCY'),
                                                        'N',
                                                        ''
                                                    ); ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4">Information Currency
                                                </label>
                                                <div class="col-md-8">
                                                    <?php echo buatcombo('inInformationCurrency',
                                                        'inInformationCurrency',
                                                        'gparams',
                                                        'name',
                                                        'code',
                                                        array('rfen' => 'CURRENCY'),
                                                        'N',
                                                        ''
                                                    ); ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Next Bill Date
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required datepicker"
                                                           readonly="" name="inNextBillDate" id="inNextBillDate">
												<span class="help-block">
												</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="tab3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Account Number</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="AccountNumber"
                                                           readonly="" name="AccountNumber">
													<span class="help-block">
													</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">First Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required uppercase"
                                                           name="inFirstName" id="inFirstName">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Last Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required uppercase"
                                                           name="inLastName" id="inLastName">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Company Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control uppercase required"
                                                           id="inCompanyName" name="inCompanyName">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">NPWP
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required"
                                                           id="inNPWP" name="inNPWP" onkeyup="setNPWP(this.value)">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Email
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required"
                                                           placeholder="Enter Email Address" name="inEmail"
                                                           id="inEmail">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Mobile Number
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required"
                                                           name="inMobileNumber" id="inMobileNumber">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Contact Type
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <?php echo buatcombo('inContactType',
                                                        'inContactType',
                                                        'gparams',
                                                        'name',
                                                        'rfid',
                                                        array('rfen' => 'CONTACTTYPE'),
                                                        'Y',
                                                        '- Pilih Contact Type -'
                                                    ); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Contact Start Date (mm/dd/yyyy)
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input class="form-control datepicker required" type="text" value=""
                                                           name="inContactStartDate" required>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Street Name
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control required uppercase"
                                                           placeholder="Enter Street Name" id="inStreetName"
                                                           name="inStreetName" value=""
                                                           onkeyup="setDocumentAddr(this.value)">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Block Name</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control uppercase"
                                                           placeholder="Enter Block Name" id="inBlockName"
                                                           name="inBlockName" value=""
                                                           onkeyup="setDocumentAddr(this.value)">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">District Name</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control uppercase"
                                                           placeholder="Enter District Name" id="inDistrictName"
                                                           name="inDistrictName" value=""
                                                           onkeyup="setDocumentAddr(this.value)">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">City</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control uppercase"
                                                           placeholder="Enter text" id="inCity"
                                                           name="inCity"
                                                           value="" onkeyup="setDocumentAddr(this.value)">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Province</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control uppercase"
                                                           placeholder="Enter Province" id="inProvinsi"
                                                           name="inProvinsi" value=""
                                                           onkeyup="setDocumentAddr(this.value)">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Zip Code
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="number" class="form-control required"
                                                           placeholder="Enter ZIP Code" maxlength="5"
                                                           id="inZipCode"
                                                           name="inZipCode" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Document Address
                                                    <span class="required">  * </span>
                                                </label>
                                                <div class="col-md-8">
                                                        <textarea class="form-control required uppercase"
                                                                  id="document_address" name="document_address"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Contact IT</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                           name="inContactIT" id="inContactIT">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Phone Number</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                           name="inITPhoneNumber" id="inITPhoneNumber">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Email</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                           name="inITEmail" id="inITEmail">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Contact Finance</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                           name="inITContactFinance">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Phone Number</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"  name="inFinancePhoneNumber">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Email</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                           name="inFinanceEmail" id="inFinanceEmail">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Contact AM</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                           name="inContactAM">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Phone Number</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                           id="inAMPhoneNumber"
                                                           name="inAMPhoneNumber" value="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Email</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                           name="inAMEmail">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Document Name</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control"
                                                           name="inDocumentName">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Bill Periode</label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" placeholder=""
                                                           name="inBillPeriode" value="1">
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control" name="inSLBillPeriode">
                                                        <option>Default</option>
                                                        <option value="D">Daily</option>
                                                        <option value="W">Weekly</option>
                                                        <option selected="selected" value="M">Monthly</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" name="inAccountingMethod">Accounting
                                                    Method</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="inAccountingMethod">
                                                        <option value="1">Balance Forward</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Payment Method</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="inPaymentMethod">
                                                        <option value="1">Normal</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Bill Style</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="inBillStyle">
                                                        <option value="1">Normal Billing</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Bill Handling Code</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="inBillHandlingCode">
                                                        <option value="SINGLEBILL">Account Single Billing</option>
                                                        <option value="INV_DETAIL" selected>Invoice Detail View</option>
                                                        <option value="INV_GROUP">Invoice Group View</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Credit Class</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="inCreditClass">
                                                        <option value="1">IDR Standard Interface</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="tab5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="grid"></table>
                                            <div id="pager"></div>
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
                                    <button type="submit" class="btn green button-submit"> Submit
                                        <i class="fa fa-check"></i>
                                    </button>
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
<script>
    jQuery(function ($) {
        var grid = $('#grid');
        var pager = $('#pager');

        grid.jqGrid({
            url: '<?php echo WS_JQGRID . "account.account_controller/getAccountAttr"; ?>',
            datatype: "json",
            mtype: "POST",
            colNames: ['Attr ID', 'Attribute Name', 'Attribute Value'],
            colModel: [
                {name: 'attr_id', index: 'attr_id', width: 450, editable: false, hidden: true},
                {name: 'attr_name', index: 'attr_name', width: 450, editable: false, hidden: false},
                {name: 'xs2', index: 'xs2', width: 150, editable: true, hidden: false}
            ],
            height: '100%',
            autowidth: true,
            viewrecords: true,
            rowNum: 10,
            rowList: [10, 20, 50],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            onSelectRow: editRow,
            sortorder: '',
            pager: '#grid-pager',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function (response) {
                if (response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }

            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '',
            caption: "Additional Informations"

        });

        var lastSelection;

        function editRow(id) {
            if (id && id !== lastSelection) {
                grid.jqGrid('restoreRow', lastSelection);
                grid.jqGrid('editRow', id, {keys: true});
                lastSelection = id;
            }
        }

        grid.jqGrid('navGrid', '#pager',
            {   //navbar options
                edit: false,
                excel: false,
                editicon: 'fa fa-pencil blue bigger-120',
                add: false,
                addicon: 'fa fa-plus-circle purple bigger-120',
                del: false,
                delicon: 'fa fa-trash-o red bigger-120',
                search: false,
                searchicon: 'fa fa-search orange bigger-120',
                refresh: false,
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
                closeOnEscape: true,
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
                afterShowForm: function (form) {
                    form.closest('.ui-jqdialog').center();
                },
                afterSubmit: function (response, postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if (response.success == false) {
                        return [false, response.message, response.responseText];
                    }
                    return [true, "", response.responseText];
                }
            },
            {
                //new record form
                closeAfterAdd: false,
                clearAfterAdd: true,
                closeOnEscape: true,
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
                afterShowForm: function (form) {
                    form.closest('.ui-jqdialog').center();
                },
                afterSubmit: function (response, postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if (response.success == false) {
                        return [false, response.message, response.responseText];
                    }

                    $(".tinfo").html('<div class="ui-state-success">' + response.message + '</div>');
                    var tinfoel = $(".tinfo").show();
                    tinfoel.delay(3000).fadeOut();


                    return [true, "", response.responseText];
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
                afterShowForm: function (form) {
                    form.closest('.ui-jqdialog').center();
                },
                onClick: function (e) {
                    //alert(1);
                },
                afterSubmit: function (response, postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if (response.success == false) {
                        return [false, response.message, response.responseText];
                    }
                    return [true, "", response.responseText];
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
            .navButtonAdd('#grid-pager', {
                caption: "Export To Excel",
                buttonicon: "fa fa-file-excel-o green",
                position: "last",
                title: "Export To Excel",
                cursor: "pointer",
                onClickButton: toExcelAccountDetails,
                id: "reset"
            });


    });

    function toExcelAccountDetails() {
        // alert("Convert to Excel");
        var c = confirm('Export to Excel ?')
        if (c == true) {
            var url = "<?php echo base_url();?>Account/excelAccountReport?";
            url += "&npwp_val=" + $('#npwp_val').val();
            // url += "&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
            window.location = url;
        }
    }

    function serializeJSON(postdata) {
        var items;
        if (postdata.oper != 'del') {
            items = JSON.stringify(postdata, function (key, value) {
                if (typeof value === 'function') {
                    return value();
                } else {
                    return value;
                }
            });
        } else {
            items = postdata.id;
        }

        var jsondata = {
            items: items,
            oper: postdata.oper,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        };
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
        $(grid_selector).jqGrid('setGridWidth', $(".page-content").width());
        $(pager_selector).jqGrid('setGridWidth', parent_column.width());

    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#acc_name_page1').attr('autocomplete', 'off');
        $('#btn-lov-nipnas').on('click', function () {
            modal_lov_nipnas_show('inNipnas', 'customer_name');
        });

        $('#btn-lov-accountnum').on('click', function () {
            modal_lov_nipnas_show('account_number', 'customer_name2');
        });

        $('#back-manage-account').on('click', function () {
            loadContentWithParams('account.list_account', {});
        });

        $('.datepicker').datepicker({
            todayHighlight: true,
            format: "mm/dd/yyyy",
            autoclose: true
        });


        var FormWizard = function () {
            return {
                //main function to initiate the module
                init: function () {
                    if (!jQuery().bootstrapWizard) {
                        return;
                    }


                    var form = $('#submit_form');
                    var error = $('.alert-danger', form);
                    var success = $('.alert-success', form);

                    form.validate({
                        doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                        errorElement: 'span', //default input error message container
                        errorClass: 'help-block help-block-error', // default input error message class
                        focusInvalid: false, // do not focus the last invalid input
                        rules: {},

                        messages: { // custom messages for radio buttons and checkboxes
                            'payment[]': {
                                required: "Please select at least one option",
                                minlength: jQuery.validator.format("Please select at least one option")
                            }
                        },

                        errorPlacement: function (error, element) { // render error placement for each input type
                            if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container
                                error.insertAfter("#form_gender_error");
                            } else if (element.attr("name") == "payment[]") { // for uniform checkboxes, insert the after the given container
                                error.insertAfter("#form_payment_error");
                            } else {
                                error.insertAfter(element); // for other inputs, just perform default behavior
                            }
                        },

                        invalidHandler: function (event, validator) { //display error alert on form submit
                            success.hide();
                            error.show();
                            App.scrollTo(error, -200);
                        },

                        highlight: function (element) { // hightlight error inputs
                            $(element)
                                .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                        },

                        unhighlight: function (element) { // revert the change done by hightlight
                            $(element)
                                .closest('.form-group').removeClass('has-error'); // set error class to the control group
                        },

                        success: function (label) {
                            if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                                label
                                    .closest('.form-group').removeClass('has-error').addClass('has-success');
                                label.remove(); // remove error label here
                            } else { // display success icon for other inputs
                                label
                                    .addClass('valid') // mark the current input as valid and display OK icon
                                    .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                            }
                        },

                        submitHandler: function (form) {
                            success.show();
                            error.hide();
                            /*if (form.valid() == true) {
                             alert('tes');
                             return false;
                             form.submit();
                             }*/


                            //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax

                        }

                    });


                    var handleTitle = function (tab, navigation, index) {
                        var total = navigation.find('li').length;
                        var current = index + 1;
                        // set wizard title
                        $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                        // set done steps
                        jQuery('li', $('#form_wizard_1')).removeClass("done");
                        var li_list = navigation.find('li');
                        for (var i = 0; i < index; i++) {
                            jQuery(li_list[i]).addClass("done");
                        }

                        if (current == 1) {
                            $('#form_wizard_1').find('.button-previous').hide();
                        } else {
                            $('#form_wizard_1').find('.button-previous').show();
                        }

                        if (current >= total) {
                            $('#form_wizard_1').find('.button-next').hide();
                            $('#form_wizard_1').find('.button-submit').show();
                        } else {
                            $('#form_wizard_1').find('.button-next').show();
                            $('#form_wizard_1').find('.button-submit').hide();


                            var AccountNumber = $('#AccountNumber').val();
                            var userId = $('#userId').val();
                            var groupId = $('#groupId').val();


                            if (!AccountNumber) {
                                $.ajax({
                                    url: "<?php echo site_url('account/genAccountNumber'); ?>",
                                    type: "POST",
                                    dataType: "json",
                                    data: {},
                                    success: function (data) {
                                        $("#text_AccountNumber").html(data.strMessage);
                                        $("#AccountNumber").val(data.txt_genaccnum);
                                    },
                                    error: function (xhr, status, error) {
                                        swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                                    }
                                });

                            }


                        }
                        //App.scrollTo($('.page-title'));
                    };

                    // default form wizard
                    $('#form_wizard_1').bootstrapWizard({
                        'nextSelector': '.button-next',
                        'previousSelector': '.button-previous',
                        onTabClick: function (tab, navigation, index, clickedIndex) {
                            return false;

                            success.hide();
                            error.hide();
                            if (form.valid() == false) {
                                return false;
                            }

                            handleTitle(tab, navigation, clickedIndex);
                        },
                        onNext: function (tab, navigation, index) {
                            success.hide();
                            error.hide();

                            if (form.valid() == false) {
                                return false;
                            }

                            handleTitle(tab, navigation, index);
                        },
                        onPrevious: function (tab, navigation, index) {
                            success.hide();
                            error.hide();

                            handleTitle(tab, navigation, index);
                        },
                        onTabShow: function (tab, navigation, index) {
                            var total = navigation.find('li').length;
                            var current = index + 1;
                            var $percent = (current / total) * 100;
                            $('#form_wizard_1').find('.progress-bar').css({
                                width: $percent + '%'
                            });
                        }
                    });

                    $('#form_wizard_1').find('.button-previous').hide();
                    $('#form_wizard_1 .button-submit').click(function () {
                        /* if(form.valid() == true){
                         form.submit();
                         }*/
                    }).hide();


                }

            };

        }();

        function getNextBillDTM() {
            $.ajax({
                url: "<?php echo site_url('account/genNextBillDTM'); ?>",
                type: "POST",
                dataType: "json",
                data: {},
                success: function (data) {
                    $("#inNextBillDate").val(data.dat_nextBillDate);
                },
                error: function (xhr, status, error) {
                    swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                }
            });
        }

        function setRegion() {
            var locId = $("#locId").val();
            $.ajax({
                url: "<?php echo site_url('account/setRegion'); ?>",
                type: "POST",
                dataType: "json",
                data: {locId: locId},
                success: function (data) {
                    var rowData = jQuery("#grid").jqGrid('getRowData', 8);
                    rowData.xs2 = data.region;
                    jQuery("#grid").jqGrid('setRowData', 8, rowData);
                },
                error: function (xhr, status, error) {
                    swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                }
            });
        }

        jQuery(document).ready(function () {
            FormWizard.init();
            getNextBillDTM();
            setRegion();
            setval('inAccountCurrency','IDR');
            setval('inInformationCurrency','IDR');
            setval('inContactType','1000001');
           // getRowValue('')

            $('#submit_form').on('submit', (function (e) {
                // Stop form from submitting normally
                e.preventDefault();

                var postData = $('#submit_form').serializeArray(),
                    url = "<?php echo site_url('Account/createAccount');?>";
                var account = getval('AccountNumber');
                var account_attr = getAttrValue(account);
                postData.push({name: "account_attr", value: account_attr});

                // Send the data using post
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "json",
                    data: postData,
                    success: function (data) {
                        if (data.statusCode == "T") {
                            swal('', data.strMessage);
                            loadContentWithParams('account.list_account', {});
                        } else {
                            swal('', data.strMessage);
                        }

                    },
                    error: function (xhr, status, error) {
                        swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                    }
                });
            }));

        });

    });
</script>
<script type="text/javascript">
    function setDocumentAddr() {
        var documentAddr = $("#inStreetName").val() + ' ' + $("#inBlockName").val() + ' ' + $("#inDistrictName").val() + ' ' + $("#inCity").val() + ' ' + $("#inProvinsi").val();
        $("#document_address").val(documentAddr);
    }

    function setCompanyName() {
        var AccountName = $("#inAccountName").val();
        $("#inCompanyName").val(AccountName);
    }

    function getAttrValue(accountnum) {

        var rowdata = jQuery("#grid").jqGrid('getRowData');
        var attrs = '';

        for (var i = 0; i < rowdata.length; i++) {
            attr = '';
            vAttrType = 1;

            attr = accountnum + '|' + rowdata[i].attr_id + '|' + vAttrType + '|' + rowdata[i].xs2 + '|';

            if(attrs != '')
            {
                attrs += '*'+attr;
            }
            else
            {
                attrs += attr;
            }
        }
        return attrs;
    }

    function setNPWP() {
        var npwp = $("#inNPWP").val();
        var rowData = jQuery("#grid").jqGrid('getRowData', 5);
        rowData.xs2 = npwp;
        jQuery("#grid").jqGrid('setRowData', 5, rowData);
    }

</script>